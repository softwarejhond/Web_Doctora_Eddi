<?php
/**
 * Módulo de Citas — Dashboard MEDIC EDDI
 * Calendario visual con FullCalendar v6
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
    <title>Citas — Doctora Eddi</title>

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
        /* ===== Calendario ===== */
        .citas-container {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.5rem;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
        }

        .citas-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .citas-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem;
            font-weight: 400;
            color: #2d332e;
            margin: 0;
        }

        .citas-title em { font-style: italic; color: #5a6b5c; }

        .btn-new-appt {
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

        .btn-new-appt:hover {
            background: #4a5a4c;
            border-color: #4a5a4c;
        }

        /* Leyenda de estados */
        .citas-legend {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            margin-bottom: 1rem;
        }

        .citas-legend-item {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .75rem;
            color: #6b726d;
        }

        .citas-legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* FullCalendar overrides para mantener estética */
        #calendar {
            min-height: 600px;
        }

        .fc {
            font-family: 'Inter', sans-serif;
        }

        .fc .fc-toolbar-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.2rem;
            font-weight: 400;
            color: #2d332e;
        }

        .fc .fc-button-primary {
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            color: #434f44;
            font-size: .8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .3px;
            padding: .35rem .7rem;
            transition: all .15s;
        }

        .fc .fc-button-primary:hover {
            background: #eceae6;
            border-color: #c4cec6;
            color: #2d332e;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background: #5a6b5c;
            border-color: #5a6b5c;
            color: #ffffff;
        }

        .fc .fc-button-primary:focus {
            box-shadow: 0 0 0 3px rgba(90,107,92,.15);
        }

        .fc .fc-daygrid-day.fc-day-today {
            background: rgba(90,107,92,.06);
        }

        .fc .fc-timegrid-now-indicator-line {
            border-color: #5a6b5c;
        }

        .fc .fc-timegrid-now-indicator-arrow {
            border-color: #5a6b5c;
        }

        .fc-event {
            border-radius: 2px;
            font-size: .78rem;
            padding: 2px 4px;
            cursor: pointer;
            border: none;
        }

        .fc .fc-col-header-cell-cushion {
            font-size: .78rem;
            font-weight: 600;
            color: #434f44;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .fc .fc-daygrid-day-number {
            font-size: .82rem;
            color: #6b726d;
        }

        .fc th {
            border-color: #e8e4df;
        }

        .fc td {
            border-color: #e8e4df;
        }

        .fc .fc-scrollgrid {
            border-color: #e8e4df;
        }

        /* Detail popup */
        .appt-detail-row {
            display: flex;
            align-items: flex-start;
            gap: .6rem;
            margin-bottom: .7rem;
            font-size: .88rem;
            color: #434f44;
        }

        .appt-detail-row i {
            width: 18px;
            text-align: center;
            color: #8a9a8b;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .appt-detail-row strong {
            color: #2d332e;
        }

        .appt-status-badge {
            display: inline-block;
            padding: .25rem .65rem;
            border-radius: 2px;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .3px;
            color: #ffffff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .citas-container { padding: 1rem; }
            .citas-header { flex-direction: column; align-items: flex-start; }
            #calendar { min-height: 400px; }
            .fc .fc-toolbar { flex-direction: column; gap: .5rem; }
        }
    </style>
</head>
<body class="dash-body">

    <?php include __DIR__ . '/../components/dash/sidebar.php'; ?>
    <?php include __DIR__ . '/../components/dash/header.php'; ?>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="dash-main">
        <div class="container-fluid px-3 px-md-4">
            <div class="citas-container">
                <div class="citas-header">
                    <h1 class="citas-title"><em>Agenda</em> de Citas</h1>
                    <button class="btn-new-appt" id="btnNewAppt" type="button">
                        <i class="fas fa-plus"></i> Nueva Cita
                    </button>
                </div>

                <!-- Leyenda -->
                <div class="citas-legend">
                    <div class="citas-legend-item"><span class="citas-legend-dot" style="background:#e6a817;"></span> Agendada</div>
                    <div class="citas-legend-item"><span class="citas-legend-dot" style="background:#2e86de;"></span> Confirmada</div>
                    <div class="citas-legend-item"><span class="citas-legend-dot" style="background:#5a6b5c;"></span> Completada</div>
                    <div class="citas-legend-item"><span class="citas-legend-dot" style="background:#9c5b5b;"></span> Cancelada</div>
                    <div class="citas-legend-item"><span class="citas-legend-dot" style="background:#6b726d;"></span> No presentado</div>
                </div>

                <!-- Calendario -->
                <div id="calendar"></div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS (local) -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 (local) -->
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- FullCalendar (local) -->
    <script src="../node_modules/@fullcalendar/core/index.global.min.js"></script>
    <script src="../node_modules/@fullcalendar/daygrid/index.global.min.js"></script>
    <script src="../node_modules/@fullcalendar/timegrid/index.global.min.js"></script>
    <script src="../node_modules/@fullcalendar/interaction/index.global.min.js"></script>
    <script src="../node_modules/@fullcalendar/list/index.global.min.js"></script>

    <script>
    (function() {
        'use strict';

        var API = '../controller/citas.php';
        var treatments = [];
        var calendar;

        // ── Colores por estado ──
        var statusColors = {
            agendada:      '#e6a817',
            confirmada:    '#2e86de',
            cancelada:     '#9c5b5b',
            completada:    '#5a6b5c',
            no_presentado: '#6b726d'
        };

        var statusLabels = {
            agendada:      'Agendada',
            confirmada:    'Confirmada',
            cancelada:     'Cancelada',
            completada:    'Completada',
            no_presentado: 'No Presentado'
        };

        // ── Cargar tratamientos al inicio ──
        function loadTreatments(cb) {
            fetch(API + '?action=treatments')
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) treatments = data.data;
                    if (cb) cb();
                });
        }

        // ── Generar <select> agrupado por categoría ──
        function treatmentSelectHTML(selectedId) {
            var categories = {};
            treatments.forEach(function(t) {
                if (!categories[t.category]) categories[t.category] = [];
                categories[t.category].push(t);
            });
            var html = '<select id="swal-treatment" class="swal-select">';
            html += '<option value="">— Seleccionar tratamiento —</option>';
            for (var cat in categories) {
                html += '<optgroup label="' + cat + '">';
                categories[cat].forEach(function(t) {
                    var sel = (parseInt(t.id) === parseInt(selectedId)) ? ' selected' : '';
                    html += '<option value="' + t.id + '" data-duration="' + t.duration + '"' + sel + '>'
                          + t.name + ' (' + t.duration + ' min)</option>';
                });
                html += '</optgroup>';
            }
            html += '</select>';
            return html;
        }

        // ── Formulario HTML para crear/editar ──
        function appointmentFormHTML(data) {
            var d = data || {};
            return '<div style="padding:0 .5rem; text-align:left;">'
                + '<div class="swal-input-group">'
                + '  <label for="swal-patient">Nombre del Paciente *</label>'
                + '  <input type="text" id="swal-patient" value="' + (d.patient_name || '') + '" placeholder="Nombre completo" maxlength="200">'
                + '</div>'
                + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">'
                + '  <div class="swal-input-group">'
                + '    <label for="swal-phone">Teléfono</label>'
                + '    <input type="tel" id="swal-phone" value="' + (d.patient_phone || '') + '" placeholder="300 123 4567" maxlength="20">'
                + '  </div>'
                + '  <div class="swal-input-group">'
                + '    <label for="swal-email">Email</label>'
                + '    <input type="email" id="swal-email" value="' + (d.patient_email || '') + '" placeholder="correo@ejemplo.com">'
                + '  </div>'
                + '</div>'
                + '<div class="swal-input-group">'
                + '  <label>Tratamiento *</label>'
                + treatmentSelectHTML(d.treatment_id || '')
                + '</div>'
                + '<div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">'
                + '  <div class="swal-input-group">'
                + '    <label for="swal-datetime">Fecha y Hora *</label>'
                + '    <input type="datetime-local" id="swal-datetime" value="' + (d.date_start || '') + '">'
                + '  </div>'
                + '  <div class="swal-input-group">'
                + '    <label for="swal-duration">Duración (min)</label>'
                + '    <select id="swal-duration">'
                + '      <option value="15"'+ (d.duration==15?' selected':'') +'>15 min</option>'
                + '      <option value="30"'+ (d.duration==30?' selected':'') +'>30 min</option>'
                + '      <option value="45"'+ (d.duration==45?' selected':'') +'>45 min</option>'
                + '      <option value="60"'+ ((d.duration==60||!d.duration)?' selected':'') +'>60 min</option>'
                + '      <option value="90"'+ (d.duration==90?' selected':'') +'>90 min</option>'
                + '      <option value="120"'+ (d.duration==120?' selected':'') +'>120 min</option>'
                + '    </select>'
                + '  </div>'
                + '</div>'
                + '<div class="swal-input-group">'
                + '  <label for="swal-notes">Notas</label>'
                + '  <input type="text" id="swal-notes" value="' + (d.notes || '') + '" placeholder="Observaciones internas...">'
                + '</div>'
                + '</div>';
        }

        // ── Validar y recoger datos del form ──
        function collectFormData() {
            var patient   = document.getElementById('swal-patient').value.trim();
            var phone     = document.getElementById('swal-phone').value.trim();
            var email     = document.getElementById('swal-email').value.trim();
            var treatment = document.getElementById('swal-treatment').value;
            var datetime  = document.getElementById('swal-datetime').value;
            var duration  = document.getElementById('swal-duration').value;
            var notes     = document.getElementById('swal-notes').value.trim();

            if (!patient) { Swal.showValidationMessage('El nombre del paciente es obligatorio.'); return false; }
            if (!treatment) { Swal.showValidationMessage('Seleccione un tratamiento.'); return false; }
            if (!datetime) { Swal.showValidationMessage('Seleccione fecha y hora.'); return false; }

            return {
                patient_name:  patient,
                patient_phone: phone,
                patient_email: email,
                treatment_id:  treatment,
                date_start:    datetime.replace('T', ' ') + ':00',
                duration:      duration,
                notes:         notes
            };
        }

        // ── Auto-llenar duración cuando cambia tratamiento ──
        function bindTreatmentDuration() {
            var sel = document.getElementById('swal-treatment');
            if (sel) {
                sel.addEventListener('change', function() {
                    var opt = sel.options[sel.selectedIndex];
                    var dur = opt.getAttribute('data-duration');
                    if (dur) document.getElementById('swal-duration').value = dur;
                });
            }
        }

        // ── CREAR CITA ──
        function openCreateDialog(startDate) {
            var defaultDate = startDate || '';
            if (defaultDate && defaultDate.length === 10) defaultDate += 'T09:00';

            Swal.fire({
                title: '<i class="fas fa-calendar-plus" style="color:#5a6b5c;margin-right:.5rem;"></i>Nueva Cita',
                html: appointmentFormHTML({ date_start: defaultDate }),
                customClass: { popup: 'swal-custom' },
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check me-1"></i>Agendar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5a6b5c',
                cancelButtonColor: '#8a9a8b',
                width: 540,
                didOpen: bindTreatmentDuration,
                focusConfirm: false,
                preConfirm: function() {
                    var formData = collectFormData();
                    if (!formData) return false;

                    var fd = new FormData();
                    fd.append('action', 'create');
                    for (var k in formData) fd.append(k, formData[k]);

                    return fetch(API, { method: 'POST', body: fd })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (!data.success) { Swal.showValidationMessage(data.message); return false; }
                            return data;
                        })
                        .catch(function() { Swal.showValidationMessage('Error de conexión.'); });
                }
            }).then(function(result) {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        icon: 'success', title: '¡Cita agendada!',
                        text: result.value.message,
                        confirmButtonColor: '#5a6b5c',
                        customClass: { popup: 'swal-custom' }
                    });
                    calendar.refetchEvents();
                }
            });
        }

        // ── VER / EDITAR CITA (click en evento) ──
        function openEventDetail(info) {
            var ev = info.event;
            var p = ev.extendedProps;
            var color = statusColors[p.status] || '#5a6b5c';
            var label = statusLabels[p.status] || p.status;

            var startStr = new Date(ev.start).toLocaleString('es-CO', {
                weekday:'short', year:'numeric', month:'short', day:'numeric',
                hour:'2-digit', minute:'2-digit'
            });
            var endStr = ev.end ? new Date(ev.end).toLocaleString('es-CO', {hour:'2-digit', minute:'2-digit'}) : '';

            var detailHTML = ''
                + '<div style="text-align:left;padding:0 .5rem;">'
                + '<div class="appt-detail-row"><i class="fas fa-user"></i><div><strong>' + p.patient_name + '</strong></div></div>'
                + (p.patient_phone ? '<div class="appt-detail-row"><i class="fas fa-phone"></i><div>' + p.patient_phone + '</div></div>' : '')
                + (p.patient_email ? '<div class="appt-detail-row"><i class="fas fa-envelope"></i><div>' + p.patient_email + '</div></div>' : '')
                + '<div class="appt-detail-row"><i class="fas fa-syringe"></i><div><strong>' + p.category + '</strong> → ' + p.treatment + '</div></div>'
                + '<div class="appt-detail-row"><i class="fas fa-clock"></i><div>' + startStr + (endStr ? ' — ' + endStr : '') + ' (' + p.duration + ' min)</div></div>'
                + '<div class="appt-detail-row"><i class="fas fa-tag"></i><div><span class="appt-status-badge" style="background:' + color + '">' + label + '</span></div></div>'
                + (p.notes ? '<div class="appt-detail-row"><i class="fas fa-sticky-note"></i><div style="color:#6b726d;font-style:italic;">' + p.notes + '</div></div>' : '')
                + (p.cancel_reason ? '<div class="appt-detail-row"><i class="fas fa-ban"></i><div style="color:#9c5b5b;">Motivo: ' + p.cancel_reason + '</div></div>' : '')
                + '</div>';

            Swal.fire({
                title: '<i class="fas fa-calendar-check" style="color:#5a6b5c;margin-right:.5rem;"></i>Detalle de Cita',
                html: detailHTML,
                customClass: { popup: 'swal-custom' },
                width: 480,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-edit me-1"></i>Editar',
                denyButtonText: '<i class="fas fa-exchange-alt me-1"></i>Estado',
                cancelButtonText: 'Cerrar',
                confirmButtonColor: '#5a6b5c',
                denyButtonColor: '#2e86de',
            }).then(function(result) {
                if (result.isConfirmed) {
                    openEditDialog(ev);
                } else if (result.isDenied) {
                    openStatusDialog(ev);
                }
            });
        }

        // ── EDITAR CITA ──
        function openEditDialog(ev) {
            var p = ev.extendedProps;
            var startLocal = '';
            if (ev.start) {
                var d = new Date(ev.start);
                startLocal = d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-'
                           + String(d.getDate()).padStart(2,'0') + 'T'
                           + String(d.getHours()).padStart(2,'0') + ':' + String(d.getMinutes()).padStart(2,'0');
            }

            Swal.fire({
                title: '<i class="fas fa-edit" style="color:#5a6b5c;margin-right:.5rem;"></i>Editar Cita',
                html: appointmentFormHTML({
                    patient_name:  p.patient_name,
                    patient_phone: p.patient_phone,
                    patient_email: p.patient_email,
                    treatment_id:  p.treatment_id,
                    date_start:    startLocal,
                    duration:      p.duration,
                    notes:         p.notes
                }),
                customClass: { popup: 'swal-custom' },
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: '<i class="fas fa-save me-1"></i>Guardar',
                denyButtonText: '<i class="fas fa-trash me-1"></i>Eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5a6b5c',
                denyButtonColor: '#9c5b5b',
                width: 540,
                didOpen: bindTreatmentDuration,
                focusConfirm: false,
                preConfirm: function() {
                    var formData = collectFormData();
                    if (!formData) return false;

                    var fd = new FormData();
                    fd.append('action', 'update');
                    fd.append('id', ev.id);
                    for (var k in formData) fd.append(k, formData[k]);

                    return fetch(API, { method: 'POST', body: fd })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (!data.success) { Swal.showValidationMessage(data.message); return false; }
                            return data;
                        })
                        .catch(function() { Swal.showValidationMessage('Error de conexión.'); });
                },
                preDeny: function() {
                    return Swal.fire({
                        title: '¿Eliminar cita?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'No',
                        confirmButtonColor: '#9c5b5b',
                        customClass: { popup: 'swal-custom' }
                    }).then(function(r) {
                        if (r.isConfirmed) {
                            var fd = new FormData();
                            fd.append('action', 'delete');
                            fd.append('id', ev.id);
                            return fetch(API, { method: 'POST', body: fd })
                                .then(function(r) { return r.json(); })
                                .then(function(data) { return data; });
                        }
                        return false;
                    });
                }
            }).then(function(result) {
                if (result.isConfirmed && result.value) {
                    Swal.fire({ icon:'success', title:'Cita actualizada', confirmButtonColor:'#5a6b5c', customClass:{popup:'swal-custom'} });
                    calendar.refetchEvents();
                } else if (result.isDenied && result.value && result.value.success) {
                    Swal.fire({ icon:'success', title:'Cita eliminada', confirmButtonColor:'#5a6b5c', customClass:{popup:'swal-custom'} });
                    calendar.refetchEvents();
                }
            });
        }

        // ── CAMBIAR ESTADO ──
        function openStatusDialog(ev) {
            var p = ev.extendedProps;

            var statusHTML = '<div style="text-align:left;padding:0 .5rem;">'
                + '<p style="font-size:.85rem;color:#6b726d;">Estado actual: <strong>' + (statusLabels[p.status]||p.status) + '</strong></p>'
                + '<div class="swal-input-group"><label for="swal-status">Nuevo Estado</label>'
                + '<select id="swal-status">'
                + '<option value="agendada"'+ (p.status==='agendada'?' selected':'') +'>Agendada</option>'
                + '<option value="confirmada"'+ (p.status==='confirmada'?' selected':'') +'>Confirmada</option>'
                + '<option value="completada"'+ (p.status==='completada'?' selected':'') +'>Completada</option>'
                + '<option value="cancelada"'+ (p.status==='cancelada'?' selected':'') +'>Cancelada</option>'
                + '<option value="no_presentado"'+ (p.status==='no_presentado'?' selected':'') +'>No Presentado</option>'
                + '</select></div>'
                + '<div class="swal-input-group" id="cancel-reason-group" style="display:none;">'
                + '<label for="swal-cancel-reason">Motivo de Cancelación</label>'
                + '<input type="text" id="swal-cancel-reason" placeholder="Motivo breve..." maxlength="500">'
                + '</div></div>';

            Swal.fire({
                title: '<i class="fas fa-exchange-alt" style="color:#2e86de;margin-right:.5rem;"></i>Cambiar Estado',
                html: statusHTML,
                customClass: { popup: 'swal-custom' },
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-check me-1"></i>Actualizar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5a6b5c',
                width: 420,
                didOpen: function() {
                    var sel = document.getElementById('swal-status');
                    var grp = document.getElementById('cancel-reason-group');
                    sel.addEventListener('change', function() {
                        grp.style.display = sel.value === 'cancelada' ? 'block' : 'none';
                    });
                    if (sel.value === 'cancelada') grp.style.display = 'block';
                },
                focusConfirm: false,
                preConfirm: function() {
                    var status = document.getElementById('swal-status').value;
                    var reason = document.getElementById('swal-cancel-reason').value.trim();

                    var fd = new FormData();
                    fd.append('action', 'update_status');
                    fd.append('id', ev.id);
                    fd.append('status', status);
                    if (status === 'cancelada' && reason) fd.append('cancel_reason', reason);

                    return fetch(API, { method: 'POST', body: fd })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (!data.success) { Swal.showValidationMessage(data.message); return false; }
                            return data;
                        })
                        .catch(function() { Swal.showValidationMessage('Error de conexión.'); });
                }
            }).then(function(result) {
                if (result.isConfirmed && result.value) {
                    Swal.fire({ icon:'success', title:'Estado actualizado', confirmButtonColor:'#5a6b5c', customClass:{popup:'swal-custom'} });
                    calendar.refetchEvents();
                }
            });
        }

        // ── Inicializar FullCalendar ──
        function initCalendar() {
            var calendarEl = document.getElementById('calendar');

            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left:   'prev,next today',
                    center: 'title',
                    right:  'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week:  'Semana',
                    day:   'Día',
                    list:  'Lista'
                },
                allDayText: 'Todo el día',
                noEventsText: 'No hay citas para mostrar',
                slotMinTime: '07:00:00',
                slotMaxTime: '21:00:00',
                slotDuration: '00:30:00',
                navLinks: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                eventDurationEditable: true,
                dayMaxEvents: 3,
                nowIndicator: true,
                height: 'auto',

                // Cargar eventos desde API
                events: function(info, successCallback, failureCallback) {
                    var start = info.startStr.split('T')[0];
                    var end   = info.endStr.split('T')[0];
                    fetch(API + '?action=list&start=' + start + '&end=' + end)
                        .then(function(r) { return r.json(); })
                        .then(function(data) { successCallback(data); })
                        .catch(function(err) { failureCallback(err); });
                },

                // Click en día vacío → crear cita
                dateClick: function(info) {
                    openCreateDialog(info.dateStr);
                },

                // Selección de rango → crear cita con hora
                select: function(info) {
                    var start = info.startStr;
                    if (start.includes('T')) {
                        start = start.substring(0, 16);
                    }
                    openCreateDialog(start);
                },

                // Click en evento → ver detalle
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    openEventDetail(info);
                },

                // Drag & drop → reprogramar
                eventDrop: function(info) {
                    var fd = new FormData();
                    fd.append('action', 'reschedule');
                    fd.append('id', info.event.id);
                    fd.append('date_start', info.event.start.toISOString().replace('T', ' ').substring(0, 19));
                    fd.append('date_end', info.event.end
                        ? info.event.end.toISOString().replace('T', ' ').substring(0, 19)
                        : info.event.start.toISOString().replace('T', ' ').substring(0, 19));

                    fetch(API, { method: 'POST', body: fd })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (!data.success) {
                                info.revert();
                                Swal.fire({ icon:'error', title:'Error', text:data.message, customClass:{popup:'swal-custom'} });
                            }
                        })
                        .catch(function() { info.revert(); });
                },

                // Resize → cambiar duración
                eventResize: function(info) {
                    var fd = new FormData();
                    fd.append('action', 'reschedule');
                    fd.append('id', info.event.id);
                    fd.append('date_start', info.event.start.toISOString().replace('T', ' ').substring(0, 19));
                    fd.append('date_end', info.event.end.toISOString().replace('T', ' ').substring(0, 19));

                    fetch(API, { method: 'POST', body: fd })
                        .then(function(r) { return r.json(); })
                        .then(function(data) {
                            if (!data.success) {
                                info.revert();
                                Swal.fire({ icon:'error', title:'Error', text:data.message, customClass:{popup:'swal-custom'} });
                            }
                        })
                        .catch(function() { info.revert(); });
                }
            });

            calendar.render();
        }

        // ── Botón nueva cita ──
        document.getElementById('btnNewAppt').addEventListener('click', function() {
            openCreateDialog('');
        });

        // ── Init ──
        loadTreatments(function() {
            initCalendar();
        });

    })();
    </script>
</body>
</html>
