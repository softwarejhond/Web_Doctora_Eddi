<?php
/**
 * Controlador de Autenticación — MEDIC EDDI
 * Maneja login y logout vía AJAX.
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';

$response = ['success' => false, 'message' => 'Acción no válida.'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'login') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validación básica
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Validar que username sea numérico (cédula)
    if (!ctype_digit($username)) {
        echo json_encode(['success' => false, 'message' => 'La cédula debe contener solo números.']);
        exit;
    }

    // Buscar usuario con prepared statement
    $stmt = mysqli_prepare($conn, "SELECT id, username, full_name, email, password, picture, rol, active FROM users WHERE username = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verificar si está activo
        if ((int)$row['active'] !== 1) {
            echo json_encode(['success' => false, 'message' => 'Su cuenta se encuentra deshabilitada. Contacte al administrador.']);
            mysqli_stmt_close($stmt);
            exit;
        }

        // Verificar contraseña
        if (password_verify($password, $row['password'])) {
            // Regenerar ID de sesión para prevenir session fixation
            session_regenerate_id(true);

            $_SESSION['user_id']    = $row['id'];
            $_SESSION['username']   = $row['username'];
            $_SESSION['full_name']  = $row['full_name'];
            $_SESSION['email']      = $row['email'];
            $_SESSION['picture']    = $row['picture'];
            $_SESSION['rol']        = (int)$row['rol'];
            $_SESSION['logged_in']  = true;

            $response = [
                'success'  => true,
                'message'  => 'Inicio de sesión exitoso.',
                'redirect' => 'dashboard/'
            ];
        } else {
            $response = ['success' => false, 'message' => 'Cédula o contraseña incorrectos.'];
        }
    } else {
        // Mensaje genérico para no revelar si el usuario existe
        $response = ['success' => false, 'message' => 'Cédula o contraseña incorrectos.'];
    }

    mysqli_stmt_close($stmt);
}

// ── Crear usuario (solo admins) ──
if ($action === 'create_user') {
    // Verificar que el usuario actual sea administrador
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || (int)$_SESSION['rol'] !== 1) {
        echo json_encode(['success' => false, 'message' => 'No tiene permisos para esta acción.']);
        exit;
    }

    $username  = isset($_POST['username']) ? trim($_POST['username']) : '';
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email     = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password  = isset($_POST['password']) ? $_POST['password'] : '';
    $rol       = isset($_POST['rol']) ? (int)$_POST['rol'] : 3;

    // Validaciones
    if (empty($username) || empty($full_name) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if (!preg_match('/^\d{5,15}$/', $username)) {
        echo json_encode(['success' => false, 'message' => 'La cédula debe contener solo números (5-15 dígitos).']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    // Validar contraseña alfanumérica segura
    if (strlen($password) < 8 ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[^a-zA-Z0-9]/', $password)) {
        echo json_encode(['success' => false, 'message' => 'La contraseña debe tener mínimo 8 caracteres con mayúscula, minúscula, número y carácter especial.']);
        exit;
    }

    // Validar rol válido
    if (!in_array($rol, [1, 2, 3])) {
        $rol = 3;
    }

    // Verificar duplicados (cédula o correo)
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => false, 'message' => 'Ya existe un usuario con esa cédula o correo electrónico.']);
        mysqli_stmt_close($stmt);
        exit;
    }
    mysqli_stmt_close($stmt);

    // Hashear contraseña
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Manejo de foto de perfil
    $pictureName = 'default.png';
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

        $pictureName = $username . '_' . date('Ymd_His') . '.' . $ext;
        $destPath = __DIR__ . '/../img/profiles/' . $pictureName;

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
            exit;
        }
    }

    // Insertar usuario
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, full_name, email, password, picture, rol, active) VALUES (?, ?, ?, ?, ?, ?, 1)");
    mysqli_stmt_bind_param($stmt, 'sssssi', $username, $full_name, $email, $hashed, $pictureName, $rol);

    if (mysqli_stmt_execute($stmt)) {
        $response = ['success' => true, 'message' => 'Usuario creado exitosamente.'];
    } else {
        $response = ['success' => false, 'message' => 'Error al crear el usuario. Intente de nuevo.'];
    }
    mysqli_stmt_close($stmt);
}

echo json_encode($response);
