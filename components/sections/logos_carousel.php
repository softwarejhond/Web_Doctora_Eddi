<?php
/**
 * Sección Carrusel de Testimonios - DOCTORA EDDI
 * Banda continua de tarjetas de testimonios con autoplay
 */

$testimonios = [
    [
        'nombre' => 'Natalia Vahos',
        'tratamiento' => 'Medicina Estética',
        'estrellas' => 5,
        'texto' => 'Mi experiencia con Dra Eddi fue excelente. Es una gran profesional que orientó las necesidades de mi piel. Su tratamiento fue muy acertado y la aplicación totalmente cómoda. Quedé muy feliz con mis resultados.',
    ],
    [
        'nombre' => 'Andrea Bolívar',
        'tratamiento' => 'Medicina Estética',
        'estrellas' => 5,
        'texto' => 'Muchas gracias por los procedimientos realizados: botox, sculptra y vitaminas. Me encanta cómo se ve mi rostro y cómo me siento. Mis cambios son notorios y mi piel se ve mucho mejor.',
    ],
    [
        'nombre' => 'Aurora García',
        'tratamiento' => 'Tratamiento Capilar y Facial',
        'estrellas' => 5,
        'texto' => 'Desde que inicié con la doctora Eddi, el cambio ha sido súper notorio: mi piel está más sana, luminosa y uniforme. La caída de mi cabello mejoró muchísimo. Estoy muy agradecida por su profesionalismo.',
    ],
    [
        'nombre' => 'Andrea Escobar',
        'tratamiento' => 'Medicina Integrativa',
        'estrellas' => 5,
        'texto' => 'Llevo dos meses en tratamiento. Pasé de 77 kg a 68 kg con alimentación balanceada, suplementación vitamínica y ejercicio. He logrado un cambio significativo físico, personal y emocional. Profundamente agradecida.',
    ],
    [
        'nombre' => 'Elena',
        'tratamiento' => 'Tratamiento Capilar y Facial',
        'estrellas' => 5,
        'texto' => 'Desde que llegué, la piel de mi rostro ha cambiado: tono parejo, brillo, lozanía, firmeza. La terapia capilar ha restaurado mi cabello, aumentado su grosor y brillo. Los logros se notan.',
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
            Descubre las experiencias reales de quienes han confiado en nuestra atención profesional. 
            La satisfacción y el bienestar de nuestros pacientes es nuestra mayor motivación.
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
