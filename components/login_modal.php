<?php

/**
 * Modal de Login — DOCTORA EDDI
 * Diseño elegante alineado con la estética médica de la landing.
 */
?>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content login-modal-content">

            <!-- Header -->
            <div class="login-modal-header text-center">
                <button type="button" class="btn-close btn-close-white login-modal-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                <img src="img/logos/logo_eddi_crema.png" alt="Doctora Eddi" class="login-logo mb-3">
                <h2 id="loginModalLabel" class="login-title">Bienvenido</h2>
                <p class="login-subtitle">Ingrese sus credenciales para continuar</p>
            </div>

            <!-- Body -->
            <div class="login-modal-body">
                <div id="login-alert" class="alert alert-danger d-none" role="alert"></div>

                <form id="loginForm" method="POST" autocomplete="on" novalidate>
                    <!-- Cédula -->
                    <div class="login-field">
                        <label for="login-username" class="login-label">
                            <i class="fas fa-id-card"></i> Cédula
                        </label>
                        <input type="number"
                            id="login-username"
                            name="username"
                            class="form-control login-input"
                            placeholder="Ingrese su número de cédula"
                            inputmode="numeric"
                            required
                            autocomplete="username">
                    </div>

                    <!-- Contraseña -->
                    <div class="login-field">
                        <label for="login-password" class="login-label">
                            <i class="fas fa-lock"></i> Contraseña
                        </label>
                        <div class="position-relative">
                            <input type="password"
                                id="login-password"
                                name="password"
                                class="form-control login-input"
                                placeholder="Ingrese su contraseña"
                                required
                                autocomplete="current-password">
                            <button type="button" class="login-eye-btn" onclick="togglePasswordVisibility()" aria-label="Mostrar contraseña">
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn login-submit-btn w-100" id="login-submit-btn">
                        <span class="login-btn-text">Iniciar Sesión</span>
                        <span class="login-btn-spinner d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Verificando...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="login-modal-footer text-center">
                <small class="text-muted">Acceso exclusivo para personal autorizado</small>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== MODAL LOGIN — ESTÉTICA MÉDICA ===== */
    .login-modal-content {
        background: #ffffff;
        border: none;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(45, 51, 46, .25);
    }

    .login-modal-header {
        background: linear-gradient(135deg, #434f44 0%, #3a4540 50%, #2d332e 100%);
        padding: 2.5rem 2rem 2rem;
        position: relative;
    }

    .login-modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        opacity: .6;
        filter: none;
    }

    .login-modal-close:hover {
        opacity: 1;
    }

    .login-logo {
        height: 52px;
        width: auto;
    }

    .login-title {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: 1.6rem;
        font-weight: 400;
        color: #ffffff;
        margin: 0 0 .35rem;
    }

    .login-subtitle {
        font-size: .85rem;
        color: rgba(200, 191, 177, .8);
        margin: 0;
        letter-spacing: .3px;
    }

    .login-modal-body {
        padding: 2rem;
    }

    .login-field {
        margin-bottom: 1.25rem;
    }

    .login-label {
        display: block;
        font-size: .8rem;
        font-weight: 600;
        color: #434f44;
        letter-spacing: .5px;
        text-transform: uppercase;
        margin-bottom: .4rem;
    }

    .login-label i {
        color: #8a9a8b;
        margin-right: .25rem;
        font-size: .75rem;
    }

    .login-input {
        background: #f5f3f0;
        border: 1px solid #e8e4df;
        border-radius: 2px;
        padding: .7rem 1rem;
        font-size: .95rem;
        color: #2d332e;
        transition: border-color .2s, box-shadow .2s;
    }

    .login-input:focus {
        background: #ffffff;
        border-color: #434f44;
        box-shadow: 0 0 0 3px rgba(67, 79, 68, .1);
    }

    .login-input::placeholder {
        color: #b0aba4;
    }

    /* Quitar flechas de input number */
    .login-input[type="number"]::-webkit-inner-spin-button,
    .login-input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .login-input[type="number"] {
        -moz-appearance: textfield;
    }

    .login-eye-btn {
        position: absolute;
        right: .75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #8a9a8b;
        cursor: pointer;
        padding: .25rem;
        font-size: .9rem;
        transition: color .2s;
    }

    .login-eye-btn:hover {
        color: #434f44;
    }

    .login-submit-btn {
        background: #434f44;
        color: #ffffff;
        border: none;
        border-radius: 2px;
        padding: .75rem;
        font-size: .9rem;
        font-weight: 600;
        letter-spacing: .5px;
        text-transform: uppercase;
        transition: background .2s, transform .1s;
        margin-top: .5rem;
    }

    .login-submit-btn:hover {
        background: #3a4540;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .login-submit-btn:active {
        transform: translateY(0);
    }

    .login-modal-footer {
        padding: 1rem 2rem 1.5rem;
        border-top: 1px solid #e8e4df;
    }

    @media (max-width: 576px) {
        .login-modal-body {
            padding: 1.5rem;
        }

        .login-modal-header {
            padding: 2rem 1.5rem 1.5rem;
        }
    }
</style>

<script>
    function togglePasswordVisibility() {
        var input = document.getElementById('login-password');
        var icon = document.getElementById('eye-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var btn = document.getElementById('login-submit-btn');
        var btnText = btn.querySelector('.login-btn-text');
        var btnSpinner = btn.querySelector('.login-btn-spinner');
        var alertBox = document.getElementById('login-alert');

        // Validar campos
        var username = document.getElementById('login-username').value.trim();
        var password = document.getElementById('login-password').value;

        if (!username || !password) {
            alertBox.textContent = 'Por favor complete todos los campos.';
            alertBox.classList.remove('d-none');
            return;
        }

        // Mostrar spinner
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');
        btn.disabled = true;
        alertBox.classList.add('d-none');

        // Enviar petición AJAX
        var formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);
        formData.append('action', 'login');

        fetch('controller/auth.php', {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alertBox.textContent = data.message;
                    alertBox.classList.remove('d-none');
                }
            })
            .catch(function() {
                alertBox.textContent = 'Error de conexión. Intente nuevamente.';
                alertBox.classList.remove('d-none');
            })
            .finally(function() {
                btnText.classList.remove('d-none');
                btnSpinner.classList.add('d-none');
                btn.disabled = false;
            });
    });
</script>