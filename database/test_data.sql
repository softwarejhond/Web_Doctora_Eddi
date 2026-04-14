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
-- treatment_id: 1-10 según appointments.sql (nuevas categorías)
-- appointment_type: valoracion, revision, tratamiento
-- created_by: 1 (admin)
-- =============================================

INSERT INTO `appointments` (`number_id`, `patient_name`, `patient_phone`, `patient_email`, `appointment_type`, `treatment_id`, `duration`, `date_start`, `date_end`, `status`, `cancel_reason`, `notes`, `created_by`) VALUES
-- === ENERO 2026 — Citas completadas ===
('1001001001', 'María López García',       '3101234567', 'maria.lopez@correo.com',       'tratamiento', 1, 30, '2026-01-05 08:00:00', '2026-01-05 08:30:00', 'completada', NULL, 'Primera sesión de toxina botulínica estética. Paciente satisfecha.', 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 6, 45, '2026-01-05 09:00:00', '2026-01-05 09:45:00', 'completada', NULL, 'Mesoterapia capilar, buena respuesta.', 1),
('1001001003', 'Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      'tratamiento', 4, 60, '2026-01-06 10:00:00', '2026-01-06 11:00:00', 'completada', NULL, 'Bioestimuladores de colágeno.', 1),
('1001001004', 'Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       'valoracion', NULL, 40, '2026-01-07 08:30:00', '2026-01-07 09:10:00', 'completada', NULL, 'Valoración inicial de seguimiento.', 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 9, 45, '2026-01-08 11:00:00', '2026-01-08 11:45:00', 'completada', NULL, 'Enzimas faciales, resultados positivos.', 1),
('1001001006', 'Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     'tratamiento', 10, 60, '2026-01-09 14:00:00', '2026-01-09 15:00:00', 'cancelada', 'Paciente reportó malestar previo a la cita.', NULL, 1),
('1001001007', 'Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      'tratamiento', 5, 45, '2026-01-12 08:00:00', '2026-01-12 08:45:00', 'completada', NULL, 'Mesoterapia facial, piel sensible.', 1),
('1001001008', 'Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 'tratamiento', 6, 45, '2026-01-13 09:30:00', '2026-01-13 10:15:00', 'completada', NULL, 'Mesoterapia capilar sesión 2 de 6.', 1),
('1001001009', 'Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com','tratamiento', 5, 45, '2026-01-14 10:00:00', '2026-01-14 10:45:00', 'completada', NULL, 'Mesoterapia facial, tolerancia adecuada.', 1),
('1001001010', 'Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     'tratamiento', 8, 30, '2026-01-15 15:00:00', '2026-01-15 15:30:00', 'no_presentado', NULL, 'Paciente no se presentó, se intentó contactar.', 1),

-- === FEBRERO 2026 ===
('1001001011', 'Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 'tratamiento', 7, 45, '2026-02-02 08:00:00', '2026-02-02 08:45:00', 'completada', NULL, 'Skin boosters, buena tolerancia.', 1),
('1001001012', 'Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       'tratamiento', 6, 45, '2026-02-03 09:00:00', '2026-02-03 09:45:00', 'completada', NULL, 'Mesoterapia capilar, extracción sin complicaciones.', 1),
('1001001013', 'Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     'tratamiento', 4, 60, '2026-02-04 10:30:00', '2026-02-04 11:30:00', 'completada', NULL, 'Bioestimuladores de colágeno, procedimiento exitoso.', 1),
('1001001014', 'Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     'tratamiento', 10, 60, '2026-02-05 14:00:00', '2026-02-05 15:00:00', 'completada', NULL, 'Enzimas corporales zona abdominal.', 1),
('1001001015', 'Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     'tratamiento', 1, 30, '2026-02-06 08:00:00', '2026-02-06 08:30:00', 'cancelada', 'Paciente viajó fuera de la ciudad.', NULL, 1),
('1001001016', 'Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     'revision', NULL, 20, '2026-02-09 08:30:00', '2026-02-09 08:50:00', 'completada', NULL, 'Revisión mensual, evolución favorable.', 1),
('1001001017', 'Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    'tratamiento', 4, 60, '2026-02-10 10:00:00', '2026-02-10 11:00:00', 'completada', NULL, 'Bioestimuladores en surcos nasogenianos.', 1),
('1001001018', 'Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   'tratamiento', 8, 30, '2026-02-11 11:00:00', '2026-02-11 11:30:00', 'completada', NULL, 'Regulación metabólica, primera sesión.', 1),
('1001001019', 'Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      'tratamiento', 10, 60, '2026-02-12 14:30:00', '2026-02-12 15:30:00', 'no_presentado', NULL, NULL, 1),
('1001001020', 'Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   'tratamiento', 10, 60, '2026-02-13 09:00:00', '2026-02-13 10:00:00', 'completada', NULL, 'Enzimas corporales, paciente refiere mejoría.', 1),

-- === MARZO 2026 ===
('1001001001', 'María López García',       '3101234567', 'maria.lopez@correo.com',       'tratamiento', 1, 30, '2026-03-02 08:00:00', '2026-03-02 08:30:00', 'completada', NULL, 'Segunda sesión de toxina estética. Retoque zona frontal.', 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 6, 45, '2026-03-03 09:00:00', '2026-03-03 09:45:00', 'completada', NULL, 'Mesoterapia capilar sesión 2.', 1),
('1001001003', 'Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      'valoracion', NULL, 40, '2026-03-04 10:00:00', '2026-03-04 10:40:00', 'completada', NULL, 'Valoración integral, se define plan de tratamiento.', 1),
('1001001004', 'Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       'tratamiento', 9, 45, '2026-03-05 11:00:00', '2026-03-05 11:45:00', 'cancelada', 'Reagendado por solicitud del paciente.', NULL, 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 7, 45, '2026-03-06 08:00:00', '2026-03-06 08:45:00', 'completada', NULL, 'Skin boosters, segunda sesión.', 1),
('1001001006', 'Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     'tratamiento', 10, 60, '2026-03-09 14:00:00', '2026-03-09 15:00:00', 'completada', NULL, 'Enzimas corporales, zona flancos.', 1),
('1001001007', 'Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      'tratamiento', 5, 45, '2026-03-10 09:00:00', '2026-03-10 09:45:00', 'completada', NULL, 'Mesoterapia facial, buena tolerancia.', 1),
('1001001008', 'Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 'tratamiento', 6, 45, '2026-03-11 09:30:00', '2026-03-11 10:15:00', 'completada', NULL, 'Mesoterapia capilar sesión 3 de 6.', 1),
('1001001009', 'Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com','tratamiento', 3, 45, '2026-03-12 10:00:00', '2026-03-12 10:45:00', 'completada', NULL, 'Hiperhidrosis axilar.', 1),
('1001001010', 'Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     'tratamiento', 8, 30, '2026-03-13 15:00:00', '2026-03-13 15:30:00', 'completada', NULL, 'Regulación metabólica, paciente reporta más energía.', 1),
('1001001011', 'Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 'tratamiento', 4, 60, '2026-03-16 08:00:00', '2026-03-16 09:00:00', 'completada', NULL, 'Bioestimuladores de colágeno.', 1),
('1001001012', 'Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       'tratamiento', 6, 45, '2026-03-17 09:00:00', '2026-03-17 09:45:00', 'no_presentado', NULL, 'No se presentó. Se reprogramará.', 1),
('1001001013', 'Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     'tratamiento', 1, 30, '2026-03-18 10:30:00', '2026-03-18 11:00:00', 'completada', NULL, 'Toxina botulínica estética entrecejo y patas de gallo.', 1),
('1001001014', 'Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     'tratamiento', 8, 30, '2026-03-19 14:00:00', '2026-03-19 14:30:00', 'completada', NULL, 'Regulación metabólica sesión 2.', 1),
('1001001015', 'Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     'tratamiento', 4, 60, '2026-03-20 08:00:00', '2026-03-20 09:00:00', 'completada', NULL, 'Bioestimuladores de colágeno, procedimiento sin complicaciones.', 1),

-- === ABRIL 2026 (mes actual) ===
('1001001016', 'Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     'tratamiento', 10, 60, '2026-04-01 08:00:00', '2026-04-01 09:00:00', 'completada', NULL, 'Enzimas corporales muslos.', 1),
('1001001017', 'Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    'tratamiento', 9, 45, '2026-04-01 10:00:00', '2026-04-01 10:45:00', 'completada', NULL, 'Enzimas faciales con vitaminas.', 1),
('1001001018', 'Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   'tratamiento', 6, 45, '2026-04-02 09:00:00', '2026-04-02 09:45:00', 'completada', NULL, 'Mesoterapia capilar, se observa mejoría.', 1),
('1001001019', 'Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      'tratamiento', 5, 45, '2026-04-02 11:00:00', '2026-04-02 11:45:00', 'completada', NULL, 'Mesoterapia facial profunda.', 1),
('1001001020', 'Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   'tratamiento', 10, 60, '2026-04-03 14:00:00', '2026-04-03 15:00:00', 'completada', NULL, 'Enzimas corporales, segunda sesión.', 1),
('1001001001', 'María López García',       '3101234567', 'maria.lopez@correo.com',       'tratamiento', 7, 45, '2026-04-03 08:00:00', '2026-04-03 08:45:00', 'completada', NULL, 'Skin boosters sesión 1.', 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 6, 45, '2026-04-04 09:00:00', '2026-04-04 09:45:00', 'confirmada', NULL, 'Mesoterapia capilar sesión 4.', 1),
('1001001003', 'Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      'tratamiento', 1, 30, '2026-04-07 08:00:00', '2026-04-07 08:30:00', 'confirmada', NULL, 'Toxina botulínica estética retoque.', 1),
('1001001004', 'Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       'tratamiento', 9, 45, '2026-04-07 10:00:00', '2026-04-07 10:45:00', 'confirmada', NULL, 'Enzimas faciales segunda sesión.', 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 5, 45, '2026-04-07 14:00:00', '2026-04-07 14:45:00', 'agendada', NULL, 'Mesoterapia facial.', 1),
('1001001006', 'Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     'tratamiento', 10, 60, '2026-04-08 08:00:00', '2026-04-08 09:00:00', 'agendada', NULL, 'Enzimas corporales abdomen.', 1),
('1001001007', 'Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      'tratamiento', 4, 60, '2026-04-08 10:00:00', '2026-04-08 11:00:00', 'agendada', NULL, 'Bioestimuladores de colágeno.', 1),
('1001001008', 'Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 'tratamiento', 6, 45, '2026-04-08 11:00:00', '2026-04-08 11:45:00', 'agendada', NULL, 'Mesoterapia capilar sesión 4 de 6.', 1),
('1001001009', 'Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com','tratamiento', 4, 60, '2026-04-09 09:00:00', '2026-04-09 10:00:00', 'agendada', NULL, 'Bioestimuladores de colágeno rejuvenecimiento.', 1),
('1001001010', 'Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     'revision', NULL, 20, '2026-04-09 10:30:00', '2026-04-09 10:50:00', 'confirmada', NULL, 'Revisión de control.', 1),
('1001001011', 'Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 'tratamiento', 7, 45, '2026-04-09 14:00:00', '2026-04-09 14:45:00', 'agendada', NULL, 'Skin boosters sesión 2.', 1),
('1001001012', 'Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       'tratamiento', 6, 45, '2026-04-10 08:00:00', '2026-04-10 08:45:00', 'agendada', NULL, 'Mesoterapia capilar reprogramado.', 1),
('1001001013', 'Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     'valoracion', NULL, 40, '2026-04-10 10:00:00', '2026-04-10 10:40:00', 'agendada', NULL, 'Valoración integral para nuevo plan.', 1),
('1001001014', 'Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     'tratamiento', 10, 60, '2026-04-10 14:00:00', '2026-04-10 15:00:00', 'agendada', NULL, 'Enzimas corporales, primera sesión.', 1),

-- === Citas futuras ABRIL ===
('1001001015', 'Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     'tratamiento', 4, 60, '2026-04-14 08:00:00', '2026-04-14 09:00:00', 'agendada', NULL, 'Bioestimuladores de colágeno.', 1),
('1001001016', 'Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     'tratamiento', 8, 30, '2026-04-14 10:00:00', '2026-04-14 10:30:00', 'agendada', NULL, 'Regulación metabólica.', 1),
('1001001017', 'Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    'tratamiento', 1, 30, '2026-04-15 08:00:00', '2026-04-15 08:30:00', 'agendada', NULL, 'Toxina botulínica estética frontal.', 1),
('1001001018', 'Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   'tratamiento', 8, 30, '2026-04-15 09:30:00', '2026-04-15 10:00:00', 'agendada', NULL, 'Regulación metabólica sesión 3.', 1),
('1001001019', 'Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      'tratamiento', 5, 45, '2026-04-16 10:00:00', '2026-04-16 10:45:00', 'agendada', NULL, 'Mesoterapia facial superficial.', 1),
('1001001020', 'Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   'tratamiento', 10, 60, '2026-04-16 14:00:00', '2026-04-16 15:00:00', 'agendada', NULL, 'Enzimas corporales brazos.', 1),
('1001001001', 'María López García',       '3101234567', 'maria.lopez@correo.com',       'tratamiento', 5, 45, '2026-04-17 08:00:00', '2026-04-17 08:45:00', 'agendada', NULL, NULL, 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 6, 45, '2026-04-17 09:00:00', '2026-04-17 09:45:00', 'agendada', NULL, 'Mesoterapia capilar sesión 3.', 1),
('1001001003', 'Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      'tratamiento', 9, 45, '2026-04-21 10:00:00', '2026-04-21 10:45:00', 'agendada', NULL, 'Enzimas faciales, tercera sesión.', 1),
('1001001004', 'Juan Pablo Torres',        '3154567890', NULL,                            'valoracion', NULL, 40, '2026-04-21 11:30:00', '2026-04-21 12:10:00', 'agendada', NULL, 'Valoración de seguimiento.', 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 7, 45, '2026-04-22 08:00:00', '2026-04-22 08:45:00', 'agendada', NULL, 'Skin boosters sesión 3.', 1),
('1001001006', 'Diego Alejandro Herrera',  '3201234567', NULL,                            'tratamiento', 10, 60, '2026-04-22 14:00:00', '2026-04-22 15:00:00', 'agendada', NULL, 'Enzimas corporales sesión 2.', 1),
('1001001007', 'Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      'tratamiento', 4, 60, '2026-04-23 09:00:00', '2026-04-23 10:00:00', 'agendada', NULL, 'Bioestimuladores de colágeno.', 1),
('1001001008', 'Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 'tratamiento', 6, 45, '2026-04-23 10:30:00', '2026-04-23 11:15:00', 'agendada', NULL, 'Mesoterapia capilar sesión 5 de 6.', 1),
('1001001009', 'Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com','tratamiento', 4, 60, '2026-04-24 08:00:00', '2026-04-24 09:00:00', 'agendada', NULL, 'Bioestimuladores mentón.', 1),
('1001001010', 'Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     'tratamiento', 8, 30, '2026-04-24 10:00:00', '2026-04-24 10:30:00', 'agendada', NULL, 'Regulación metabólica segunda sesión.', 1),
('1001001011', 'Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 'tratamiento', 1, 30, '2026-04-28 08:00:00', '2026-04-28 08:30:00', 'agendada', NULL, 'Toxina botulínica estética.', 1),
('1001001012', 'Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       'tratamiento', 6, 45, '2026-04-28 09:00:00', '2026-04-28 09:45:00', 'agendada', NULL, 'Mesoterapia capilar.', 1),
('1001001013', 'Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     'tratamiento', 5, 45, '2026-04-29 10:00:00', '2026-04-29 10:45:00', 'agendada', NULL, 'Mesoterapia facial profunda.', 1),
('1001001014', 'Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     'tratamiento', 10, 60, '2026-04-29 14:00:00', '2026-04-29 15:00:00', 'agendada', NULL, 'Enzimas corporales.', 1),
('1001001015', 'Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     'tratamiento', 7, 45, '2026-04-30 08:00:00', '2026-04-30 08:45:00', 'agendada', NULL, NULL, 1),

-- === MAYO 2026 ===
('1001001016', 'Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     'tratamiento', 9, 45, '2026-05-04 10:00:00', '2026-05-04 10:45:00', 'agendada', NULL, 'Enzimas faciales primera sesión.', 1),
('1001001017', 'Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    'tratamiento', 10, 60, '2026-05-05 08:00:00', '2026-05-05 09:00:00', 'agendada', NULL, 'Enzimas corporales.', 1),
('1001001018', 'Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   'tratamiento', 8, 30, '2026-05-05 10:00:00', '2026-05-05 10:30:00', 'agendada', NULL, 'Regulación metabólica sesión 4.', 1),
('1001001019', 'Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      'tratamiento', 1, 30, '2026-05-06 08:00:00', '2026-05-06 08:30:00', 'agendada', NULL, 'Toxina botulínica estética primera vez.', 1),
('1001001020', 'Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   'tratamiento', 4, 60, '2026-05-06 09:00:00', '2026-05-06 10:00:00', 'agendada', NULL, 'Bioestimuladores de colágeno rodillas.', 1),
('1001001001', 'María López García',       '3101234567', 'maria.lopez@correo.com',       'tratamiento', 4, 60, '2026-05-07 10:00:00', '2026-05-07 11:00:00', 'agendada', NULL, 'Bioestimuladores surcos.', 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 6, 45, '2026-05-07 11:00:00', '2026-05-07 11:45:00', 'agendada', NULL, 'Mesoterapia capilar sesión 5.', 1),
('1001001003', 'Ana Sofía Martínez',       '3112345678', 'ana.martinez@correo.com',      'tratamiento', 8, 30, '2026-05-08 14:00:00', '2026-05-08 14:30:00', 'agendada', NULL, 'Regulación metabólica.', 1),
('1001001004', 'Juan Pablo Torres',        '3154567890', 'juan.torres@correo.com',       'tratamiento', 5, 45, '2026-05-11 10:00:00', '2026-05-11 10:45:00', 'agendada', NULL, 'Mesoterapia facial.', 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 10, 60, '2026-05-11 14:00:00', '2026-05-11 15:00:00', 'agendada', NULL, 'Enzimas corporales.', 1),
('1001001006', 'Diego Alejandro Herrera',  '3201234567', 'diego.herrera@correo.com',     'revision', NULL, 20, '2026-05-12 08:00:00', '2026-05-12 08:20:00', 'agendada', NULL, 'Revisión de control post-tratamiento.', 1),
('1001001007', 'Camila Andrea Rojas',      '3209876543', 'camila.rojas@correo.com',      'valoracion', NULL, 40, '2026-05-12 09:00:00', '2026-05-12 09:40:00', 'agendada', NULL, 'Valoración integral semestral.', 1),
('1001001008', 'Sebastián Morales',        '3151234567', 'sebastian.morales@correo.com', 'tratamiento', 6, 45, '2026-05-13 09:30:00', '2026-05-13 10:15:00', 'agendada', NULL, 'Mesoterapia capilar sesión 6 de 6 (última).', 1),
('1001001009', 'Valentina Castillo',       '3179876543', 'valentina.castillo@correo.com','tratamiento', 10, 60, '2026-05-13 14:00:00', '2026-05-13 15:00:00', 'agendada', NULL, 'Enzimas corporales flancos.', 1),
('1001001010', 'Andrés Felipe Vargas',     '3001234567', 'andres.vargas@correo.com',     'tratamiento', 5, 45, '2026-05-14 08:00:00', '2026-05-14 08:45:00', 'agendada', NULL, 'Mesoterapia facial.', 1),
('1001001011', 'Isabella Restrepo',        '3009876543', 'isabella.restrepo@correo.com', 'tratamiento', 6, 45, '2026-05-14 10:00:00', '2026-05-14 10:45:00', 'agendada', NULL, 'Mesoterapia capilar.', 1),
('1001001012', 'Miguel Ángel Peña',        '3121234567', 'miguel.pena@correo.com',       'tratamiento', 10, 60, '2026-05-18 09:00:00', '2026-05-18 10:00:00', 'agendada', NULL, 'Enzimas corporales.', 1),
('1001001013', 'Daniela Gómez Ríos',       '3129876543', 'daniela.gomez@correo.com',     'tratamiento', 4, 60, '2026-05-18 10:30:00', '2026-05-18 11:30:00', 'agendada', NULL, 'Bioestimuladores pómulos.', 1),
('1001001014', 'Julián Esteban Castro',    '3141234567', 'julian.castro@correo.com',     'tratamiento', 7, 45, '2026-05-19 14:00:00', '2026-05-19 14:45:00', 'agendada', NULL, 'Skin boosters.', 1),
('1001001015', 'Paula Andrea Mendoza',     '3149876543', 'paula.mendoza@correo.com',     'tratamiento', 9, 45, '2026-05-20 08:00:00', '2026-05-20 08:45:00', 'agendada', NULL, 'Enzimas faciales.', 1),
('1001001016', 'Santiago Ruiz Ospina',     '3161234567', 'santiago.ruiz@correo.com',     'tratamiento', 6, 45, '2026-05-20 10:00:00', '2026-05-20 10:45:00', 'agendada', NULL, 'Mesoterapia capilar.', 1),
('1001001017', 'Natalia Suárez Pineda',    '3169876543', 'natalia.suarez@correo.com',    'tratamiento', 5, 45, '2026-05-21 09:00:00', '2026-05-21 09:45:00', 'agendada', NULL, 'Mesoterapia facial leve.', 1),
('1001001018', 'Tomás Hernández Cano',     '3181234567', 'tomas.hernandez@correo.com',   'tratamiento', 8, 30, '2026-05-21 14:00:00', '2026-05-21 14:30:00', 'agendada', NULL, 'Regulación metabólica detox.', 1),
('1001001019', 'Sara Jiménez Duque',       '3189876543', 'sara.jimenez@correo.com',      'tratamiento', 10, 60, '2026-05-22 08:00:00', '2026-05-22 09:00:00', 'agendada', NULL, 'Enzimas corporales glúteos.', 1),
('1001001020', 'Ricardo Salazar Mejía',    '3191234567', 'ricardo.salazar@correo.com',   'revision', NULL, 20, '2026-05-22 10:00:00', '2026-05-22 10:20:00', 'agendada', NULL, 'Revisión general.', 1),
('1001001002', 'Carlos Andrés Ramírez',    '3109876543', 'carlos.ramirez@correo.com',    'tratamiento', 2, 30, '2026-05-25 09:00:00', '2026-05-25 09:30:00', 'agendada', NULL, 'Toxina botulínica médica para bruxismo.', 1),
('1001001005', 'Laura Valentina Díaz',     '3187654321', 'laura.diaz@correo.com',        'tratamiento', 3, 45, '2026-05-25 10:00:00', '2026-05-25 10:45:00', 'agendada', NULL, 'Hiperhidrosis axilar.', 1);
