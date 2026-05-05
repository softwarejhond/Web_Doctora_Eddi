<?php
/**
 * Sección Manifiesto — Doctora Eddi
 * Incluir antes del footer en index.php y tratamientos.php
 */
?>

<style>
    .manifiesto-wrap {
        max-width: 780px;
        margin: 0 auto;
        background: #fdfaf6;
        border: 1px solid #d4cfc8;
        border-radius: 2px;
        padding: 4rem 4.5rem;
        box-shadow:
            0 2px 8px rgba(67, 79, 68, .08),
            inset 0 0 60px rgba(200, 191, 177, .12);
        text-align: center;
        position: relative;
    }

    .manifiesto-wrap::before,
    .manifiesto-wrap::after {
        content: '';
        position: absolute;
        left: 14px;
        right: 14px;
        height: 1px;
        background: #d4cfc8;
    }

    .manifiesto-wrap::before { top: 14px; }
    .manifiesto-wrap::after  { bottom: 14px; }

    .manifiesto-overline {
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #8a9a8b;
        margin-bottom: 0.4rem;
    }

    .manifiesto-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 2.4rem;
        font-weight: 400;
        color: #2d332e;
        line-height: 1.2;
        margin-bottom: 0;
    }

    .manifiesto-title em {
        font-style: italic;
        color: #5a6b5c;
    }

    .manifiesto-ornament {
        font-size: 1.4rem;
        color: #c8bfb1;
        margin: 1.2rem 0;
        line-height: 1;
    }

    .manifiesto-body {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.05rem;
        color: #4a5449;
        line-height: 2;
        font-weight: 400;
    }

    .manifiesto-body p {
        margin-bottom: 1rem;
    }

    .manifiesto-body p:last-child {
        margin-bottom: 0;
    }

    .manifiesto-body em {
        font-style: italic;
        color: #434f44;
    }

    @media (max-width: 768px) {
        .manifiesto-wrap { padding: 2.5rem 1.5rem; }
        .manifiesto-body { font-size: .95rem; }
    }
</style>

<div class="container-fluid px-3 px-md-5 pb-5">
    <div class="manifiesto-wrap">
        <p class="manifiesto-overline">Manifiesto</p>
        <h2 class="manifiesto-title">Doctora <em>Eddi</em></h2>
        <div class="manifiesto-ornament">❧</div>
        <div class="manifiesto-body">
            <p>Creemos que la belleza no se crea, <em>se revela.</em></p>
            <p>Que una piel sana es el reflejo de un organismo en equilibrio.</p>
            <p>No creemos en tratamientos aislados ni en soluciones momentáneas, ni mágicas.<br>
            Creemos en comprender, en escuchar y en tratar la causa, no solo lo visible.</p>
            <p>Entendemos que cada piel tiene una historia,<br>
            y que detrás de cada mancha, brote o signo de envejecimiento,<br>
            hay procesos internos que merecen ser atendidos con respeto y precisión.</p>
            <p>Integramos la ciencia, la medicina estética y la medicina biorreguladora<br>
            para acompañar a tu cuerpo en su capacidad natural de regenerarse.</p>
            <p>No buscamos cambiarte.<br>
            <em>Buscamos que te reconectes con tu mejor versión.</em></p>
            <p>Una versión más equilibrada, más saludable, más luminosa.<br>
            Una belleza que no depende de excesos, sino de coherencia.</p>
            <p>Porque cuando el cuerpo está en armonía,<br>
            <em>la piel lo refleja.</em></p>
        </div>
        <div class="manifiesto-ornament">✦</div>
    </div>
</div>
