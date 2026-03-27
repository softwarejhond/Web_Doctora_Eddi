<?php
/**
 * Sección Carrusel de Testimonios - DOCTORA EDDI
 * Banda continua de tarjetas de testimonios con autoplay
 */

$testimonios = [
    [
        'nombre' => 'María García',
        'tratamiento' => 'Medicina Regenerativa',
        'estrellas' => 5,
        'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
    ],
    [
        'nombre' => 'Carolina López',
        'tratamiento' => 'Terapias Naturales',
        'estrellas' => 5,
        'texto' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
    ],
    [
        'nombre' => 'Andrea Martínez',
        'tratamiento' => 'Medicina Integrativa',
        'estrellas' => 5,
        'texto' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
    ],
    [
        'nombre' => 'Laura Rodríguez',
        'tratamiento' => 'Medicina Estética',
        'estrellas' => 4,
        'texto' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    ],
    [
        'nombre' => 'Valentina Pérez',
        'tratamiento' => 'Bienestar y Prevención',
        'estrellas' => 5,
        'texto' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem.',
    ],
    [
        'nombre' => 'Daniela Torres',
        'tratamiento' => 'Medicina Regenerativa',
        'estrellas' => 5,
        'texto' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni.',
    ],
];
?>

<section id="section-clients" class="clients-section mb-5">
    <div class="text-center mb-4 welcome-glass p-4 p-md-5">
        <p class="catalog-overtitle">Testimonios</p>
        <h2 class="catalog-main-title">
            Lo que dicen nuestros <em>pacientes</em>
        </h2>
        <div class="welcome-divider mx-auto mt-3 mb-3"></div>
        <p class="catalog-intro mx-auto">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. La confianza 
            y el bienestar de nuestras pacientes es nuestra mayor satisfacción.
        </p>
    </div>

    <!-- Carrusel banda continua -->
    <div class="logo-carousel-wrapper">
        <div class="logo-carousel-track-container">
            <div class="logo-carousel-track">
                <?php
                // Renderizar testimonios 3 veces para crear el loop infinito
                for ($i = 0; $i < 3; $i++):
                    foreach ($testimonios as $t):
                ?>
                    <div class="testimonial-card">
                        <div class="testimonial-stars">
                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                <i class="fas fa-star<?php echo $s <= $t['estrellas'] ? '' : ' testimonial-star-empty'; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text"><?php echo htmlspecialchars($t['texto']); ?></p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <?php echo mb_substr($t['nombre'], 0, 1); ?>
                            </div>
                            <div>
                                <span class="testimonial-name"><?php echo htmlspecialchars($t['nombre']); ?></span>
                                <span class="testimonial-treatment"><?php echo htmlspecialchars($t['tratamiento']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach;
                endfor; 
                ?>
            </div>
        </div>
    </div>
</section>
