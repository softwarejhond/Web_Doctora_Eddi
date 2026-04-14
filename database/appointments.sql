-- =============================================
-- Tablas del módulo de Citas — MEDIC EDDI
-- Base de datos: medic_eddi
-- =============================================

-- Categorías de tratamiento
CREATE TABLE IF NOT EXISTS `treatment_categories` (
    `id`   INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL COMMENT 'Ej: Facial, Capilar, Corporal',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tratamientos específicos dentro de cada categoría
CREATE TABLE IF NOT EXISTS `treatments` (
    `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` INT UNSIGNED NOT NULL,
    `name`        VARCHAR(150) NOT NULL COMMENT 'Ej: Toxina Botulínica, Bioestimulación',
    `duration`    INT UNSIGNED NOT NULL DEFAULT 60 COMMENT 'Duración por defecto en minutos',
    `active`      TINYINT(1)  NOT NULL DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `fk_treat_cat` (`category_id`),
    CONSTRAINT `fk_treat_cat` FOREIGN KEY (`category_id`) REFERENCES `treatment_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Citas médicas
CREATE TABLE IF NOT EXISTS `appointments` (
    `id`               INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `number_id`        VARCHAR(20)     DEFAULT NULL COMMENT 'Cédula del paciente',
    `patient_name`     VARCHAR(200)    NOT NULL,
    `patient_phone`    VARCHAR(20)     DEFAULT NULL,
    `patient_email`    VARCHAR(150)    DEFAULT NULL,
    `appointment_type` ENUM('valoracion','revision','tratamiento')
                       NOT NULL DEFAULT 'tratamiento' COMMENT 'Tipo de cita',
    `treatment_id`     INT UNSIGNED    DEFAULT NULL COMMENT 'NULL para valoración/revisión',
    `duration`         INT UNSIGNED    NOT NULL DEFAULT 60 COMMENT 'Duración en minutos',
    `date_start`       DATETIME        NOT NULL COMMENT 'Fecha y hora de inicio',
    `date_end`         DATETIME        NOT NULL COMMENT 'Fecha y hora de fin',
    `status`           ENUM('agendada','confirmada','cancelada','completada','no_presentado')
                       NOT NULL DEFAULT 'agendada',
    `cancel_reason`    VARCHAR(500)    DEFAULT NULL COMMENT 'Motivo de cancelación',
    `notes`            TEXT            DEFAULT NULL COMMENT 'Notas internas',
    `created_by`       INT UNSIGNED    DEFAULT NULL COMMENT 'ID del usuario que creó la cita',
    `creation_date`    TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `update_date`      TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_date_start` (`date_start`),
    KEY `idx_status`     (`status`),
    KEY `fk_appt_treat`  (`treatment_id`),
    KEY `fk_appt_user`   (`created_by`),
    CONSTRAINT `fk_appt_treat` FOREIGN KEY (`treatment_id`) REFERENCES `treatments`(`id`) ON DELETE RESTRICT,
    CONSTRAINT `fk_appt_user`  FOREIGN KEY (`created_by`)   REFERENCES `users`(`id`)      ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =============================================
-- Datos iniciales: Categorías y Tratamientos
-- =============================================

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

INSERT INTO `treatments` (`category_id`, `name`, `duration`) VALUES
-- Toxina Botulínica
(1, 'Toxina Botulínica Estética',                30),
(1, 'Toxina Botulínica Médica para Bruxismo',    30),
-- Hiperhidrosis
(2, 'Hiperhidrosis Axilar',                      45),
-- Bioestimuladores
(3, 'Bioestimuladores de Colágeno',              60),
-- Mesoterapias Faciales
(4, 'Mesoterapias Faciales',                     45),
-- Mesoterapia Capilares
(5, 'Mesoterapia Capilares',                     45),
-- Skin Boosters
(6, 'Skin Boosters',                             45),
-- Regulación Metabólica
(7, 'Medicamentos para Regulación Metabólica',   30),
-- Enzimas Faciales
(8, 'Enzimas Faciales',                          45),
-- Enzimas Corporales
(9, 'Enzimas Corporales',                        60);
