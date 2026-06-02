<!-- ===== MODAL ANUNCIO / POPUP — Nuevo o Editar ===== -->
<div class="modal fade" id="modalAnuncio" tabindex="-1" aria-labelledby="modalAnuncioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius:2px; border:1px solid #e8e4df;">

            <!-- Header -->
            <div class="modal-header" style="border-bottom:1px solid #e8e4df; padding:1rem 1.5rem;">
                <h5 class="modal-title" id="modalAnuncioLabel"
                    style="font-family:'Playfair Display',Georgia,serif; font-weight:400; color:#2d332e; font-size:1.3rem;">
                    Nuevo Anuncio
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"
                        style="filter: opacity(0.5);"></button>
            </div>

            <!-- Body -->
            <div class="modal-body" style="padding:1.5rem;">
                <form id="formAnuncio" enctype="multipart/form-data" novalidate>

                    <!-- Fila 1: Título -->
                    <div class="mb-3">
                        <label for="anuncioTitulo" class="anuncio-label">
                            Título interno <span class="anuncio-required">*</span>
                        </label>
                        <input type="text" id="anuncioTitulo" name="titulo"
                               class="anuncio-input" maxlength="200"
                               placeholder="Ej: Día de la Madre — Mayo 2026"
                               required>
                        <div class="anuncio-hint">Solo visible en el dashboard, no aparece en el popup.</div>
                    </div>

                    <!-- Fila 2: Imagen (tabs File / URL) -->
                    <div class="mb-3">
                        <label class="anuncio-label">
                            Imagen del popup <span class="anuncio-required">*</span>
                        </label>

                        <ul class="nav nav-tabs anuncio-tabs mb-2" id="imgTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabFile" type="button"
                                        role="tab" data-tab="file"
                                        onclick="switchImgTab('file', this)">
                                    <i class="fas fa-upload me-1"></i> Subir archivo
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabUrl" type="button"
                                        role="tab" data-tab="url"
                                        onclick="switchImgTab('url', this)">
                                    <i class="fas fa-link me-1"></i> URL externa
                                </button>
                            </li>
                        </ul>

                        <!-- Panel Archivo -->
                        <div id="panelFile">
                            <input type="file" id="anuncioImgFile" name="imagen_file"
                                   class="anuncio-input" accept="image/jpeg,image/png,image/webp,image/gif"
                                   onchange="previewImagen(this)">
                            <div class="anuncio-hint">JPG, PNG, WEBP o GIF. Máximo 5 MB. Recomendado: 680 × 680 px.</div>
                        </div>

                        <!-- Panel URL -->
                        <div id="panelUrl" style="display:none;">
                            <input type="url" id="anuncioImgUrl" name="imagen_url"
                                   class="anuncio-input"
                                   placeholder="https://ejemplo.com/imagen.jpg"
                                   oninput="previewUrl(this.value)">
                            <div class="anuncio-hint">Pega la URL completa de una imagen pública.</div>
                        </div>

                        <!-- Preview -->
                        <div id="previewContainer" style="display:none; margin-top:.75rem;">
                            <div class="anuncio-preview-box">
                                <img id="anuncioImgPreview" src="" alt="Vista previa"
                                     style="max-width:100%; max-height:220px; border-radius:2px; display:block; margin:0 auto;">
                            </div>
                        </div>
                    </div>

                    <!-- Fila 3: WhatsApp -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-5">
                            <label for="anuncioWaNumero" class="anuncio-label">
                                Número WhatsApp <span class="anuncio-required">*</span>
                            </label>
                            <input type="text" id="anuncioWaNumero" name="wa_numero"
                                   class="anuncio-input" maxlength="20"
                                   placeholder="573013388063"
                                   required>
                            <div class="anuncio-hint">Sin +, con código de país. Ej: 573013388063</div>
                        </div>
                        <div class="col-sm-7">
                            <label for="anuncioTextoBoton" class="anuncio-label">
                                Texto del botón <span class="anuncio-required">*</span>
                            </label>
                            <input type="text" id="anuncioTextoBoton" name="texto_boton"
                                   class="anuncio-input" maxlength="150"
                                   placeholder="Quiero este tratamiento para mamá"
                                   value="Quiero este tratamiento"
                                   required>
                        </div>
                    </div>

                    <!-- Fila 4: Mensaje WA -->
                    <div class="mb-3">
                        <label for="anuncioWaMensaje" class="anuncio-label">
                            Mensaje preescrito WhatsApp <span class="anuncio-required">*</span>
                        </label>
                        <textarea id="anuncioWaMensaje" name="wa_mensaje"
                                  class="anuncio-input" rows="3" maxlength="1000"
                                  placeholder="Hola Doctora Eddi, estoy interesada en…"
                                  required></textarea>
                        <div class="anuncio-hint">El paciente verá este mensaje prellenado al abrir WhatsApp.</div>
                    </div>

                    <!-- Fila 5: Fechas -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="anuncioFechaInicio" class="anuncio-label">
                                Fecha inicio <span class="anuncio-required">*</span>
                            </label>
                            <input type="date" id="anuncioFechaInicio" name="fecha_inicio"
                                   class="anuncio-input" required
                                   onchange="validarFechas()">
                        </div>
                        <div class="col-sm-6">
                            <label for="anuncioFechaFin" class="anuncio-label">
                                Fecha fin <span class="anuncio-required">*</span>
                            </label>
                            <input type="date" id="anuncioFechaFin" name="fecha_fin"
                                   class="anuncio-input" required
                                   onchange="validarFechas()">
                            <div class="anuncio-hint" id="fechaError"
                                 style="color:#9c5b5b;display:none;">
                                La fecha fin debe ser posterior a la fecha inicio.
                            </div>
                        </div>
                    </div>

                    <!-- Fila 6: Delay y Activo -->
                    <div class="row g-3 mb-1">
                        <div class="col-sm-6">
                            <label for="anuncioDelay" class="anuncio-label">
                                Retardo (ms)
                            </label>
                            <input type="number" id="anuncioDelay" name="delay_ms"
                                   class="anuncio-input" min="0" max="10000" step="100"
                                   value="1400">
                            <div class="anuncio-hint">Milisegundos antes de mostrar el popup. Por defecto: 1400 ms.</div>
                        </div>
                        <div class="col-sm-6 d-flex align-items-center" style="padding-top:1.5rem;">
                            <div class="anuncio-toggle-wrap">
                                <input type="checkbox" id="anuncioActivo" name="activo"
                                       class="anuncio-toggle-input" value="1" checked>
                                <label for="anuncioActivo" class="anuncio-toggle-label">
                                    <span class="anuncio-toggle-track"></span>
                                    <span class="anuncio-toggle-text">Anuncio activo</span>
                                </label>
                            </div>
                        </div>
                    </div>

                </form>
            </div><!-- /modal-body -->

            <!-- Footer -->
            <div class="modal-footer" style="border-top:1px solid #e8e4df; padding:1rem 1.5rem;">
                <button type="button" class="anuncio-btn-cancel" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="submit" form="formAnuncio" class="anuncio-btn-save" id="btnGuardarAnuncio">
                    <i class="fas fa-save me-1"></i> Guardar Anuncio
                </button>
            </div>

        </div><!-- /modal-content -->
    </div><!-- /modal-dialog -->
</div><!-- /modal -->

<!-- ===== ESTILOS DEL MODAL ===== -->
<style>
    /* Labels */
    .anuncio-label {
        display: block;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: #6b726d;
        margin-bottom: .35rem;
    }

    .anuncio-required { color: #9c5b5b; }

    .anuncio-hint {
        font-size: .75rem;
        color: #8a9a8b;
        margin-top: .25rem;
    }

    /* Inputs */
    .anuncio-input {
        display: block;
        width: 100%;
        padding: .55rem .75rem;
        font-size: .875rem;
        color: #2d332e;
        background: #ffffff;
        border: 1px solid #e8e4df;
        border-radius: 2px;
        transition: border-color .2s, box-shadow .2s;
        font-family: 'Inter', sans-serif;
    }

    .anuncio-input:focus {
        outline: none;
        border-color: #5a6b5c;
        box-shadow: 0 0 0 3px rgba(90,107,92,.12);
    }

    textarea.anuncio-input { resize: vertical; }

    /* Tabs de imagen */
    .anuncio-tabs {
        border-bottom: 1px solid #e8e4df;
        margin-bottom: 0;
    }

    .anuncio-tabs .nav-link {
        font-size: .8rem;
        font-weight: 600;
        letter-spacing: .3px;
        text-transform: uppercase;
        color: #8a9a8b;
        border: none;
        border-bottom: 2px solid transparent;
        border-radius: 0;
        padding: .5rem 1rem;
        background: transparent;
        transition: color .15s, border-color .15s;
    }

    .anuncio-tabs .nav-link:hover {
        color: #5a6b5c;
        border-bottom-color: #c4cec6;
    }

    .anuncio-tabs .nav-link.active {
        color: #5a6b5c;
        border-bottom: 2px solid #5a6b5c;
        background: transparent;
    }

    /* Preview box */
    .anuncio-preview-box {
        background: #f5f3f0;
        border: 1px solid #e8e4df;
        border-radius: 2px;
        padding: .75rem;
        text-align: center;
    }

    /* Toggle activo */
    .anuncio-toggle-wrap {
        display: flex;
        align-items: center;
        gap: .6rem;
    }

    .anuncio-toggle-input { display: none; }

    .anuncio-toggle-label {
        display: flex;
        align-items: center;
        gap: .6rem;
        cursor: pointer;
        user-select: none;
    }

    .anuncio-toggle-track {
        position: relative;
        width: 40px;
        height: 22px;
        background: #d0d6d1;
        border-radius: 11px;
        transition: background .2s;
        flex-shrink: 0;
    }

    .anuncio-toggle-track::after {
        content: '';
        position: absolute;
        top: 3px; left: 3px;
        width: 16px; height: 16px;
        background: #fff;
        border-radius: 50%;
        transition: transform .2s;
        box-shadow: 0 1px 3px rgba(0,0,0,.2);
    }

    .anuncio-toggle-input:checked + .anuncio-toggle-label .anuncio-toggle-track {
        background: #5a6b5c;
    }

    .anuncio-toggle-input:checked + .anuncio-toggle-label .anuncio-toggle-track::after {
        transform: translateX(18px);
    }

    .anuncio-toggle-text {
        font-size: .85rem;
        color: #434f44;
        font-weight: 500;
    }

    /* Botones del footer */
    .anuncio-btn-cancel {
        padding: .5rem 1.1rem;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: .3px;
        text-transform: uppercase;
        border: 1px solid #e8e4df;
        border-radius: 2px;
        background: transparent;
        color: #8a9a8b;
        cursor: pointer;
        transition: all .2s;
    }

    .anuncio-btn-cancel:hover {
        background: #f5f3f0;
        border-color: #c4cec6;
        color: #434f44;
    }

    .anuncio-btn-save {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .5rem 1.3rem;
        font-size: .85rem;
        font-weight: 600;
        letter-spacing: .3px;
        text-transform: uppercase;
        border: 1px solid #5a6b5c;
        border-radius: 2px;
        background: #5a6b5c;
        color: #ffffff;
        cursor: pointer;
        transition: all .2s;
    }

    .anuncio-btn-save:hover:not(:disabled) {
        background: #4a5a4c;
        border-color: #4a5a4c;
    }

    .anuncio-btn-save:disabled {
        opacity: .65;
        cursor: not-allowed;
    }
</style>

<!-- ===== JS DEL MODAL ===== -->
<script>
'use strict';

// ── Tabs de imagen ────────────────────────────────────────────────────────────
function switchImgTab(tab, btn) {
    document.querySelectorAll('#imgTabs .nav-link').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.getElementById('panelFile').style.display = tab === 'file' ? '' : 'none';
    document.getElementById('panelUrl').style.display  = tab === 'url'  ? '' : 'none';

    // Limpiar campos del tab que se ocultó
    if (tab === 'file') {
        document.getElementById('anuncioImgUrl').value = '';
    } else {
        document.getElementById('anuncioImgFile').value = '';
    }
}

// ── Preview al seleccionar archivo ────────────────────────────────────────────
function previewImagen(input) {
    const prev    = document.getElementById('anuncioImgPreview');
    const prevCont = document.getElementById('previewContainer');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            prev.src = e.target.result;
            prevCont.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        prevCont.style.display = 'none';
        prev.src = '';
    }
}

// ── Preview al escribir URL ───────────────────────────────────────────────────
function previewUrl(url) {
    const prev    = document.getElementById('anuncioImgPreview');
    const prevCont = document.getElementById('previewContainer');
    if (url && url.startsWith('http')) {
        prev.src = url;
        prevCont.style.display = 'block';
        prev.onerror = function() {
            prevCont.style.display = 'none';
            prev.src = '';
        };
    } else {
        prevCont.style.display = 'none';
        prev.src = '';
    }
}

// ── Validar fechas ────────────────────────────────────────────────────────────
function validarFechas() {
    const ini = document.getElementById('anuncioFechaInicio').value;
    const fin = document.getElementById('anuncioFechaFin').value;
    const err = document.getElementById('fechaError');
    if (ini && fin && fin < ini) {
        err.style.display = 'block';
        document.getElementById('anuncioFechaFin').style.borderColor = '#9c5b5b';
    } else {
        err.style.display = 'none';
        document.getElementById('anuncioFechaFin').style.borderColor = '';
    }
}

// ── Limpiar modal al cerrar ───────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    const modalEl = document.getElementById('modalAnuncio');
    if (modalEl) {
        modalEl.addEventListener('hidden.bs.modal', function() {
            // resetFormAnuncio está definida en anuncios.php
            if (typeof resetFormAnuncio === 'function') resetFormAnuncio();
        });
    }
});
</script>
