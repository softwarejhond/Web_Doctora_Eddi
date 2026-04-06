<?php
/**
 * Sidebar del Dashboard — Componente reutilizable
 * Requiere: $rol (int), sesión activa
 */
$currentPage = isset($currentPage) ? $currentPage : basename($_SERVER['PHP_SELF'], '.php');
?>
<!-- ===== SIDEBAR ===== -->
<div class="dash-sidebar-overlay" id="sidebarOverlay"></div>
<aside class="dash-sidebar" id="dashSidebar">
    <div class="dash-sidebar-header">
        <h3 class="dash-sidebar-title"><i class="fas fa-th-large me-2"></i>Menú</h3>
        <button class="dash-sidebar-close" id="sidebarClose" aria-label="Cerrar menú lateral">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="dash-sidebar-body">
        <div class="dash-sidebar-section">
            <div class="dash-sidebar-section-label">Navegación</div>
            <a href="index.php" class="dash-sidebar-item <?php echo $currentPage === 'index' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a href="citas.php" class="dash-sidebar-item <?php echo $currentPage === 'citas' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-alt"></i> Citas
            </a>
            <a href="#" class="dash-sidebar-item">
                <i class="fas fa-file-medical"></i> Historial
            </a>
        </div>

        <?php if ($rol === 1): ?>
        <div class="dash-sidebar-section">
            <div class="dash-sidebar-section-label">Administración</div>
            <button class="dash-sidebar-item" id="btnCreateUser" type="button">
                <i class="fas fa-user-plus"></i> Crear Usuario
            </button>
            <a href="#" class="dash-sidebar-item">
                <i class="fas fa-users-cog"></i> Gestionar Usuarios
            </a>
        </div>
        <?php endif; ?>

        <div class="dash-sidebar-section">
            <div class="dash-sidebar-section-label">Cuenta</div>
            <a href="#" class="dash-sidebar-item">
                <i class="fas fa-user"></i> Mi Perfil
            </a>
            <a href="#" class="dash-sidebar-item">
                <i class="fas fa-cog"></i> Configuración
            </a>
            <a href="../controller/logout.php" class="dash-sidebar-item" style="color:#9c5b5b;">
                <i class="fas fa-sign-out-alt" style="color:#9c5b5b;"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</aside>

<script>
/* Sidebar toggle — reutilizable */
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    var sidebar  = document.getElementById('dashSidebar');
    var overlay  = document.getElementById('sidebarOverlay');
    var toggleBtn = document.getElementById('sidebarToggle');
    var closeBtn  = document.getElementById('sidebarClose');

    function openSidebar()  { sidebar.classList.add('open'); overlay.classList.add('active'); }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('active'); }

    if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
    if (closeBtn)  closeBtn.addEventListener('click', closeSidebar);
    if (overlay)   overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) closeSidebar();
    });
});
</script>
