<?php
/**
 * Widget de Accesibilidad — WCAG 2.1 AA/AAA
 * Funcionalidades: fuente dislexia, tamaño texto, espaciado,
 * alto contraste, saturación, resaltado enlaces, cursor grande,
 * detener animaciones, guía de lectura, modo oscuro.
 */
?>

<!-- Botón flotante de accesibilidad -->
<button id="a11y-toggle" 
    class="a11y-fab" 
    aria-label="Abrir menú de accesibilidad" 
    aria-expanded="false"
    aria-controls="a11y-panel"
    title="Opciones de accesibilidad">
    <i class="fas fa-universal-access" aria-hidden="true"></i>
</button>

<!-- Panel de accesibilidad -->
<div id="a11y-panel" class="a11y-panel" role="dialog" aria-label="Opciones de accesibilidad" aria-hidden="true">
    <div class="a11y-panel-header">
        <h2 class="a11y-panel-title">
            <i class="fas fa-universal-access" aria-hidden="true"></i>
            Accesibilidad
        </h2>
        <button id="a11y-close" class="a11y-close-btn" aria-label="Cerrar menú de accesibilidad">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="a11y-panel-body">

        <!-- Reset -->
        <button id="a11y-reset" class="a11y-reset-btn" aria-label="Restablecer todas las opciones de accesibilidad">
            <i class="fas fa-undo" aria-hidden="true"></i> Restablecer todo
        </button>

        <!-- Tamaño de fuente -->
        <div class="a11y-group">
            <span class="a11y-group-label" id="lbl-fontsize">Tamaño de texto</span>
            <div class="a11y-btn-row" role="group" aria-labelledby="lbl-fontsize">
                <button class="a11y-btn" data-action="font-decrease" aria-label="Reducir tamaño de texto">
                    <i class="fas fa-minus" aria-hidden="true"></i> A<small>−</small>
                </button>
                <span id="a11y-font-level" class="a11y-level" aria-live="polite">100%</span>
                <button class="a11y-btn" data-action="font-increase" aria-label="Aumentar tamaño de texto">
                    <i class="fas fa-plus" aria-hidden="true"></i> A<small>+</small>
                </button>
            </div>
        </div>

        <!-- Fuente para dislexia -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="dyslexia-font" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-font" aria-hidden="true"></i></span>
                <span>Fuente para dislexia</span>
            </button>
        </div>

        <!-- Espaciado de texto -->
        <div class="a11y-group">
            <span class="a11y-group-label" id="lbl-spacing">Espaciado de texto</span>
            <div class="a11y-btn-row" role="group" aria-labelledby="lbl-spacing">
                <button class="a11y-btn" data-action="spacing-decrease" aria-label="Reducir espaciado">
                    <i class="fas fa-compress-alt" aria-hidden="true"></i>
                </button>
                <span id="a11y-spacing-level" class="a11y-level" aria-live="polite">Normal</span>
                <button class="a11y-btn" data-action="spacing-increase" aria-label="Aumentar espaciado">
                    <i class="fas fa-expand-alt" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <!-- Alto contraste -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="high-contrast" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-adjust" aria-hidden="true"></i></span>
                <span>Alto contraste</span>
            </button>
        </div>

        <!-- Modo oscuro -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="dark-mode" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-moon" aria-hidden="true"></i></span>
                <span>Modo oscuro</span>
            </button>
        </div>

        <!-- Invertir colores -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="invert-colors" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-exchange-alt" aria-hidden="true"></i></span>
                <span>Invertir colores</span>
            </button>
        </div>

        <!-- Saturación -->
        <div class="a11y-group">
            <span class="a11y-group-label" id="lbl-saturation">Saturación</span>
            <div class="a11y-btn-row" role="group" aria-labelledby="lbl-saturation">
                <button class="a11y-btn" data-action="saturation-decrease" aria-label="Reducir saturación">
                    <i class="fas fa-tint-slash" aria-hidden="true"></i>
                </button>
                <span id="a11y-saturation-level" class="a11y-level" aria-live="polite">Normal</span>
                <button class="a11y-btn" data-action="saturation-increase" aria-label="Aumentar saturación">
                    <i class="fas fa-tint" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <!-- Resaltar enlaces -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="highlight-links" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-link" aria-hidden="true"></i></span>
                <span>Resaltar enlaces</span>
            </button>
        </div>

        <!-- Resaltar títulos -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="highlight-headings" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-heading" aria-hidden="true"></i></span>
                <span>Resaltar títulos</span>
            </button>
        </div>

        <!-- Cursor grande -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="big-cursor" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-mouse-pointer" aria-hidden="true"></i></span>
                <span>Cursor grande</span>
            </button>
        </div>

        <!-- Detener animaciones -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="stop-animations" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-stop-circle" aria-hidden="true"></i></span>
                <span>Detener animaciones</span>
            </button>
        </div>

        <!-- Guía de lectura -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="reading-guide" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-glasses" aria-hidden="true"></i></span>
                <span>Guía de lectura</span>
            </button>
        </div>

        <!-- Enfoque visible -->
        <div class="a11y-group">
            <button class="a11y-toggle-btn" data-action="focus-outline" aria-pressed="false">
                <span class="a11y-toggle-icon"><i class="fas fa-border-style" aria-hidden="true"></i></span>
                <span>Enfoque visible</span>
            </button>
        </div>

    </div>

    <div class="a11y-panel-footer">
        <small>Cumple WCAG 2.1 AA · Norma EN 301 549</small>
    </div>
</div>

<!-- Guía de lectura overlay -->
<div id="a11y-reading-guide" class="a11y-reading-guide" aria-hidden="true"></div>
