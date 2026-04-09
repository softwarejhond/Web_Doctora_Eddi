-- =============================================
-- Datos de prueba — MEDIC EDDI
-- 100+ citas de ejemplo para testing
-- Ejecutar DESPUÉS de appointments.sql y users.sql
-- Base de datos: medic_eddi
-- =============================================

-- Pacientes de prueba (rol 3)
-- Password para todos: Test1234*
INSERT INTO `users` (`username`, `full_name`, `email`, `password`, `picture`, `rol`, `active`) VALUES
(1001001001, 'María López García',       'maria.lopez@correo.com',       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001002, 'Carlos Andrés Ramírez',    'carlos.ramirez@correo.com',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001003, 'Ana Sofía Martínez',       'ana.martinez@correo.com',      '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001004, 'Juan Pablo Torres',        'juan.torres@correo.com',       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001005, 'Laura Valentina Díaz',     'laura.diaz@correo.com',        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001006, 'Diego Alejandro Herrera',  'diego.herrera@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001007, 'Camila Andrea Rojas',      'camila.rojas@correo.com',      '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001008, 'Sebastián Morales',        'sebastian.morales@correo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001009, 'Valentina Castillo',       'valentina.castillo@correo.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001010, 'Andrés Felipe Vargas',     'andres.vargas@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001011, 'Isabella Restrepo',        'isabella.restrepo@correo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001012, 'Miguel Ángel Peña',        'miguel.pena@correo.com',       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001013, 'Daniela Gómez Ríos',       'daniela.gomez@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001014, 'Julián Esteban Castro',    'julian.castro@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001015, 'Paula Andrea Mendoza',     'paula.mendoza@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001016, 'Santiago Ruiz Ospina',     'santiago.ruiz@correo.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001017, 'Natalia Suárez Pineda',    'natalia.suarez@correo.com',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001018, 'Tomás Hernández Cano',     'tomas.hernandez@correo.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001019, 'Sara Jiménez Duque',       'sara.jimenez@correo.com',      '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1),
(1001001020, 'Ricardo Salazar Mejía',    'ricardo.salazar@correo.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 3, 1);

-- Doctor de prueba (rol 2)
INSERT INTO `users` (`username`, `full_name`, `email`, `password`, `picture`, `rol`, `active`) VALUES
(2002002001, 'Dra. Eddi Carolina Pérez', 'dra.eddi@medicinaintegrativa.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'default.png', 2, 1);

-- =============================================
-- 105 Citas de prueba — Variedad de estados, tratamientos y fechas
-- treatment_id: 1-18 según appointments.sql
-- created_by: 1 (admin)
-- =============================================

INSERT INTO `appointments` (`patient_name`, `patient_phone`, `patient_email`, `treatment_id`, `duration`, `date_start`, `date_end`, `status`, `cancel_reason`, `notes`, `created_by`) VALUES
-- === ENERO 2026 — Citas completadas ===
('María López García',       '3101234567', 'maria.lopez@correo.com',       1, 30, '2026-01-05 08:00:00', '2026-01-05 08:30:00', 'completada', NULL, 'Primera sesión de toxina botulínica. Paciente satisfecha.', 1),
('Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    7, 60, '2026-01-05 09:00:00', '2026-01-05 10:00:00', 'completada', NULL, 'Bioestimulación capilar, buena respuesta.', 1),
('Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      2, 45, '2026-01-06 10:00:00', '2026-01-06 10:45:00', 'completada', NULL, 'Relleno de labios con ácido hialurónico.', 1),
('Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       17, 30, '2026-01-07 08:30:00', '2026-01-07 09:00:00', 'completada', NULL, 'Consulta general de seguimiento.', 1),
('Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        4, 60, '2026-01-08 11:00:00', '2026-01-08 12:00:00', 'completada', NULL, 'Microneedling facial, resultados positivos.', 1),
('Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     10, 90, '2026-01-09 14:00:00', '2026-01-09 15:30:00', 'cancelada', 'Paciente reportó malestar previo a la cita.', NULL, 1),
('Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      5, 45, '2026-01-12 08:00:00', '2026-01-12 08:45:00', 'completada', NULL, 'Limpieza facial profunda, piel sensible.', 1),
('Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 8, 45, '2026-01-13 09:30:00', '2026-01-13 10:15:00', 'completada', NULL, 'Mesoterapia capilar sesión 2 de 6.', 1),
('Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com',3, 60, '2026-01-14 10:00:00', '2026-01-14 11:00:00', 'completada', NULL, 'Peeling químico, tolerancia adecuada.', 1),
('Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     16, 60, '2026-01-15 15:00:00', '2026-01-15 16:00:00', 'no_presentado', NULL, 'Paciente no se presentó, se intentó contactar.', 1),

-- === FEBRERO 2026 ===
('Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 6, 60, '2026-02-02 08:00:00', '2026-02-02 09:00:00', 'completada', NULL, 'Radiofrecuencia facial, buena tolerancia.', 1),
('Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       9, 60, '2026-02-03 09:00:00', '2026-02-03 10:00:00', 'completada', NULL, 'PRP capilar, extracción de sangre sin complicaciones.', 1),
('Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     14, 60, '2026-02-04 10:30:00', '2026-02-04 11:30:00', 'completada', NULL, 'Plasma rico en plaquetas, procedimiento exitoso.', 1),
('Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     11, 60, '2026-02-05 14:00:00', '2026-02-05 15:00:00', 'completada', NULL, 'Radiofrecuencia corporal zona abdominal.', 1),
('Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     1, 30, '2026-02-06 08:00:00', '2026-02-06 08:30:00', 'cancelada', 'Paciente viajó fuera de la ciudad.', NULL, 1),
('Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     17, 30, '2026-02-09 08:30:00', '2026-02-09 09:00:00', 'completada', NULL, 'Control mensual, evolución favorable.', 1),
('Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    2, 45, '2026-02-10 10:00:00', '2026-02-10 10:45:00', 'completada', NULL, 'Ácido hialurónico en surcos nasogenianos.', 1),
('Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   15, 45, '2026-02-11 11:00:00', '2026-02-11 11:45:00', 'completada', NULL, 'Ozonoterapia, primera sesión.', 1),
('Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      12, 45, '2026-02-12 14:30:00', '2026-02-12 15:15:00', 'no_presentado', NULL, NULL, 1),
('Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   13, 60, '2026-02-13 09:00:00', '2026-02-13 10:00:00', 'completada', NULL, 'Drenaje linfático, paciente refiere mejoría.', 1),

-- === MARZO 2026 ===
('María López García',       '3101234567', 'maria.lopez@correo.com',       1, 30, '2026-03-02 08:00:00', '2026-03-02 08:30:00', 'completada', NULL, 'Segunda sesión de toxina. Retoque zona frontal.', 1),
('Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    7, 60, '2026-03-03 09:00:00', '2026-03-03 10:00:00', 'completada', NULL, 'Bioestimulación capilar sesión 2.', 1),
('Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      18, 45, '2026-03-04 10:00:00', '2026-03-04 10:45:00', 'completada', NULL, 'Valoración integral, se define plan de tratamiento.', 1),
('Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       4, 60, '2026-03-05 11:00:00', '2026-03-05 12:00:00', 'cancelada', 'Reagendado por solicitud del paciente.', NULL, 1),
('Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        6, 60, '2026-03-06 08:00:00', '2026-03-06 09:00:00', 'completada', NULL, 'Radiofrecuencia facial, segunda sesión.', 1),
('Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     10, 90, '2026-03-09 14:00:00', '2026-03-09 15:30:00', 'completada', NULL, 'Reducción de grasa, zona flancos.', 1),
('Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      3, 60, '2026-03-10 09:00:00', '2026-03-10 10:00:00', 'completada', NULL, 'Peeling químico medio, buena tolerancia.', 1),
('Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 8, 45, '2026-03-11 09:30:00', '2026-03-11 10:15:00', 'completada', NULL, 'Mesoterapia capilar sesión 3 de 6.', 1),
('Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com',5, 45, '2026-03-12 10:00:00', '2026-03-12 10:45:00', 'completada', NULL, 'Limpieza facial profunda post-peeling.', 1),
('Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     16, 60, '2026-03-13 15:00:00', '2026-03-13 16:00:00', 'completada', NULL, 'Sueroterapia vitaminas, paciente reporta más energía.', 1),
('Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 2, 45, '2026-03-16 08:00:00', '2026-03-16 08:45:00', 'completada', NULL, 'Ácido hialurónico ojeras.', 1),
('Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       9, 60, '2026-03-17 09:00:00', '2026-03-17 10:00:00', 'no_presentado', NULL, 'No se presentó. Se reprogramará.', 1),
('Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     1, 30, '2026-03-18 10:30:00', '2026-03-18 11:00:00', 'completada', NULL, 'Toxina botulínica entrecejo y patas de gallo.', 1),
('Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     15, 45, '2026-03-19 14:00:00', '2026-03-19 14:45:00', 'completada', NULL, 'Ozonoterapia sesión 2, mejoría en dolor articular.', 1),
('Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     14, 60, '2026-03-20 08:00:00', '2026-03-20 09:00:00', 'completada', NULL, 'PRP facial, procedimiento sin complicaciones.', 1),

-- === ABRIL 2026 (mes actual) ===
('Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     11, 60, '2026-04-01 08:00:00', '2026-04-01 09:00:00', 'completada', NULL, 'Radiofrecuencia corporal muslos.', 1),
('Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    4, 60, '2026-04-01 10:00:00', '2026-04-01 11:00:00', 'completada', NULL, 'Microneedling con vitaminas.', 1),
('Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   7, 60, '2026-04-02 09:00:00', '2026-04-02 10:00:00', 'completada', NULL, 'Bioestimulación capilar, se observa mejoría.', 1),
('Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      5, 45, '2026-04-02 11:00:00', '2026-04-02 11:45:00', 'completada', NULL, 'Limpieza facial profunda.', 1),
('Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   13, 60, '2026-04-03 14:00:00', '2026-04-03 15:00:00', 'completada', NULL, 'Drenaje linfático, segunda sesión.', 1),
('María López García',       '3101234567', 'maria.lopez@correo.com',       6, 60, '2026-04-03 08:00:00', '2026-04-03 09:00:00', 'completada', NULL, 'Radiofrecuencia facial sesión 1.', 1),
('Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    8, 45, '2026-04-04 09:00:00', '2026-04-04 09:45:00', 'confirmada', NULL, 'Mesoterapia capilar sesión 4.', 1),
('Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      1, 30, '2026-04-07 08:00:00', '2026-04-07 08:30:00', 'confirmada', NULL, 'Toxina botulínica retoque.', 1),
('Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       4, 60, '2026-04-07 10:00:00', '2026-04-07 11:00:00', 'confirmada', NULL, 'Microneedling segunda sesión.', 1),
('Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        3, 60, '2026-04-07 14:00:00', '2026-04-07 15:00:00', 'agendada', NULL, 'Peeling químico medio.', 1),
('Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     12, 45, '2026-04-08 08:00:00', '2026-04-08 08:45:00', 'agendada', NULL, 'Mesoterapia corporal abdomen.', 1),
('Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      2, 45, '2026-04-08 10:00:00', '2026-04-08 10:45:00', 'agendada', NULL, 'Ácido hialurónico labios.', 1),
('Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 8, 45, '2026-04-08 11:00:00', '2026-04-08 11:45:00', 'agendada', NULL, 'Mesoterapia capilar sesión 4 de 6.', 1),
('Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com',14, 60, '2026-04-09 09:00:00', '2026-04-09 10:00:00', 'agendada', NULL, 'PRP facial rejuvenecimiento.', 1),
('Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     17, 30, '2026-04-09 10:30:00', '2026-04-09 11:00:00', 'confirmada', NULL, 'Consulta general de control.', 1),
('Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 6, 60, '2026-04-09 14:00:00', '2026-04-09 15:00:00', 'agendada', NULL, 'Radiofrecuencia facial sesión 2.', 1),
('Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       9, 60, '2026-04-10 08:00:00', '2026-04-10 09:00:00', 'agendada', NULL, 'PRP capilar reprogramado.', 1),
('Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     18, 45, '2026-04-10 10:00:00', '2026-04-10 10:45:00', 'agendada', NULL, 'Valoración integral para nuevo plan.', 1),
('Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     10, 90, '2026-04-10 14:00:00', '2026-04-10 15:30:00', 'agendada', NULL, 'Reducción de grasa, primera sesión.', 1),

-- === Citas futuras ABRIL ===
('Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     2, 45, '2026-04-14 08:00:00', '2026-04-14 08:45:00', 'agendada', NULL, 'Ácido hialurónico ojeras.', 1),
('Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     16, 60, '2026-04-14 10:00:00', '2026-04-14 11:00:00', 'agendada', NULL, 'Sueroterapia vitaminas IV.', 1),
('Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    1, 30, '2026-04-15 08:00:00', '2026-04-15 08:30:00', 'agendada', NULL, 'Toxina botulínica frontal.', 1),
('Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   15, 45, '2026-04-15 09:30:00', '2026-04-15 10:15:00', 'agendada', NULL, 'Ozonoterapia sesión 3.', 1),
('Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      3, 60, '2026-04-16 10:00:00', '2026-04-16 11:00:00', 'agendada', NULL, 'Peeling químico superficial.', 1),
('Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   11, 60, '2026-04-16 14:00:00', '2026-04-16 15:00:00', 'agendada', NULL, 'Radiofrecuencia corporal brazos.', 1),
('María López García',       '3101234567', 'maria.lopez@correo.com',       5, 45, '2026-04-17 08:00:00', '2026-04-17 08:45:00', 'agendada', NULL, NULL, 1),
('Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    7, 60, '2026-04-17 09:00:00', '2026-04-17 10:00:00', 'agendada', NULL, 'Bioestimulación capilar sesión 3.', 1),
('Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      4, 60, '2026-04-21 10:00:00', '2026-04-21 11:00:00', 'agendada', NULL, 'Microneedling, tercera sesión.', 1),
('Juan Pablo Torres',        '3154567890', NULL,                            17, 30, '2026-04-21 11:30:00', '2026-04-21 12:00:00', 'agendada', NULL, 'Consulta de seguimiento.', 1),
('Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        6, 60, '2026-04-22 08:00:00', '2026-04-22 09:00:00', 'agendada', NULL, 'Radiofrecuencia facial sesión 3.', 1),
('Diego Alejandro Herrera',  '3201234567', NULL,                            10, 90, '2026-04-22 14:00:00', '2026-04-22 15:30:00', 'agendada', NULL, 'Reducción de grasa sesión 2.', 1),
('Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      14, 60, '2026-04-23 09:00:00', '2026-04-23 10:00:00', 'agendada', NULL, 'PRP facial.', 1),
('Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 8, 45, '2026-04-23 10:30:00', '2026-04-23 11:15:00', 'agendada', NULL, 'Mesoterapia capilar sesión 5 de 6.', 1),
('Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com',2, 45, '2026-04-24 08:00:00', '2026-04-24 08:45:00', 'agendada', NULL, 'Ácido hialurónico mentón.', 1),
('Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     16, 60, '2026-04-24 10:00:00', '2026-04-24 11:00:00', 'agendada', NULL, 'Sueroterapia segunda sesión.', 1),
('Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 1, 30, '2026-04-28 08:00:00', '2026-04-28 08:30:00', 'agendada', NULL, 'Toxina botulínica.', 1),
('Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       7, 60, '2026-04-28 09:00:00', '2026-04-28 10:00:00', 'agendada', NULL, 'Bioestimulación capilar.', 1),
('Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     5, 45, '2026-04-29 10:00:00', '2026-04-29 10:45:00', 'agendada', NULL, 'Limpieza facial profunda.', 1),
('Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     13, 60, '2026-04-29 14:00:00', '2026-04-29 15:00:00', 'agendada', NULL, 'Drenaje linfático.', 1),
('Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     6, 60, '2026-04-30 08:00:00', '2026-04-30 09:00:00', 'agendada', NULL, NULL, 1),

-- === MAYO 2026 ===
('Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     4, 60, '2026-05-04 10:00:00', '2026-05-04 11:00:00', 'agendada', NULL, 'Microneedling primera sesión.', 1),
('Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    12, 45, '2026-05-05 08:00:00', '2026-05-05 08:45:00', 'agendada', NULL, 'Mesoterapia corporal.', 1),
('Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   15, 45, '2026-05-05 10:00:00', '2026-05-05 10:45:00', 'agendada', NULL, 'Ozonoterapia sesión 4.', 1),
('Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      1, 30, '2026-05-06 08:00:00', '2026-05-06 08:30:00', 'agendada', NULL, 'Toxina botulínica primera vez.', 1),
('Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   14, 60, '2026-05-06 09:00:00', '2026-05-06 10:00:00', 'agendada', NULL, 'PRP rodillas.', 1),
('María López García',       '3101234567', 'maria.lopez@correo.com',       2, 45, '2026-05-07 10:00:00', '2026-05-07 10:45:00', 'agendada', NULL, 'Ácido hialurónico surcos.', 1),
('Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    8, 45, '2026-05-07 11:00:00', '2026-05-07 11:45:00', 'agendada', NULL, 'Mesoterapia capilar sesión 5.', 1),
('Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      16, 60, '2026-05-08 14:00:00', '2026-05-08 15:00:00', 'agendada', NULL, 'Sueroterapia vitaminas.', 1),
('Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       3, 60, '2026-05-11 10:00:00', '2026-05-11 11:00:00', 'agendada', NULL, 'Peeling químico.', 1),
('Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        11, 60, '2026-05-11 14:00:00', '2026-05-11 15:00:00', 'agendada', NULL, 'Radiofrecuencia corporal.', 1),
('Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     17, 30, '2026-05-12 08:00:00', '2026-05-12 08:30:00', 'agendada', NULL, 'Consulta de control post-tratamiento.', 1),
('Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      18, 45, '2026-05-12 09:00:00', '2026-05-12 09:45:00', 'agendada', NULL, 'Valoración integral semestral.', 1),
('Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 8, 45, '2026-05-13 09:30:00', '2026-05-13 10:15:00', 'agendada', NULL, 'Mesoterapia capilar sesión 6 de 6 (última).', 1),
('Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com',10, 90, '2026-05-13 14:00:00', '2026-05-13 15:30:00', 'agendada', NULL, 'Reducción de grasa flancos.', 1),
('Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     5, 45, '2026-05-14 08:00:00', '2026-05-14 08:45:00', 'agendada', NULL, 'Limpieza facial.', 1),
('Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 9, 60, '2026-05-14 10:00:00', '2026-05-14 11:00:00', 'agendada', NULL, 'PRP capilar.', 1),
('Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       13, 60, '2026-05-18 09:00:00', '2026-05-18 10:00:00', 'agendada', NULL, 'Drenaje linfático.', 1),
('Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     2, 45, '2026-05-18 10:30:00', '2026-05-18 11:15:00', 'agendada', NULL, 'Ácido hialurónico pómulos.', 1),
('Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     6, 60, '2026-05-19 14:00:00', '2026-05-19 15:00:00', 'agendada', NULL, 'Radiofrecuencia facial.', 1),
('Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     4, 60, '2026-05-20 08:00:00', '2026-05-20 09:00:00', 'agendada', NULL, 'Microneedling con PRP.', 1),
('Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     7, 60, '2026-05-20 10:00:00', '2026-05-20 11:00:00', 'agendada', NULL, 'Bioestimulación capilar.', 1),
('Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    3, 60, '2026-05-21 09:00:00', '2026-05-21 10:00:00', 'agendada', NULL, 'Peeling químico leve.', 1),
('Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   16, 60, '2026-05-21 14:00:00', '2026-05-21 15:00:00', 'agendada', NULL, 'Sueroterapia detox.', 1),
('Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      11, 60, '2026-05-22 08:00:00', '2026-05-22 09:00:00', 'agendada', NULL, 'Radiofrecuencia corporal glúteos.', 1),
('Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   17, 30, '2026-05-22 10:00:00', '2026-05-22 10:30:00', 'agendada', NULL, 'Consulta general.', 1);
