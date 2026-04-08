<?php
/**
 * Servicio de correo — MEDIC EDDI
 * Usa PHPMailer + configuración SMTP desde la tabla smtpconfig (id=1).
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * Obtiene la configuración SMTP de la base de datos.
 */
function getSmtpConfig($conn) {
    $stmt = mysqli_prepare($conn, "SELECT username, host, email, password, port, dependence, Subject FROM smtpconfig WHERE id = 1 LIMIT 1");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $config = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $config;
}

/**
 * Envía correo de notificación de cita agendada.
 *
 * @param mysqli $conn       Conexión a BD
 * @param array  $appointment Datos de la cita:
 *   - patient_name, patient_email, patient_phone
 *   - treatment_name, category_name
 *   - date_start, date_end, duration, notes
 * @return bool
 */
function sendAppointmentEmail($conn, $appointment) {
    if (empty($appointment['patient_email'])) {
        return false;
    }

    $smtpConfig = getSmtpConfig($conn);
    if (!$smtpConfig) {
        return false;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host       = $smtpConfig['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpConfig['username'];
        $mail->Password   = $smtpConfig['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = (int)$smtpConfig['port'];
        $mail->CharSet    = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom($smtpConfig['email'], 'Doctora Eddi');
        $mail->addAddress($appointment['patient_email'], $appointment['patient_name']);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Tu cita ha sido agendada — Doctora Eddi';

        // Adjuntar logo como imagen embebida
        $logoPath = __DIR__ . '/../img/logos/logo_eddi_crema.png';
        if (file_exists($logoPath)) {
            $mail->addEmbeddedImage($logoPath, 'logo_eddi', 'logo_eddi_crema.png', 'base64', 'image/png');
        }

        $mail->Body    = buildAppointmentEmailHTML($appointment);
        $mail->AltBody = buildAppointmentEmailText($appointment);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Genera el HTML del correo de notificación de cita.
 */
function buildAppointmentEmailHTML($appt) {
    $patientName   = htmlspecialchars($appt['patient_name'], ENT_QUOTES, 'UTF-8');
    $treatment     = htmlspecialchars($appt['treatment_name'], ENT_QUOTES, 'UTF-8');
    $category      = htmlspecialchars($appt['category_name'], ENT_QUOTES, 'UTF-8');
    $duration      = (int)$appt['duration'];

    // Formatear fecha
    $dt = new DateTime($appt['date_start']);
    $dayNames = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    $monthNames = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $dayOfWeek = $dayNames[(int)$dt->format('w')];
    $day       = $dt->format('d');
    $month     = $monthNames[(int)$dt->format('n')];
    $year      = $dt->format('Y');
    $time      = $dt->format('h:i A');
    $dateFormatted = "$dayOfWeek, $day de $month de $year";

    return '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Agendada</title>
</head>
<body style="margin:0;padding:0;background:#f5f3f0;font-family:Inter,Helvetica,Arial,sans-serif;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f5f3f0;padding:30px 15px;">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" border="0" width="600" style="max-width:600px;width:100%;">

                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(135deg,#5a6b5c 0%,#4a5a4c 100%);padding:30px 30px 25px;text-align:center;border-radius:2px 2px 0 0;">
                            <img src="cid:logo_eddi" alt="Doctora Eddi" style="max-width:200px;height:auto;margin-bottom:12px;">
                            <p style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:13px;color:rgba(255,255,255,.65);margin:0;letter-spacing:.5px;text-transform:uppercase;">
                                Confirmación de Cita
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="background:#ffffff;padding:35px 30px 20px;border-left:1px solid #e8e4df;border-right:1px solid #e8e4df;">
                            <p style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:16px;color:#2d332e;margin:0 0 6px;">
                                Hola, <strong>' . $patientName . '</strong>
                            </p>
                            <p style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:14px;color:#6b726d;margin:0 0 25px;line-height:1.6;">
                                Tu cita ha sido agendada exitosamente. A continuación encontrarás los detalles:
                            </p>

                            <!-- Appointment Card -->
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#fdfcfb;border:1px solid #e8e4df;border-radius:2px;">

                                <!-- Date highlight -->
                                <tr>
                                    <td style="padding:18px 20px;border-bottom:1px solid #f0ede9;text-align:center;">
                                        <div style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:12px;color:#8a9a8b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Fecha</div>
                                        <div style="font-family:Georgia,\'Playfair Display\',serif;font-size:20px;color:#2d332e;font-weight:400;">' . $dateFormatted . '</div>
                                    </td>
                                </tr>

                                <!-- Time & Duration -->
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid #f0ede9;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td width="50%" style="text-align:center;padding:0 5px;">
                                                    <div style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:11px;color:#8a9a8b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Hora</div>
                                                    <div style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:18px;color:#5a6b5c;font-weight:600;">' . $time . '</div>
                                                </td>
                                                <td width="50%" style="text-align:center;padding:0 5px;border-left:1px solid #f0ede9;">
                                                    <div style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:11px;color:#8a9a8b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Duración</div>
                                                    <div style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:18px;color:#5a6b5c;font-weight:600;">' . $duration . ' min</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Treatment -->
                                <tr>
                                    <td style="padding:14px 20px;border-bottom:1px solid #f0ede9;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:11px;color:#8a9a8b;text-transform:uppercase;letter-spacing:.5px;padding-bottom:4px;">
                                                    Tratamiento
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:15px;color:#2d332e;font-weight:500;">
                                                    ' . $treatment . '
                                                    <span style="font-size:12px;color:#8a9a8b;font-weight:400;margin-left:6px;">(' . $category . ')</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>

                            <!-- Reminder notice -->
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:20px;">
                                <tr>
                                    <td style="background:#f0ede9;border-left:3px solid #5a6b5c;padding:12px 16px;border-radius:0 2px 2px 0;">
                                        <p style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:13px;color:#434f44;margin:0;line-height:1.5;">
                                            <strong>Recordatorio:</strong> Te recomendamos llegar 10 minutos antes de tu cita. Si necesitas cancelar o reprogramar, por favor contáctanos con al menos 24 horas de anticipación.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Location -->
                    <tr>
                        <td style="background:#ffffff;padding:0 30px 30px;border-left:1px solid #e8e4df;border-right:1px solid #e8e4df;">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-top:1px solid #f0ede9;padding-top:20px;">
                                <tr>
                                    <td style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:12px;color:#8a9a8b;text-transform:uppercase;letter-spacing:.5px;padding-bottom:10px;">
                                        Ubicación
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:14px;color:#434f44;line-height:1.6;">
                                        <strong>Carrera 43 A # 1 Sur - 50, El Poblado</strong><br>
                                        Edificio Cross Business, Consultorio 1102<br>
                                        <span style="color:#8a9a8b;">Medellín, Colombia</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#2d332e;padding:25px 30px;border-radius:0 0 2px 2px;text-align:center;">
                            <!-- Contact -->
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:16px;">
                                <tr>
                                    <td align="center" style="padding-bottom:12px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="padding:0 12px;">
                                                    <a href="https://wa.me/573013537082" target="_blank" style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:13px;color:#c4cec6;text-decoration:none;">
                                                        &#128222; +57 3013537082
                                                    </a>
                                                </td>
                                                <td style="padding:0 12px;border-left:1px solid #434f44;">
                                                    <a href="mailto:doctora.eddi@gmail.com" style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:13px;color:#c4cec6;text-decoration:none;">
                                                        &#9993; doctora.eddi@gmail.com
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Social -->
                            <table cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 16px;">
                                <tr>
                                    <td style="padding:0 6px;">
                                        <a href="https://www.instagram.com/doctora.eddi" target="_blank" style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:13px;color:#c4cec6;text-decoration:none;">
                                            &#128247; @doctora.eddi
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Copyright -->
                            <p style="font-family:Inter,Helvetica,Arial,sans-serif;font-size:11px;color:#6b726d;margin:0;line-height:1.5;">
                                Doctora Eddi &copy; ' . date('Y') . ' — Todos los derechos reservados<br>
                                <a href="https://www.agenciaeaglesoftware.com/" target="_blank" style="color:#8a9a8b;text-decoration:none;">Eagle Software</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
}

/**
 * Versión texto plano del correo.
 */
function buildAppointmentEmailText($appt) {
    $dt = new DateTime($appt['date_start']);

    $text  = "DOCTORA EDDI — Confirmación de Cita\n";
    $text .= "====================================\n\n";
    $text .= "Hola, " . $appt['patient_name'] . "\n\n";
    $text .= "Tu cita ha sido agendada exitosamente.\n\n";
    $text .= "DETALLES DE LA CITA:\n";
    $text .= "- Fecha: " . $dt->format('d/m/Y') . "\n";
    $text .= "- Hora: " . $dt->format('h:i A') . "\n";
    $text .= "- Duración: " . $appt['duration'] . " minutos\n";
    $text .= "- Tratamiento: " . $appt['treatment_name'] . " (" . $appt['category_name'] . ")\n";
    $text .= "\nUBICACIÓN:\n";
    $text .= "Carrera 43 A # 1 Sur - 50, El Poblado\n";
    $text .= "Edificio Cross Business, Consultorio 1102\n";
    $text .= "Medellín, Colombia\n\n";
    $text .= "CONTACTO:\n";
    $text .= "WhatsApp: +57 3013537082\n";
    $text .= "Correo: doctora.eddi@gmail.com\n";
    $text .= "Instagram: @doctora.eddi\n\n";
    $text .= "Recordatorio: Te recomendamos llegar 10 minutos antes de tu cita.\n\n";
    $text .= "Doctora Eddi © " . date('Y') . " — Todos los derechos reservados\n";

    return $text;
}
