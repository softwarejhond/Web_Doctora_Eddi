<?php
/**
 * Controlador de Perfil — MEDIC EDDI
 * Permite al usuario logueado ver y actualizar su propio perfil.
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

// Verificar sesión activa
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Sesión no válida.']);
    exit;
}

$userId = (int)$_SESSION['user_id'];
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// ── Obtener datos del perfil ──
if ($action === 'get' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = mysqli_prepare($conn, "SELECT id, username, full_name, email, picture, rol, active, creation_date FROM users WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'i', $userId);
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

// ── Actualizar perfil ──
if ($action === 'update') {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email     = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password  = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($full_name) || mb_strlen($full_name) < 3) {
        echo json_encode(['success' => false, 'message' => 'El nombre debe tener al menos 3 caracteres.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    // Verificar email duplicado (excluyendo usuario actual)
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'si', $email, $userId);
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

        // Obtener datos actuales
        $stmtU = mysqli_prepare($conn, "SELECT username, picture FROM users WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmtU, 'i', $userId);
        mysqli_stmt_execute($stmtU);
        $resU = mysqli_stmt_get_result($stmtU);
        $rowU = mysqli_fetch_assoc($resU);
        mysqli_stmt_close($stmtU);

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
    $fields = ['full_name = ?', 'email = ?'];
    $types  = 'ss';
    $params = [$full_name, $email];

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
    $params[] = $userId;

    $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    if (mysqli_stmt_execute($stmt)) {
        // Actualizar datos de sesión
        $_SESSION['full_name'] = $full_name;
        $_SESSION['email']     = $email;
        if ($pictureName !== null) {
            $_SESSION['picture'] = $pictureName;
        }

        echo json_encode(['success' => true, 'message' => 'Perfil actualizado exitosamente.', 'picture' => $pictureName]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
