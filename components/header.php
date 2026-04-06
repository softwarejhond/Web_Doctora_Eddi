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
            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0 align-items-center">
                <a href="https://www.instagram.com/doctora.eddi" target="_blank" class="nav-social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <div class="vr mx-2 opacity-25" style="height: 24px; border-color: #fff;"></div>
                <button class="btn btn-outline-light btn-sm nav-scroll-btn d-flex align-items-center gap-2" 
                        data-bs-toggle="modal" data-bs-target="#loginModal"
                        style="border-color: rgba(200,191,177,.45); color: #c8bfb1;">
                    <i class="fas fa-sign-in-alt"></i> Ingresar
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer para compensar el header fijo -->
<div id="top" style="height: 70px;"></div>
