<?php
/**
 * Historial de Citas — Dashboard MEDIC EDDI
 * Tabla DataTables con filtros por estado, tratamiento y fecha.
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
    <title>Historial de Citas — Doctora Eddi</title>

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
        /* ===== Historial de citas ===== */
        .historial-container {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.5rem;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
        }

        .historial-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .historial-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #2d332e;
            margin: 0;
        }

        .historial-title em { font-style: italic; color: #5a6b5c; }

        /* ── Filtros ── */
        .historial-filters {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            margin-bottom: 1.25rem;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: .25rem;
        }

        .filter-group label {
            font-size: .7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
            color: #6b726d;
        }

        .filter-group select,
        .filter-group input[type="date"] {
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: .4rem .6rem;
            font-size: .82rem;
            color: #2d332e;
            background: #fff;
            min-width: 160px;
            transition: border-color .2s;
        }

        .filter-group select:focus,
        .filter-group input[type="date"]:focus {
            outline: none;
            border-color: #5a6b5c;
            box-shadow: 0 0 0 3px rgba(90, 107, 92, .1);
        }

        .btn-clear-filters {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .4rem .85rem;
            font-size: .78rem;
            font-weight: 600;
            letter-spacing: .3px;
            text-transform: uppercase;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            background: #f5f3f0;
            color: #6b726d;
            cursor: pointer;
            transition: all .2s;
            align-self: flex-end;
        }

        .btn-clear-filters:hover {
            background: #e8e4df;
            color: #2d332e;
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

        /* Badges de estado */
        .badge-status {
            font-size: .72rem;
            font-weight: 600;
            padding: .3rem .6rem;
            border-radius: 2px;
            letter-spacing: .3px;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-agendada     { background: #fdf3d7; color: #92740c; }
        .badge-confirmada   { background: #d6e8f7; color: #1a5fa0; }
        .badge-completada   { background: #d5e0d7; color: #2d6a37; }
        .badge-cancelada    { background: #e8d5d5; color: #9c3b3b; }
        .badge-no_presentado { background: #e4e4e4; color: #555555; }

        /* Botón detalle */
        .btn-detail {
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
            color: #5a6b5c;
        }

        .btn-detail:hover {
            background: #5a6b5c;
            color: #fff;
            border-color: #5a6b5c;
        }

        /* Swal detail rows */
        .detail-grid {
            text-align: left;
            padding: .5rem 0;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            gap: .75rem;
            padding: .55rem 0;
            border-bottom: 1px solid #f0ede9;
            font-size: .85rem;
            color: #434f44;
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-row i {
            width: 20px;
            text-align: center;
            color: #8a9a8b;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .detail-row strong {
            color: #2d332e;
            font-weight: 600;
            min-width: 100px;
        }

        .detail-row span {
            color: #434f44;
        }

        @media (max-width: 768px) {
            .historial-container { padding: 1rem; }
            .historial-header { flex-direction: column; align-items: flex-start; }
            .historial-filters { flex-direction: column; }
            .filter-group select,
            .filter-group input[type="date"] { min-width: 100%; }
        }
    </style>
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container-fluid px-3 px-md-4">
            <div class="historial-container">
                <div class="historial-header">
                    <h2 class="historial-title"><i class="fas fa-file-medical me-2" style="color:#8a9a8b;"></i>Historial de <em>Citas</em></h2>
                </div>

                <!-- Filtros -->
                <div class="historial-filters">
                    <div class="filter-group">
                        <label for="filterStatus">Estado</label>
                        <select id="filterStatus">
                            <option value="">Todos</option>
                            <option value="agendada">Agendada</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="completada">Completada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="no_presentado">No Presentado</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filterTreatment">Tratamiento</label>
                        <select id="filterTreatment">
                            <option value="">Todos</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filterDateFrom">Fecha Desde</label>
                        <input type="date" id="filterDateFrom">
                    </div>
                    <div class="filter-group">
                        <label for="filterDateTo">Fecha Hasta</label>
                        <input type="date" id="filterDateTo">
                    </div>
                    <button class="btn-clear-filters" id="btnClearFilters" type="button">
                        <i class="fas fa-eraser"></i> Limpiar
                    </button>
                </div>

                <div class="table-responsive">
                    <table id="historialTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Paciente</th>
                                <th>Tratamiento</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Detalle</th>
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
    (function() {
        'use strict';

        var API = '../controller/citas.php';

        var statusLabels = {
            'agendada':      '<span class="badge-status badge-agendada">Agendada</span>',
            'confirmada':    '<span class="badge-status badge-confirmada">Confirmada</span>',
            'completada':    '<span class="badge-status badge-completada">Completada</span>',
            'cancelada':     '<span class="badge-status badge-cancelada">Cancelada</span>',
            'no_presentado': '<span class="badge-status badge-no_presentado">No Presentado</span>'
        };

        var statusTexts = {
            'agendada': 'Agendada',
            'confirmada': 'Confirmada',
            'completada': 'Completada',
            'cancelada': 'Cancelada',
            'no_presentado': 'No Presentado'
        };

        // ── Cargar tratamientos en el filtro ──
        fetch(API + '?action=treatments')
            .then(function(r) { return r.json(); })
            .then(function(json) {
                if (!json.success) return;
                var sel = document.getElementById('filterTreatment');
                var grouped = {};
                json.data.forEach(function(t) {
                    if (!grouped[t.category]) grouped[t.category] = [];
                    grouped[t.category].push(t);
                });
                Object.keys(grouped).sort().forEach(function(cat) {
                    var optGroup = document.createElement('optgroup');
                    optGroup.label = cat;
                    grouped[cat].forEach(function(t) {
                        var opt = document.createElement('option');
                        opt.value = t.name;
                        opt.textContent = t.name;
                        optGroup.appendChild(opt);
                    });
                    sel.appendChild(optGroup);
                });
            });

        // ── Inicializar DataTable ──
        var historialTable = $('#historialTable').DataTable({
            ajax: {
                url: API + '?action=history_list',
                dataSrc: function(json) {
                    return json.success ? json.data : [];
                }
            },
            columns: [
                { data: 'number_id' },
                { data: 'patient_name' },
                {
                    data: 'treatment_name',
                    render: function(data, type, row) {
                        if (type === 'filter') return data;
                        return '<span style="color:#5a6b5c;font-weight:500;">' + escapeHtml(data) + '</span>' +
                               '<br><small style="color:#8a9a8b;">' + escapeHtml(row.category_name) + '</small>';
                    }
                },
                {
                    data: 'date_start',
                    render: function(data, type) {
                        if (!data) return '';
                        var d = new Date(data);
                        if (type === 'sort' || type === 'type') return data;
                        return d.toLocaleDateString('es-CO', { day: '2-digit', month: '2-digit', year: 'numeric' });
                    }
                },
                {
                    data: 'date_start',
                    render: function(data) {
                        if (!data) return '';
                        var d = new Date(data);
                        return d.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });
                    },
                    orderable: false
                },
                {
                    data: 'status',
                    render: function(data) {
                        return statusLabels[data] || data;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return '<button class="btn-detail" title="Ver detalle" onclick="showDetail(' + data.id + ')">' +
                                   '<i class="fas fa-eye"></i>' +
                               '</button>';
                    },
                    width: '50px',
                    className: 'text-center'
                }
            ],
            responsive: true,
            order: [[3, 'desc']],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50, 100],
            dom: '<"row mb-3"<"col-sm-6"l><"col-sm-6"f>>rtip'
        });

        // ── Filtros personalizados ──
        // Estado
        document.getElementById('filterStatus').addEventListener('change', function() {
            historialTable.column(5).search(this.value).draw();
        });

        // Tratamiento
        document.getElementById('filterTreatment').addEventListener('change', function() {
            var val = this.value;
            historialTable.column(2).search(val ? '^' + escapeRegex(val) + '$' : '', true, false).draw();
        });

        // Rango de fechas — filtro custom
        $.fn.dataTable.ext.search.push(function(settings, data) {
            if (settings.nTable.id !== 'historialTable') return true;
            var from = document.getElementById('filterDateFrom').value;
            var to   = document.getElementById('filterDateTo').value;
            if (!from && !to) return true;

            // data[2] es la fecha formateada dd/mm/yyyy, usar el raw de la columna
            var rowDate = settings.aoData[settings._iDisplayStart !== undefined ? data[data.length - 1] : 0];
            // Mejor usar la data original
            var rawData = historialTable.row(this.api ? this.api().row(data).index() : 0).data();
            return true; // fallback, usamos otro approach
        });

        // Filtro de fecha vía custom search usando los datos crudos
        $.fn.dataTable.ext.search.pop(); // quitar el anterior
        $.fn.dataTable.ext.search.push(function(settings, searchData, dataIndex) {
            if (settings.nTable.id !== 'historialTable') return true;
            var from = document.getElementById('filterDateFrom').value;
            var to   = document.getElementById('filterDateTo').value;
            if (!from && !to) return true;

            var rowData = historialTable.row(dataIndex).data();
            if (!rowData || !rowData.date_start) return false;

            var rowDate = rowData.date_start.substring(0, 10); // YYYY-MM-DD
            if (from && rowDate < from) return false;
            if (to && rowDate > to) return false;
            return true;
        });

        document.getElementById('filterDateFrom').addEventListener('change', function() {
            historialTable.draw();
        });
        document.getElementById('filterDateTo').addEventListener('change', function() {
            historialTable.draw();
        });

        // Limpiar filtros
        document.getElementById('btnClearFilters').addEventListener('click', function() {
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterTreatment').value = '';
            document.getElementById('filterDateFrom').value = '';
            document.getElementById('filterDateTo').value = '';
            historialTable.search('').columns().search('').draw();
        });

        // ── Utilidades ──
        function escapeHtml(str) {
            if (!str) return '';
            var div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

        function escapeRegex(str) {
            return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        // ── Ver detalle en SweetAlert2 ──
        window.showDetail = function(id) {
            var data = null;
            historialTable.rows().every(function() {
                var d = this.data();
                if (parseInt(d.id) === id) { data = d; }
            });

            if (!data) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se encontró la cita.', confirmButtonColor: '#5a6b5c' });
                return;
            }

            var dateStart = new Date(data.date_start);
            var dateEnd   = new Date(data.date_end);

            var fechaStr = dateStart.toLocaleDateString('es-CO', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
            var horaInicio = dateStart.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });
            var horaFin    = dateEnd.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });

            var statusBadge = statusLabels[data.status] || data.status;
            var statusText  = statusTexts[data.status] || data.status;

            var html = '<div class="detail-grid">';
            html += '<div class="detail-row"><i class="fas fa-id-card"></i><strong>Cédula</strong><span>' + escapeHtml(data.number_id) + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-user"></i><strong>Paciente</strong><span>' + escapeHtml(data.patient_name) + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-phone"></i><strong>Teléfono</strong><span>' + (data.patient_phone ? escapeHtml(data.patient_phone) : '<em style="color:#aaa;">No registrado</em>') + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-envelope"></i><strong>Correo</strong><span>' + (data.patient_email ? escapeHtml(data.patient_email) : '<em style="color:#aaa;">No registrado</em>') + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-stethoscope"></i><strong>Tratamiento</strong><span>' + escapeHtml(data.treatment_name) + ' <small style="color:#8a9a8b;">(' + escapeHtml(data.category_name) + ')</small></span></div>';
            html += '<div class="detail-row"><i class="fas fa-calendar-day"></i><strong>Fecha</strong><span style="text-transform:capitalize;">' + fechaStr + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-clock"></i><strong>Horario</strong><span>' + horaInicio + ' — ' + horaFin + '</span></div>';
            html += '<div class="detail-row"><i class="fas fa-hourglass-half"></i><strong>Duración</strong><span>' + data.duration + ' minutos</span></div>';
            html += '<div class="detail-row"><i class="fas fa-info-circle"></i><strong>Estado</strong><span>' + statusBadge + '</span></div>';

            if (data.status === 'cancelada' && data.cancel_reason) {
                html += '<div class="detail-row"><i class="fas fa-ban"></i><strong>Motivo</strong><span>' + escapeHtml(data.cancel_reason) + '</span></div>';
            }

            if (data.notes) {
                html += '<div class="detail-row"><i class="fas fa-sticky-note"></i><strong>Notas</strong><span>' + escapeHtml(data.notes) + '</span></div>';
            }

            var createdDate = new Date(data.creation_date);
            html += '<div class="detail-row"><i class="fas fa-plus-circle"></i><strong>Creada</strong><span>' + createdDate.toLocaleDateString('es-CO', { day: '2-digit', month: '2-digit', year: 'numeric' }) + ' ' + createdDate.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit' }) + '</span></div>';
            html += '</div>';

            Swal.fire({
                title: '<i class="fas fa-file-medical" style="color:#5a6b5c;margin-right:.5rem;"></i>Detalle de Cita',
                html: html,
                width: 520,
                confirmButtonText: 'Cerrar',
                confirmButtonColor: '#5a6b5c',
                customClass: { popup: 'swal-custom' }
            });
        };

    })();
    </script>
</body>
</html>
