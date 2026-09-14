<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Cotizaciones') }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">Genera documentos profesionales con IA</p>
            </div>
            <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-full bg-gradient-to-r from-indigo-50 to-violet-50 text-indigo-700 text-xs font-medium border border-indigo-100">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                IA Activa
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-slate-50 via-indigo-50/30 to-violet-50/40 min-h-screen">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-14">

            {{-- ===== FORMULARIO ===== --}}
            <div class="bg-white rounded-2xl border border-indigo-100/60 shadow-[0_2px_8px_-2px_rgba(79,70,229,0.08)] overflow-hidden mb-8">
                <div class="px-6 py-5 border-b border-indigo-50 flex items-center justify-between bg-gradient-to-r from-indigo-50/50 via-violet-50/30 to-transparent">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-md shadow-indigo-500/20">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900">Nueva Cotización</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Pega el texto, la IA extrae y genera todo</p>
                        </div>
                    </div>
                </div>

                <form id="quotationForm" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
                        <div class="lg:col-span-4">
                            <label for="client_name" class="block text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wider">
                                Cliente <span class="text-slate-300 font-normal normal-case">— opcional</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="client_name" type="text" name="client_name"
                                       class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition bg-white placeholder:text-slate-400"
                                       placeholder="A quien corresponda">
                            </div>
                        </div>

                        <div class="lg:col-span-8">
                            <div class="flex items-center justify-between mb-2">
                                <label for="raw_input" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                                    Texto <span class="text-slate-300 font-normal">— requerido</span>
                                </label>
                                <span class="text-[11px] text-slate-400 tabular-nums"><span id="charCount">0</span> caracteres</span>
                            </div>
                            <textarea id="raw_input" name="raw_input" rows="5" required
                                      class="block w-full border border-slate-200 rounded-xl px-4 py-3 text-sm resize-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition font-mono bg-white placeholder:text-slate-400 leading-relaxed"
                                      placeholder="• Pista de baile en vinil impreso de 6 x 7 mts. $10,080&#10;• Tarima para DJ booth de 7 x 3 mts $6700&#10;• Espejo en texto con vinil $1800"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-5">
                        <button type="submit" id="submitBtn"
                                class="group inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-violet-600 text-white rounded-xl text-sm font-semibold hover:from-indigo-600 hover:to-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 disabled:opacity-60 disabled:cursor-not-allowed">
                            <svg id="btnIcon" class="w-4 h-4 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span id="btnText">Procesar con IA</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ===== HISTORIAL ===== --}}
            <div class="mb-5 flex items-end justify-between">
                <div>
                    <h3 class="text-base font-semibold text-slate-900 tracking-tight">Historial</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Cotizaciones generadas recientemente</p>
                </div>
                <span class="text-[11px] text-indigo-600 bg-indigo-50 border border-indigo-100 px-3 py-1.5 rounded-lg tabular-nums font-medium">
                    {{ $quotations->total() }} {{ $quotations->total() === 1 ? 'registro' : 'registros' }}
                </span>
            </div>

            <div id="historyContainer">
                @include('quotations._history', ['quotations' => $quotations])
            </div>

        </div>
    </div>

    {{-- Overlay de procesamiento --}}
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 text-center">
            <div class="relative w-20 h-20 mx-auto mb-5">
                <div class="absolute inset-0 rounded-full border-[3px] border-indigo-100"></div>
                <div class="absolute inset-0 rounded-full border-[3px] border-transparent border-t-indigo-500 animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-slate-900 mb-1" id="loadingTitle">Procesando con IA</h3>
            <p class="text-xs text-slate-500 mb-4" id="loadingText">Analizando el texto y extrayendo los datos...</p>
            <div class="flex items-center justify-center space-x-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0s"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-violet-500 animate-bounce" style="animation-delay: 0.15s"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0.3s"></span>
            </div>
        </div>
    </div>

    {{-- ===== MODAL POST-GENERACIÓN ===== --}}
    <div id="successModal" class="fixed inset-0 z-[60] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
        <div id="successModalPanel"
             class="bg-white rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform scale-95 opacity-0 transition-all duration-300 ease-out">

            <div class="px-7 py-8 text-center">

                {{-- Ícono --}}
                <div class="relative w-20 h-20 mx-auto mb-5">
                    <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-60"></div>
                    <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Mensaje --}}
                <h3 class="text-lg font-bold text-slate-900 mb-1.5">
                    ¡Listo!
                </h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Tu cotización <span id="successFolio" class="font-semibold text-indigo-600 tabular-nums">—</span> se generó correctamente.
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    <span id="successClient">—</span>
                </p>

                {{-- Acciones --}}
                <div class="flex items-center justify-center gap-3 mt-7">
                    <button type="button" id="successClose"
                            class="px-5 py-2.5 text-sm font-medium text-slate-500 hover:text-slate-800 transition">
                        Cerrar
                    </button>
                    <button type="button" id="downloadPdfBtn"
                            class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-violet-600 text-white rounded-xl text-sm font-semibold hover:from-indigo-600 hover:to-violet-700 transition-all shadow-md shadow-indigo-500/20">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Descargar PDF
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
                success: { border: 'border-emerald-200', dot: 'bg-emerald-500', bg: 'from-emerald-50/80' },
                error:   { border: 'border-red-200',     dot: 'bg-red-500',     bg: 'from-red-50/80' },
                info:    { border: 'border-indigo-200',  dot: 'bg-indigo-500',  bg: 'from-indigo-50/80' },
            };
            const cfg = configs[type] || configs.info;
            const toast = document.createElement('div');
            toast.className = `flex items-center space-x-3 bg-gradient-to-r ${cfg.bg} to-white border ${cfg.border} p-3.5 rounded-xl shadow-lg transform transition-all duration-300 translate-x-full opacity-0 min-w-[280px]`;
            toast.innerHTML = `<span class="w-2 h-2 rounded-full ${cfg.dot} flex-shrink-0"></span><p class="text-sm flex-1 text-slate-700">${message}</p>`;
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
                    credentials: 'same-origin',   // ← CLAVE
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
                    credentials: 'same-origin',   // ← CLAVE
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
                credentials: 'same-origin',   // ← CLAVE
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
    </script>
    @endpush
</x-app-layout>