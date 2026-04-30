<!DOCTYPE html>
<html lang="es" style="scroll-behavior:smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamientos — Doctora Eddi</title>

    <!-- SEO -->
    <meta name="description" content="Conoce todos los tratamientos de Doctora Eddi: calidad de piel, acné, melasma, rosácea, colágeno, arrugas, recuperación capilar y bruxismo.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.doctoraeddi.com/tratamientos">

    <!-- Bootstrap CSS (local) -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Bootstrap Colors -->
    <link href="css/custom-bootstrap.css?v=2.5" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/logos/icono_eddi_claro.png">

    <style>
        /* ===== BASE ===== */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f3f0;
            color: #434f44;
            margin: 0;
        }

        html {
            scroll-padding-top: 88px;
        }

        /* ===== NAVBAR (reutilizada del header principal) ===== */
        .med-header {
            background: #434f44;
            border-bottom: 1px solid #3a4540;
            padding: 0.6rem 1rem;
            z-index: 1030;
        }

        .med-logo {
            height: 48px;
            width: auto;
        }

        .nav-scroll-btn {
            border-radius: 2px;
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: all 0.2s ease;
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-scroll-btn:hover,
        .nav-scroll-btn.active {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(200, 191, 177, 0.3);
        }

        .nav-social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .nav-social-icon:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        /* ===== HERO BANNER ===== */
        .trat-hero {
            background: linear-gradient(135deg, #434f44 0%, #3a4540 50%, #2d332e 100%);
            padding: 5rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .trat-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('img/hero_two.png') center/cover no-repeat;
            opacity: 0.08;
        }

        .trat-hero-content {
            position: relative;
            z-index: 1;
        }

        .trat-hero-overline {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #c8bfb1;
            margin-bottom: 0.75rem;
        }

        .trat-hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 3rem;
            font-weight: 400;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .trat-hero-title em {
            font-style: italic;
            color: #c8bfb1;
        }

        .trat-hero-sub {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 300;
            max-width: 580px;
        }

        /* ===== ÍNDICE RÁPIDO (pills) ===== */
        .trat-index {
            background: #ffffff;
            border-bottom: 1px solid #e8e4df;
            padding: 1rem 0;
            position: sticky;
            top: 64px;
            z-index: 900;
        }

        .trat-index-pill {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            border-radius: 2px;
            border: 1px solid #e8e4df;
            color: #6b726d;
            text-decoration: none;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .trat-index-pill:hover,
        .trat-index-pill.active {
            background: #434f44;
            color: #ffffff;
            border-color: #434f44;
        }

        /* ===== ARTÍCULO DE TRATAMIENTO ===== */
        .trat-section {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 3.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 4px rgba(67,79,68,.06);
        }

        .trat-overline {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #8a9a8b;
            margin-bottom: 0.5rem;
        }

        .trat-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.2rem;
            font-weight: 400;
            color: #2d332e;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .trat-title em {
            font-style: italic;
            color: #5a6b5c;
        }

        .trat-divider {
            width: 50px;
            height: 2px;
            background: #c8bfb1;
            margin: 1.2rem 0 1.5rem;
        }

        .trat-body {
            font-size: 1rem;
            color: #6b726d;
            line-height: 1.85;
        }

        .trat-body p {
            margin-bottom: 1.25rem;
        }

        .trat-body p:last-child {
            margin-bottom: 0;
        }

        /* Frase destacada (último párrafo / objetivo) */
        .trat-objetivo {
            background: #f5f3f0;
            border-left: 3px solid #434f44;
            border-radius: 0 2px 2px 0;
            padding: 1.25rem 1.5rem;
            font-style: italic;
            color: #434f44;
            font-size: 0.97rem;
            margin-top: 1.5rem;
        }

        /* ===== IMAGEN DE TRATAMIENTO ===== */
        .trat-img-treatment {
            width: 100%;
            height: auto;
            border-radius: 2px;
            display: block;
        }

        /* Badge de icono del tratamiento */
        .trat-icon-badge {
            width: 52px;
            height: 52px;
            border-radius: 2px;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #434f44;
            margin-bottom: 1rem;
        }

        /* ===== CTA FLOTANTE LATERAL ===== */
        .trat-cta-card {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.75rem;
            position: sticky;
            top: 130px;
        }

        .trat-cta-card h6 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.05rem;
            font-weight: 400;
            color: #2d332e;
            margin-bottom: 0.75rem;
        }

        .trat-cta-card p {
            font-size: 0.85rem;
            color: #8a9a8b;
            line-height: 1.6;
            margin-bottom: 1.2rem;
        }

        /* ===== FOOTER heredado ===== */
        .footer-contact {
            padding: 5rem 0 2rem;
            background: #434f44;
        }

        .contact-icon-box {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #c8bfb1;
        }

        .social-icon-link {
            text-decoration: none;
        }

        .social-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.2s ease;
        }

        .social-icon-box:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .footer-input,
        .footer-input:focus {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border-radius: 2px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: border-color 0.2s ease;
        }

        .footer-input::placeholder {
            color: rgba(107, 114, 109, 0.6);
        }

        .footer-input:focus {
            border-color: rgba(200, 191, 177, 0.4);
            box-shadow: 0 0 0 2px rgba(200, 191, 177, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .footer-input option {
            background: #434f44;
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .welcome-glass {
            background: #ffffff;
            border-radius: 2px;
            border: 1px solid #e8e4df;
            box-shadow: 0 2px 8px rgba(67, 79, 68, 0.06);
        }

        @media (max-width: 768px) {
            .trat-hero-title { font-size: 2rem; }
            .trat-title      { font-size: 1.7rem; }
            .trat-index      { display: none; }
            .trat-section    { padding: 2rem 1.25rem; }
        }
    </style>
</head>

<body>

    <?php include 'components/header_tratamientos.php'; ?>

    <!-- ===== HERO ===== -->
    <section class="trat-hero">
        <div class="container-fluid px-3 px-md-5">
            <div class="trat-hero-content">
                <p class="trat-hero-overline">Doctora Eddi — Medicina Integrativa</p>
                <h1 class="trat-hero-title">Nuestros <em>Tratamientos</em></h1>
                <p class="trat-hero-sub">
                    Protocolos personalizados que combinan medicina estética, regulación metabólica
                    y terapias regenerativas para lograr resultados auténticos y sostenibles.
                </p>
            </div>
        </div>
    </section>

    <!-- ===== ÍNDICE RÁPIDO ===== -->
    <!-- <div class="trat-index">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex gap-2 flex-wrap">
                <a href="#calidad-piel" class="trat-index-pill">Calidad de Piel</a>
                <a href="#acne" class="trat-index-pill">Acné</a>
                <a href="#melasma" class="trat-index-pill">Melasma y Manchas</a>
                <a href="#rosacea" class="trat-index-pill">Rosácea</a>
                <a href="#colageno" class="trat-index-pill">Activa tu Colágeno</a>
                <a href="#arrugas" class="trat-index-pill">Suaviza Arrugas</a>
                <a href="#capilar" class="trat-index-pill">Recuperación Capilar</a>
                <a href="#bruxismo" class="trat-index-pill">Bruxismo</a>
            </div>
        </div>
    </div> -->

    <!-- ===== TRATAMIENTOS ===== -->
    <div class="container-fluid px-3 px-md-5 py-4">

        <!-- ── 1. CALIDAD DE PIEL ── -->
        <section id="calidad-piel" class="trat-section">
            <div class="row g-5 align-items-start">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-droplet"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 01</p> -->
                    <h2 class="trat-title">Calidad de <em>Piel</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            Los tratamientos de calidad de piel van más allá de lo superficial.
                            Diseñamos protocolos integrales que combinan la regulación de tu metabolismo a través de
                            medicamentos y suplementación, con el objetivo de disminuir la inflamación generada por
                            factores como la alimentación, el sedentarismo y el estrés crónico.
                        </p>
                        <p>
                            A este abordaje interno le sumamos tratamientos faciales combinados y personalizados,
                            que trabajan en sinergia para restaurar el equilibrio de la piel, mejorar su función y potenciar
                            su capacidad de regeneración. Así logramos no solo una piel más hidratada y luminosa,
                            sino también más saludable, uniforme y resistente en el tiempo.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro enfoque está orientado a lograr resultados auténticos y sostenibles, donde la
                            transformación no solo es visible, sino que también se experimenta desde el bienestar interno.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/piel_1.png" alt="Calidad de Piel" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 2. ACNÉ ── -->
        <section id="acne" class="trat-section">
            <div class="row g-5 align-items-start flex-lg-row-reverse">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-shield-halved"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 02</p> -->
                    <h2 class="trat-title">Tratamiento de <em>Acné</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            El acné se aborda como una condición multifactorial que requiere mucho
                            más que tratamientos tópicos. Diseñamos protocolos integrales enfocados en regular los
                            factores internos que lo desencadenan, como los desequilibrios hormonales, la inflamación,
                            la alimentación y el estrés.
                        </p>
                        <p>
                            Combinamos manejo médico, regulación metabólica y tratamientos faciales personalizados
                            que permiten desinflamar la piel, controlar la producción de sebo, mejorar la microbiota
                            cutánea y prevenir la aparición de nuevas lesiones. Además, trabajamos en la recuperación
                            de la piel para disminuir manchas y marcas residuales.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo no es solo controlar el acné de forma temporal, sino lograr una piel más
                            sana, equilibrada y estable en el tiempo, evitando recaídas y mejorando la calidad de vida del paciente.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/consulta_1.1.jpg" alt="Acné" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 3. MELASMA Y MANCHAS ── -->
        <section id="melasma" class="trat-section">
            <div class="row g-5 align-items-start">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-circle-half-stroke"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 03</p> -->
                    <h2 class="trat-title">Melasma y <em>Manchas</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            El manejo del melasma y las manchas va mucho más allá de
                            despigmentar la piel. Entendemos que es una condición compleja, influenciada por factores
                            hormonales, inflamatorios, exposición solar y hábitos de vida, por lo que requiere un
                            abordaje integral y altamente personalizado.
                        </p>
                        <p>
                            Diseñamos protocolos que combinan tratamiento médico, regulación interna y terapias
                            faciales avanzadas, enfocados en disminuir la producción de pigmento, controlar la
                            inflamación y fortalecer la barrera cutánea. Trabajamos de forma progresiva y segura para
                            lograr una piel más uniforme, luminosa y saludable.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo es no solo mejorar las manchas visibles, sino estabilizar la piel a largo
                            plazo, prevenir recaídas y devolverte la confianza en tu piel.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/tratamiento_6.6.png" alt="Melasma y Manchas" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 4. ROSÁCEA ── -->
        <section id="rosacea" class="trat-section">
            <div class="row g-5 align-items-start flex-lg-row-reverse">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-fire-flame-curved"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 04</p> -->
                    <h2 class="trat-title"><em>Rosácea</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            La rosácea se aborda como una condición inflamatoria crónica que
                            requiere un manejo integral y respetuoso con la piel. Más allá de tratar el enrojecimiento
                            visible, buscamos identificar y regular los factores desencadenantes como el estrés, la
                            alimentación, los desequilibrios internos y la alteración de la barrera cutánea.
                        </p>
                        <p>
                            Diseñamos protocolos personalizados que combinan manejo médico, regulación metabólica
                            y tratamientos suaves pero efectivos, enfocados en desinflamar, fortalecer la piel y mejorar
                            su tolerancia. Trabajamos para reducir el enrojecimiento, la sensibilidad y los brotes,
                            mientras restauramos el equilibrio cutáneo.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo es lograr una piel más estable, resistente y confortable, mejorando no solo
                            su apariencia, sino también la calidad de vida del paciente.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/proceso_4.jpeg" alt="Rosácea" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 5. ACTIVA TU COLÁGENO ── -->
        <section id="colageno" class="trat-section">
            <div class="row g-5 align-items-start">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-bolt"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 05</p> -->
                    <h2 class="trat-title">Activa tu <em>Colágeno</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            Los tratamientos para estimular la producción de colágeno y elastina están
                            diseñados para recuperar la firmeza, la estructura y la calidad de la piel de forma progresiva
                            y natural. Entendemos que la flacidez es el resultado de procesos internos como el
                            envejecimiento celular, la inflamación y la pérdida del soporte de la piel, por lo que su
                            manejo debe ser integral.
                        </p>
                        <p>
                            Combinamos bioestimulación y terapias regenerativas con un enfoque interno orientado a
                            optimizar el metabolismo y potenciar la capacidad del cuerpo para producir sus propias
                            fibras de sostén. De esta manera, logramos mejorar la firmeza, redefinir contornos y
                            devolverle a la piel una apariencia más densa, elástica y rejuvenecida.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo es estimular tu piel, no reemplazarla, obteniendo resultados armónicos,
                            naturales y sostenibles en el tiempo.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/tratamiento_5.5.jpg" alt="Activa tu Colágeno" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 6. SUAVIZA ARRUGAS ── -->
        <section id="arrugas" class="trat-section">
            <div class="row g-5 align-items-start flex-lg-row-reverse">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-wand-magic-sparkles"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 06</p> -->
                    <h2 class="trat-title">Suaviza Arrugas y <em>Revitaliza tu Piel</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            Este protocolo combina estratégicamente la toxina botulínica con skin
                            boosters para lograr un rejuvenecimiento integral y natural. Mientras la toxina botulínica
                            relaja la musculatura responsable de las líneas de expresión, previniendo y suavizando
                            arrugas, los skin boosters actúan en la calidad de la piel, aportando hidratación profunda,
                            luminosidad y regeneración.
                        </p>
                        <p>
                            A este abordaje sumamos la aplicación de medicamentos biorreguladores, que favorecen la
                            síntesis de colágeno, estimulan la regeneración celular y optimizan los procesos biológicos
                            de la piel, potenciando así los resultados y haciéndolos más sostenibles en el tiempo.
                        </p>
                        <p>
                            Este tratamiento permite no solo verte más fresca y descansada, sino también mejorar la
                            textura, elasticidad y vitalidad de la piel. Es ideal para quienes buscan resultados sutiles
                            pero efectivos, donde la piel se vea saludable, luminosa y rejuvenecida sin perder la naturalidad.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro enfoque combina precisión médica y armonía facial, logrando un equilibrio perfecto
                            entre prevención, tratamiento y regeneración.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/proceso_1.1.jpg" alt="Suaviza Arrugas" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 7. RECUPERACIÓN CAPILAR ── -->
        <section id="capilar" class="trat-section">
            <div class="row g-5 align-items-start">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-seedling"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 07</p> -->
                    <h2 class="trat-title">Recuperación <em>Capilar</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            El abordaje capilar va más allá de tratar la caída del cabello. Entendemos
                            que la salud capilar está profundamente relacionada con el equilibrio interno, por lo que
                            evaluamos factores como el estado metabólico, hormonal, nutricional y el impacto del estrés
                            en el organismo.
                        </p>
                        <p>
                            Diseñamos protocolos integrales que combinan tratamiento médico, regulación interna y
                            terapias capilares avanzadas, orientadas a disminuir la caída, fortalecer el folículo piloso y
                            estimular el crecimiento de un cabello más sano y resistente. Además, trabajamos en la
                            calidad del cuero cabelludo, ya que un entorno saludable es clave para obtener resultados duraderos.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo es no solo recuperar el cabello, sino restablecer su ciclo natural de
                            crecimiento, logrando cambios visibles, progresivos y sostenibles en el tiempo.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/valoracion_1.1.jpg" alt="Recuperación Capilar" class="trat-img-treatment">
                </div>
            </div>
        </section>

        <!-- ── 8. BRUXISMO ── -->
        <section id="bruxismo" class="trat-section">
            <div class="row g-5 align-items-start flex-lg-row-reverse">
                <!-- Texto -->
                <div class="col-lg-8">
                    <div class="trat-icon-badge"><i class="fas fa-tooth"></i></div>
                    <!-- <p class="trat-overline">Tratamiento 08</p> -->
                    <h2 class="trat-title">Mejora tu <em>Bruxismo</em></h2>
                    <div class="trat-divider"></div>
                    <div class="trat-body">
                        <p>
                            El bruxismo se aborda de manera integral, entendiendo que no solo afecta
                            la estética facial, sino también la salud y el bienestar. El apretamiento o rechinamiento
                            dental puede generar tensión muscular, dolor, desgaste dental e incluso alterar la armonía
                            del rostro.
                        </p>
                        <p>
                            Nuestro tratamiento combina la aplicación de toxina botulínica para relajar la musculatura
                            responsable, con un enfoque complementario que busca regular factores como el estrés y la
                            sobrecarga muscular. Esto permite disminuir la tensión, aliviar síntomas como dolor o
                            rigidez y mejorar la calidad de vida del paciente.
                        </p>
                        <p>
                            Además, al relajar estos músculos, se logra un efecto estético sutil que estiliza el rostro,
                            manteniendo siempre la naturalidad.
                        </p>
                        <div class="trat-objetivo">
                            Nuestro objetivo es no solo tratar el síntoma, sino mejorar tu bienestar de forma integral
                            y sostenida en el tiempo.
                        </div>
                    </div>
                </div>
                <!-- Imagen -->
                <div class="col-lg-4">
                    <img src="img/proceso_6.6.png" alt="Bruxismo" class="trat-img-treatment">
                </div>
            </div>
        </section>

    </div><!-- /container -->

    <!-- ===== FOOTER ===== -->
    <?php include 'components/sections/footer_contact.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Scroll Spy para pills del índice ──────────────────────────────
        (function() {
            const sections = document.querySelectorAll('.trat-section[id]');
            const pills = document.querySelectorAll('.trat-index-pill');
            if (!sections.length || !pills.length) return;

            function updateActive() {
                let current = '';
                sections.forEach(function(sec) {
                    if (window.scrollY >= sec.offsetTop - 140) {
                        current = sec.getAttribute('id');
                    }
                });
                pills.forEach(function(pill) {
                    pill.classList.toggle('active',
                        pill.getAttribute('href') === '#' + current);
                });
            }

            window.addEventListener('scroll', updateActive, {
                passive: true
            });
            updateActive();
        })();

        // ── Smooth scroll al cargar con hash en la URL ────────────────────
        (function() {
            if (!window.location.hash) return;
            const target = document.querySelector(window.location.hash);
            if (!target) return;
            setTimeout(function() {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 120);
        })();
    </script>

</body>

</html>