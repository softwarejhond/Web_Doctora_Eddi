<?php
/**
 * Controlador de Anuncios / Popups — MEDIC EDDI
 * Requiere sesión activa con rol 1 (Administrador).
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

header('Content-Type: application/json; charset=UTF-8');

// ── Seguridad ────────────────────────────────────────────────────────────────
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || (int)$_SESSION['rol'] !== 1) {
    http_response_code(403);
    echo json_encode(['ok' => false, 'msg' => 'Acceso denegado']);
    exit;
}

require_once __DIR__ . '/conexion.php';

$action = isset($_POST['action']) ? trim($_POST['action']) : (isset($_GET['action']) ? trim($_GET['action']) : '');

// ── Helpers ──────────────────────────────────────────────────────────────────
function jsonOk(array $data = []): void {
    echo json_encode(array_merge(['ok' => true], $data));
    exit;
}

function jsonErr(string $msg, int $code = 400): void {
    http_response_code($code);
    echo json_encode(['ok' => false, 'msg' => $msg]);
    exit;
}

function sanitizePhone(string $phone): string {
    return preg_replace('/[^0-9]/', '', $phone);
}

/**
 * Guarda una imagen subida y devuelve el nombre del archivo guardado.
 * Devuelve null si no se subió ningún archivo.
 */
function saveUploadedImage(string $inputName): ?string {
    if (empty($_FILES[$inputName]['tmp_name'])) return null;

    $file   = $_FILES[$inputName];
    $maxSz  = 5 * 1024 * 1024; // 5 MB
    $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        jsonErr('Error al subir el archivo (código ' . $file['error'] . ')');
    }

    // Validar por MIME real (no solo extensión)
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowed, true)) {
        jsonErr('Solo se permiten imágenes JPEG, PNG, WEBP o GIF.');
    }

    if ($file['size'] > $maxSz) {
        jsonErr('La imagen no puede superar los 5 MB.');
    }

    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $safeName = 'anuncio_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . strtolower($ext);
    $dest     = __DIR__ . '/../img/anuncios/' . $safeName;

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        jsonErr('No se pudo guardar la imagen en el servidor.');
    }

    return $safeName;
}

// ── Acciones ─────────────────────────────────────────────────────────────────
switch ($action) {

    // ── Listar todos los anuncios ────────────────────────────────────────────
    case 'list':
        $stmt = $conn->prepare(
            'SELECT a.*, u.full_name AS creador
               FROM anuncios a
               LEFT JOIN users u ON u.id = a.created_by
              ORDER BY a.creation_date DESC'
        );
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        jsonOk(['data' => $rows]);

    // ── Crear nuevo anuncio ──────────────────────────────────────────────────
    case 'create':
        $titulo      = trim($_POST['titulo']      ?? '');
        $wa_numero   = sanitizePhone($_POST['wa_numero']   ?? '');
        $wa_mensaje  = trim($_POST['wa_mensaje']  ?? '');
        $texto_boton = trim($_POST['texto_boton'] ?? 'Quiero este tratamiento');
        $fecha_inicio = trim($_POST['fecha_inicio'] ?? '');
        $fecha_fin    = trim($_POST['fecha_fin']    ?? '');
        $delay_ms    = max(0, (int)($_POST['delay_ms'] ?? 1400));
        $activo      = isset($_POST['activo']) && $_POST['activo'] === '1' ? 1 : 0;
        $created_by  = (int)($_SESSION['user_id'] ?? 0) ?: null;

        if (!$titulo || !$wa_numero || !$wa_mensaje || !$fecha_inicio || !$fecha_fin) {
            jsonErr('Faltan campos obligatorios.');
        }
        if ($fecha_fin < $fecha_inicio) {
            jsonErr('La fecha fin debe ser igual o posterior a la fecha inicio.');
        }

        // Imagen: archivo subido o URL externa
        $imagen = saveUploadedImage('imagen_file');
        if (!$imagen) {
            $imagen = trim($_POST['imagen_url'] ?? '');
        }
        if (!$imagen) {
            jsonErr('Debes proporcionar una imagen (archivo o URL).');
        }

        $stmt = $conn->prepare(
            'INSERT INTO anuncios (titulo, imagen, wa_numero, wa_mensaje, texto_boton,
                                   fecha_inicio, fecha_fin, delay_ms, activo, created_by)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssssssiis',
            $titulo, $imagen, $wa_numero, $wa_mensaje, $texto_boton,
            $fecha_inicio, $fecha_fin, $delay_ms, $activo, $created_by
        );
        if (!$stmt->execute()) {
            jsonErr('Error al guardar: ' . $stmt->error, 500);
        }
        $newId = (int)$stmt->insert_id;
        $stmt->close();
        jsonOk(['id' => $newId, 'msg' => 'Anuncio creado correctamente.']);

    // ── Actualizar anuncio ───────────────────────────────────────────────────
    case 'update':
        $id          = (int)($_POST['id'] ?? 0);
        $titulo      = trim($_POST['titulo']      ?? '');
        $wa_numero   = sanitizePhone($_POST['wa_numero']   ?? '');
        $wa_mensaje  = trim($_POST['wa_mensaje']  ?? '');
        $texto_boton = trim($_POST['texto_boton'] ?? 'Quiero este tratamiento');
        $fecha_inicio = trim($_POST['fecha_inicio'] ?? '');
        $fecha_fin    = trim($_POST['fecha_fin']    ?? '');
        $delay_ms    = max(0, (int)($_POST['delay_ms'] ?? 1400));
        $activo      = isset($_POST['activo']) && $_POST['activo'] === '1' ? 1 : 0;

        if (!$id || !$titulo || !$wa_numero || !$wa_mensaje || !$fecha_inicio || !$fecha_fin) {
            jsonErr('Faltan campos obligatorios.');
        }
        if ($fecha_fin < $fecha_inicio) {
            jsonErr('La fecha fin debe ser igual o posterior a la fecha inicio.');
        }

        // Buscar imagen actual
        $stmtImg = $conn->prepare('SELECT imagen FROM anuncios WHERE id = ?');
        $stmtImg->bind_param('i', $id);
        $stmtImg->execute();
        $imgRow = $stmtImg->get_result()->fetch_assoc();
        $stmtImg->close();
        if (!$imgRow) jsonErr('Anuncio no encontrado.', 404);

        $imagen = saveUploadedImage('imagen_file');
        if (!$imagen) {
            $urlNueva = trim($_POST['imagen_url'] ?? '');
            $imagen   = $urlNueva ?: $imgRow['imagen']; // conservar la anterior si no se envía nueva
        } else {
            // Borrar imagen antigua si era un archivo local
            $oldFile = __DIR__ . '/../img/anuncios/' . $imgRow['imagen'];
            if (file_exists($oldFile) && strpos($imgRow['imagen'], 'anuncio_') === 0) {
                @unlink($oldFile);
            }
        }

        $stmt = $conn->prepare(
            'UPDATE anuncios
                SET titulo=?, imagen=?, wa_numero=?, wa_mensaje=?, texto_boton=?,
                    fecha_inicio=?, fecha_fin=?, delay_ms=?, activo=?
              WHERE id=?'
        );
        // s×7 (strings) + i×3 (delay_ms, activo, id)
        $stmt->bind_param('sssssssiii',
            $titulo, $imagen, $wa_numero, $wa_mensaje, $texto_boton,
            $fecha_inicio, $fecha_fin, $delay_ms, $activo, $id
        );
        if (!$stmt->execute()) {
            jsonErr('Error al actualizar: ' . $stmt->error, 500);
        }
        $stmt->close();
        jsonOk(['msg' => 'Anuncio actualizado correctamente.']);

    // ── Activar / Desactivar ─────────────────────────────────────────────────
    case 'toggle':
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) jsonErr('ID inválido.');

        $stmt = $conn->prepare('UPDATE anuncios SET activo = 1 - activo WHERE id = ?');
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) jsonErr('Error al cambiar estado.', 500);
        $stmt->close();

        // Devolver nuevo estado
        $stmt2 = $conn->prepare('SELECT activo FROM anuncios WHERE id = ?');
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $row = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        jsonOk(['activo' => (int)$row['activo']]);

    // ── Eliminar anuncio ─────────────────────────────────────────────────────
    case 'delete':
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) jsonErr('ID inválido.');

        // Recuperar imagen para borrarla del disco
        $stmtImg = $conn->prepare('SELECT imagen FROM anuncios WHERE id = ?');
        $stmtImg->bind_param('i', $id);
        $stmtImg->execute();
        $imgRow = $stmtImg->get_result()->fetch_assoc();
        $stmtImg->close();

        $stmt = $conn->prepare('DELETE FROM anuncios WHERE id = ?');
        $stmt->bind_param('i', $id);
        if (!$stmt->execute()) jsonErr('Error al eliminar.', 500);
        $stmt->close();

        // Borrar imagen local si existe
        if ($imgRow && strpos($imgRow['imagen'], 'anuncio_') === 0) {
            $path = __DIR__ . '/../img/anuncios/' . $imgRow['imagen'];
            if (file_exists($path)) @unlink($path);
        }
        jsonOk(['msg' => 'Anuncio eliminado.']);

    default:
        jsonErr('Acción no reconocida.', 400);
}
