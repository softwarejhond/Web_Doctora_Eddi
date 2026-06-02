<?php
/**
 * Header del Dashboard — Componente reutilizable
 * Requiere: $fullName, $firstName, $picture, $rol, $rolLabel (definidos en guard/index)
 * Requiere: sesión activa con $_SESSION['email']
 */
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

?>
<!-- ===== DASHBOARD HEADER ===== -->
<header class="dash-header">
    <div class="dash-header-inner">
        <!-- Sidebar toggle -->
        <button class="dash-sidebar-toggle" id="sidebarToggle" aria-label="Abrir menú lateral">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Logo -->
        <a href="index">
            <img src="../img/logos/logo_eddi_oscuro.png" alt="Doctora Eddi" class="dash-logo"
                 onerror="this.src='../img/logos/logo_eddi_crema.png'">
        </a>

        <!-- Navegación -->
        <nav>
            <ul class="dash-nav">
                <li><a href="index" class="dash-nav-link <?php echo $currentPage === 'index' ? 'active' : ''; ?>"><i class="fas fa-home me-1"></i> Inicio</a></li>
                <?php if ($rol === 1): ?>
                <li><a href="usuarios" class="dash-nav-link <?php echo $currentPage === 'usuarios' ? 'active' : ''; ?>"><i class="fas fa-users me-1"></i> Usuarios</a></li>
                <li><a href="anuncios" class="dash-nav-link <?php echo $currentPage === 'anuncios' ? 'active' : ''; ?>"><i class="fas fa-bullhorn me-1"></i> Anuncios</a></li>
                <?php endif; ?>
                <li><a href="citas" class="dash-nav-link <?php echo $currentPage === 'citas' ? 'active' : ''; ?>"><i class="fas fa-calendar-alt me-1"></i> Citas</a></li>
                <li><a href="historial" class="dash-nav-link <?php echo $currentPage === 'historial' ? 'active' : ''; ?>"><i class="fas fa-file-medical me-1"></i> Historial</a></li>
            </ul>
        </nav>

        <!-- Perfil a la derecha -->
        <div class="dash-profile-area dropdown">
            <button class="dash-profile-btn dropdown-toggle" type="button" id="profileDropdown" 
                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="true">
                <?php if ($picture && $picture !== 'default.png' && file_exists(__DIR__ . '/../../img/profiles/' . $picture)): ?>
                    <img src="../img/profiles/<?php echo $picture; ?>" alt="Foto de perfil" class="dash-avatar">
                <?php else: ?>
                    <div class="dash-avatar-placeholder"><?php echo mb_substr($fullName, 0, 1, 'UTF-8'); ?></div>
                <?php endif; ?>
                <div class="d-none d-sm-block text-start">
                    <div class="dash-profile-name"><?php echo $firstName; ?></div>
                    <div class="dash-profile-role"><?php echo $rolLabel; ?></div>
                </div>
                <i class="fas fa-chevron-down dash-profile-chevron"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end dash-dropdown" aria-labelledby="profileDropdown">
                <li>
                    <div class="px-3 py-2">
                        <div class="fw-semibold" style="font-size:.9rem; color:#2d332e;"><?php echo $fullName; ?></div>
                        <div style="font-size:.75rem; color:#8a9a8b;"><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="perfil"><i class="fas fa-user"></i> Mi Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="../controller/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</header>
