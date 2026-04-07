<section id="contacto" class="footer-contact">
    <div class="container-fluid px-3 px-md-5">

        <!-- Encabezado -->
        <div class="footer-header text-center mb-5">
            <span class="badge bg-light text-dark px-4 py-2 mb-3" style="font-size: 1rem; border-radius: 2px;">
                <i class="fas fa-calendar-check me-2"></i>Agenda tu Cita
            </span>
            <h2 class="fw-bold text-white font-display" style="font-size: 2.8rem;">¿Listo para cuidar tu <em>bienestar</em>?</h2>
            <p class="text-white-50" style="font-size: 1.2rem;">Agenda tu valoración y comienza un proceso diseñado exclusivamente para ti.</p>
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Columna izquierda: Info de contacto + redes -->
            <div class="col-lg-5">
                <div class="welcome-glass p-4 p-md-5 h-100 d-flex flex-column justify-content-between">

                    <div>
                        <h4 class="fw-bold mb-4 font-display" style="font-size: 1.6rem; color: #434f44;">
                            <i class="fas fa-stethoscope me-2" style="color: #8a9a8b;"></i>Información de contacto
                        </h4>

                        <!-- WhatsApp -->
                        <div class="contact-info-item d-flex align-items-start mb-4">
                            <div class="contact-icon-box me-3">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div>
                                <span class="d-block" style="font-size: 0.9rem; color: #6b726d;">WhatsApp</span>
                                <a href="https://wa.me/573013537082" class="text-decoration-none fw-semibold" target="_blank" style="font-size: 1.15rem; color: #434f44;">
                                    +57 3013537082
                                </a>
                            </div>
                        </div>

                        <!-- Correo -->
                        <div class="contact-info-item d-flex align-items-start mb-4">
                            <div class="contact-icon-box me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <span class="d-block" style="font-size: 0.9rem; color: #6b726d;">Correo electrónico</span>
                                <a href="mailto:doctora.eddi@gmail.com" class="text-decoration-none fw-semibold" style="font-size: 1.15rem; color: #434f44;">
                                    doctora.eddi@gmail.com
                                </a>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="contact-info-item d-flex align-items-start mb-4">
                            <div class="contact-icon-box me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span class="d-block" style="font-size: 0.9rem; color: #6b726d;">Dirección</span>
                                <span class="fw-semibold" style="font-size: 1.15rem; color: #434f44;">
                                    Carrera 43 A # 1 Sur - 50, El Poblado<br>
                                    <small style="font-size: 1rem;">Edificio: Cross Business, Consultorio 1102</small>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Redes sociales -->
                    <div class="mt-4">
                        <h6 class="mb-3" style="font-size: 0.95rem; color: #6b726d;">Síguenos en redes</h6>
                        <div class="d-flex gap-3">
                            <!-- <a href="#" class="social-icon-link" aria-label="Facebook">
                                <div class="social-icon-box border-secondary">
                                    <i class="fab fa-facebook-f text-secondary"></i>
                                </div>
                            </a> -->
                            <a href="https://www.instagram.com/doctora.eddi" class="social-icon-link" aria-label="Instagram" target="_blank">
                                <div class="social-icon-box border-secondary">
                                    <i class="fab fa-instagram text-secondary"></i>
                                </div>
                            </a>
                            <!-- <a href="#" class="social-icon-link" aria-label="LinkedIn">
                                <div class="social-icon-box border-secondary">
                                    <i class="fab fa-linkedin-in text-secondary"></i>
                                </div>
                            </a> -->
                        </div>
                    </div>

                </div>
            </div>

            <!-- Columna derecha: Formulario -->
            <div class="col-lg-7">
                <div class="welcome-glass p-4 p-md-5 h-100">
                    <h4 class="fw-bold mb-4 font-display" style="font-size: 1.6rem; color: #434f44;">
                        <i class="fas fa-paper-plane me-2" style="color: #8a9a8b;"></i>Solicita una consulta
                    </h4>

                    <form id="form-whatsapp" onsubmit="return false;">
                        <div class="row g-3">
                            <!-- Mensaje -->
                            <div class="col-12">
                                <label class="form-label" style="font-size: 0.95rem; color: #6b726d;">Tu mensaje</label>
                                <textarea id="whatsapp-message" class="form-control text-secondary border-primary footer-input" rows="5" placeholder="Cuéntanos cómo podemos ayudarte..." required></textarea>
                            </div>
                            <!-- Botón WhatsApp -->
                            <div class="col-12 mt-2">
                                <button type="button" id="btn-whatsapp" class="btn btn-success btn-lg w-100 fw-bold" style="font-size: 1.15rem; padding: 14px;" onclick="sendWhatsApp()">
                                    <i class="fab fa-whatsapp me-2"></i>Enviar por WhatsApp
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Barra inferior -->
        <div class="footer-bottom text-center mt-5 pt-4">
            <p class="text-white-50 mb-0" style="font-size: 0.95rem;">
                Doctora Eddi &copy; <?php echo date('Y'); ?> - Made by <a href="https://www.agenciaeaglesoftware.com/" target="_blank" rel="noopener noreferrer" class="eagle-software-link">Eagle Software</a> - Todos los derechos reservados
            </p>
        </div>

    </div>
</section>

<script>
    function sendWhatsApp() {
        const message = document.getElementById('whatsapp-message').value.trim();
        if (!message) {
            document.getElementById('whatsapp-message').focus();
            return;
        }
        const phone = '573013537082';
        const url = 'https://wa.me/' + phone + '?text=' + encodeURIComponent(message);
        window.open(url, '_blank');
    }
</script>