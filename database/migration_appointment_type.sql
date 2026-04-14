-- =============================================
-- Migración: Tipo de cita + nuevas categorías/tratamientos
-- Base de datos: medic_eddi
-- Ejecutar sobre una base de datos existente
-- =============================================

-- 1. Agregar columna appointment_type a appointments
ALTER TABLE `appointments`
    ADD COLUMN `appointment_type` ENUM('valoracion','revision','tratamiento')
    NOT NULL DEFAULT 'tratamiento'
    AFTER `patient_email`;

-- 2. Marcar todas las citas existentes como tipo 'tratamiento'
UPDATE `appointments` SET `appointment_type` = 'tratamiento';

-- 3. Eliminar FK de treatment_id para poder modificarla
ALTER TABLE `appointments` DROP FOREIGN KEY `fk_appt_treat`;

-- 4. Hacer treatment_id nullable (valoracion/revision no tienen tratamiento)
ALTER TABLE `appointments` MODIFY `treatment_id` INT UNSIGNED DEFAULT NULL;

-- 5. Poner treatment_id en NULL (los tratamientos viejos serán eliminados)
UPDATE `appointments` SET `treatment_id` = NULL;

-- 6. Eliminar tratamientos y categorías antiguas
DELETE FROM `treatments`;
DELETE FROM `treatment_categories`;

-- 7. Resetear auto-increment
ALTER TABLE `treatment_categories` AUTO_INCREMENT = 1;
ALTER TABLE `treatments` AUTO_INCREMENT = 1;

-- 8. Insertar nuevas categorías
INSERT INTO `treatment_categories` (`id`, `name`) VALUES
(1, 'Toxina Botulínica'),
(2, 'Hiperhidrosis'),
(3, 'Bioestimuladores'),
(4, 'Mesoterapias Faciales'),
(5, 'Mesoterapia Capilares'),
(6, 'Skin Boosters'),
(7, 'Regulación Metabólica'),
(8, 'Enzimas Faciales'),
(9, 'Enzimas Corporales');

-- 9. Insertar nuevos tratamientos
INSERT INTO `treatments` (`category_id`, `name`, `duration`) VALUES
(1, 'Toxina Botulínica Estética',                30),
(1, 'Toxina Botulínica Médica para Bruxismo',    30),
(2, 'Hiperhidrosis Axilar',                      45),
(3, 'Bioestimuladores de Colágeno',              60),
(4, 'Mesoterapias Faciales',                     45),
(5, 'Mesoterapia Capilares',                     45),
(6, 'Skin Boosters',                             45),
(7, 'Medicamentos para Regulación Metabólica',   30),
(8, 'Enzimas Faciales',                          45),
(9, 'Enzimas Corporales',                        60);

-- 10. Re-agregar FK constraint (ahora permite NULL)
ALTER TABLE `appointments`
    ADD CONSTRAINT `fk_appt_treat`
    FOREIGN KEY (`treatment_id`) REFERENCES `treatments`(`id`)
    ON DELETE RESTRICT;
