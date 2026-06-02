<?php
// ── Contador de visitas ─────────────────────────────────────
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/controller/conexion.php';
try {
    $__hash = hash('sha256', (session_id() ?: '') . microtime(true));
    $__s = $conn->prepare('INSERT INTO page_visits (session_hash) VALUES (?)');
    $__s->bind_param('s', $__hash);
    $__s->execute();
    $__s->close();
} catch (Exception $__e) { /* silencioso */ }
?>
<!DOCTYPE html>
<html lang="es" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctora Eddi — Medicina Estética, Integrativa y Regenerativa en Medellín</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Doctora Eddi: medicina estética e integrativa en Medellín. Tratamientos faciales, corporales, bioestimulación capilar, terapias con péptidos y protocolos personalizados. Agenda tu valoración integral.">
    <meta name="keywords" content="medicina estética Medellín, medicina integrativa, toxina botulínica, bioestimuladores de colágeno, bioestimulación capilar, tratamiento melasma, péptidos, pérdida de peso, Doctora Eddi, El Poblado">
    <meta name="author" content="Doctora Eddi">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.doctoraeddi.com/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.doctoraeddi.com/">
    <meta property="og:title" content="Doctora Eddi — Medicina Estética, Integrativa y Regenerativa en Medellín">
    <meta property="og:description" content="Medicina estética con enfoque integrativo: tratamos la causa, no solo el síntoma. Valoración integral, protocolos personalizados y resultados naturales.">
    <meta property="og:image" content="https://www.doctoraeddi.com/img/logos/logo_eddi_claro.png">
    <meta property="og:locale" content="es_CO">
    <meta property="og:site_name" content="Doctora Eddi">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Doctora Eddi — Medicina Estética, Integrativa y Regenerativa en Medellín">
    <meta name="twitter:description" content="Medicina estética con enfoque integrativo: tratamos la causa, no solo el síntoma. Agenda tu valoración integral.">
    <meta name="twitter:image" content="https://www.doctoraeddi.com/img/logos/logo_eddi_claro.png">

    <!-- Geo Tags (SEO Local) -->
    <meta name="geo.region" content="CO-ANT">
    <meta name="geo.placename" content="Medellín">
    <meta name="geo.position" content="6.2088;-75.5742">
    <meta name="ICBM" content="6.2088, -75.5742">

    <!-- Bootstrap CSS (local) -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Bootstrap Colors & Buttons -->
    <link href="css/custom-bootstrap.css?v=2.5" rel="stylesheet">

    <!-- Accesibilidad WCAG 2.1 -->
    <link href="css/accessibility.css?v=1.0" rel="stylesheet">

    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts - Inter (limpio y médico) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/logos/icono_eddi_claro.png">
    <link rel="shortcut icon" type="image/png" href="img/logos/icono_eddi_claro.png">
    <link rel="apple-touch-icon" href="img/logos/icono_eddi_claro.png">

    <!-- SweetAlert2 CSS -->
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Schema.org JSON-LD (Datos Estructurados) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "MedicalBusiness",
            "name": "Doctora Eddi — Medicina Estética e Integrativa",
            "description": "Medicina estética con enfoque integrativo en Medellín. Tratamientos faciales, corporales, bioestimulación capilar, terapias con péptidos y protocolos personalizados.",
            "url": "https://www.doctoraeddi.com",
            "logo": "https://www.doctoraeddi.com/img/logos/logo_eddi_claro.png",
            "image": "https://www.doctoraeddi.com/img/logos/logo_eddi_claro.png",
            "telephone": "+573013388063",
            "email": "doctora.eddi@gmail.com",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Carrera 43 A # 1 Sur - 50, Edificio Cross Business, Consultorio 1102",
                "addressLocality": "Medellín",
                "addressRegion": "Antioquia",
                "addressCountry": "CO",
                "postalCode": "050021"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 6.2088,
                "longitude": -75.5742
            },
            "areaServed": {
                "@type": "City",
                "name": "Medellín"
            },
            "sameAs": [
                "https://www.instagram.com/doctora.eddi"
            ],
            "medicalSpecialty": [
                "Medicina Estética",
                "Medicina Integrativa",
                "Medicina Regenerativa"
            ],
            "hasOfferCatalog": {
                "@type": "OfferCatalog",
                "name": "Servicios Médicos",
                "itemListElement": [{
                        "@type": "MedicalProcedure",
                        "name": "Toxina Botulínica",
                        "procedureType": "NoninvasiveProcedure"
                    },
                    {
                        "@type": "MedicalProcedure",
                        "name": "Bioestimuladores de Colágeno",
                        "procedureType": "NoninvasiveProcedure"
                    },
                    {
                        "@type": "MedicalProcedure",
                        "name": "Bioestimulación Capilar",
                        "procedureType": "NoninvasiveProcedure"
                    },
                    {
                        "@type": "MedicalProcedure",
                        "name": "Tratamiento para Melasma, Acné y Rosácea",
                        "procedureType": "NoninvasiveProcedure"
                    },
                    {
                        "@type": "MedicalProcedure",
                        "name": "Terapias con Péptidos",
                        "procedureType": "NoninvasiveProcedure"
                    },
                    {
                        "@type": "MedicalProcedure",
                        "name": "Reducción de Grasa Localizada",
                        "procedureType": "NoninvasiveProcedure"
                    }
                ]
            }
        }
    </script>

    <!-- Schema.org - Persona (Doctor) -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Physician",
            "name": "Doctora Eddi",
            "description": "Médica general con formación en medicina estética y medicina integrativa",
            "url": "https://www.doctoraeddi.com",
            "medicalSpecialty": ["Medicina Estética", "Medicina Integrativa"],
            "alumniOf": [{
                    "@type": "CollegeOrUniversity",
                    "name": "Universidad Cooperativa de Colombia"
                },
                {
                    "@type": "CollegeOrUniversity",
                    "name": "Universidad del Tolima"
                },
                {
                    "@type": "CollegeOrUniversity",
                    "name": "Universidad Pontificia Bolivariana"
                }
            ],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Carrera 43 A # 1 Sur - 50, Edificio Cross Business, Consultorio 1102",
                "addressLocality": "Medellín",
                "addressRegion": "Antioquia",
                "addressCountry": "CO"
            }
        }
    </script>

    <style>
        /* ===== BASE ===== */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 1rem;
            margin: 0;
            background: #f5f3f0;
            color: #434f44;
        }

        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* ===== SECCIONES CON FONDO LIMPIO ===== */
        .med-section {
            background: #ffffff;
            border-radius: 2px;
            box-shadow: 0 1px 4px rgba(67, 79, 68, 0.06);
            margin-bottom: 2rem;
            border: 1px solid #e8e4df;
        }

        .section-title {
            color: #2d332e !important;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* ===== HEADER / NAVBAR ===== */
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

        html {
            scroll-padding-top: 80px;
        }

        /* ===== HERO / BIENVENIDA ===== */
        .welcome-glass {
            background: #ffffff;
            border-radius: 2px;
            border: 1px solid #e8e4df;
            box-shadow: 0 2px 8px rgba(67, 79, 68, 0.06);
        }

        .hero-medical {
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #434f44 0%, #3a4540 50%, #2d332e 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-medical::before {
            content: '';
            position: absolute;
            inset: -20px;
            background: url('img/hero_two.png') center/cover no-repeat;
            filter: blur(8px);
            opacity: 0.25;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-overline {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #c8bfb1;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 3.8rem;
            font-weight: 400;
            color: #ffffff;
            line-height: 1.15;
            margin-bottom: 1.5rem;
        }

        .hero-title em {
            font-style: italic;
            color: #c8bfb1;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 300;
            line-height: 1.8;
            max-width: 540px;
        }

        .hero-divider {
            width: 60px;
            height: 2px;
            background: #c8bfb1;
            margin: 2rem 0;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.8);
            padding: 0.4rem 1rem;
            border-radius: 2px;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .hero-img-box {
            position: relative;
            z-index: 2;
        }

        .hero-img-box img {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .hero-medical {
                min-height: auto;
                padding: 4rem 0;
            }

            .hero-img-box img {
                height: 300px;
            }
        }

        /* ===== CATÁLOGO DE ESPECIALIDADES ===== */
        .catalog-overtitle {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #8a9a8b;
            margin-bottom: 0.5rem;
        }

        .catalog-main-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.4rem;
            font-weight: 400;
            color: #2d332e;
        }

        .catalog-main-title em {
            font-style: italic;
            color: #5a6b5c;
        }

        .welcome-highlight {
            color: #5a6b5c;
            font-style: italic;
        }

        .catalog-intro {
            font-size: 1.05rem;
            color: #6b726d;
            max-width: 650px;
            line-height: 1.8;
        }

        .welcome-divider {
            width: 60px;
            height: 2px;
            background: #c8bfb1;
        }

        .catalog-card {
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 2rem;
            height: 100%;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .catalog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #434f44;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .catalog-card:hover {
            border-color: #c4cec6;
            box-shadow: 0 4px 16px rgba(67, 79, 68, 0.08);
        }

        .catalog-card:hover::before {
            opacity: 1;
        }

        .catalog-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .catalog-icon-accent {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 2px;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #434f44;
            transition: all 0.2s ease;
        }

        .catalog-card:hover .catalog-icon-accent {
            background: #434f44;
            color: #ffffff;
            border-color: #434f44;
        }

        .catalog-card-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d332e;
            margin: 0;
        }

        .catalog-card-tag {
            font-size: 0.8rem;
            color: #8a9a8b;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .catalog-card-desc {
            font-size: 0.95rem;
            color: #6b726d;
            line-height: 1.75;
            margin-bottom: 1rem;
        }

        .catalog-features {
            list-style: none;
            padding: 0;
            margin: 0 0 1rem 0;
        }

        .catalog-features li {
            position: relative;
            padding-left: 1.2rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #6b726d;
            line-height: 1.5;
        }

        .catalog-features li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.55rem;
            width: 6px;
            height: 6px;
            border-radius: 1px;
            background: #8a9a8b;
        }

        .catalog-cta-text {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.3rem;
            color: #434f44;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .catalog-main-title {
                font-size: 1.8rem;
            }

            .catalog-card {
                padding: 1.5rem;
            }
        }

        /* ===== TIMELINE / PROCESO ===== */
        .tl-container {
            position: relative;
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .tl-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: #d4cfc8;
            transform: translateX(-50%);
        }

        .tl-item {
            position: relative;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 40px 1fr;
            gap: 1.5rem;
            padding-bottom: 3.5rem;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
            align-items: stretch;
        }

        .tl-item.tl-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .tl-left .tl-content {
            grid-column: 1;
            text-align: right;
        }

        .tl-left .tl-dot {
            grid-column: 2;
        }

        .tl-left .tl-image {
            grid-column: 3;
        }

        .tl-right .tl-image {
            grid-column: 1;
        }

        .tl-right .tl-dot {
            grid-column: 2;
        }

        .tl-right .tl-content {
            grid-column: 3;
            text-align: left;
        }

        .tl-dot {
            grid-row: 1;
            width: 36px;
            height: 36px;
            border-radius: 2px;
            background: #434f44;
            border: 2px solid #f5f3f0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            justify-self: center;
            margin-top: 0.3rem;
            transition: background 0.2s ease;
        }

        .tl-item:hover .tl-dot {
            background: #2d332e;
        }

        .tl-dot span {
            font-size: 0.8rem;
            font-weight: 600;
            color: #ffffff;
        }

        .tl-content {
            grid-row: 1;
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.8rem 2rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .tl-content::after {
            content: '';
            position: absolute;
            top: 14px;
            width: 10px;
            height: 10px;
            background: #ffffff;
            border: 1px solid #e8e4df;
            transform: rotate(45deg);
        }

        .tl-left .tl-content::after {
            right: -6px;
            border-left: none;
            border-bottom: none;
        }

        .tl-right .tl-content::after {
            left: -6px;
            border-right: none;
            border-top: none;
        }

        .tl-item:hover .tl-content {
            border-color: #c4cec6;
            box-shadow: 0 4px 16px rgba(67, 79, 68, 0.06);
        }

        .tl-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #8a9a8b;
            margin-bottom: 0.4rem;
        }

        .tl-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d332e;
            margin: 0 0 0.6rem 0;
        }

        .tl-desc {
            font-size: 0.95rem;
            color: #6b726d;
            line-height: 1.75;
            margin-bottom: 1rem;
        }

        .tl-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .tl-left .tl-tags {
            justify-content: flex-end;
        }

        .tl-image {
            grid-row: 1;
            overflow: hidden;
            border-radius: 2px;
            position: relative;
        }

        .tl-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 2px;
            border: 1px solid #e8e4df;
            transition: opacity 0.3s ease;
        }

        .tl-item:hover .tl-image img {
            opacity: 0.9;
        }

        .tl-tags span {
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 2px;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            color: #6b726d;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .tl-line {
                left: 18px;
            }

            .tl-item {
                display: flex;
                flex-direction: column;
                padding-left: 50px;
            }

            .tl-left .tl-content,
            .tl-right .tl-content {
                text-align: left;
            }

            .tl-dot {
                position: absolute;
                left: 0;
                top: 0;
            }

            .tl-left .tl-content::after,
            .tl-right .tl-content::after {
                left: -6px;
                right: auto;
                border-right: none;
                border-top: none;
                border-left: 1px solid #e8e4df;
                border-bottom: 1px solid #e8e4df;
            }

            .tl-left .tl-tags {
                justify-content: flex-start;
            }

            .tl-image {
                order: 2;
                margin-top: 1rem;
                position: relative;
                width: 100%;
                aspect-ratio: 4 / 3;
                min-height: 280px;
            }

            .tl-content {
                order: 1;
            }

            .tl-image img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            .tl-title {
                font-size: 1.15rem;
            }
        }

        /* ===== CARRUSEL DE LOGOS ===== */
        .logo-carousel-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .logo-carousel-track-container {
            overflow: hidden;
            flex: 1;
            mask-image: linear-gradient(90deg, transparent, #000 5%, #000 95%, transparent);
            -webkit-mask-image: linear-gradient(90deg, transparent, #000 5%, #000 95%, transparent);
        }

        .logo-carousel-track {
            display: flex;
            align-items: center;
            gap: 0;
            will-change: transform;
            animation: logoScroll 40s linear infinite;
        }

        .logo-carousel-track:hover {
            animation-play-state: paused;
        }

        @keyframes logoScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-33.333%);
            }
        }

        .testimonial-card {
            flex: 0 0 auto;
            width: 340px;
            background: #ffffff;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 1.8rem;
            margin: 0 0.6rem;
            display: flex;
            flex-direction: column;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .testimonial-card:hover {
            border-color: #c4cec6;
            box-shadow: 0 4px 16px rgba(67, 79, 68, 0.08);
        }

        .testimonial-stars {
            display: flex;
            gap: 0.2rem;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: #c8bfb1;
        }

        .testimonial-star-empty {
            opacity: 0.3;
        }

        .testimonial-text {
            font-size: 0.95rem;
            color: #6b726d;
            line-height: 1.75;
            margin-bottom: 1.2rem;
            flex: 1;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-top: 1px solid #e8e4df;
            padding-top: 1rem;
        }

        .testimonial-avatar {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 2px;
            background: #434f44;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1rem;
            font-weight: 600;
        }

        .testimonial-name {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #2d332e;
        }

        .testimonial-treatment {
            display: block;
            font-size: 0.75rem;
            color: #8a9a8b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .testimonial-card {
                width: 280px;
                padding: 1.4rem;
            }
        }

        /* ===== FOOTER / CONTACTO ===== */
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

        .contact-info-item:hover .contact-icon-box {
            background: rgba(255, 255, 255, 0.12);
            transition: all 0.2s ease;
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

        @media (max-width: 768px) {
            .footer-contact {
                padding: 3rem 0 1.5rem;
            }

            .footer-header h2 {
                font-size: 1.8rem !important;
            }
        }

        /* ===== SOBRE LA DOCTORA ===== */
        .about-img-wrapper {
            position: relative;
        }

        .about-img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            object-position: center 20%;
            border-radius: 2px;
            border: 1px solid #e8e4df;
        }

        .about-img-accent {
            position: absolute;
            bottom: -12px;
            right: -12px;
            width: 60%;
            height: 60%;
            border: 2px solid #c8bfb1;
            border-radius: 2px;
            z-index: -1;
        }

        .about-bio {
            font-size: 1.05rem;
            color: #6b726d;
            line-height: 1.85;
            margin-bottom: 1.5rem;
        }

        .about-philosophy {
            background: #f5f3f0;
            border-left: 3px solid #434f44;
            border-radius: 0 2px 2px 0;
            padding: 1.5rem 1.8rem;
        }

        .about-philosophy-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #434f44;
            margin-bottom: 0.6rem;
        }

        .about-philosophy-text {
            font-size: 0.95rem;
            color: #6b726d;
            line-height: 1.75;
            font-style: italic;
            margin-bottom: 0;
        }

        .about-credential {
            display: inline-flex;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 500;
            color: #6b726d;
            background: #f5f3f0;
            border: 1px solid #e8e4df;
            border-radius: 2px;
            padding: 0.4rem 0.8rem;
            letter-spacing: 0.3px;
        }

        .about-credential i {
            color: #8a9a8b;
            font-size: 0.75rem;
        }

        @media (max-width: 768px) {
            .about-img {
                height: 350px;
            }

            .about-img-accent {
                display: none;
            }
        }
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>

    <!-- Hero Section -->
    <?php include 'components/sections/landind_sections.php'; ?>

    <!-- Catálogo de Especialidades -->
    <div class="container-fluid px-3 px-md-5 mb-5">
        <?php include 'components/sections/catalog_sections.php'; ?>
    </div>

    <!-- Sobre la Doctora -->
    <div class="container-fluid px-3 px-md-5 mb-5">
        <?php include 'components/sections/about_doctor.php'; ?>
    </div>

    <!-- Proceso / Timeline -->
    <div class="container-fluid px-3 px-md-5 mb-5">
        <?php include 'components/sections/process_timeline.php'; ?>
    </div>

    <!-- Carrusel de Aliados -->
    <div class="container-fluid px-3 px-md-5 mb-5">
        <?php include 'components/sections/logos_carousel.php'; ?>
    </div>

    <!-- Manifiesto -->
    <?php include 'components/sections/manifiesto.php'; ?>

    <!-- Footer / Contacto -->
    <?php include 'components/sections/footer_contact.php'; ?>

    <!-- Widget de Accesibilidad WCAG -->
    <?php include 'components/accessibility_widget.php'; ?>

    <!-- Modal Login -->
    <?php include 'components/login_modal.php'; ?>

    <!-- Bootstrap JS (local) -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Accesibilidad JS -->
    <script src="js/accessibility.js?v=1.0"></script>

    <!-- SweetAlert2 (local) -->
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Popup Promocional — gestionado desde el Dashboard -->
    <?php
    // ── Buscar anuncio activo y vigente (el más reciente) ───────────────────
    $__anuncio = null;
    try {
        $__today = date('Y-m-d');
        $__sa = $conn->prepare(
            'SELECT id, titulo, imagen, wa_numero, wa_mensaje, texto_boton, delay_ms
               FROM anuncios
              WHERE activo = 1
                AND fecha_inicio <= ?
                AND fecha_fin    >= ?
              ORDER BY creation_date DESC
              LIMIT 1'
        );
        $__sa->bind_param('ss', $__today, $__today);
        $__sa->execute();
        $__anuncio = $__sa->get_result()->fetch_assoc();
        $__sa->close();
    } catch (Exception $__e) { /* silencioso */ }

    if ($__anuncio):
        // Determinar src de la imagen (URL externa o archivo local)
        $__imgSrc = (strpos($__anuncio['imagen'], 'http') === 0)
            ? htmlspecialchars($__anuncio['imagen'], ENT_QUOTES, 'UTF-8')
            : 'img/anuncios/' . htmlspecialchars($__anuncio['imagen'], ENT_QUOTES, 'UTF-8');

        $__popupId  = 'popup_anuncio_' . (int)$__anuncio['id'];
        $__waNum    = htmlspecialchars($__anuncio['wa_numero'],   ENT_QUOTES, 'UTF-8');
        $__waMsg    = json_encode($__anuncio['wa_mensaje'],        JSON_UNESCAPED_UNICODE);
        $__btnTxt   = htmlspecialchars($__anuncio['texto_boton'], ENT_QUOTES, 'UTF-8');
        $__titulo   = htmlspecialchars($__anuncio['titulo'],       ENT_QUOTES, 'UTF-8');
        $__delay    = (int)$__anuncio['delay_ms'];
    ?>
    <style>
        @keyframes swalPromoIn {
            from { opacity: 0; transform: scale(0.88) translateY(28px); }
            to   { opacity: 1; transform: scale(1)    translateY(0);    }
        }
        @keyframes swalPromoOut {
            from { opacity: 1; transform: scale(1)    translateY(0);    }
            to   { opacity: 0; transform: scale(0.93) translateY(16px); }
        }
        .swal-promo-show { animation: swalPromoIn  0.6s cubic-bezier(0.22, 1, 0.36, 1) both; }
        .swal-promo-hide { animation: swalPromoOut 0.3s ease forwards; }
        .swal-promo-popup {
            border: 1px solid #e8e4df !important;
            box-shadow: 0 32px 80px rgba(0,0,0,.22) !important;
            border-radius: 2px !important;
        }
        .swal-promo-close {
            color: #8a9a8b !important;
            font-size: 1.4rem !important;
            top: 0.6rem !important;
            right: 0.8rem !important;
        }
        .swal-promo-close:hover {
            color: #434f44 !important;
            background: #f5f3f0 !important;
            border-radius: 2px !important;
        }
        .swal-promo-wa-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            background: #434f44;
            color: #ffffff;
            text-decoration: none;
            padding: 0.85rem 1.5rem;
            border-radius: 2px;
            font-family: Inter, sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: background 0.2s ease;
        }
        .swal-promo-wa-btn:hover { background: #2d332e; color: #ffffff; }
        .swal2-backdrop-show {
            backdrop-filter: blur(5px) !important;
            background: rgba(67,79,68,.35) !important;
        }
    </style>

    <script>
        (function() {
            var popupKey = <?php echo json_encode($__popupId); ?>;
            if (sessionStorage.getItem(popupKey)) return;
            sessionStorage.setItem(popupKey, '1');

            var waUrl = 'https://wa.me/<?php echo $__waNum; ?>?text=' + encodeURIComponent(<?php echo $__waMsg; ?>);

            setTimeout(function() {
                Swal.fire({
                    html: '<img src="<?php echo $__imgSrc; ?>"' +
                          ' alt="<?php echo $__titulo; ?>"' +
                          ' style="width:100%;border-radius:2px;display:block;margin-bottom:1.1rem;">' +
                          '<a href="' + waUrl + '"' +
                          '   target="_blank" rel="noopener noreferrer"' +
                          '   class="swal-promo-wa-btn">' +
                          '  <i class="fab fa-whatsapp" style="font-size:1.1rem;"></i>' +
                          '  <?php echo $__btnTxt; ?>' +
                          '</a>',
                    showConfirmButton: false,
                    showCloseButton:   true,
                    background: '#ffffff',
                    width:      'min(680px, 94vw)',
                    padding:    '1.2rem 1.2rem 1.4rem',
                    backdrop:   true,
                    showClass:  { popup: 'swal-promo-show' },
                    hideClass:  { popup: 'swal-promo-hide' },
                    customClass: {
                        popup:       'swal-promo-popup',
                        closeButton: 'swal-promo-close'
                    }
                });
            }, <?php echo $__delay; ?>);
        })();
    </script>
    <?php endif; ?>

    <script>
        // Timeline: reveal on scroll
        const tlObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('tl-visible');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        document.querySelectorAll('.tl-item').forEach(item => {
            tlObserver.observe(item);
        });

        // Logo carousel: scroll con rueda del mouse
        (function() {
            const container = document.querySelector('.logo-carousel-track-container');
            const track = document.querySelector('.logo-carousel-track');
            if (!track || !container) return;

            const setWidth = track.scrollWidth / 3;

            function wrapPosition(x) {
                let wrapped = x % setWidth;
                if (wrapped > 0) wrapped -= setWidth;
                return wrapped;
            }

            container.addEventListener('wheel', function(e) {
                e.preventDefault();
                const style = window.getComputedStyle(track);
                const matrix = new DOMMatrix(style.transform);
                let currentX = matrix.m41;
                const delta = e.deltaY !== 0 ? e.deltaY : e.deltaX;

                let newX = wrapPosition(currentX - delta);

                track.style.animation = 'none';
                track.style.transform = 'translateX(' + newX + 'px)';

                clearTimeout(track._scrollTimer);
                track._scrollTimer = setTimeout(() => {
                    track.style.transform = '';
                    track.style.animation = '';
                }, 1500);
            }, {
                passive: false
            });
        })();

        // Scroll Spy
        (function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-scroll-btn');
            if (!sections.length || !navLinks.length) return;

            function updateActive() {
                let current = '';
                const offset = 120;
                sections.forEach(section => {
                    const top = section.offsetTop - offset;
                    if (window.scrollY >= top) {
                        current = section.getAttribute('id');
                    }
                });
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', updateActive, {
                passive: true
            });
            updateActive();
        })();
    </script>

</body>

</html>