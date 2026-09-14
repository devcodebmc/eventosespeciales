<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="cz-display font-semibold text-2xl text-[var(--cz-ink)] leading-tight">
                    {{ __('Cotizaciones') }}
                </h2>
                <p class="text-sm text-[var(--cz-ink-soft)] mt-0.5">Genera documentos profesionales con IA</p>
            </div>
            <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-full bg-[var(--cz-brass-soft)] text-[var(--cz-brass-deep)] text-xs font-medium border border-[var(--cz-brass)]/20">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--cz-brass)] mr-2 cz-pulse"></span>
                IA activa
            </span>
        </div>
    </x-slot>

    {{-- Idealmente estos <link> van en el <head> del layout principal (x-app-layout) para
         que el navegador los precargue antes de pintar la página; los dejo aquí para que
         el cambio quede autocontenido en esta vista. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --cz-font-display: 'Space Grotesk', ui-sans-serif, system-ui, sans-serif;
            --cz-paper: #F8F7FC;
            --cz-surface: #FFFFFF;
            --cz-ink: #17132B;
            --cz-ink-soft: #6E6784;
            --cz-border: #E9E5F5;
            --cz-brass: #7C3AED;
            --cz-brass-deep: #5B21B6;
            --cz-brass-soft: #F1E6FE;
            --cz-moss: #16A34A;
            --cz-moss-soft: #DCFCE7;
            --cz-rust: #F43F5E;
            --cz-rust-soft: #FFE4E9;
            --cz-steel: #2563EB;
            --cz-steel-soft: #DBEAFE;
        }

        .cz-page {
            background-color: var(--cz-paper);
            background-image:
                radial-gradient(650px 420px at 100% 0%, rgba(147, 51, 234, 0.07), transparent 60%),
                radial-gradient(550px 380px at 0% 100%, rgba(37, 99, 235, 0.06), transparent 60%);
            background-attachment: fixed;
        }

        .cz-display { font-family: var(--cz-font-display); letter-spacing: -0.01em; }

        /* --- Gradiente morado → azul, para acentos "neón" --- */
        .cz-grad-primary {
            background-image: linear-gradient(135deg, #9333EA 0%, #6D28D9 45%, #2563EB 100%);
        }
        .cz-grad-text {
            background-image: linear-gradient(135deg, #A855F7 0%, #6366F1 55%, #2563EB 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .cz-glow {
            transition: box-shadow 0.3s ease, filter 0.3s ease, transform 0.2s ease;
        }
        .cz-glow:hover, .cz-glow:focus-visible {
            filter: brightness(1.06);
            box-shadow: 0 8px 24px -6px rgba(147, 51, 234, 0.45), 0 0 28px -10px rgba(37, 99, 235, 0.4);
        }

        /* --- Talón de boleto: línea punteada con muescas en sus propios extremos --- */
        .cz-perforation {
            position: relative;
            height: 1px;
            background-image: linear-gradient(to right, var(--cz-border) 55%, transparent 0%);
            background-size: 10px 1px;
            background-repeat: repeat-x;
        }
        .cz-perforation::before,
        .cz-perforation::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 14px;
            height: 14px;
            border-radius: 9999px;
            background: var(--cz-paper);
            border: 1px solid var(--cz-border);
            transform: translateY(-50%);
        }
        .cz-perforation::before { left: -10px; }
        .cz-perforation::after { right: -10px; }

        /* --- Secuencia única de entrada al cargar la página --- */
        @keyframes czRiseIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .cz-rise-1 { animation: czRiseIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) both; }
        .cz-rise-2 { animation: czRiseIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.08s both; }

        /* --- Sello de "procesando" --- */
        @keyframes czSealPulse {
            0% { transform: scale(0.92); opacity: 0.5; }
            70% { transform: scale(1.35); opacity: 0; }
            100% { transform: scale(1.35); opacity: 0; }
        }
        @keyframes czSealDrop {
            0% { transform: scale(0.85) rotate(-8deg); opacity: 0; }
            60% { transform: scale(1.05) rotate(2deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }
        .cz-seal-ring { animation: czSealPulse 1.8s ease-out infinite; }
        .cz-seal-icon { animation: czSealDrop 0.5s cubic-bezier(0.22, 1, 0.36, 1) both; }

        /* --- Tarjetas nuevas al usar "Cargar más" --- */
        @keyframes czCardIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .cz-card-enter { animation: czCardIn 0.4s ease-out both; }

        @media (prefers-reduced-motion: reduce) {
            .cz-rise-1, .cz-rise-2, .cz-seal-ring, .cz-seal-icon, .cz-card-enter, .cz-pulse {
                animation: none !important;
            }
        }

        .cz-pulse {
            animation: czNeonPulse 1.8s ease-in-out infinite;
        }
        @keyframes czNeonPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(147, 51, 234, 0.55), 0 0 6px 1px rgba(37, 99, 235, 0.35); }
            50% { box-shadow: 0 0 0 5px rgba(147, 51, 234, 0), 0 0 12px 4px rgba(37, 99, 235, 0.55); }
        }
    </style>

    <div class="py-8 cz-page min-h-screen">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-14">

            {{-- ===== FORMULARIO ===== --}}
            <div class="cz-rise-1 bg-[var(--cz-surface)] rounded-2xl border border-[var(--cz-border)] overflow-hidden mb-10">
                <div class="px-6 py-5 border-b border-[var(--cz-border)] flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg cz-grad-primary flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-[var(--cz-ink)]">Nueva cotización</h3>
                        <p class="text-xs text-[var(--cz-ink-soft)] mt-0.5">Pega el texto, la IA extrae y genera todo</p>
                    </div>
                </div>

                <form id="quotationForm" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                        <div class="lg:col-span-4">
                            <label for="client_name" class="block text-xs font-semibold text-[var(--cz-ink-soft)] mb-2">
                                Cliente <span class="font-normal text-[var(--cz-ink-soft)]/70">— opcional</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-[var(--cz-brass)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="client_name" type="text" name="client_name"
                                       class="block w-full pl-10 pr-3 py-2.5 border border-[var(--cz-border)] rounded-xl text-sm focus:ring-2 focus:ring-[var(--cz-brass)]/25 focus:border-[var(--cz-brass)] transition bg-white placeholder:text-[var(--cz-ink-soft)]/60 text-[var(--cz-ink)]"
                                       placeholder="A quien corresponda">
                            </div>
                        </div>

                        <div class="lg:col-span-8">
                            <div class="flex items-center justify-between mb-2">
                                <label for="raw_input" class="block text-xs font-semibold text-[var(--cz-ink-soft)]">
                                    Texto <span class="font-normal text-[var(--cz-ink-soft)]/70">— requerido</span>
                                </label>
                                <span class="text-[11px] text-[var(--cz-ink-soft)] tabular-nums"><span id="charCount">0</span> caracteres</span>
                            </div>
                            <textarea id="raw_input" name="raw_input" rows="5" required
                                      class="block w-full border border-[var(--cz-border)] rounded-xl px-4 py-3 text-sm resize-none focus:ring-2 focus:ring-[var(--cz-brass)]/25 focus:border-[var(--cz-brass)] transition bg-white placeholder:text-[var(--cz-ink-soft)]/50 text-[var(--cz-ink)] leading-relaxed"
                                      placeholder="• Pista de baile en vinil impreso de 6 x 7 mts. $10,080&#10;• Tarima para DJ booth de 7 x 3 mts $6700&#10;• Espejo en texto con vinil $1800"></textarea>
                        </div>
                    </div>

                    <div class="cz-perforation my-6"></div>

                    <div class="flex justify-end">
                        <button type="submit" id="submitBtn"
                                class="group inline-flex items-center px-6 py-2.5 cz-grad-primary cz-glow text-white rounded-xl text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--cz-brass)] transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed">
                            <svg id="btnIcon" class="w-4 h-4 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span id="btnText">Procesar con IA</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ===== HISTORIAL ===== --}}
            <div class="cz-rise-2 mb-5 flex items-end justify-between">
                <div>
                    <h3 class="text-base font-semibold text-[var(--cz-ink)]">Historial</h3>
                    <p class="text-xs text-[var(--cz-ink-soft)] mt-0.5">Cotizaciones generadas recientemente</p>
                </div>
                <span class="text-[11px] text-[var(--cz-brass-deep)] bg-[var(--cz-brass-soft)] border border-[var(--cz-brass)]/20 px-3 py-1.5 rounded-lg tabular-nums font-medium" id="historyCountBadge">
                    {{ $quotations->count() }} {{ $quotations->count() === 1 ? 'registro' : 'registros' }}
                </span>
            </div>

            <div id="historyContainer" class="cz-rise-2">
                @include('quotations._history', ['quotations' => $quotations, 'hasMore' => $hasMore, 'nextOffset' => $nextOffset])
            </div>

        </div>
    </div>

    {{-- Overlay de procesamiento --}}
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-[var(--cz-ink)]/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 text-center">
            <div class="relative w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                <span class="absolute inset-0 rounded-full border-2 border-[var(--cz-brass)] cz-seal-ring"></span>
                <div class="relative w-14 h-14 rounded-full cz-grad-primary flex items-center justify-center cz-seal-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-[var(--cz-ink)] mb-1" id="loadingTitle">Procesando con IA</h3>
            <p class="text-xs text-[var(--cz-ink-soft)] mb-4" id="loadingText">Analizando el texto y extrayendo los datos...</p>
            <div class="flex items-center justify-center space-x-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--cz-brass)] animate-bounce" style="animation-delay: 0s"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--cz-brass)]/60 animate-bounce" style="animation-delay: 0.15s"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--cz-brass)] animate-bounce" style="animation-delay: 0.3s"></span>
            </div>
        </div>
    </div>

    {{-- ===== MODAL POST-GENERACIÓN ===== --}}
    <div id="successModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-[var(--cz-ink)]/50 backdrop-blur-sm p-4">
        <div id="successModalPanel"
             class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out">

            <div class="px-7 py-8 text-center">

                <div class="relative w-20 h-20 mx-auto mb-5 flex items-center justify-center">
                    <span class="absolute inset-0 rounded-full bg-[var(--cz-moss-soft)] cz-seal-ring"></span>
                    <div class="relative w-16 h-16 rounded-full bg-[var(--cz-moss)] flex items-center justify-center cz-seal-icon">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <h3 class="text-lg cz-display font-semibold text-[var(--cz-ink)] mb-1.5">
                    ¡Listo!
                </h3>
                <p class="text-sm text-[var(--cz-ink-soft)] leading-relaxed">
                    Tu cotización <span id="successFolio" class="font-semibold text-[var(--cz-brass-deep)] tabular-nums">—</span> se generó correctamente.
                </p>
                <p class="text-xs text-[var(--cz-ink-soft)]/80 mt-1">
                    <span id="successClient">—</span>
                </p>

                <div class="flex items-center justify-center gap-3 mt-7">
                    <button type="button" id="successClose"
                            class="px-5 py-2.5 text-sm font-medium text-[var(--cz-ink-soft)] hover:text-[var(--cz-ink)] transition">
                        Cerrar
                    </button>
                    <button type="button" id="downloadPdfBtn"
                            class="inline-flex items-center px-5 py-2.5 cz-grad-primary cz-glow text-white rounded-xl text-sm font-semibold transition-all">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Descargar PDF
                    </button>
                </div>
            </div>

        </div>
    </div>

    {{-- Modal confirmar eliminación --}}
    <div id="deleteModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-[var(--cz-ink)]/50 backdrop-blur-sm p-4">
        <div id="deleteModalPanel"
            class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out">
            <div class="px-7 py-8 text-center">
                <div class="w-16 h-16 rounded-full bg-[var(--cz-rust-soft)] flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7 text-[var(--cz-rust)]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-lg cz-display font-semibold text-[var(--cz-ink)] mb-1.5">¿Eliminar cotización?</h3>
                <p class="text-sm text-[var(--cz-ink-soft)]">
                    Se eliminará <span id="deleteFolio" class="font-semibold text-[var(--cz-rust)]"></span> y sus archivos (PDF, Word, Excel). Esta acción no se puede deshacer.
                </p>
                <div class="flex items-center justify-center gap-3 mt-7">
                    <button type="button" id="deleteCancelBtn"
                            class="px-5 py-2.5 text-sm font-medium text-[var(--cz-ink-soft)] hover:text-[var(--cz-ink)] transition">
                        Cancelar
                    </button>
                    <button type="button" id="deleteConfirmBtn"
                            class="inline-flex items-center px-5 py-2.5 bg-[var(--cz-rust)] cz-glow text-white rounded-xl text-sm font-semibold transition-all hover:opacity-90 disabled:opacity-60 disabled:cursor-not-allowed">
                        <svg class="w-4 h-4 mr-1.5 icon-default" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <svg class="w-4 h-4 mr-1.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast container --}}
    <div id="toastContainer" class="fixed top-4 right-4 z-[70] space-y-2"></div>

    @push('js')
        <script>
        // =============================
        // CONFIGURACIÓN GENERAL
        // =============================
        const csrfToken = '{{ csrf_token() }}';
        const storeUrl = '{{ route('quotations.store') }}';
        const loadMoreUrl = '{{ route('quotations.loadMore') }}';
        const downloadBase = '{{ url('admin/quotations') }}';  // ← CON /admin

        // =============================
        // CONTADOR DE CARACTERES
        // =============================
        const textarea = document.getElementById('raw_input');
        const charCount = document.getElementById('charCount');
        if (textarea) {
            textarea.addEventListener('input', () => charCount.textContent = textarea.value.length);
        }

        // =============================
        // TOASTS
        // =============================
        function showToast(message, type = 'success') {
            const configs = {
                success: { border: 'border-[var(--cz-moss)]/30', dot: 'bg-[var(--cz-moss)]' },
                error:   { border: 'border-[var(--cz-rust)]/30',  dot: 'bg-[var(--cz-rust)]' },
                info:    { border: 'border-[var(--cz-brass)]/30', dot: 'bg-[var(--cz-brass)]' },
            };
            const cfg = configs[type] || configs.info;
            const toast = document.createElement('div');
            toast.className = `flex items-center space-x-3 bg-white border ${cfg.border} p-3.5 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full opacity-0 min-w-[280px]`;
            toast.innerHTML = `<span class="w-2 h-2 rounded-full ${cfg.dot} flex-shrink-0"></span><p class="text-sm flex-1 text-[var(--cz-ink)]">${message}</p>`;
            document.getElementById('toastContainer').appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full', 'opacity-0'));
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        // =============================
        // MODAL POST-GENERACIÓN
        // =============================
        const successModal = document.getElementById('successModal');
        const successModalPanel = document.getElementById('successModalPanel');
        const successClose = document.getElementById('successClose');
        const successFolio = document.getElementById('successFolio');
        const successClient = document.getElementById('successClient');
        const downloadPdfBtn = document.getElementById('downloadPdfBtn');

        let currentDownloadUrl = null;

        function openSuccessModal() {
            successModal.classList.remove('hidden');
            successModal.classList.add('flex');
            requestAnimationFrame(() => {
                successModalPanel.classList.remove('scale-95', 'opacity-0');
                successModalPanel.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeSuccessModal() {
            successModalPanel.classList.remove('scale-100', 'opacity-100');
            successModalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                successModal.classList.add('hidden');
                successModal.classList.remove('flex');
            }, 250);
        }

        successClose.addEventListener('click', closeSuccessModal);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !successModal.classList.contains('hidden')) closeSuccessModal();
        });
        successModal.addEventListener('click', (e) => {
            if (e.target === successModal) closeSuccessModal();
        });

        // Descarga desde el modal
        downloadPdfBtn.addEventListener('click', async () => {
            if (!currentDownloadUrl) return;
            const originalHTML = downloadPdfBtn.innerHTML;
            downloadPdfBtn.disabled = true;
            downloadPdfBtn.innerHTML = '<svg class="w-4 h-4 mr-1.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Generando...';

            try {
                const response = await fetch(currentDownloadUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/pdf, */*',
                    },
                });

                if (!response.ok) {
                    const err = await response.json().catch(() => ({ message: 'Error al descargar' }));
                    throw new Error(err.message);
                }

                const disposition = response.headers.get('Content-Disposition') || '';
                const match = disposition.match(/filename="?([^"]+)"?/);
                const filename = match ? match[1] : 'cotizacion.pdf';

                const blob = await response.blob();
                const blobUrl = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = blobUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                setTimeout(() => URL.revokeObjectURL(blobUrl), 1000);
                showToast('PDF descargado correctamente', 'success');
            } catch (err) {
                showToast(err.message, 'error');
            } finally {
                downloadPdfBtn.disabled = false;
                downloadPdfBtn.innerHTML = originalHTML;
            }
        });

        // =============================
        // FORM: CREAR COTIZACIÓN
        // =============================
        const form = document.getElementById('quotationForm');
        const overlay = document.getElementById('loadingOverlay');
        const loadingTitle = document.getElementById('loadingTitle');
        const loadingText = document.getElementById('loadingText');
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');

        const steps = [
            { title: 'Procesando con IA', text: 'Analizando el texto y extrayendo los datos...' },
            { title: 'Generando PDF', text: 'Creando el documento maestro con tu diseño...' },
            { title: 'Convirtiendo formatos', text: 'Generando Word y Excel...' },
            { title: 'Casi listo', text: 'Guardando los archivos...' },
        ];

        function setLoadingStep(index) {
            if (steps[index]) {
                loadingTitle.textContent = steps[index].title;
                loadingText.textContent = steps[index].text;
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const data = {
                client_name: formData.get('client_name'),
                raw_input: formData.get('raw_input'),
            };

            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            setLoadingStep(0);
            btn.disabled = true;
            btnText.textContent = 'Procesando...';
            btnIcon.classList.add('animate-spin');

            let stepIndex = 0;
            const stepInterval = setInterval(() => {
                stepIndex = (stepIndex + 1) % steps.length;
                setLoadingStep(stepIndex);
            }, 1800);

            try {
                const response = await fetch(storeUrl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Error al procesar la cotización');

                clearInterval(stepInterval);
                setLoadingStep(3);
                await new Promise(r => setTimeout(r, 500));

                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                document.getElementById('historyContainer').innerHTML = result.history;
                bindLoadMoreButton();

                form.reset();
                charCount.textContent = '0';

                const folio = result.quotation.folio;
                const clientName = result.quotation.client_name;
                const quotationId = result.quotation.id;

                successFolio.textContent = folio;
                successClient.textContent = clientName;

                currentDownloadUrl = `${downloadBase}/${quotationId}/download/pdf`;

                openSuccessModal();
                showToast(`Cotización ${folio} generada`, 'success');
            } catch (error) {
                clearInterval(stepInterval);
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                showToast(error.message, 'error');
            } finally {
                btn.disabled = false;
                btnText.textContent = 'Procesar con IA';
                btnIcon.classList.remove('animate-spin');
            }
        });

        // =============================
        // CARGAR MÁS (sin paginación tradicional)
        // =============================
        function bindLoadMoreButton() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (!loadMoreBtn) return;

            loadMoreBtn.addEventListener('click', async () => {
                const offset = parseInt(loadMoreBtn.dataset.offset, 10) || 0;
                const icon = document.getElementById('loadMoreIcon');
                const spinner = document.getElementById('loadMoreSpinner');
                const text = document.getElementById('loadMoreText');

                loadMoreBtn.disabled = true;
                icon.classList.add('hidden');
                spinner.classList.remove('hidden');
                text.textContent = 'Cargando...';

                try {
                    const url = `${loadMoreUrl}?offset=${offset}`;
                    const response = await fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: { 'Accept': 'application/json' },
                    });

                    if (!response.ok) throw new Error('No se pudo cargar más cotizaciones');
                    const result = await response.json();

                    const grid = document.getElementById('historyGrid');
                    const temp = document.createElement('div');
                    temp.innerHTML = result.html;

                    Array.from(temp.children).forEach((card, i) => {
                        card.classList.add('cz-card-enter');
                        card.style.animationDelay = `${i * 40}ms`;
                        grid.appendChild(card);
                    });

                    // Actualiza el contador visible del historial
                    const countBadge = document.getElementById('historyCountBadge');
                    if (countBadge) {
                        const current = grid.children.length;
                        countBadge.textContent = `${current} ${current === 1 ? 'registro' : 'registros'}`;
                    }

                    if (result.hasMore) {
                        loadMoreBtn.dataset.offset = result.nextOffset;
                        loadMoreBtn.disabled = false;
                        icon.classList.remove('hidden');
                        spinner.classList.add('hidden');
                        text.textContent = 'Cargar más';
                    } else {
                        document.getElementById('loadMoreWrap').classList.add('hidden');
                        document.getElementById('historyEndMsg').classList.remove('hidden');
                    }
                } catch (error) {
                    showToast(error.message, 'error');
                    loadMoreBtn.disabled = false;
                    icon.classList.remove('hidden');
                    spinner.classList.add('hidden');
                    text.textContent = 'Cargar más';
                }
            });
        }
        bindLoadMoreButton();

        // =============================
        // DESCARGAS DESDE EL HISTORIAL
        // =============================
        document.addEventListener('click', function (e) {
            const link = e.target.closest('.quotation-download');
            if (!link) return;
            e.preventDefault();

            const url = link.getAttribute('href');
            const format = link.getAttribute('data-format') || 'archivo';
            const defaultIcon = link.querySelector('.icon-default');
            const loadingIcon = link.querySelector('.icon-loading');

            defaultIcon.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
            link.classList.add('pointer-events-none', 'opacity-70');
            showToast(`Regenerando ${format.toUpperCase()}...`, 'info');

            fetch(url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/pdf, application/octet-stream, */*',
                },
            })
            .then(async (response) => {
                if (!response.ok) {
                    const err = await response.json().catch(() => ({ message: 'Error al generar' }));
                    throw new Error(err.message || 'Error al generar');
                }
                const disposition = response.headers.get('Content-Disposition') || '';
                const match = disposition.match(/filename="?([^"]+)"?/);
                const filename = match ? match[1] : `documento.${format}`;

                const blob = await response.blob();
                const blobUrl = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = blobUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                setTimeout(() => URL.revokeObjectURL(blobUrl), 1000);
                showToast(`${format.toUpperCase()} descargado`, 'success');
            })
            .catch((error) => showToast(error.message, 'error'))
            .finally(() => {
                defaultIcon.classList.remove('hidden');
                loadingIcon.classList.add('hidden');
                link.classList.remove('pointer-events-none', 'opacity-70');
            });
        });

        // ELIMINAR COTIZACIÓN
        const deleteModal      = document.getElementById('deleteModal');
        const deleteModalPanel = document.getElementById('deleteModalPanel');
        const deleteCancelBtn  = document.getElementById('deleteCancelBtn');
        const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');
        const deleteFolioSpan  = document.getElementById('deleteFolio');

        let pendingDeleteId   = null;
        let pendingDeleteCard = null;

        function openDeleteModal(id, folio, card) {
            pendingDeleteId   = id;
            pendingDeleteCard = card;
            deleteFolioSpan.textContent = folio;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
            requestAnimationFrame(() => {
                deleteModalPanel.classList.remove('scale-95', 'opacity-0');
                deleteModalPanel.classList.add('scale-100', 'opacity-100');
            });
        }

        function closeDeleteModal() {
            deleteModalPanel.classList.remove('scale-100', 'opacity-100');
            deleteModalPanel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                pendingDeleteId   = null;
                pendingDeleteCard = null;
            }, 250);
        }

        deleteCancelBtn.addEventListener('click', closeDeleteModal);
        deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) closeDeleteModal(); });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) closeDeleteModal();
        });

        deleteConfirmBtn.addEventListener('click', async () => {
            if (!pendingDeleteId) return;

            const iconDefault  = deleteConfirmBtn.querySelector('.icon-default');
            const iconLoading  = deleteConfirmBtn.querySelector('.icon-loading');
            deleteConfirmBtn.disabled = true;
            iconDefault.classList.add('hidden');
            iconLoading.classList.remove('hidden');

            try {
                const response = await fetch(`${downloadBase}/${pendingDeleteId}`, {
                    method: 'DELETE',
                    credentials: 'same-origin',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                if (!response.ok) {
                    const err = await response.json().catch(() => ({ message: 'Error al eliminar' }));
                    throw new Error(err.message);
                }

                // Anima y elimina la tarjeta del DOM
                if (pendingDeleteCard) {
                    pendingDeleteCard.style.transition = 'opacity 0.3s, transform 0.3s';
                    pendingDeleteCard.style.opacity    = '0';
                    pendingDeleteCard.style.transform  = 'scale(0.95)';
                    setTimeout(() => {
                        pendingDeleteCard.remove();

                        // Actualiza contador
                        const grid = document.getElementById('historyGrid');
                        const countBadge = document.getElementById('historyCountBadge');
                        if (grid && countBadge) {
                            const current = grid.children.length;
                            countBadge.textContent = `${current} ${current === 1 ? 'registro' : 'registros'}`;
                        }

                        // Si el grid queda vacío recarga la sección completa
                        if (grid && grid.children.length === 0) {
                            document.getElementById('historyContainer').innerHTML = `
                                <div class="bg-[var(--cz-surface)] rounded-2xl border border-[var(--cz-border)] p-14 text-center">
                                    <div class="mx-auto w-12 h-12 rounded-xl bg-[var(--cz-brass-soft)] flex items-center justify-center mb-3">
                                        <svg class="w-5 h-5 text-[var(--cz-brass)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-[var(--cz-ink)]">Aún no hay cotizaciones</p>
                                    <p class="text-xs text-[var(--cz-ink-soft)] mt-1">Comienza pegando el texto de tu primera cotización arriba</p>
                                </div>`;
                        }
                    }, 300);
                }

                showToast(`Cotización ${deleteFolioSpan.textContent} eliminada`, 'success');
                closeDeleteModal();

            } catch (err) {
                showToast(err.message, 'error');
            } finally {
                deleteConfirmBtn.disabled = false;
                iconDefault.classList.remove('hidden');
                iconLoading.classList.add('hidden');
            }
        });

        // Delegar click en botones .quotation-delete
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.quotation-delete');
            if (!btn) return;
            const card = btn.closest('.cz-card');
            openDeleteModal(btn.dataset.id, btn.dataset.folio, card);
        });
        </script>
    @endpush
</x-app-layout>