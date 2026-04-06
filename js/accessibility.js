/**
 * Widget de Accesibilidad — WCAG 2.1 AA/AAA
 * Gestión de estado, persistencia (localStorage) y funcionalidades.
 */
(function () {
    'use strict';

    const ROOT = document.documentElement;
    const STORAGE_KEY = 'a11y_settings';

    // Estado por defecto
    const defaults = {
        fontSize: 0,        // -3 a +5
        spacing: 0,         // 0,1,2,3
        saturation: 0,      // -2,-1,0,1
        dyslexiaFont: false,
        highContrast: false,
        darkMode: false,
        invertColors: false,
        highlightLinks: false,
        highlightHeadings: false,
        bigCursor: false,
        stopAnimations: false,
        readingGuide: false,
        focusOutline: false
    };

    let state = loadState();

    // ── Persistencia ──
    function loadState() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            if (raw) {
                const saved = JSON.parse(raw);
                return Object.assign({}, defaults, saved);
            }
        } catch (e) { /* ignorar */ }
        return Object.assign({}, defaults);
    }

    function saveState() {
        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        } catch (e) { /* ignorar */ }
    }

    // ── Aplicar al DOM ──
    function applyAll() {
        // Tamaño de fuente (se aplica al root html para escalar rem)
        const pct = 100 + (state.fontSize * 12.5);
        ROOT.style.fontSize = pct + '%';
        updateLabel('a11y-font-level', pct + '%');

        // Espaciado
        ROOT.classList.remove('a11y-spacing-1', 'a11y-spacing-2', 'a11y-spacing-3');
        if (state.spacing > 0) {
            ROOT.classList.add('a11y-spacing-' + state.spacing);
        }
        const spacingLabels = ['Normal', 'Amplio', 'Muy amplio', 'Máximo'];
        updateLabel('a11y-spacing-level', spacingLabels[state.spacing] || 'Normal');

        // Saturación
        ROOT.classList.remove('a11y-saturation-low', 'a11y-saturation-none', 'a11y-saturation-high');
        if (state.saturation === -2) ROOT.classList.add('a11y-saturation-none');
        else if (state.saturation === -1) ROOT.classList.add('a11y-saturation-low');
        else if (state.saturation === 1) ROOT.classList.add('a11y-saturation-high');
        const satLabels = { '-2': 'Sin color', '-1': 'Baja', '0': 'Normal', '1': 'Alta' };
        updateLabel('a11y-saturation-level', satLabels[state.saturation] || 'Normal');

        // Toggles de clase
        toggleClass('a11y-dyslexia-font', state.dyslexiaFont);
        toggleClass('a11y-high-contrast', state.highContrast);
        toggleClass('a11y-dark-mode', state.darkMode);
        toggleClass('a11y-invert-colors', state.invertColors);
        toggleClass('a11y-highlight-links', state.highlightLinks);
        toggleClass('a11y-highlight-headings', state.highlightHeadings);
        toggleClass('a11y-big-cursor', state.bigCursor);
        toggleClass('a11y-stop-animations', state.stopAnimations);
        toggleClass('a11y-focus-outline', state.focusOutline);

        // Guía de lectura
        const guide = document.getElementById('a11y-reading-guide');
        if (guide) {
            if (state.readingGuide) {
                guide.classList.add('active');
                guide.setAttribute('aria-hidden', 'false');
            } else {
                guide.classList.remove('active');
                guide.setAttribute('aria-hidden', 'true');
            }
        }

        // Actualizar aria-pressed de los botones toggle
        updatePressed('dyslexia-font', state.dyslexiaFont);
        updatePressed('high-contrast', state.highContrast);
        updatePressed('dark-mode', state.darkMode);
        updatePressed('invert-colors', state.invertColors);
        updatePressed('highlight-links', state.highlightLinks);
        updatePressed('highlight-headings', state.highlightHeadings);
        updatePressed('big-cursor', state.bigCursor);
        updatePressed('stop-animations', state.stopAnimations);
        updatePressed('reading-guide', state.readingGuide);
        updatePressed('focus-outline', state.focusOutline);

        saveState();
    }

    function toggleClass(cls, active) {
        ROOT.classList.toggle(cls, active);
    }

    function updateLabel(id, text) {
        const el = document.getElementById(id);
        if (el) el.textContent = text;
    }

    function updatePressed(action, val) {
        const btn = document.querySelector('[data-action="' + action + '"]');
        if (btn) btn.setAttribute('aria-pressed', val ? 'true' : 'false');
    }

    // ── Acciones ──
    const actions = {
        'font-increase': function () {
            if (state.fontSize < 5) state.fontSize++;
        },
        'font-decrease': function () {
            if (state.fontSize > -3) state.fontSize--;
        },
        'spacing-increase': function () {
            if (state.spacing < 3) state.spacing++;
        },
        'spacing-decrease': function () {
            if (state.spacing > 0) state.spacing--;
        },
        'saturation-increase': function () {
            if (state.saturation < 1) state.saturation++;
        },
        'saturation-decrease': function () {
            if (state.saturation > -2) state.saturation--;
        },
        'dyslexia-font': function () { state.dyslexiaFont = !state.dyslexiaFont; },
        'high-contrast': function () {
            state.highContrast = !state.highContrast;
            if (state.highContrast) { state.darkMode = false; state.invertColors = false; }
        },
        'dark-mode': function () {
            state.darkMode = !state.darkMode;
            if (state.darkMode) { state.highContrast = false; state.invertColors = false; }
        },
        'invert-colors': function () {
            state.invertColors = !state.invertColors;
            if (state.invertColors) { state.highContrast = false; state.darkMode = false; }
        },
        'highlight-links': function () { state.highlightLinks = !state.highlightLinks; },
        'highlight-headings': function () { state.highlightHeadings = !state.highlightHeadings; },
        'big-cursor': function () { state.bigCursor = !state.bigCursor; },
        'stop-animations': function () { state.stopAnimations = !state.stopAnimations; },
        'reading-guide': function () { state.readingGuide = !state.readingGuide; },
        'focus-outline': function () { state.focusOutline = !state.focusOutline; }
    };

    // ── Inicialización ──
    function init() {
        const fab = document.getElementById('a11y-toggle');
        const panel = document.getElementById('a11y-panel');
        const closeBtn = document.getElementById('a11y-close');
        const resetBtn = document.getElementById('a11y-reset');
        const guide = document.getElementById('a11y-reading-guide');

        if (!fab || !panel) return;

        // Abrir / cerrar panel
        fab.addEventListener('click', function () {
            const isOpen = panel.classList.contains('a11y-open');
            if (isOpen) {
                closePanel();
            } else {
                openPanel();
            }
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closePanel);
        }

        // Cerrar con Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && panel.classList.contains('a11y-open')) {
                closePanel();
                fab.focus();
            }
        });

        // Cerrar si se hace clic fuera
        document.addEventListener('click', function (e) {
            if (panel.classList.contains('a11y-open') && !panel.contains(e.target) && e.target !== fab && !fab.contains(e.target)) {
                closePanel();
            }
        });

        function openPanel() {
            panel.classList.add('a11y-open');
            panel.setAttribute('aria-hidden', 'false');
            fab.setAttribute('aria-expanded', 'true');
            // Focus trap: enfocar primer botón
            var firstBtn = panel.querySelector('button');
            if (firstBtn) firstBtn.focus();
        }

        function closePanel() {
            panel.classList.remove('a11y-open');
            panel.setAttribute('aria-hidden', 'true');
            fab.setAttribute('aria-expanded', 'false');
        }

        // Reset
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                state = Object.assign({}, defaults);
                ROOT.style.fontSize = '';
                applyAll();
            });
        }

        // Delegación de eventos para acciones
        panel.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-action]');
            if (!btn) return;
            var action = btn.getAttribute('data-action');
            if (actions[action]) {
                actions[action]();
                applyAll();
            }
        });

        // Guía de lectura: sigue el mouse
        if (guide) {
            document.addEventListener('mousemove', function (e) {
                if (state.readingGuide) {
                    guide.style.top = (e.clientY - 6) + 'px';
                }
            });
        }

        // Aplicar estado guardado
        applyAll();
    }

    // Iniciar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
