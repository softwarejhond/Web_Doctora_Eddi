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
            <a href="index" class="dash-sidebar-item <?php echo $currentPage === 'index' ? 'active' : ''; ?>">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a href="citas" class="dash-sidebar-item <?php echo $currentPage === 'citas' ? 'active' : ''; ?>">
                <i class="fas fa-calendar-alt"></i> Citas
            </a>
            <a href="historial" class="dash-sidebar-item <?php echo $currentPage === 'historial' ? 'active' : ''; ?>">
                <i class="fas fa-file-medical"></i> Historial
            </a>
        </div>

        <?php if ($rol === 1): ?>
        <div class="dash-sidebar-section">
            <div class="dash-sidebar-section-label">Administración</div>
            <button class="dash-sidebar-item" id="btnCreateUser" type="button">
                <i class="fas fa-user-plus"></i> Crear Usuario
            </button>
            <a href="usuarios" class="dash-sidebar-item <?php echo $currentPage === 'usuarios' ? 'active' : ''; ?>">
                <i class="fas fa-users-cog"></i> Gestionar Usuarios
            </a>
            <a href="anuncios" class="dash-sidebar-item <?php echo $currentPage === 'anuncios' ? 'active' : ''; ?>">
                <i class="fas fa-bullhorn"></i> Anuncios / Popups
            </a>
        </div>
        <?php endif; ?>

        <div class="dash-sidebar-section">
            <div class="dash-sidebar-section-label">Cuenta</div>
            <a href="perfil" class="dash-sidebar-item <?php echo $currentPage === 'perfil' ? 'active' : ''; ?>">
                <i class="fas fa-user"></i> Mi Perfil
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

    // ── Crear Usuario con SweetAlert2 (disponible en todas las páginas del dash) ──
    var createUserBtn = document.getElementById('btnCreateUser');
    if (createUserBtn) {
        createUserBtn.addEventListener('click', function() {
            closeSidebar();

            Swal.fire({
                title: '<i class="fas fa-user-plus" style="color:#5a6b5c;margin-right:.5rem;"></i>Crear Usuario',
                html: '\n' +
                    '<div style="padding: 0 .5rem;">\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-username">Cédula</label>\n' +
                    '    <input type="text" id="swal-username" placeholder="Ej: 1234567890" maxlength="15" inputmode="numeric">\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-fullname">Nombre Completo</label>\n' +
                    '    <input type="text" id="swal-fullname" placeholder="Nombre y Apellidos" maxlength="200">\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-email">Correo Electrónico</label>\n' +
                    '    <input type="email" id="swal-email" placeholder="correo@ejemplo.com" maxlength="150">\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-picture">Foto de Perfil <small style="color:#8a9a8b;font-weight:400;text-transform:none;">(opcional)</small></label>\n' +
                    '    <input type="file" id="swal-picture" accept=".jpg,.jpeg,.png,.gif">\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-password">Contraseña</label>\n' +
                    '    <div style="position:relative;">\n' +
                    '      <input type="password" id="swal-password" placeholder="Contraseña segura" maxlength="100" style="padding-right:2.5rem;">\n' +
                    '      <button type="button" class="swal-pw-toggle" onclick="togglePw(\x27swal-password\x27, this)" tabindex="-1" title="Ver contraseña">\n' +
                    '        <i class="fas fa-eye"></i>\n' +
                    '      </button>\n' +
                    '    </div>\n' +
                    '    <div class="swal-pw-hint">Mínimo 8 caracteres: al menos 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.</div>\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-password2">Confirmar Contraseña</label>\n' +
                    '    <div style="position:relative;">\n' +
                    '      <input type="password" id="swal-password2" placeholder="Repita la contraseña" maxlength="100" style="padding-right:2.5rem;">\n' +
                    '      <button type="button" class="swal-pw-toggle" onclick="togglePw(\x27swal-password2\x27, this)" tabindex="-1" title="Ver contraseña">\n' +
                    '        <i class="fas fa-eye"></i>\n' +
                    '      </button>\n' +
                    '    </div>\n' +
                    '  </div>\n' +
                    '  <div class="swal-input-group">\n' +
                    '    <label for="swal-rol">Rol</label>\n' +
                    '    <select id="swal-rol">\n' +
                    '      <option value="3">Paciente</option>\n' +
                    '      <option value="2">Doctor</option>\n' +
                    '      <option value="1">Administrador</option>\n' +
                    '    </select>\n' +
                    '  </div>\n' +
                    '</div>',
                customClass: { popup: 'swal-custom' },
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check me-1"></i>Crear',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5a6b5c',
                cancelButtonColor: '#8a9a8b',
                focusConfirm: false,
                width: 480,
                preConfirm: function() {
                    var username  = document.getElementById('swal-username').value.trim();
                    var fullname  = document.getElementById('swal-fullname').value.trim();
                    var email     = document.getElementById('swal-email').value.trim();
                    var password  = document.getElementById('swal-password').value;
                    var password2 = document.getElementById('swal-password2').value;
                    var rol       = document.getElementById('swal-rol').value;

                    document.querySelectorAll('.swal-input-group .input-error').forEach(function(el) { el.classList.remove('input-error'); });
                    document.querySelectorAll('.swal-input-group .error-text').forEach(function(el) { el.remove(); });

                    var errors = [];
                    function markError(id, msg) {
                        var input = document.getElementById(id);
                        input.classList.add('input-error');
                        var err = document.createElement('div');
                        err.className = 'error-text';
                        err.textContent = msg;
                        input.closest('.swal-input-group').appendChild(err);
                    }

                    if (!username || !/^\d{5,15}$/.test(username)) { markError('swal-username', 'Cédula inválida (solo números, 5-15 dígitos)'); errors.push(true); }
                    if (!fullname || fullname.length < 3) { markError('swal-fullname', 'Nombre requerido (mínimo 3 caracteres)'); errors.push(true); }
                    var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!email || !emailRe.test(email)) { markError('swal-email', 'Correo electrónico inválido'); errors.push(true); }
                    var pwRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]).{8,}$/;
                    if (!password || !pwRe.test(password)) { markError('swal-password', 'No cumple los requisitos de seguridad'); errors.push(true); }
                    if (password !== password2) { markError('swal-password2', 'Las contraseñas no coinciden'); errors.push(true); }
                    if (errors.length > 0) return false;

                    var formData = new FormData();
                    formData.append('action', 'create_user');
                    formData.append('username', username);
                    formData.append('full_name', fullname);
                    formData.append('email', email);
                    formData.append('password', password);
                    formData.append('rol', rol);
                    var pictureFile = document.getElementById('swal-picture').files[0];
                    if (pictureFile) formData.append('picture', pictureFile);

                    return fetch('../controller/auth.php', { method: 'POST', body: formData })
                        .then(function(res) { return res.json(); })
                        .then(function(data) {
                            if (!data.success) { Swal.showValidationMessage(data.message); return false; }
                            return data;
                        })
                        .catch(function() { Swal.showValidationMessage('Error de conexión con el servidor'); });
                }
            }).then(function(result) {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Usuario Creado!',
                        text: result.value.message || 'El usuario fue registrado exitosamente.',
                        confirmButtonColor: '#5a6b5c',
                        customClass: { popup: 'swal-custom' }
                    }).then(function() {
                        // Recargar tabla de usuarios si existe
                        if (typeof usersTable !== 'undefined') usersTable.ajax.reload(null, false);
                    });
                }
            });
        });
    }
});

function togglePw(inputId, btn) {
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
