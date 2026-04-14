<?php
/**
 * Controlador de Citas — MEDIC EDDI
 * CRUD completo vía AJAX (JSON).
 * Acciones: list, create, update, update_status, delete, treatments
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/mailer.php';

// Verificar sesión activa
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'No autenticado.']);
    exit;
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

// ── Verificar solapamiento de citas ──
function hasOverlap($conn, $date_start, $date_end, $excludeId = 0) {
    $sql = "SELECT COUNT(*) AS total FROM appointments
            WHERE status NOT IN ('cancelada','no_presentado')
              AND date_start < ? AND date_end > ?";
    if ($excludeId > 0) {
        $sql .= " AND id != ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $date_end, $date_start, $excludeId);
    } else {
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $date_end, $date_start);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return (int)$row['total'] > 0;
}

// ── Listar tratamientos (para el formulario) ──
if ($action === 'treatments') {
    $sql = "SELECT t.id, t.name, t.duration, tc.name AS category
            FROM treatments t
            JOIN treatment_categories tc ON tc.id = t.category_id
            WHERE t.active = 1
            ORDER BY tc.name, t.name";
    $result = mysqli_query($conn, $sql);
    $treatments = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $treatments[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $treatments]);
    exit;
}

// ── Listar historial de citas (para DataTables) ──
if ($action === 'history_list') {
    $sql = "SELECT a.id, a.number_id, a.patient_name, a.patient_phone, a.patient_email,
                   a.appointment_type, a.treatment_id,
                   COALESCE(t.name, '') AS treatment_name,
                   COALESCE(tc.name, '') AS category_name,
                   a.duration, a.date_start, a.date_end, a.status,
                   a.cancel_reason, a.notes, a.created_by,
                   a.creation_date, a.update_date
            FROM appointments a
            LEFT JOIN treatments t ON t.id = a.treatment_id
            LEFT JOIN treatment_categories tc ON tc.id = t.category_id
            ORDER BY a.date_start DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $data]);
    exit;
}

// ── Listar citas (para FullCalendar) ──
if ($action === 'list') {
    $start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
    $end   = isset($_GET['end'])   ? $_GET['end']   : date('Y-m-t');

    $stmt = mysqli_prepare($conn,
        "SELECT a.id, a.number_id, a.patient_name, a.patient_phone, a.patient_email,
                a.appointment_type, a.treatment_id,
                COALESCE(t.name, '') AS treatment_name,
                COALESCE(tc.name, '') AS category_name,
                a.duration, a.date_start, a.date_end, a.status,
                a.cancel_reason, a.notes, a.created_by
         FROM appointments a
         LEFT JOIN treatments t ON t.id = a.treatment_id
         LEFT JOIN treatment_categories tc ON tc.id = t.category_id
         WHERE a.date_start >= ? AND a.date_end <= ?
         ORDER BY a.date_start"
    );
    mysqli_stmt_bind_param($stmt, 'ss', $start, $end);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $events = [];
    $statusColors = [
        'agendada'      => '#e6a817',
        'confirmada'    => '#2e86de',
        'cancelada'     => '#9c5b5b',
        'completada'    => '#5a6b5c',
        'no_presentado' => '#6b726d'
    ];

    $typeLabels = ['valoracion' => 'Valoración', 'revision' => 'Revisión'];

    while ($row = mysqli_fetch_assoc($result)) {
        // Título del evento según tipo de cita
        if ($row['appointment_type'] === 'tratamiento' && !empty($row['treatment_name'])) {
            $title = $row['patient_name'] . ' — ' . $row['treatment_name'];
        } else {
            $title = $row['patient_name'] . ' — ' . ($typeLabels[$row['appointment_type']] ?? '');
        }

        $events[] = [
            'id'    => $row['id'],
            'title' => $title,
            'start' => $row['date_start'],
            'end'   => $row['date_end'],
            'color' => isset($statusColors[$row['status']]) ? $statusColors[$row['status']] : '#5a6b5c',
            'extendedProps' => [
                'number_id'      => $row['number_id'],
                'patient_name'   => $row['patient_name'],
                'patient_phone'  => $row['patient_phone'],
                'patient_email'  => $row['patient_email'],
                'appointment_type' => $row['appointment_type'],
                'treatment_id'   => $row['treatment_id'],
                'treatment'      => $row['treatment_name'],
                'category'       => $row['category_name'],
                'duration'       => $row['duration'],
                'status'         => $row['status'],
                'cancel_reason'  => $row['cancel_reason'],
                'notes'          => $row['notes']
            ]
        ];
    }

    mysqli_stmt_close($stmt);
    echo json_encode($events);
    exit;
}

// A partir de aquí solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

// ── Crear cita ──
if ($action === 'create') {
    $appointment_type = isset($_POST['appointment_type']) ? trim($_POST['appointment_type']) : 'tratamiento';
    $number_id     = isset($_POST['number_id'])     ? trim($_POST['number_id'])     : '';
    $patient_name  = isset($_POST['patient_name'])  ? trim($_POST['patient_name'])  : '';
    $patient_phone = isset($_POST['patient_phone']) ? trim($_POST['patient_phone']) : '';
    $patient_email = isset($_POST['patient_email']) ? trim($_POST['patient_email']) : '';
    $treatment_id  = isset($_POST['treatment_id'])  ? (int)$_POST['treatment_id']   : 0;
    $duration      = isset($_POST['duration'])      ? (int)$_POST['duration']       : 60;
    $date_start    = isset($_POST['date_start'])    ? trim($_POST['date_start'])    : '';
    $notes         = isset($_POST['notes'])         ? trim($_POST['notes'])         : '';

    // Validar tipo de cita
    $validTypes = ['valoracion', 'revision', 'tratamiento'];
    if (!in_array($appointment_type, $validTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipo de cita no válido.']);
        exit;
    }

    // Validaciones base
    if (empty($number_id) || empty($patient_name) || empty($patient_phone) || empty($patient_email) || empty($date_start)) {
        echo json_encode(['success' => false, 'message' => 'Cédula, nombre, teléfono, correo y fecha son obligatorios.']);
        exit;
    }

    // Solo requerir tratamiento para tipo 'tratamiento'
    if ($appointment_type === 'tratamiento' && $treatment_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Seleccione un tratamiento.']);
        exit;
    }

    // Fijar duración según tipo de cita
    if ($appointment_type === 'valoracion') {
        $duration = 40;
        $treatment_id = 0;
    } elseif ($appointment_type === 'revision') {
        $duration = 20;
        $treatment_id = 0;
    }

    if (!ctype_digit($number_id)) {
        echo json_encode(['success' => false, 'message' => 'La cédula solo debe contener números.']);
        exit;
    }

    if ($patient_email && !filter_var($patient_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    if ($duration < 15 || $duration > 480) {
        $duration = 60;
    }

    // Calcular fecha fin
    $startDt = new DateTime($date_start);
    $endDt   = clone $startDt;
    $endDt->modify("+{$duration} minutes");
    $date_end = $endDt->format('Y-m-d H:i:s');

    // Verificar solapamiento
    if (hasOverlap($conn, $date_start, $date_end)) {
        echo json_encode(['success' => false, 'message' => 'Ya existe una cita programada en ese horario. Por favor seleccione otra fecha u hora.']);
        exit;
    }

    $created_by = (int)$_SESSION['user_id'];

    if ($treatment_id > 0) {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO appointments (number_id, patient_name, patient_phone, patient_email, appointment_type, treatment_id, duration, date_start, date_end, status, notes, created_by)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'agendada', ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'sssssiisssi',
            $number_id, $patient_name, $patient_phone, $patient_email,
            $appointment_type, $treatment_id, $duration, $date_start, $date_end,
            $notes, $created_by
        );
    } else {
        $stmt = mysqli_prepare($conn,
            "INSERT INTO appointments (number_id, patient_name, patient_phone, patient_email, appointment_type, treatment_id, duration, date_start, date_end, status, notes, created_by)
             VALUES (?, ?, ?, ?, ?, NULL, ?, ?, ?, 'agendada', ?, ?)"
        );
        mysqli_stmt_bind_param($stmt, 'sssssisssi',
            $number_id, $patient_name, $patient_phone, $patient_email,
            $appointment_type, $duration, $date_start, $date_end,
            $notes, $created_by
        );
    }

    if (mysqli_stmt_execute($stmt)) {
        $newId = mysqli_insert_id($conn);

        // Enviar notificación por correo si hay email
        $emailSent = false;
        if (!empty($patient_email)) {
            $treatmentName = '';
            $categoryName  = '';

            if ($appointment_type === 'tratamiento' && $treatment_id > 0) {
                // Obtener nombre del tratamiento y categoría
                $tStmt = mysqli_prepare($conn, "SELECT t.name AS treatment_name, tc.name AS category_name FROM treatments t JOIN treatment_categories tc ON tc.id = t.category_id WHERE t.id = ? LIMIT 1");
                mysqli_stmt_bind_param($tStmt, 'i', $treatment_id);
                mysqli_stmt_execute($tStmt);
                $tResult = mysqli_stmt_get_result($tStmt);
                $tData = mysqli_fetch_assoc($tResult);
                mysqli_stmt_close($tStmt);
                if ($tData) {
                    $treatmentName = $tData['treatment_name'];
                    $categoryName  = $tData['category_name'];
                }
            } else {
                $apptTypeLabels = ['valoracion' => 'Valoración', 'revision' => 'Revisión'];
                $treatmentName = $apptTypeLabels[$appointment_type] ?? '';
                $categoryName  = 'Tipo de Cita';
            }

            if ($treatmentName) {
                $emailSent = sendAppointmentEmail($conn, [
                    'patient_name'   => $patient_name,
                    'patient_email'  => $patient_email,
                    'patient_phone'  => $patient_phone,
                    'treatment_name' => $treatmentName,
                    'category_name'  => $categoryName,
                    'date_start'     => $date_start,
                    'date_end'       => $date_end,
                    'duration'       => $duration,
                    'notes'          => $notes
                ]);
            }
        }

        echo json_encode([
            'success' => true,
            'message' => 'Cita creada exitosamente.' . ($emailSent ? ' Se envió notificación al correo.' : ''),
            'id'      => $newId,
            'email_sent' => $emailSent
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear la cita.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// ── Actualizar cita (edición completa o drag & drop) ──
if ($action === 'update') {
    $id              = isset($_POST['id'])              ? (int)$_POST['id']              : 0;
    $appointment_type = isset($_POST['appointment_type']) ? trim($_POST['appointment_type']) : 'tratamiento';
    $number_id     = isset($_POST['number_id'])     ? trim($_POST['number_id'])     : '';
    $patient_name  = isset($_POST['patient_name'])  ? trim($_POST['patient_name'])  : '';
    $patient_phone = isset($_POST['patient_phone']) ? trim($_POST['patient_phone']) : '';
    $patient_email = isset($_POST['patient_email']) ? trim($_POST['patient_email']) : '';
    $treatment_id  = isset($_POST['treatment_id'])  ? (int)$_POST['treatment_id']   : 0;
    $duration      = isset($_POST['duration'])      ? (int)$_POST['duration']       : 60;
    $date_start    = isset($_POST['date_start'])    ? trim($_POST['date_start'])    : '';
    $notes         = isset($_POST['notes'])         ? trim($_POST['notes'])         : '';

    // Validar tipo de cita
    $validTypes = ['valoracion', 'revision', 'tratamiento'];
    if (!in_array($appointment_type, $validTypes)) {
        echo json_encode(['success' => false, 'message' => 'Tipo de cita no válido.']);
        exit;
    }

    if ($id <= 0 || empty($number_id) || empty($patient_name) || empty($patient_phone) || empty($patient_email) || empty($date_start)) {
        echo json_encode(['success' => false, 'message' => 'Cédula, nombre, teléfono, correo y fecha son obligatorios.']);
        exit;
    }

    if ($appointment_type === 'tratamiento' && $treatment_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Seleccione un tratamiento.']);
        exit;
    }

    // Fijar duración según tipo de cita
    if ($appointment_type === 'valoracion') {
        $duration = 40;
        $treatment_id = 0;
    } elseif ($appointment_type === 'revision') {
        $duration = 20;
        $treatment_id = 0;
    }

    if (!ctype_digit($number_id)) {
        echo json_encode(['success' => false, 'message' => 'La cédula solo debe contener números.']);
        exit;
    }

    if ($duration < 15 || $duration > 480) {
        $duration = 60;
    }

    $startDt = new DateTime($date_start);
    $endDt   = clone $startDt;
    $endDt->modify("+{$duration} minutes");
    $date_end = $endDt->format('Y-m-d H:i:s');

    // Verificar solapamiento (excluye la cita actual)
    if (hasOverlap($conn, $date_start, $date_end, $id)) {
        echo json_encode(['success' => false, 'message' => 'Ya existe una cita programada en ese horario. Por favor seleccione otra fecha u hora.']);
        exit;
    }

    if ($treatment_id > 0) {
        $stmt = mysqli_prepare($conn,
            "UPDATE appointments SET number_id=?, patient_name=?, patient_phone=?, patient_email=?,
                    appointment_type=?, treatment_id=?, duration=?, date_start=?, date_end=?, notes=?
             WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, 'sssssiisssi',
            $number_id, $patient_name, $patient_phone, $patient_email,
            $appointment_type, $treatment_id, $duration, $date_start, $date_end,
            $notes, $id
        );
    } else {
        $stmt = mysqli_prepare($conn,
            "UPDATE appointments SET number_id=?, patient_name=?, patient_phone=?, patient_email=?,
                    appointment_type=?, treatment_id=NULL, duration=?, date_start=?, date_end=?, notes=?
             WHERE id=?"
        );
        mysqli_stmt_bind_param($stmt, 'sssssisssi',
            $number_id, $patient_name, $patient_phone, $patient_email,
            $appointment_type, $duration, $date_start, $date_end,
            $notes, $id
        );
    }

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cita actualizada exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la cita.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// ── Reprogramar (drag & drop / resize) ──
if ($action === 'reschedule') {
    $id         = isset($_POST['id'])         ? (int)$_POST['id']         : 0;
    $date_start = isset($_POST['date_start']) ? trim($_POST['date_start']) : '';
    $date_end   = isset($_POST['date_end'])   ? trim($_POST['date_end'])   : '';

    if ($id <= 0 || empty($date_start) || empty($date_end)) {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos para reprogramar.']);
        exit;
    }

    // Recalcular duración
    $s = new DateTime($date_start);
    $e = new DateTime($date_end);
    $diff = $s->diff($e);
    $duration = ($diff->h * 60) + $diff->i;

    // Verificar solapamiento (excluye la cita actual)
    if (hasOverlap($conn, $date_start, $date_end, $id)) {
        echo json_encode(['success' => false, 'message' => 'Ya existe una cita programada en ese horario. Por favor seleccione otra fecha u hora.']);
        exit;
    }

    $stmt = mysqli_prepare($conn,
        "UPDATE appointments SET date_start=?, date_end=?, duration=? WHERE id=?"
    );
    mysqli_stmt_bind_param($stmt, 'ssii', $date_start, $date_end, $duration, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cita reprogramada.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al reprogramar.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// ── Cambiar estado ──
if ($action === 'update_status') {
    $id     = isset($_POST['id'])     ? (int)$_POST['id']     : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $cancel_reason = isset($_POST['cancel_reason']) ? trim($_POST['cancel_reason']) : null;

    $validStatuses = ['agendada', 'confirmada', 'cancelada', 'completada', 'no_presentado'];
    if ($id <= 0 || !in_array($status, $validStatuses)) {
        echo json_encode(['success' => false, 'message' => 'Estado no válido.']);
        exit;
    }

    if ($status === 'cancelada' && $cancel_reason) {
        $stmt = mysqli_prepare($conn, "UPDATE appointments SET status=?, cancel_reason=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssi', $status, $cancel_reason, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE appointments SET status=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Estado actualizado.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar estado.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

// ── Eliminar cita ──
if ($action === 'delete') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID de cita no válido.']);
        exit;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM appointments WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Cita eliminada.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar la cita.']);
    }
    mysqli_stmt_close($stmt);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
