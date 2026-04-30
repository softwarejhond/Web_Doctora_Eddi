<?php
/**
 * Header Tratamientos — DOCTORA EDDI
 * Navbar fija con navegación interna entre tratamientos
 */
?>

<nav class="med-header navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-3 px-md-5">

        <a class="navbar-brand d-flex align-items-center" href="index">
            <img src="img/logos/logo_eddi_crema.png" alt="Doctora Eddi" class="med-logo me-2">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTrat" aria-controls="navbarTrat"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarTrat">
            <ul class="navbar-nav ms-auto gap-1 mt-3 mt-lg-0 flex-wrap">
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#calidad-piel">Calidad de Piel</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#acne">Acné</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#melasma">Melasma</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#rosacea">Rosácea</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#colageno">Colágeno</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#arrugas">Arrugas</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#capilar">Capilar</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm nav-scroll-btn" href="#bruxismo">Bruxismo</a>
                </li>
            </ul>
            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0 align-items-center">
                <a href="index" class="btn btn-outline-light btn-sm nav-scroll-btn">
                    <i class="fas fa-house me-1"></i>Inicio
                </a>
                <a href="https://www.instagram.com/doctora.eddi" target="_blank"
                   class="nav-social-icon" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <div class="vr mx-2 opacity-25" style="height:24px; border-color:#fff;"></div>
                <a href="index#contacto" class="btn btn-outline-light btn-sm nav-scroll-btn"
                   style="border-color:rgba(200,191,177,.45); color:#c8bfb1;">
                    <i class="fas fa-calendar-check me-1"></i>Agendar Cita
                </a>
            </div>
        </div>

    </div>
</nav>

<!-- Spacer para compensar header fijo -->
<div id="top" style="height:70px;"></div>
