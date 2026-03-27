<?php
/**
 * Componente de Botones Personalizados - LANDING EAGLE
 * Muestra todos los estilos de botones con la paleta personalizada
 */
?>

<!-- BOTONES THEME PRINCIPALES -->
<div id="section-theme" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-palette me-2"></i>
        Botones Theme Principales
    </h2>
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-primary w-100">
                <i class="fas fa-star me-2"></i>Primary - Púrpura
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-secondary w-100">
                <i class="fas fa-cog me-2"></i>Secondary - Gris
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-success w-100">
                <i class="fas fa-check me-2"></i>Success - Verde Teal
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-info w-100">
                <i class="fas fa-info me-2"></i>Info - Índigo Claro
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-warning w-100">
                <i class="fas fa-exclamation-triangle me-2"></i>Warning - Ámbar
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-danger w-100">
                <i class="fas fa-times me-2"></i>Danger - Rosa
            </button>
        </div>
    </div>
    <div class="code-preview mt-3">
        <strong>Código:</strong> &lt;button class="btn btn-primary"&gt;Primary&lt;/button&gt;
    </div>
</div>

<!-- BOTONES OUTLINE -->
<div id="section-outline" class="demo-section p-4">
    <h2 class="section-title">
        <i class="far fa-square me-2"></i>
        Botones Outline
    </h2>
    <div class="row g-3">
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-outline-primary w-100">
                <i class="far fa-star me-2"></i>Outline Primary
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-outline-success w-100">
                <i class="far fa-check-circle me-2"></i>Outline Success
            </button>
        </div>
        <div class="col-md-4 col-sm-6">
            <button class="btn btn-outline-danger w-100">
                <i class="far fa-times-circle me-2"></i>Outline Danger
            </button>
        </div>
    </div>
    <div class="code-preview mt-3">
        <strong>Código:</strong> &lt;button class="btn btn-outline-primary"&gt;Outline&lt;/button&gt;
    </div>
</div>

<!-- TAMAÑOS DE BOTONES -->
<div id="section-sizes" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-expand-arrows-alt me-2"></i>
        Tamaños de Botones
    </h2>
    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-center">
        <button class="btn btn-primary btn-sm">
            <i class="fas fa-minus me-1"></i>Pequeño
        </button>
        <button class="btn btn-success">
            <i class="fas fa-equals me-2"></i>Normal
        </button>
        <button class="btn btn-warning btn-lg">
            <i class="fas fa-plus me-2"></i>Grande
        </button>
    </div>
    <div class="code-preview mt-3">
        <strong>Códigos:</strong><br>
        • &lt;button class="btn btn-primary btn-sm"&gt;Pequeño&lt;/button&gt;<br>
        • &lt;button class="btn btn-primary"&gt;Normal&lt;/button&gt;<br>
        • &lt;button class="btn btn-primary btn-lg"&gt;Grande&lt;/button&gt;
    </div>
</div>

<!-- BOTONES COLORES PERSONALIZADOS -->
<div id="section-custom" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-rainbow me-2"></i>
        Colores Personalizados EAGLE
    </h2>
    <div class="row g-3">
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-magenta w-100">
                <i class="fas fa-heart me-2"></i>Magenta
            </button>
        </div>
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-lime w-100">
                <i class="fas fa-leaf me-2"></i>Lima
            </button>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="btn bg-orange text-white w-100">
                <i class="fas fa-fire me-2"></i>Naranja
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="btn bg-red-dark text-white w-100">
                <i class="fas fa-exclamation me-2"></i>Rojo Oscuro
            </div>
        </div>
    </div>
    <div class="code-preview mt-3">
        <strong>Código:</strong> &lt;button class="btn btn-magenta"&gt;Magenta&lt;/button&gt;
    </div>
</div>

<!-- BOTONES CON ESTADOS -->
<div id="section-states" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-toggle-on me-2"></i>
        Estados de Botones
    </h2>
    <div class="row g-3">
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-primary w-100">
                <i class="fas fa-mouse-pointer me-2"></i>Normal
            </button>
        </div>
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-primary w-100 active">
                <i class="fas fa-check me-2"></i>Activo
            </button>
        </div>
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-primary w-100" disabled>
                <i class="fas fa-ban me-2"></i>Deshabilitado
            </button>
        </div>
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-primary w-100" data-bs-toggle="button" aria-pressed="false">
                <i class="fas fa-power-off me-2"></i>Toggle
            </button>
        </div>
    </div>
    <div class="code-preview mt-3">
        <strong>Estados:</strong><br>
        • Normal: &lt;button class="btn btn-primary"&gt;<br>
        • Activo: &lt;button class="btn btn-primary active"&gt;<br>
        • Deshabilitado: &lt;button class="btn btn-primary" disabled&gt;
    </div>
</div>

<!-- COMBINACIONES ESPECIALES -->
<div id="section-combos" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-magic me-2"></i>
        Combinaciones Especiales
    </h2>
    
    <!-- Grupo de botones -->
    <div class="mb-4">
        <h5 class="text-secondary mb-3">Grupo de Botones</h5>
        <div class="btn-group" role="group" aria-label="Grupo de botones">
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-align-left"></i>
            </button>
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-align-center"></i>
            </button>
            <button type="button" class="btn btn-outline-primary">
                <i class="fas fa-align-right"></i>
            </button>
        </div>
    </div>
    
    <!-- Botones con dropdown -->
    <div class="mb-4">
        <h5 class="text-secondary mb-3">Botón con Menú</h5>
        <div class="btn-group">
            <button type="button" class="btn btn-success">
                <i class="fas fa-download me-2"></i>Descargar
            </button>
            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i>PDF</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-word me-2"></i>Word</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Excel</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Botones de acción -->
    <div class="mb-4">
        <h5 class="text-secondary mb-3">Acciones Comunes</h5>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Guardar
            </button>
            <button class="btn btn-success">
                <i class="fas fa-share me-2"></i>Compartir
            </button>
            <button class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Editar
            </button>
            <button class="btn btn-danger">
                <i class="fas fa-trash me-2"></i>Eliminar
            </button>
            <button class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Cancelar
            </button>
        </div>
    </div>
    
    <div class="code-preview mt-3">
        <strong>Grupo de botones:</strong><br>
        &lt;div class="btn-group" role="group"&gt;<br>
        &nbsp;&nbsp;&lt;button class="btn btn-outline-primary"&gt;Izq&lt;/button&gt;<br>
        &nbsp;&nbsp;&lt;button class="btn btn-outline-primary"&gt;Centro&lt;/button&gt;<br>
        &nbsp;&nbsp;&lt;button class="btn btn-outline-primary"&gt;Der&lt;/button&gt;<br>
        &lt;/div&gt;
    </div>
</div>

<!-- SECCIÓN DE PRUEBAS INTERACTIVAS -->
<div id="section-test" class="demo-section p-4">
    <h2 class="section-title">
        <i class="fas fa-flask me-2"></i>
        Pruebas Interactivas
    </h2>
    <div class="alert alert-info-subtle border border-info-subtle">
        <i class="fas fa-lightbulb me-2"></i>
        <strong>¡Prueba los efectos!</strong> Haz clic, hover y focus en los botones para ver las animaciones 3D
    </div>
    
    <div class="text-center">
        <div class="row g-3">
            <div class="col-md-6">
                <button class="btn btn-primary btn-lg w-100" onclick="showAlert('primary')">
                    <i class="fas fa-rocket me-2"></i>¡Haz clic aquí!
                </button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-success btn-lg w-100" onclick="showAlert('success')">
                    <i class="fas fa-thumbs-up me-2"></i>¡Y aquí también!
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showAlert(type) {
    const messages = {
        primary: '¡Botón Primary presionado! 🎉',
        success: '¡Botón Success presionado! 🚀'
    };
    
    alert(messages[type] || '¡Botón presionado!');
}
</script>