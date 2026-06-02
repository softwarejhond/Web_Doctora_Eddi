<?php
/**
 * Módulo de Anuncios / Popups — Dashboard MEDIC EDDI
 * Gestión de popups promocionales que aparecen en el landing.
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
    <title>Anuncios — Doctora Eddi</title>

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
        /* ===== Anuncios container ===== */
        .anuncios-container {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.5rem;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
        }

        .anuncios-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .anuncios-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #2d332e;
            margin: 0;
        }

        .anuncios-title em { font-style: italic; color: #5a6b5c; }

        .btn-new-anuncio {
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

        .btn-new-anuncio:hover {
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
            box-shadow: 0 0 0 3px rgba(90,107,92,.1);
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: .3rem 1.75rem .3rem .5rem;
            font-size: .85rem;
            color: #2d332e;
            appearance: auto;
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

        /* Badges de estado */
        .badge-activo {
            background: rgba(90,107,92,.12);
            color: #3a5a3c;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .4px;
            padding: .25rem .6rem;
            border-radius: 2px;
            text-transform: uppercase;
        }

        .badge-inactivo {
            background: rgba(156,91,91,.1);
            color: #9c5b5b;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .4px;
            padding: .25rem .6rem;
            border-radius: 2px;
            text-transform: uppercase;
        }

        .badge-vigente {
            background: rgba(90,107,92,.12);
            color: #3a5a3c;
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .6rem;
            border-radius: 2px;
        }

        .badge-vencido {
            background: rgba(156,91,91,.1);
            color: #9c5b5b;
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .6rem;
            border-radius: 2px;
        }

        .badge-futuro {
            background: rgba(90,107,141,.1);
            color: #3a4a7c;
            font-size: .72rem;
            font-weight: 600;
            padding: .25rem .6rem;
            border-radius: 2px;
        }

        /* Botones de acción */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            background: transparent;
            color: #6b726d;
            font-size: .8rem;
            cursor: pointer;
            transition: all .15s;
        }

        .btn-action:hover {
            background: #f5f3f0;
            border-color: #c4cec6;
            color: #434f44;
        }

        .btn-action.toggle-active { color: #9c5b5b; border-color: rgba(156,91,91,.3); }
        .btn-action.toggle-active:hover { background: rgba(156,91,91,.08); }
        .btn-action.toggle-inactive { color: #5a6b5c; border-color: rgba(90,107,92,.3); }
        .btn-action.toggle-inactive:hover { background: rgba(90,107,92,.08); }
        .btn-action.btn-delete { color: #9c5b5b; }
        .btn-action.btn-delete:hover { background: rgba(156,91,91,.08); border-color: rgba(156,91,91,.3); }

        /* Thumbnail anuncio */
        .anuncio-thumb {
            width: 56px;
            height: 40px;
            object-fit: cover;
            border-radius: 2px;
            border: 1px solid #e8e4df;
        }

        .anuncio-thumb-placeholder {
            width: 56px;
            height: 40px;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c4cec6;
            font-size: .8rem;
        }

        /* Nota informativa */
        .anuncios-info-note {
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            border-left: 3px solid #5a6b5c;
            border-radius: 2px;
            padding: .75rem 1rem;
            font-size: .82rem;
            color: #6b726d;
            margin-bottom: 1.25rem;
        }

        .anuncios-info-note i { color: #5a6b5c; }

        /* DataTables info / paginate */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: .82rem;
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
            color: #434f44 !important;
            border-radius: 2px;
        }
    </style>
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container-fluid px-3 px-md-4">

            <!-- Cabecera de página -->
            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                <div>
                    <h1 class="dash-welcome-title mb-0">
                        Anuncios <em style="font-style:italic; color:#5a6b5c;">Popups</em>
                    </h1>
                    <p class="text-muted mb-0" style="font-size:.88rem;">
                        Gestiona los popups promocionales del landing
                    </p>
                </div>
                <button class="btn-new-anuncio" id="btnNuevoAnuncio" type="button">
                    <i class="fas fa-plus"></i> Nuevo Anuncio
                </button>
            </div>

            <!-- Nota informativa -->
            <div class="anuncios-info-note">
                <i class="fas fa-info-circle me-2"></i>
                El popup se muestra automáticamente cuando el anuncio está <strong>activo</strong>
                y la fecha actual está dentro del rango de vigencia. Solo se muestra <strong>una vez
                por sesión de navegador</strong>. Si hay varios anuncios vigentes y activos, se
                mostrará el más reciente.
            </div>

            <!-- Tabla -->
            <div class="anuncios-container">
                <div class="anuncios-header">
                    <h2 class="anuncios-title">Lista de <em>Anuncios</em></h2>
                </div>

                <div class="table-responsive">
                    <table id="tablaAnuncios" class="table w-100" style="min-width:700px;">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Título</th>
                                <th>Vigencia</th>
                                <th>Estado</th>
                                <th>Periodo</th>
                                <th>Delay</th>
                                <th>Creado por</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaAnunciosBody">
                            <!-- Se llena con JS -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /container -->
    </main>

    <?php include __DIR__ . '/../components/dash/footer.php'; ?>

    <!-- ===== MODAL NUEVO / EDITAR ANUNCIO ===== -->
    <?php include __DIR__ . '/../components/dash/modals_entry.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
    'use strict';
    // ── Estado ──────────────────────────────────────────────────────────────
    let dtAnuncios = null;
    let modoEdicion = false;
    let editId = null;

    // ── Helpers ─────────────────────────────────────────────────────────────
    function formatDate(str) {
        if (!str) return '—';
        const [y, m, d] = str.split('-');
        return `${d}/${m}/${y}`;
    }

    function periodoLabel(inicio, fin) {
        const hoy  = new Date().toISOString().slice(0, 10);
        if (hoy < inicio) return '<span class="badge-futuro">Futuro</span>';
        if (hoy > fin)    return '<span class="badge-vencido">Vencido</span>';
        return '<span class="badge-vigente">Vigente</span>';
    }

    function imgSrc(imagen) {
        if (!imagen) return null;
        if (imagen.startsWith('http://') || imagen.startsWith('https://')) return imagen;
        return `../img/anuncios/${imagen}`;
    }

    // ── Cargar datos ─────────────────────────────────────────────────────────
    function cargarAnuncios() {
        fetch('../controller/anuncios.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=list'
        })
        .then(r => r.json())
        .then(res => {
            if (!res.ok) { console.error(res.msg); return; }

            // 1. Destruir DataTables ANTES de tocar el DOM
            if (dtAnuncios) {
                dtAnuncios.destroy();
                dtAnuncios = null;
            }

            const tbody = document.getElementById('tablaAnunciosBody');
            tbody.innerHTML = '';

            res.data.forEach(a => {
                const src = imgSrc(a.imagen);
                const thumb = src
                    ? `<img src="${src}" class="anuncio-thumb" alt="${escHtml(a.titulo)}" loading="lazy">`
                    : `<div class="anuncio-thumb-placeholder"><i class="fas fa-image"></i></div>`;

                const estadoBadge = a.activo === '1' || a.activo === 1
                    ? '<span class="badge-activo">Activo</span>'
                    : '<span class="badge-inactivo">Inactivo</span>';

                const toggleClass = (a.activo === '1' || a.activo === 1) ? 'toggle-active' : 'toggle-inactive';
                const toggleIcon  = (a.activo === '1' || a.activo === 1) ? 'fa-toggle-on'  : 'fa-toggle-off';
                const toggleTitle = (a.activo === '1' || a.activo === 1) ? 'Desactivar'    : 'Activar';

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${thumb}</td>
                    <td><strong style="color:#2d332e;">${escHtml(a.titulo)}</strong></td>
                    <td style="white-space:nowrap;">${formatDate(a.fecha_inicio)} → ${formatDate(a.fecha_fin)}</td>
                    <td>${estadoBadge}</td>
                    <td>${periodoLabel(a.fecha_inicio, a.fecha_fin)}</td>
                    <td>${a.delay_ms} ms</td>
                    <td style="color:#8a9a8b;font-size:.8rem;">${escHtml(a.creador || '—')}</td>
                    <td>
                        <div style="display:flex;gap:.35rem;">
                            <button class="btn-action" title="Editar"
                                    onclick="abrirEditar(${a.id})">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn-action ${toggleClass}" title="${toggleTitle}"
                                    onclick="toggleAnuncio(${a.id}, this)">
                                <i class="fas ${toggleIcon}"></i>
                            </button>
                            <button class="btn-action btn-delete" title="Eliminar"
                                    onclick="eliminarAnuncio(${a.id}, '${escHtml(a.titulo)}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });

            // 2. Reinicializar DataTables sobre el DOM ya actualizado
            dtAnuncios = $('#tablaAnuncios').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                order: [[2, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [0, 7] }
                ]
            });
        })
        .catch(err => console.error('Error cargando anuncios:', err));
    }

    function escHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // ── Abrir modal nuevo ────────────────────────────────────────────────────
    document.getElementById('btnNuevoAnuncio').addEventListener('click', function() {
        modoEdicion = false;
        editId = null;
        resetFormAnuncio();
        document.getElementById('modalAnuncioLabel').textContent = 'Nuevo Anuncio';
        const modal = new bootstrap.Modal(document.getElementById('modalAnuncio'));
        modal.show();
    });

    // ── Abrir modal editar ───────────────────────────────────────────────────
    function abrirEditar(id) {
        fetch('../controller/anuncios.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=list'
        })
        .then(r => r.json())
        .then(res => {
            if (!res.ok) return;
            const a = res.data.find(x => parseInt(x.id) === parseInt(id));
            if (!a) return;

            modoEdicion = true;
            editId = id;
            resetFormAnuncio();

            document.getElementById('modalAnuncioLabel').textContent = 'Editar Anuncio';
            document.getElementById('anuncioTitulo').value      = a.titulo;
            document.getElementById('anuncioWaNumero').value    = a.wa_numero;
            document.getElementById('anuncioWaMensaje').value   = a.wa_mensaje;
            document.getElementById('anuncioTextoBoton').value  = a.texto_boton;
            document.getElementById('anuncioFechaInicio').value = a.fecha_inicio;
            document.getElementById('anuncioFechaFin').value    = a.fecha_fin;
            document.getElementById('anuncioDelay').value       = a.delay_ms;
            document.getElementById('anuncioActivo').checked    = (a.activo === '1' || a.activo === 1);

            // Mostrar imagen actual
            const src = imgSrc(a.imagen);
            const prevImg = document.getElementById('anuncioImgPreview');
            const prevCont = document.getElementById('previewContainer');
            if (src) {
                prevImg.src = src;
                prevCont.style.display = 'block';
            }
            if (a.imagen && (a.imagen.startsWith('http://') || a.imagen.startsWith('https://'))) {
                document.getElementById('anuncioImgUrl').value = a.imagen;
                document.getElementById('tabUrl').click();
            }

            const modal = new bootstrap.Modal(document.getElementById('modalAnuncio'));
            modal.show();
        });
    }

    // ── Toggle activo / inactivo ─────────────────────────────────────────────
    function toggleAnuncio(id, btn) {
        fetch('../controller/anuncios.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=toggle&id=${id}`
        })
        .then(r => r.json())
        .then(res => {
            if (!res.ok) {
                Swal.fire({ icon: 'error', title: 'Error', text: res.msg, confirmButtonColor: '#5a6b5c' });
                return;
            }
            cargarAnuncios();
        });
    }

    // ── Eliminar ─────────────────────────────────────────────────────────────
    function eliminarAnuncio(id, titulo) {
        Swal.fire({
            title: '¿Eliminar anuncio?',
            html: `<span style="font-size:.9rem;color:#6b726d;">Se eliminará permanentemente: <strong>${titulo}</strong></span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#9c5b5b',
            cancelButtonColor: '#5a6b5c',
            reverseButtons: true
        }).then(result => {
            if (!result.isConfirmed) return;
            fetch('../controller/anuncios.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=delete&id=${id}`
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    Swal.fire({ icon: 'success', title: '¡Eliminado!', text: res.msg, timer: 1800, showConfirmButton: false });
                    cargarAnuncios();
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: res.msg, confirmButtonColor: '#5a6b5c' });
                }
            });
        });
    }

    // ── Reset formulario ─────────────────────────────────────────────────────
    function resetFormAnuncio() {
        document.getElementById('formAnuncio').reset();
        document.getElementById('anuncioActivo').checked = true;
        document.getElementById('previewContainer').style.display = 'none';
        document.getElementById('anuncioImgPreview').src = '';
        document.getElementById('tabFile').click();
    }

    // ── Submit formulario ────────────────────────────────────────────────────
    document.getElementById('formAnuncio').addEventListener('submit', function(e) {
        e.preventDefault();

        const fd = new FormData(this);
        fd.set('action', modoEdicion ? 'update' : 'create');
        if (modoEdicion) fd.set('id', editId);

        // Si la pestaña activa es URL, limpiar el file input y vice-versa
        const tabActivo = document.querySelector('#imgTabs .nav-link.active')?.dataset.tab;
        if (tabActivo === 'url') {
            fd.delete('imagen_file');
        } else {
            fd.delete('imagen_url');
        }

        fd.set('activo', document.getElementById('anuncioActivo').checked ? '1' : '0');

        const btn = document.getElementById('btnGuardarAnuncio');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-circle-notch fa-spin me-1"></i> Guardando…';

        fetch('../controller/anuncios.php', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(res => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save me-1"></i> Guardar Anuncio';
            if (res.ok) {
                bootstrap.Modal.getInstance(document.getElementById('modalAnuncio')).hide();
                Swal.fire({
                    icon: 'success',
                    title: modoEdicion ? '¡Actualizado!' : '¡Creado!',
                    text: res.msg,
                    timer: 1800,
                    showConfirmButton: false
                });
                cargarAnuncios();
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: res.msg, confirmButtonColor: '#5a6b5c' });
            }
        })
        .catch(() => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save me-1"></i> Guardar Anuncio';
            Swal.fire({ icon: 'error', title: 'Error de red', text: 'No se pudo conectar con el servidor.', confirmButtonColor: '#5a6b5c' });
        });
    });

    // ── Inicializar ──────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', cargarAnuncios);
    </script>
</body>
</html>
