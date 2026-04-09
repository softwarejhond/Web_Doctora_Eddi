<?php
/**
 * Gestión de Usuarios — Dashboard MEDIC EDDI
 * Tabla DataTables con edición y activación/desactivación.
 * Solo accesible para administradores (rol 1).
 */
require_once __DIR__ . '/guard.php';
require_once __DIR__ . '/../controller/conexion.php';

$fullName  = htmlspecialchars($_SESSION['full_name'], ENT_QUOTES, 'UTF-8');
$picture   = htmlspecialchars($_SESSION['picture'], ENT_QUOTES, 'UTF-8');
$rol       = (int)$_SESSION['rol'];
$firstName = explode(' ', $fullName)[0];

$rolNames = [1 => 'Administrador', 2 => 'Doctor', 3 => 'Paciente'];
$rolLabel = isset($rolNames[$rol]) ? $rolNames[$rol] : 'Usuario';

// Solo administradores
if ($rol !== 1) {
    header('Location: index');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios — Doctora Eddi</title>

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
    <!-- DataTables CSS (CDN) -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../img/logos/icono_eddi_claro.png">

    <style>
        /* ===== Tabla de usuarios ===== */
        .usuarios-container {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.5rem;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
        }

        .usuarios-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .usuarios-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #2d332e;
            margin: 0;
        }

        .usuarios-title em { font-style: italic; color: #5a6b5c; }

        .btn-create-user {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem 1.1rem;
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

        .btn-create-user:hover {
            background: #4a5a4c;
            border-color: #4a5a4c;
            color: #ffffff;
        }

        /* DataTables custom styling */
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: .4rem .75rem;
            font-size: .85rem;
            color: #2d332e;
            transition: border-color .2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            outline: none;
            border-color: #5a6b5c;
            box-shadow: 0 0 0 3px rgba(90, 107, 92, .1);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: .3rem 1.75rem .3rem .5rem;
            font-size: .85rem;
            color: #2d332e;
            appearance: auto;
            -webkit-appearance: auto;
            -moz-appearance: auto;
        }

        table.dataTable thead th {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #6b726d;
            border-bottom: 2px solid #e8e4df;
            padding: .75rem .5rem;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            font-size: .85rem;
            color: #434f44;
            padding: .65rem .5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0ede9;
        }

        table.dataTable tbody tr:hover {
            background: #faf9f7;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #5a6b5c !important;
            border-color: #5a6b5c !important;
            color: #fff !important;
            border-radius: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f5f3f0 !important;
            border-color: #e8e4df !important;
            color: #2d332e !important;
        }

        .dataTables_wrapper .dataTables_info {
            font-size: .8rem;
            color: #8a9a8b;
        }

        /* Badges */
        .badge-rol {
            font-size: .72rem;
            font-weight: 600;
            padding: .3rem .6rem;
            border-radius: 2px;
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .badge-admin { background: #e8ddd5; color: #7a5c3c; }
        .badge-doctor { background: #d5e0d7; color: #3c5a3f; }
        .badge-paciente { background: #dde4ee; color: #3c4f7a; }

        .badge-active { background: #d5e0d7; color: #2d6a37; }
        .badge-inactive { background: #e8d5d5; color: #9c3b3b; }

        /* Botones de acción */
        .btn-action {
            width: 32px;
            height: 32px;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s;
            font-size: .8rem;
            padding: 0;
        }

        .btn-action-edit { color: #5a6b5c; }
        .btn-action-edit:hover { background: #5a6b5c; color: #fff; border-color: #5a6b5c; }

        .btn-action-toggle { color: #b08d3e; }
        .btn-action-toggle:hover { background: #b08d3e; color: #fff; border-color: #b08d3e; }

        .btn-action-disable { color: #9c5b5b; }
        .btn-action-disable:hover { background: #9c5b5b; color: #fff; border-color: #9c5b5b; }

        /* Password toggle in swal */
        .swal-pw-toggle {
            position: absolute;
            right: .5rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8a9a8b;
            cursor: pointer;
            padding: .25rem;
            font-size: .85rem;
            line-height: 1;
        }

        .swal-pw-toggle:hover { color: #5a6b5c; }

        /* User avatar in table */
        .user-avatar-sm {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e8e4df;
        }

        .user-avatar-placeholder-sm {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #5a6b5c;
            border: 2px solid #c4cec6;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: .65rem;
        }

        @media (max-width: 768px) {
            .usuarios-container { padding: 1rem; }
            .usuarios-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container-fluid px-3 px-md-4">
            <div class="usuarios-container">
                <div class="usuarios-header">
                    <h2 class="usuarios-title"><i class="fas fa-users-cog me-2" style="color:#8a9a8b;"></i>Gestión de <em>Usuarios</em></h2>
                    <button class="btn-create-user" id="btnCreateUserPage" type="button">
                        <i class="fas fa-user-plus"></i> Nuevo Usuario
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="usersTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../components/dash/footer.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS (CDN) -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
    var usersTable;

    (function() {
        'use strict';

        var rolLabels = { 1: '<span class="badge-rol badge-admin">Administrador</span>', 2: '<span class="badge-rol badge-doctor">Doctor</span>', 3: '<span class="badge-rol badge-paciente">Paciente</span>' };

        // ── Inicializar DataTable ──
        usersTable = $('#usersTable').DataTable({
            ajax: {
                url: '../controller/usuarios.php?action=list',
                dataSrc: function(json) {
                    return json.success ? json.data : [];
                }
            },
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        if (data.picture && data.picture !== 'default.png') {
                            return '<img src="../img/profiles/' + encodeURIComponent(data.picture) + '" alt="" class="user-avatar-sm">';
                        }
                        var initial = data.full_name ? data.full_name.charAt(0).toUpperCase() : '?';
                        return '<div class="user-avatar-placeholder-sm">' + initial + '</div>';
                    },
                    width: '40px',
                    className: 'text-center'
                },
                { data: 'username' },
                { data: 'full_name' },
                { data: 'email' },
                {
                    data: 'rol',
                    render: function(data) {
                        return rolLabels[parseInt(data)] || data;
                    }
                },
                {
                    data: 'active',
                    render: function(data) {
                        return parseInt(data) === 1
                            ? '<span class="badge-rol badge-active">Activo</span>'
                            : '<span class="badge-rol badge-inactive">Inactivo</span>';
                    }
                },
                {
                    data: 'creation_date',
                    render: function(data) {
                        if (!data) return '';
                        var d = new Date(data);
                        return d.toLocaleDateString('es-CO', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        var isActive = parseInt(data.active) === 1;
                        var toggleIcon = isActive ? 'fa-user-slash' : 'fa-user-check';
                        var toggleTitle = isActive ? 'Deshabilitar' : 'Habilitar';
                        var toggleClass = isActive ? 'btn-action-disable' : 'btn-action-toggle';

                        return '<div class="d-flex gap-1">' +
                            '<button class="btn-action btn-action-edit" title="Editar" onclick="editUser(' + data.id + ')">' +
                                '<i class="fas fa-pen"></i>' +
                            '</button>' +
                            '<button class="btn-action ' + toggleClass + '" title="' + toggleTitle + '" onclick="toggleUser(' + data.id + ',' + (isActive ? 0 : 1) + ',\'' + data.full_name.replace(/'/g, "\\'") + '\')">' +
                                '<i class="fas ' + toggleIcon + '"></i>' +
                            '</button>' +
                        '</div>';
                    },
                    width: '80px'
                }
            ],
            responsive: true,
            order: [[1, 'asc']],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            dom: '<"row mb-3"<"col-sm-6"l><"col-sm-6"f>>rtip'
        });

        // ── Botón crear usuario de esta página (dispara el del sidebar) ──
        var btnPage = document.getElementById('btnCreateUserPage');
        if (btnPage) {
            btnPage.addEventListener('click', function() {
                var btnSidebar = document.getElementById('btnCreateUser');
                if (btnSidebar) btnSidebar.click();
            });
        }

    })();

    // ── Editar usuario ──
    function editUser(id) {
        // Obtener datos del usuario
        fetch('../controller/usuarios.php?action=get&id=' + id)
            .then(function(res) { return res.json(); })
            .then(function(json) {
                if (!json.success) {
                    Swal.fire({ icon: 'error', title: 'Error', text: json.message, confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                    return;
                }
                var u = json.data;

                Swal.fire({
                    title: '<i class="fas fa-user-edit" style="color:#5a6b5c;margin-right:.5rem;"></i>Editar Usuario',
                    html:
                        '<div style="padding: 0 .5rem;">' +
                        '  <div class="swal-input-group">' +
                        '    <label for="edit-username">Cédula</label>' +
                        '    <input type="text" id="edit-username" value="' + u.username + '" disabled style="background:#f5f3f0;cursor:not-allowed;">' +
                        '  </div>' +
                        '  <div class="swal-input-group">' +
                        '    <label for="edit-fullname">Nombre Completo</label>' +
                        '    <input type="text" id="edit-fullname" value="' + u.full_name.replace(/"/g, '&quot;') + '" maxlength="200">' +
                        '  </div>' +
                        '  <div class="swal-input-group">' +
                        '    <label for="edit-email">Correo Electrónico</label>' +
                        '    <input type="email" id="edit-email" value="' + u.email.replace(/"/g, '&quot;') + '" maxlength="150">' +
                        '  </div>' +
                        '  <div class="swal-input-group">' +
                        '    <label>Foto Actual</label>' +
                        '    <div style="margin-bottom:.5rem;">' +
                        (u.picture && u.picture !== 'default.png'
                            ? '<img src="../img/profiles/' + encodeURIComponent(u.picture) + '" style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid #e8e4df;">'
                            : '<div style="width:50px;height:50px;border-radius:50%;background:#5a6b5c;display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:1rem;border:2px solid #c4cec6;">' + (u.full_name ? u.full_name.charAt(0).toUpperCase() : '?') + '</div>') +
                        '    </div>' +
                        '    <label for="edit-picture">Cambiar Foto <small style="color:#8a9a8b;font-weight:400;text-transform:none;">(opcional)</small></label>' +
                        '    <input type="file" id="edit-picture" accept=".jpg,.jpeg,.png,.gif">' +
                        '  </div>' +
                        '  <div class="swal-input-group">' +
                        '    <label for="edit-password">Nueva Contraseña <small style="color:#8a9a8b;font-weight:400;text-transform:none;">(dejar vacío para no cambiar)</small></label>' +
                        '    <div style="position:relative;">' +
                        '      <input type="password" id="edit-password" placeholder="Nueva contraseña" maxlength="100" style="padding-right:2.5rem;">' +
                        '      <button type="button" class="swal-pw-toggle" onclick="togglePw(\'edit-password\', this)" tabindex="-1" title="Ver contraseña">' +
                        '        <i class="fas fa-eye"></i>' +
                        '      </button>' +
                        '    </div>' +
                        '    <div class="swal-pw-hint">Mínimo 8 caracteres: al menos 1 mayúscula, 1 minúscula, 1 número y 1 carácter especial.</div>' +
                        '  </div>' +
                        '  <div class="swal-input-group">' +
                        '    <label for="edit-rol">Rol</label>' +
                        '    <select id="edit-rol">' +
                        '      <option value="3"' + (parseInt(u.rol) === 3 ? ' selected' : '') + '>Paciente</option>' +
                        '      <option value="2"' + (parseInt(u.rol) === 2 ? ' selected' : '') + '>Doctor</option>' +
                        '      <option value="1"' + (parseInt(u.rol) === 1 ? ' selected' : '') + '>Administrador</option>' +
                        '    </select>' +
                        '  </div>' +
                        '</div>',
                    customClass: { popup: 'swal-custom' },
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-save me-1"></i>Guardar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#5a6b5c',
                    cancelButtonColor: '#8a9a8b',
                    focusConfirm: false,
                    width: 480,
                    preConfirm: function() {
                        var fullname = document.getElementById('edit-fullname').value.trim();
                        var email    = document.getElementById('edit-email').value.trim();
                        var password = document.getElementById('edit-password').value;
                        var rol      = document.getElementById('edit-rol').value;

                        document.querySelectorAll('.swal-input-group .input-error').forEach(function(el) { el.classList.remove('input-error'); });
                        document.querySelectorAll('.swal-input-group .error-text').forEach(function(el) { el.remove(); });

                        var errors = [];
                        function markError(elId, msg) {
                            var input = document.getElementById(elId);
                            input.classList.add('input-error');
                            var err = document.createElement('div');
                            err.className = 'error-text';
                            err.textContent = msg;
                            input.closest('.swal-input-group').appendChild(err);
                        }

                        if (!fullname || fullname.length < 3) { markError('edit-fullname', 'Nombre requerido (mínimo 3 caracteres)'); errors.push(true); }
                        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!email || !emailRe.test(email)) { markError('edit-email', 'Correo electrónico inválido'); errors.push(true); }

                        if (password) {
                            var pwRe = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]).{8,}$/;
                            if (!pwRe.test(password)) { markError('edit-password', 'No cumple los requisitos de seguridad'); errors.push(true); }
                        }

                        if (errors.length > 0) return false;

                        var formData = new FormData();
                        formData.append('action', 'update');
                        formData.append('id', id);
                        formData.append('full_name', fullname);
                        formData.append('email', email);
                        formData.append('rol', rol);
                        if (password) formData.append('password', password);
                        var pictureFile = document.getElementById('edit-picture').files[0];
                        if (pictureFile) formData.append('picture', pictureFile);

                        return fetch('../controller/usuarios.php', { method: 'POST', body: formData })
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
                            title: '¡Actualizado!',
                            text: result.value.message || 'Usuario actualizado exitosamente.',
                            confirmButtonColor: '#5a6b5c',
                            customClass: { popup: 'swal-custom' }
                        });
                        usersTable.ajax.reload(null, false);
                    }
                });
            })
            .catch(function() {
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
            });
    }

    // ── Activar / Desactivar usuario ──
    function toggleUser(id, newStatus, name) {
        var action = newStatus === 1 ? 'habilitar' : 'deshabilitar';
        var icon = newStatus === 1 ? 'question' : 'warning';

        Swal.fire({
            icon: icon,
            title: (newStatus === 1 ? 'Habilitar' : 'Deshabilitar') + ' Usuario',
            html: '¿Está seguro de <strong>' + action + '</strong> al usuario<br><strong>' + name + '</strong>?',
            showCancelButton: true,
            confirmButtonText: newStatus === 1 ? '<i class="fas fa-user-check me-1"></i>Habilitar' : '<i class="fas fa-user-slash me-1"></i>Deshabilitar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: newStatus === 1 ? '#5a6b5c' : '#9c5b5b',
            cancelButtonColor: '#8a9a8b',
            customClass: { popup: 'swal-custom' }
        }).then(function(result) {
            if (result.isConfirmed) {
                var formData = new FormData();
                formData.append('action', 'toggle_status');
                formData.append('id', id);
                formData.append('active', newStatus);

                fetch('../controller/usuarios.php', { method: 'POST', body: formData })
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: newStatus === 1 ? '¡Habilitado!' : '¡Deshabilitado!',
                                text: data.message,
                                confirmButtonColor: '#5a6b5c',
                                customClass: { popup: 'swal-custom' }
                            });
                            usersTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                        }
                    })
                    .catch(function() {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#5a6b5c', customClass: { popup: 'swal-custom' } });
                    });
            }
        });
    }
    </script>
</body>
</html>
