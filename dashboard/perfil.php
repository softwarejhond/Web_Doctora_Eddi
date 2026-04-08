<?php
/**
 * Mi Perfil — Dashboard MEDIC EDDI
 * Permite al usuario ver y editar su información personal.
 */
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../controller/conexion.php';

$fullName  = htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8');
$picture   = htmlspecialchars($_SESSION['picture'], ENT_QUOTES, 'UTF-8');
$rol       = (int)$_SESSION['rol'];
$firstName = explode(' ', $fullName)[0];

$rolNames = [1 => 'Administrador', 2 => 'Doctor', 3 => 'Paciente'];
$rolLabel = isset($rolNames[$rol]) ? $rolNames[$rol] : 'Usuario';

// Obtener datos completos del usuario
$stmt = mysqli_prepare($conn, "SELECT id, username, full_name, email, picture, rol, creation_date FROM users WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil — Doctora Eddi</title>

    <!-- Bootstrap CSS (local) -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Bootstrap Colors -->
    <link href="../css/custom-bootstrap.css?v=2.0" rel="stylesheet">
    <!-- Dashboard CSS -->
    <link href="../css/dashboard.css?v=1.0" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="../node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../img/logos/icono_eddi_claro.png">

    <style>
        .perfil-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .perfil-card {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
            overflow: hidden;
        }

        .perfil-header-section {
            background: linear-gradient(135deg, #5a6b5c 0%, #4a5a4c 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .perfil-avatar-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .perfil-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,.3);
            box-shadow: 0 4px 20px rgba(0,0,0,.2);
        }

        .perfil-avatar-placeholder {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            border: 4px solid rgba(255,255,255,.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 600;
            font-size: 2.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,.2);
        }

        .perfil-avatar-btn {
            position: absolute;
            bottom: 4px;
            right: 4px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #e8e4df;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #5a6b5c;
            font-size: .85rem;
            transition: all .2s;
            box-shadow: 0 2px 8px rgba(0,0,0,.15);
        }

        .perfil-avatar-btn:hover {
            background: #f5f3f0;
            color: #2d332e;
        }

        .perfil-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.8rem;
            font-weight: 400;
            color: #ffffff;
            margin: 0;
        }

        .perfil-name em { font-style: italic; }

        .perfil-role-badge {
            display: inline-block;
            background: rgba(255,255,255,.15);
            color: #ffffff;
            font-size: .75rem;
            font-weight: 600;
            padding: .3rem .8rem;
            border-radius: 2px;
            letter-spacing: .5px;
            text-transform: uppercase;
            margin-top: .5rem;
        }

        .perfil-body {
            padding: 2rem;
        }

        .perfil-section-title {
            font-size: .8rem;
            font-weight: 600;
            color: #8a9a8b;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 1rem;
            padding-bottom: .5rem;
            border-bottom: 1px solid #f0ede9;
        }

        .perfil-field {
            margin-bottom: 1.25rem;
        }

        .perfil-field-label {
            font-size: .75rem;
            font-weight: 600;
            color: #8a9a8b;
            text-transform: uppercase;
            letter-spacing: .3px;
            margin-bottom: .35rem;
        }

        .perfil-field-value {
            font-size: 1rem;
            color: #2d332e;
            font-weight: 500;
        }

        .perfil-field-value i {
            color: #8a9a8b;
            margin-right: .5rem;
            width: 18px;
            text-align: center;
        }

        .perfil-form-group {
            margin-bottom: 1.25rem;
        }

        .perfil-form-group label {
            display: block;
            font-size: .8rem;
            font-weight: 600;
            color: #434f44;
            margin-bottom: .35rem;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .perfil-form-group input {
            width: 100%;
            padding: .6rem .85rem;
            font-size: .9rem;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            color: #2d332e;
            background: #ffffff;
            transition: border-color .2s;
            font-family: 'Inter', sans-serif;
        }

        .perfil-form-group input:focus {
            outline: none;
            border-color: #5a6b5c;
            box-shadow: 0 0 0 3px rgba(90, 107, 92, .1);
        }

        .perfil-form-group input:disabled {
            background: #f5f3f0;
            cursor: not-allowed;
            color: #8a9a8b;
        }

        .perfil-form-group .input-error {
            border-color: #c0392b;
        }

        .perfil-form-group .error-text {
            color: #c0392b;
            font-size: .75rem;
            margin-top: .25rem;
        }

        .perfil-pw-wrapper {
            position: relative;
        }

        .perfil-pw-wrapper input {
            padding-right: 2.5rem;
        }

        .perfil-pw-toggle {
            position: absolute !important;
            right: .5rem !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: none !important;
            border: none !important;
            color: #8a9a8b !important;
            cursor: pointer !important;
            padding: .25rem !important;
            font-size: .85rem !important;
            line-height: 1 !important;
            box-shadow: none !important;
            outline: none !important;
            width: auto !important;
            height: auto !important;
            margin: 0 !important;
            min-width: 0 !important;
        }

        .perfil-pw-toggle:hover { color: #5a6b5c !important; }

        .btn-perfil-save {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .65rem 1.5rem;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: .3px;
            text-transform: uppercase;
            border: 1px solid #5a6b5c;
            border-radius: 2px;
            background: #5a6b5c;
            color: #ffffff;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-perfil-save:hover {
            background: #4a5a4c;
            border-color: #4a5a4c;
            color: #ffffff;
        }

        .perfil-info-row {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: .75rem 0;
            border-bottom: 1px solid #f5f3f0;
        }

        .perfil-info-row:last-child { border-bottom: none; }

        .perfil-info-icon {
            width: 40px;
            height: 40px;
            border-radius: 2px;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5a6b5c;
            font-size: .9rem;
            flex-shrink: 0;
        }

        /* Hidden file input */
        #avatarFileInput { display: none; }

        @media (max-width: 576px) {
            .perfil-header-section { padding: 1.5rem 1rem; }
            .perfil-avatar, .perfil-avatar-placeholder { width: 90px; height: 90px; }
            .perfil-avatar-placeholder { font-size: 2rem; }
            .perfil-name { font-size: 1.4rem; }
            .perfil-body { padding: 1.25rem; }
        }
    </style>
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <input type="file" id="avatarFileInput" accept=".jpg,.jpeg,.png,.gif">

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container">
            <div class="perfil-container">

                <div class="perfil-card mb-4">
                    <!-- Cabecera con avatar -->
                    <div class="perfil-header-section">
                        <div class="perfil-avatar-wrapper">
                            <?php if ($user['picture'] && $user['picture'] !== 'default.png' && file_exists(__DIR__ . '/../img/profiles/' . $user['picture'])): ?>
                                <img src="../img/profiles/<?php echo htmlspecialchars($user['picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto de perfil" class="perfil-avatar" id="perfilAvatarImg">
                            <?php else: ?>
                                <div class="perfil-avatar-placeholder" id="perfilAvatarPlaceholder"><?php echo mb_substr($user['full_name'], 0, 1, 'UTF-8'); ?></div>
                            <?php endif; ?>
                            <button class="perfil-avatar-btn" id="btnChangeAvatar" title="Cambiar foto de perfil">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h2 class="perfil-name"><?php echo htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <div class="perfil-role-badge"><?php echo $rolLabel; ?></div>
                    </div>

                    <!-- Información de cuenta -->
                    <div class="perfil-body">
                        <div class="perfil-section-title"><i class="fas fa-id-card me-2"></i>Información de la cuenta</div>

                        <div class="perfil-info-row">
                            <div class="perfil-info-icon"><i class="fas fa-fingerprint"></i></div>
                            <div>
                                <div class="perfil-field-label">Cédula</div>
                                <div class="perfil-field-value"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>
                        </div>

                        <div class="perfil-info-row">
                            <div class="perfil-info-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div class="perfil-field-label">Correo electrónico</div>
                                <div class="perfil-field-value" id="displayEmail"><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>
                        </div>

                        <div class="perfil-info-row">
                            <div class="perfil-info-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <div class="perfil-field-label">Rol</div>
                                <div class="perfil-field-value"><?php echo $rolLabel; ?></div>
                            </div>
                        </div>

                        <div class="perfil-info-row">
                            <div class="perfil-info-icon"><i class="fas fa-calendar-plus"></i></div>
                            <div>
                                <div class="perfil-field-label">Miembro desde</div>
                                <div class="perfil-field-value"><?php echo date('d/m/Y', strtotime($user['creation_date'])); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de edición -->
                <div class="perfil-card">
                    <div class="perfil-body">
                        <div class="perfil-section-title"><i class="fas fa-pen me-2"></i>Editar perfil</div>

                        <form id="perfilForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="perfil-form-group">
                                        <label for="perfil-cedula">Cédula</label>
                                        <input type="text" id="perfil-cedula" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="perfil-form-group">
                                        <label for="perfil-fullname">Nombre Completo</label>
                                        <input type="text" id="perfil-fullname" value="<?php echo htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8'); ?>" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="perfil-form-group">
                                        <label for="perfil-email">Correo Electrónico</label>
                                        <input type="email" id="perfil-email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>" maxlength="150">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="perfil-form-group">
                                        <label for="perfil-password">Nueva Contraseña <small style="color:#8a9a8b;font-weight:400;text-transform:none;">(dejar vacío para no cambiar)</small></label>
                                        <div class="perfil-pw-wrapper">
                                            <input type="password" id="perfil-password" placeholder="Nueva contraseña" maxlength="100">
                                            <button type="button" class="perfil-pw-toggle" onclick="togglePerfilPw('perfil-password', this)" title="Ver contraseña">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="swal-pw-hint" style="margin-top:.3rem;">Mínimo 8 caracteres: 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-2">
                                <button type="submit" class="btn-perfil-save">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../components/dash/footer.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script>
    (function() {
        'use strict';

        // ── Cambiar avatar ──
        var btnAvatar = document.getElementById('btnChangeAvatar');
        var fileInput = document.getElementById('avatarFileInput');

        btnAvatar.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            if (!this.files || !this.files[0]) return;

            var file = this.files[0];
            var allowed = ['image/jpeg', 'image/png', 'image/gif'];
            if (allowed.indexOf(file.type) === -1) {
                Swal.fire({ icon: 'error', title: 'Formato no válido', text: 'Solo se permiten imágenes JPG, PNG y GIF.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                this.value = '';
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({ icon: 'error', title: 'Archivo muy grande', text: 'La imagen no debe superar los 5 MB.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                this.value = '';
                return;
            }

            // Subir foto inmediatamente
            var formData = new FormData();
            formData.append('action', 'update');
            formData.append('full_name', document.getElementById('perfil-fullname').value.trim());
            formData.append('email', document.getElementById('perfil-email').value.trim());
            formData.append('picture', file);

            fetch('../controller/perfil.php', { method: 'POST', body: formData })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Foto actualizada!',
                            text: 'Tu foto de perfil ha sido cambiada.',
                            confirmButtonColor: '#5a6b5c',
                            customClass: { popup: 'swal-custom' }
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                    }
                })
                .catch(function() {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                });

            this.value = '';
        });

        // ── Formulario de edición ──
        var form = document.getElementById('perfilForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Limpiar errores
            document.querySelectorAll('.perfil-form-group .input-error').forEach(function(el) { el.classList.remove('input-error'); });
            document.querySelectorAll('.perfil-form-group .error-text').forEach(function(el) { el.remove(); });

            var fullname = document.getElementById('perfil-fullname').value.trim();
            var email    = document.getElementById('perfil-email').value.trim();
            var password = document.getElementById('perfil-password').value;

            var errors = [];
            function markError(id, msg) {
                var input = document.getElementById(id);
                input.classList.add('input-error');
                var err = document.createElement('div');
                err.className = 'error-text';
                err.textContent = msg;
                input.closest('.perfil-form-group').appendChild(err);
            }

            if (!fullname || fullname.length < 3) { markError('perfil-fullname', 'Nombre requerido (mínimo 3 caracteres)'); errors.push(true); }
            var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRe.test(email)) { markError('perfil-email', 'Correo electrónico inválido'); errors.push(true); }

            if (password) {
                var pwRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]).{8,}$/;
                if (!pwRe.test(password)) { markError('perfil-password', 'No cumple los requisitos de seguridad'); errors.push(true); }
            }

            if (errors.length > 0) return;

            var formData = new FormData();
            formData.append('action', 'update');
            formData.append('full_name', fullname);
            formData.append('email', email);
            if (password) formData.append('password', password);

            // Deshabilitar botón
            var btn = form.querySelector('.btn-perfil-save');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';

            fetch('../controller/perfil.php', { method: 'POST', body: formData })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-save"></i> Guardar Cambios';

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Perfil actualizado!',
                            text: data.message,
                            confirmButtonColor: '#5a6b5c',
                            customClass: { popup: 'swal-custom' }
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                    }
                })
                .catch(function() {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-save"></i> Guardar Cambios';
                    Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                });
        });
    })();

    function togglePerfilPw(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
    </script>
</body>
</html>
