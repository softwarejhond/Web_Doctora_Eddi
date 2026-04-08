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

    <?php include __DIR__ . '/../components/dash/footer.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>


</body>
</html>
