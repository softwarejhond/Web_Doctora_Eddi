-- =============================================
-- Tabla de usuarios — MEDIC EDDI
-- Base de datos: medic_eddi
-- =============================================

CREATE TABLE IF NOT EXISTS `users` (
    `id`            INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `username`      BIGINT UNSIGNED NOT NULL COMMENT 'Cédula del usuario',
    `full_name`     VARCHAR(200)    NOT NULL,
    `email`         VARCHAR(150)    NOT NULL,
    `password`      VARCHAR(255)    NOT NULL COMMENT 'Hash bcrypt',
    `picture`       VARCHAR(255)    DEFAULT 'default.png' COMMENT 'Nombre archivo foto de perfil',
    `rol`           TINYINT UNSIGNED NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=Doctor, 3=Paciente',
    `active`        TINYINT(1)      NOT NULL DEFAULT 1 COMMENT '1=Activo, 0=Inactivo',
    `creation_date` TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `update_date`   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_username` (`username`),
    UNIQUE KEY `uk_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Usuario administrador de prueba (password: Admin123*)
INSERT INTO `users` (`username`, `full_name`, `email`, `password`, `picture`, `rol`, `active`)
VALUES (
    1234567890,
    'Administrador Sistema',
    'admin@medicinaintegrativa.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'default.png',
    1,
    1
);
