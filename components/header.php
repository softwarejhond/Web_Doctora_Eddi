<?php
/**
 * Componente Header - DOCTORA EDDI
 * Navbar fija con estilo médico angular y limpio
 */
?>

<nav class="med-header navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#top">
            <img src="img/logos/logo_eddi_crema.png" alt="Doctora Eddi" class="med-logo me-2">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMed" aria-controls="navbarMed" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarMed">
            <ul class="navbar-nav ms-auto gap-1 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#section-welcome">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#section-catalog">Especialidades</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#section-about">Sobre Mí</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#section-process">Proceso</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#section-clients">Testimonios</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#contacto">Contacto</a>
                </li>
            </ul>
            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0">
                <a href="#" target="_blank" class="nav-social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank" class="nav-social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" class="nav-social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer para compensar el header fijo -->
<div id="top" style="height: 70px;"></div>
