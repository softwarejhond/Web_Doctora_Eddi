<?php
/**
 * AJAX Endpoint — Stats y Citas de Hoy
 * Componente del dashboard: devuelve JSON con estadísticas
 * y el listado de citas del día actual.
 *
 * Ruta: components/dash/dashboard_hoy.php
 */
session_start();
header('Content-Type: application/json; charset=utf-8');

// Verificar sesión activa
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autenticado.']);
    exit;
}

require_once __DIR__ . '/../../controller/conexion.php';

// ── Estadísticas ────────────────────────────────────────────

// 1. Citas de hoy (activas: agendada, confirmada, completada)
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS n FROM appointments
     WHERE DATE(date_start) = CURDATE()
       AND status IN ('agendada','confirmada','completada')"
);
$citasHoy = (int)mysqli_fetch_assoc($r)['n'];

// 2. Pacientes únicos por cédula
$r = mysqli_query($conn,
    "SELECT COUNT(DISTINCT number_id) AS n FROM appointments
     WHERE number_id IS NOT NULL AND number_id != ''"
);
$pacientes = (int)mysqli_fetch_assoc($r)['n'];

// 3. Consultas completadas este mes
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS n FROM appointments
     WHERE MONTH(date_start) = MONTH(NOW())
       AND YEAR(date_start)  = YEAR(NOW())
       AND status = 'completada'"
);
$consultasMes = (int)mysqli_fetch_assoc($r)['n'];

// 4. Citas pendientes de confirmación
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS n FROM appointments
     WHERE status = 'agendada'"
);
$porConfirmar = (int)mysqli_fetch_assoc($r)['n'];

// 5. Visitas totales a la landing
$r = mysqli_query($conn, "SELECT COUNT(*) AS n FROM page_visits");
$visitasTotal = (int)mysqli_fetch_assoc($r)['n'];

// 6. Visitas este mes
$r = mysqli_query($conn,
    "SELECT COUNT(*) AS n FROM page_visits
     WHERE MONTH(visited_at) = MONTH(NOW())
       AND YEAR(visited_at)  = YEAR(NOW())"
);
$visitasMes = (int)mysqli_fetch_assoc($r)['n'];

// ── Citas de hoy ────────────────────────────────────────────
$sql = "SELECT a.id,
               a.patient_name,
               a.patient_phone,
               a.appointment_type,
               a.duration,
               a.date_start,
               a.date_end,
               a.status,
               COALESCE(t.name,  '') AS treatment_name,
               COALESCE(tc.name, '') AS category_name
        FROM appointments a
        LEFT JOIN treatments t            ON t.id  = a.treatment_id
        LEFT JOIN treatment_categories tc ON tc.id = t.category_id
        WHERE DATE(a.date_start) = CURDATE()
        ORDER BY a.date_start ASC";

$result = mysqli_query($conn, $sql);
$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

echo json_encode([
    'success' => true,
    'stats'   => [
        'citas_hoy'     => $citasHoy,
        'pacientes'     => $pacientes,
        'consultas_mes' => $consultasMes,
        'por_confirmar' => $porConfirmar,
        'visitas_total' => $visitasTotal,
        'visitas_mes'   => $visitasMes,
    ],
    'appointments' => $appointments,
]);
