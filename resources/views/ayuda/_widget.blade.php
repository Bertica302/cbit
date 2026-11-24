{{-- Botón de ayuda fijo abajo a la derecha --}}
<div class="position-fixed bottom-0 end-0 m-3" style="z-index: 1040;">

    {{-- Panel que se abre hacia arriba --}}
    <div id="ayuda-panel" class="card shadow border-0 mb-2 d-none" style="width: 260px;">
        <div class="card-body p-3">
            <p class="fw-semibold text-secondary mb-2" style="font-size: .8rem;">
                ¿Necesitas ayuda?
            </p>

            <a href="{{ route('ayuda.incidencia') }}"
               class="btn btn-light w-100 text-start d-flex align-items-center gap-2 mb-2 text-primary fw-semibold">
                <i class="bi bi-exclamation-triangle"></i> Reporte de incidencias
            </a>

            {{-- Manual de usuario: dos opciones --}}
            <button type="button"
                    class="btn btn-light w-100 text-start d-flex align-items-center gap-2 mb-2 text-primary fw-semibold"
                    onclick="document.getElementById('ayuda-manual-opciones').classList.toggle('d-none')">
                <i class="bi bi-file-earmark-text"></i> Manual de usuario
                <i class="bi bi-chevron-down ms-auto" style="font-size:.75rem;"></i>
            </button>

            <div id="ayuda-manual-opciones" class="d-none ps-3 mb-2">
                <a href="{{ route('ayuda.manual.leer') }}"
                   target="_blank"
                   class="btn btn-sm btn-outline-primary w-100 text-start d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-book"></i> Leer manual
                </a>
                <a href="{{ route('ayuda.manual') }}"
                   class="btn btn-sm btn-outline-primary w-100 text-start d-flex align-items-center gap-2">
                    <i class="bi bi-download"></i> Descargar manual
                </a>
            </div>
        </div>
    </div>

    {{-- Botón flotante --}}
    <button type="button"
            id="ayuda-boton"
            class="btn btn-light border border-primary rounded-pill shadow-sm d-flex align-items-center gap-2 px-3 fw-semibold text-primary"
            aria-label="Abrir ayuda"
            aria-expanded="false">
        <i class="bi bi-question-circle-fill"></i> Ayuda
    </button>
</div>

<style>
    #ayuda-boton:hover {
        background-color: #e7f1ff;
    }
</style>

<script>
    (function () {
        const boton = document.getElementById('ayuda-boton');
        const panel = document.getElementById('ayuda-panel');
        if (!boton || !panel) return;

        boton.addEventListener('click', function (e) {
            e.stopPropagation();
            panel.classList.toggle('d-none');
            boton.setAttribute('aria-expanded', panel.classList.contains('d-none') ? 'false' : 'true');
        });

        document.addEventListener('click', function (e) {
            if (!panel.contains(e.target) && !boton.contains(e.target)) {
                panel.classList.add('d-none');
                boton.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                panel.classList.add('d-none');
                boton.setAttribute('aria-expanded', 'false');
            }
        });
    })();
</script>