<!-- ===== FOOTER DASHBOARD ===== -->
<footer class="dash-footer">
    <div class="container">
        <p class="mb-0">
            Doctora Eddi &copy; <?php echo date('Y'); ?> - Made by 
            <a href="https://www.agenciaeaglesoftware.com/" target="_blank" rel="noopener noreferrer" class="dash-footer-link">
                Eagle Software
            </a> - Todos los derechos reservados
        </p>
    </div>
</footer>

<style>
@font-face {
    font-family: 'Sparose';
    src: url('../css/fonts/fonnts.com-Sparose.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

.dash-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fdfcfb;
    border-top: 1px solid #e8e4df;
    padding: 1rem 1.5rem;
    text-align: center;
    font-size: 0.85rem;
    color: #8a9a8b;
    z-index: 1000;
    box-shadow: 0 -1px 4px rgba(67, 79, 68, .04);
}

.dash-footer p {
    line-height: 1.4;
}

.dash-footer-link {
    color: #5a6b5c;
    text-decoration: none;
    font-weight: 500;
    font-family: 'Sparose', sans-serif;
    transition: color .2s;
}

.dash-footer-link:hover {
    color: #434f44;
    text-decoration: underline;
}

/* Agregar padding al body para compensar el footer fijo */
body.dash-body {
    padding-bottom: 60px;
}
</style>
