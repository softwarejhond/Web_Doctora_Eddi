<?php
/**
 * Controlador de Usuarios — MEDIC EDDI
 * CRUD de usuarios vía AJAX (solo admin).
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

// Verificar sesión y rol admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || (int)$_SESSION['rol'] !== 1) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'No tiene permisos para esta acción.']);
    exit;
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// ── Listar usuarios ──
if ($action === 'list' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = mysqli_prepare($conn, "SELECT id, username, full_name, email, picture, rol, active, creation_date, update_date FROM users ORDER BY id DESC");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    mysqli_stmt_close($stmt);

    echo json_encode(['success' => true, 'data' => $users]);
    exit;
}

// ── Obtener un usuario ──
if ($action === 'get' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
        exit;
    }

    $stmt = mysqli_prepare($conn, "SELECT id, username, full_name, email, picture, rol, active FROM users WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        exit;
    }

    echo json_encode(['success' => true, 'data' => $user]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

// ── Editar usuario ──
if ($action === 'update') {
    $id        = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email     = isset($_POST['email']) ? trim($_POST['email']) : '';
    $rol       = isset($_POST['rol']) ? (int)$_POST['rol'] : 0;
    $password  = isset($_POST['password']) ? $_POST['password'] : '';

    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
        exit;
    }

    if (empty($full_name) || mb_strlen($full_name) < 3) {
        echo json_encode(['success' => false, 'message' => 'El nombre debe tener al menos 3 caracteres.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    if (!in_array($rol, [1, 2, 3])) {
        echo json_encode(['success' => false, 'message' => 'Rol no válido.']);
        exit;
    }

    // Verificar email duplicado (excluyendo usuario actual)
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'si', $email, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Ya existe otro usuario con ese correo electrónico.']);
        mysqli_stmt_close($stmt);
        exit;
    }
    mysqli_stmt_close($stmt);

    // Validar contraseña si se envía
    if (!empty($password)) {
        if (strlen($password) < 8 ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^a-zA-Z0-9]/', $password)) {
            echo json_encode(['success' => false, 'message' => 'La contraseña debe tener mínimo 8 caracteres con mayúscula, minúscula, número y carácter especial.']);
            exit;
        }
    }

    // Manejo de foto de perfil
    $pictureName = null;
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $allowedExts  = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = mime_content_type($_FILES['picture']['tmp_name']);
        $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes) || !in_array($ext, $allowedExts)) {
            echo json_encode(['success' => false, 'message' => 'Formato de imagen no permitido. Solo JPG, PNG y GIF.']);
            exit;
        }
        if ($_FILES['picture']['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'La imagen no debe superar los 5 MB.']);
            exit;
        }

        // Obtener username del usuario para nombrar el archivo
        $stmtU = mysqli_prepare($conn, "SELECT username, picture FROM users WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmtU, 'i', $id);
        mysqli_stmt_execute($stmtU);
        $resU = mysqli_stmt_get_result($stmtU);
        $rowU = mysqli_fetch_assoc($resU);
        mysqli_stmt_close($stmtU);

        if (!$rowU) {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
            exit;
        }

        // Eliminar foto anterior si no es default
        if ($rowU['picture'] && $rowU['picture'] !== 'default.png') {
            $oldPath = __DIR__ . '/../img/profiles/' . $rowU['picture'];
            if (file_exists($oldPath)) unlink($oldPath);
        }

        $pictureName = $rowU['username'] . '_' . date('Ymd_His') . '.' . $ext;
        $destPath = __DIR__ . '/../img/profiles/' . $pictureName;

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
            exit;
        }
    }

    // Construir query dinámicamente
    $fields = ['full_name = ?', 'email = ?', 'rol = ?'];
    $types  = 'ssi';
    $params = [$full_name, $email, $rol];

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $fields[] = 'password = ?';
        $types .= 's';
        $params[] = $hashed;
    }

    if ($pictureName !== null) {
        $fields[] = 'picture = ?';
        $types .= 's';
        $params[] = $pictureName;
    }

    $types .= 'i';
    $params[] = $id;

    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// ── Cambiar estado (activar/desactivar) ──
if ($action === 'toggle_status') {
    $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $active = isset($_POST['active']) ? (int)$_POST['active'] : -1;

    if ($id <= 0 || !in_array($active, [0, 1])) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit;
    }

    // No permitir desactivarse a sí mismo
    if ($id === (int)$_SESSION['user_id'] && $active === 0) {
        echo json_encode(['success' => false, 'message' => 'No puede desactivar su propia cuenta.']);
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE users SET active = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $active, $id);

    if (mysqli_stmt_execute($stmt)) {
        $label = $active === 1 ? 'activado' : 'desactivado';
        echo json_encode(['success' => true, 'message' => "Usuario {$label} exitosamente."]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cambiar el estado del usuario.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
