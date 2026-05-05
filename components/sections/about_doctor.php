<?php

/**
 * Sección Sobre la Doctora - DOCTORA EDDI
 * Layout con imagen izquierda y descripción derecha
 */
?>

<section id="section-about" class="about-section mb-5">
    <div class="welcome-glass p-4 p-md-5">
        <div class="row align-items-center g-4 g-lg-5">

            <!-- Imagen -->
            <div class="col-lg-5">
                <div class="about-img-wrapper">
                    <img src="img/hero_four.png" alt="Doctora Eddi — Medicina Estética e Integrativa" class="about-img">
                    <div class="about-img-accent"></div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="col-lg-7">
                <p class="catalog-overtitle">Conóceme</p>
                <h2 class="catalog-main-title mb-3">
                    Doctora <em>Eddi</em>
                </h2>
                <div class="welcome-divider mt-2 mb-4"></div>

                <p class="about-bio">
                    Soy médica general egresada de la Universidad Cooperativa de Colombia,
                    con formación en medicina estética por la Universidad del Tolima y en
                    medicina integrativa por la Universidad Pontificia Bolivariana.
                </p>

                <div class="about-philosophy">
                    <h4 class="about-philosophy-title">
                        <i class="fas fa-quote-left me-2"></i>Mi Filosofía
                    </h4>
                    <p class="about-philosophy-text">
                        Creo en una medicina estética consciente, donde la belleza no se
                        transforma, se revela. Mi objetivo es ayudarte a verte bien, sentirte
                        mejor y entender tu cuerpo desde un enfoque integral.
                    </p>
                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 mt-4">
                    <div class="about-credential">
                        <i class="fas fa-graduation-cap me-2"></i>Universidad Cooperativa de Colombia
                    </div>
                    <div class="about-credential">
                        <i class="fas fa-award me-2"></i>Universidad del Tolima
                    </div>
                    <div class="about-credential">
                        <i class="fas fa-certificate me-2"></i>Universidad Pontificia Bolivariana
                    </div>
                </div>

                <div class="mt-4 w-100">
                    <a href="#contacto" class="btn btn-primary w-100">
                        <i class="fas fa-calendar-check me-2"></i>Agenda tu Valoración
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ¿Por qué elegirnos? -->
<section class="welcome-glass p-4 p-md-5 mb-1">
    <p class="catalog-overtitle">Nuestra diferencia</p>
    <h2 class="catalog-main-title mb-0">¿Por qué <em>elegirnos</em>?</h2>
    <div class="welcome-divider mt-3 mb-4"></div>
    <div class="row g-3">
        <?php
        $razones = [
            ['icon' => 'fa-layer-group',  'titulo' => 'Enfoque integral',           'desc' => 'Tratamos la piel desde adentro, conectando lo estético con el estado interno del organismo.'],
            ['icon' => 'fa-user-check',   'titulo' => 'Protocolos 100% personalizados', 'desc' => 'Cada plan de tratamiento se diseña exclusivamente para tu biología y tus objetivos.'],
            ['icon' => 'fa-dna',          'titulo' => 'Medicina multi-disciplinar', 'desc' => 'Estética + integrativa + biorreguladora + regenerativa en un solo protocolo coherente.'],
            ['icon' => 'fa-magnifying-glass-chart', 'titulo' => 'Causa raíz',       'desc' => 'Abordamos inflamación, hormonas, metabolismo y estilo de vida, no solo lo visible.'],
            ['icon' => 'fa-leaf',         'titulo' => 'Resultados naturales',        'desc' => 'Progresivos y duraderos, respetando siempre la armonía y proporciones de tu rostro.'],
            ['icon' => 'fa-shield-halved','titulo' => 'Productos certificados',      'desc' => 'Alta calidad con registro INVIMA, aplicados con técnica y criterio médico.'],
            ['icon' => 'fa-heart-pulse',  'titulo' => 'Respeto por tu armonía',     'desc' => 'Cada decisión clínica entiende tu cuerpo y cuida tu identidad.'],
            ['icon' => 'fa-handshake',    'titulo' => 'Acompañamiento cercano',      'desc' => 'Seguimiento médico humano, consciente y continuo a lo largo de todo el proceso.'],
        ];
        foreach ($razones as $r): ?>
        <div class="col-sm-6 col-lg-3">
            <div style="
                background: #f5f3f0;
                border: 1px solid #e8e4df;
                border-radius: 2px;
                padding: 1.4rem 1.5rem;
                height: 100%;
            ">
                <div style="
                    width: 38px; height: 38px;
                    background: #434f44;
                    border-radius: 2px;
                    display: flex; align-items: center; justify-content: center;
                    color: #fff; font-size: 0.95rem;
                    margin-bottom: 0.85rem;
                ">
                    <i class="fas <?= $r['icon'] ?>" aria-hidden="true"></i>
                </div>
                <p style="
                    font-size: 0.9rem; font-weight: 600;
                    color: #2d332e; margin-bottom: 0.35rem;
                    letter-spacing: 0.2px;
                "><?= $r['titulo'] ?></p>
                <p style="
                    font-size: 0.875rem; color: #6b726d;
                    line-height: 1.65; margin: 0;
                "><?= $r['desc'] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>