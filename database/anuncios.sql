-- =============================================
-- Tabla de Anuncios / Popups — MEDIC EDDI
-- Base de datos: medic_eddi
-- =============================================

CREATE TABLE IF NOT EXISTS `anuncios` (
    `id`           INT UNSIGNED      NOT NULL AUTO_INCREMENT,
    `titulo`       VARCHAR(200)      NOT NULL COMMENT 'Título interno del anuncio (no visible al paciente)',
    `imagen`       VARCHAR(500)      NOT NULL COMMENT 'Nombre de archivo en /img/anuncios/ o URL completa',
    `wa_numero`    VARCHAR(20)       NOT NULL COMMENT 'Número WhatsApp sin + (ej: 573013388063)',
    `wa_mensaje`   TEXT              NOT NULL COMMENT 'Mensaje preescrito para WhatsApp',
    `texto_boton`  VARCHAR(150)      NOT NULL DEFAULT 'Quiero este tratamiento' COMMENT 'Texto del botón CTA',
    `fecha_inicio` DATE              NOT NULL COMMENT 'Fecha de inicio de vigencia del popup',
    `fecha_fin`    DATE              NOT NULL COMMENT 'Fecha de fin de vigencia del popup',
    `delay_ms`     SMALLINT UNSIGNED NOT NULL DEFAULT 1400 COMMENT 'Retardo en milisegundos antes de mostrar el popup',
    `activo`       TINYINT(1)        NOT NULL DEFAULT 1 COMMENT '1=Activo, 0=Inactivo',
    `created_by`   INT UNSIGNED      DEFAULT NULL COMMENT 'ID del usuario administrador que creó el anuncio',
    `creation_date` TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `update_date`  TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_vigencia`    (`fecha_inicio`, `fecha_fin`, `activo`),
    KEY `fk_anuncio_user` (`created_by`),
    CONSTRAINT `fk_anuncio_user` FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
