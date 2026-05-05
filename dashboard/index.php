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
                <div class="col-6 col-md">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="dash-stat-number" id="stat-citas-hoy">
                            <span class="stat-spinner"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </div>
                        <div class="dash-stat-label">Citas Hoy</div>
                    </div>
                </div>
                <div class="col-6 col-md">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-user-injured"></i></div>
                        <div class="dash-stat-number" id="stat-pacientes">
                            <span class="stat-spinner"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </div>
                        <div class="dash-stat-label">Pacientes</div>
                    </div>
                </div>
                <div class="col-6 col-md">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-notes-medical"></i></div>
                        <div class="dash-stat-number" id="stat-consultas-mes">
                            <span class="stat-spinner"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </div>
                        <div class="dash-stat-label">Consultas Mes</div>
                    </div>
                </div>
                <div class="col-6 col-md">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="dash-stat-number" id="stat-por-confirmar">
                            <span class="stat-spinner"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </div>
                        <div class="dash-stat-label">Por Confirmar</div>
                    </div>
                </div>
                <div class="col-6 col-md">
                    <div class="dash-stat-card">
                        <div class="dash-stat-icon"><i class="fas fa-eye"></i></div>
                        <div class="dash-stat-number" id="stat-visitas">
                            <span class="stat-spinner"><i class="fas fa-circle-notch fa-spin"></i></span>
                        </div>
                        <div class="dash-stat-label">Visitas Web</div>
                    </div>
                </div>
            </div>

            <!-- Citas de hoy -->
            <div class="dash-welcome-card">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                    <h5 class="mb-0" style="font-family:'Playfair Display',serif; font-weight:400; color:#2d332e;">
                        <i class="fas fa-calendar-day me-2" style="color:#8a9a8b; font-size:.9rem;"></i>Citas de Hoy
                    </h5>
                    <span class="text-muted" style="font-size:.78rem;" id="hoy-last-update"></span>
                </div>

                <!-- Tabla -->
                <div id="hoy-table-wrap" class="table-responsive">
                    <div class="text-center py-4 text-muted" id="hoy-loading">
                        <i class="fas fa-circle-notch fa-spin me-2"></i>Cargando citas…
                    </div>
                    <table class="table table-sm align-middle mb-0" id="hoy-table" style="display:none;">
                        <thead>
                            <tr style="font-size:.75rem; text-transform:uppercase; letter-spacing:.4px; color:#8a9a8b; border-bottom:2px solid #e8e4df;">
                                <th style="font-weight:600; padding:.75rem .5rem;">Hora</th>
                                <th style="font-weight:600; padding:.75rem .5rem;">Paciente</th>
                                <th style="font-weight:600; padding:.75rem .5rem;" class="d-none d-md-table-cell">Tratamiento</th>
                                <th style="font-weight:600; padding:.75rem .5rem;" class="d-none d-sm-table-cell">Duración</th>
                                <th style="font-weight:600; padding:.75rem .5rem;">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="hoy-tbody" style="font-size:.88rem; color:#434f44;"></tbody>
                    </table>
                    <div class="text-center py-4" id="hoy-empty" style="display:none;">
                        <i class="fas fa-calendar-xmark fa-2x mb-2" style="color:#c4cec6;"></i>
                        <p class="text-muted mb-0" style="font-size:.9rem;">No hay citas programadas para hoy.</p>
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
    (function () {
        'use strict';

        const ENDPOINT    = '../components/dash/dashboard_hoy';
        const INTERVAL_MS = 30000; // actualiza cada 30 segundos

        // ── Mapas de etiquetas ──────────────────────────────────────
        const STATUS_BADGE = {
            agendada      : '<span class="badge" style="background:#fff3cd;color:#856404;border:1px solid #ffc107;font-weight:500;font-size:.72rem;border-radius:2px;">Agendada</span>',
            confirmada    : '<span class="badge" style="background:#d1e7dd;color:#0f5132;border:1px solid #a3cfbb;font-weight:500;font-size:.72rem;border-radius:2px;">Confirmada</span>',
            completada    : '<span class="badge" style="background:#e8e4df;color:#434f44;border:1px solid #c4cec6;font-weight:500;font-size:.72rem;border-radius:2px;">Completada</span>',
            cancelada     : '<span class="badge" style="background:#f8d7da;color:#842029;border:1px solid #f5c2c7;font-weight:500;font-size:.72rem;border-radius:2px;">Cancelada</span>',
            no_presentado : '<span class="badge" style="background:#f5f3f0;color:#6b726d;border:1px solid #e8e4df;font-weight:500;font-size:.72rem;border-radius:2px;">No presentó</span>',
        };

        const APPT_TYPE_LABEL = {
            valoracion  : 'Valoración',
            revision    : 'Revisión',
            tratamiento : null,  // usa nombre del tratamiento
        };

        // ── Elementos DOM ───────────────────────────────────────────
        const els = {
            citasHoy    : document.getElementById('stat-citas-hoy'),
            pacientes   : document.getElementById('stat-pacientes'),
            consultasMes: document.getElementById('stat-consultas-mes'),
            porConfirmar: document.getElementById('stat-por-confirmar'),
            visitas     : document.getElementById('stat-visitas'),
            loading     : document.getElementById('hoy-loading'),
            table       : document.getElementById('hoy-table'),
            tbody       : document.getElementById('hoy-tbody'),
            empty       : document.getElementById('hoy-empty'),
            lastUpdate  : document.getElementById('hoy-last-update'),
        };

        // ── Utilidades ──────────────────────────────────────────────
        function fmtHora(datetimeStr) {
            const d = new Date(datetimeStr.replace(' ', 'T'));
            return d.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });
        }

        function animateNumber(el, value) {
            el.textContent = value;
        }

        function renderStats(stats) {
            animateNumber(els.citasHoy,     stats.citas_hoy);
            animateNumber(els.pacientes,    stats.pacientes);
            animateNumber(els.consultasMes, stats.consultas_mes);
            animateNumber(els.porConfirmar, stats.por_confirmar);
            animateNumber(els.visitas,      stats.visitas_total);
        }

        function renderAppointments(appointments) {
            els.loading.style.display = 'none';

            if (!appointments || appointments.length === 0) {
                els.table.style.display  = 'none';
                els.empty.style.display  = 'block';
                return;
            }

            els.empty.style.display  = 'none';
            els.table.style.display  = '';

            const rows = appointments.map(function (a) {
                const hora      = fmtHora(a.date_start);
                const horaFin   = fmtHora(a.date_end);
                const typeLabel = APPT_TYPE_LABEL[a.appointment_type];
                const trat      = typeLabel !== null
                    ? typeLabel
                    : (a.treatment_name || a.appointment_type);
                const badge     = STATUS_BADGE[a.status] || a.status;
                const duracion  = a.duration + ' min';

                return '<tr style="border-bottom:1px solid #f5f3f0;">'
                    + '<td style="padding:.65rem .5rem; white-space:nowrap; color:#5a6b5c; font-variant-numeric:tabular-nums;">'
                    +     hora + '<span class="d-none d-sm-inline text-muted"> – ' + horaFin + '</span>'
                    + '</td>'
                    + '<td style="padding:.65rem .5rem;">'
                    +     '<span style="font-weight:500;">' + escapeHtml(a.patient_name) + '</span>'
                    +     (a.patient_phone ? '<br><small class="text-muted">' + escapeHtml(a.patient_phone) + '</small>' : '')
                    + '</td>'
                    + '<td style="padding:.65rem .5rem;" class="d-none d-md-table-cell">' + escapeHtml(trat) + '</td>'
                    + '<td style="padding:.65rem .5rem;" class="d-none d-sm-table-cell text-muted">' + duracion + '</td>'
                    + '<td style="padding:.65rem .5rem;">' + badge + '</td>'
                    + '</tr>';
            });

            els.tbody.innerHTML = rows.join('');
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        // ── Fetch principal ─────────────────────────────────────────
        function fetchDashboard() {
            fetch(ENDPOINT, { credentials: 'same-origin' })
                .then(function (res) {
                    if (res.status === 401) { window.location.href = '../index.php'; return null; }
                    if (!res.ok) { throw new Error('HTTP ' + res.status); }
                    return res.json();
                })
                .then(function (data) {
                    if (!data || !data.success) return;
                    renderStats(data.stats);
                    renderAppointments(data.appointments);

                    const now = new Date();
                    els.lastUpdate.textContent = 'Actualizado a las '
                        + now.toLocaleTimeString('es-CO', { hour: '2-digit', minute: '2-digit', hour12: true });
                })
                .catch(function () {
                    // silencioso: se reintenta en el siguiente ciclo
                });
        }

        // ── Inicialización y polling ────────────────────────────────
        fetchDashboard();
        setInterval(fetchDashboard, INTERVAL_MS);

    })();
    </script>

</body>
</html>
