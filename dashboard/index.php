<?php
/**
 * Dashboard — DOCTORA EDDI
 * Panel principal post-login.
 */
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../controller/conexion.php';

$fullName  = htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8');
$picture   = htmlspecialchars($_SESSION['picture'], ENT_QUOTES, 'UTF-8');
$rol       = (int)$_SESSION['rol'];
$firstName = explode(' ', $fullName)[0];

$rolNames = [1 => 'Administrador', 2 => 'Doctor', 3 => 'Paciente'];
$rolLabel = isset($rolNames[$rol]) ? $rolNames[$rol] : 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Doctora Eddi</title>

    <!-- Bootstrap CSS (local) -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Bootstrap Colors -->
    <link href="../css/custom-bootstrap.css?v=2.0" rel="stylesheet">
    <!-- Dashboard CSS -->
    <link href="../css/dashboard.css?v=1.0" rel="stylesheet">
    <!-- SweetAlert2 CSS (local) -->
    <link href="../node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../img/logos/icono_eddi_claro.png">
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container">
            <!-- Bienvenida -->
            <div class="dash-welcome-card mb-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h1 class="dash-welcome-title">Bienvenido, <em><?php echo $firstName; ?></em></h1>
                        <p class="text-muted mb-0" style="font-size:.95rem;">Panel de gestión — <?php echo $rolLabel; ?></p>
                    </div>
                    <div class="text-end text-muted" style="font-size:.85rem;">
                        <i class="fas fa-calendar-day me-1"></i>
                        <?php echo date('d/m/Y'); ?>
                    </div>
                </div>
            </div>

            <!-- Stats rápidos -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="dash-stat-number">0</div>
                        <div class="dash-stat-label">Citas Hoy</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-user-injured"></i></div>
                        <div class="dash-stat-number">0</div>
                        <div class="dash-stat-label">Pacientes</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-notes-medical"></i></div>
                        <div class="dash-stat-number">0</div>
                        <div class="dash-stat-label">Consultas Mes</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-bell"></i></div>
                        <div class="dash-stat-number">0</div>
                        <div class="dash-stat-label">Notificaciones</div>
                    </div>
                </div>
            </div>

            <!-- Contenido placeholder -->
            <div class="dash-welcome-card">
                <div class="text-center py-5">
                    <i class="fas fa-stethoscope fa-3x mb-3" style="color: #c4cec6;"></i>
                    <h4 style="color: #6b726d; font-weight: 400;">Módulos en desarrollo</h4>
                    <p class="text-muted">Las funcionalidades del dashboard serán habilitadas próximamente.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script>
    (function() {
        'use strict';

        // ── Crear Usuario con SweetAlert2 ──
        var createUserBtn = document.getElementById('btnCreateUser');
        if (createUserBtn) {
            createUserBtn.addEventListener('click', function() {
                // Cerrar sidebar si está abierto
                var sidebar = document.getElementById('dashSidebar');
                var overlay = document.getElementById('sidebarOverlay');
                if (sidebar) sidebar.classList.remove('open');
                if (overlay) overlay.classList.remove('active');

                Swal.fire({
                    title: '<i class="fas fa-user-plus" style="color:#5a6b5c;margin-right:.5rem;"></i>Crear Usuario',
                    html: `
                        <div style="padding: 0 .5rem;">
                            <div class="swal-input-group">
                                <label for="swal-username">Cédula</label>
                                <input type="text" id="swal-username" placeholder="Ej: 1234567890" maxlength="15" inputmode="numeric">
                            </div>
                            <div class="swal-input-group">
                                <label for="swal-fullname">Nombre Completo</label>
                                <input type="text" id="swal-fullname" placeholder="Nombre y Apellidos" maxlength="200">
                            </div>
                            <div class="swal-input-group">
                                <label for="swal-email">Correo Electrónico</label>
                                <input type="email" id="swal-email" placeholder="correo@ejemplo.com" maxlength="150">
                            </div>
                            <div class="swal-input-group">
                                <label for="swal-password">Contraseña</label>
                                <input type="password" id="swal-password" placeholder="Contraseña segura" maxlength="100">
                                <div class="swal-pw-hint">Mínimo 8 caracteres: al menos 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.</div>
                            </div>
                            <div class="swal-input-group">
                                <label for="swal-password2">Confirmar Contraseña</label>
                                <input type="password" id="swal-password2" placeholder="Repita la contraseña" maxlength="100">
                            </div>
                            <div class="swal-input-group">
                                <label for="swal-rol">Rol</label>
                                <select id="swal-rol">
                                    <option value="3">Paciente</option>
                                    <option value="2">Doctor</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                    `,
                    customClass: { popup: 'swal-custom' },
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check me-1"></i>Crear',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#5a6b5c',
                    cancelButtonColor: '#8a9a8b',
                    focusConfirm: false,
                    width: 480,
                    preConfirm: function() {
                        const username  = document.getElementById('swal-username').value.trim();
                        const fullname  = document.getElementById('swal-fullname').value.trim();
                        const email     = document.getElementById('swal-email').value.trim();
                        const password  = document.getElementById('swal-password').value;
                        const password2 = document.getElementById('swal-password2').value;
                        const rol       = document.getElementById('swal-rol').value;

                        // Limpiar errores previos
                        document.querySelectorAll('.swal-input-group .input-error').forEach(function(el) {
                            el.classList.remove('input-error');
                        });
                        document.querySelectorAll('.swal-input-group .error-text').forEach(function(el) {
                            el.remove();
                        });

                        var errors = [];

                        function markError(id, msg) {
                            var input = document.getElementById(id);
                            input.classList.add('input-error');
                            var err = document.createElement('div');
                            err.className = 'error-text';
                            err.textContent = msg;
                            input.parentNode.appendChild(err);
                        }

                        if (!username || !/^\d{5,15}$/.test(username)) {
                            markError('swal-username', 'Cédula inválida (solo números, 5-15 dígitos)');
                            errors.push(true);
                        }

                        if (!fullname || fullname.length < 3) {
                            markError('swal-fullname', 'Nombre requerido (mínimo 3 caracteres)');
                            errors.push(true);
                        }

                        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!email || !emailRe.test(email)) {
                            markError('swal-email', 'Correo electrónico inválido');
                            errors.push(true);
                        }

                        // Validación alfanumérica: mayúscula, minúscula, número, carácter especial, mín 8
                        var pwRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]).{8,}$/;
                        if (!password || !pwRe.test(password)) {
                            markError('swal-password', 'No cumple los requisitos de seguridad');
                            errors.push(true);
                        }

                        if (password !== password2) {
                            markError('swal-password2', 'Las contraseñas no coinciden');
                            errors.push(true);
                        }

                        if (errors.length > 0) {
                            return false;
                        }

                        // Enviar al servidor
                        var formData = new FormData();
                        formData.append('action', 'create_user');
                        formData.append('username', username);
                        formData.append('full_name', fullname);
                        formData.append('email', email);
                        formData.append('password', password);
                        formData.append('rol', rol);

                        return fetch('../controller/auth.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(function(res) { return res.json(); })
                        .then(function(data) {
                            if (!data.success) {
                                Swal.showValidationMessage(data.message);
                                return false;
                            }
                            return data;
                        })
                        .catch(function() {
                            Swal.showValidationMessage('Error de conexión con el servidor');
                        });
                    }
                }).then(function(result) {
                    if (result.isConfirmed && result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Usuario Creado!',
                            text: result.value.message || 'El usuario fue registrado exitosamente.',
                            confirmButtonColor: '#5a6b5c',
                            customClass: { popup: 'swal-custom' }
                        });
                    }
                });
            });
        }
    })();
    </script>
</body>
</html>
