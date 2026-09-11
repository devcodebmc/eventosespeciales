<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Cotizaciones') }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">Genera documentos profesionales con IA</p>
            </div>
            <span class="hidden sm:inline-flex items-center px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium border border-indigo-100">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                IA Activa
            </span>
        </div>
    </x-slot>

    <div class="py-5 bg-gradient-to-br from-slate-100 via-slate-50 to-indigo-50/40 min-h-screen">
        <div class="w-full px-4 sm:px-6 lg:px-8 xl:px-10 2xl:px-12">

            {{-- ===== FORMULARIO ===== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden mb-6">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-indigo-50/40 to-transparent">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-sm">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-800">Nueva Cotización</h3>
                            <p class="text-xs text-gray-500">Pega el texto, la IA extrae y genera todo</p>
                        </div>
                    </div>
                </div>

                <form id="quotationForm" class="p-5">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        {{-- Cliente --}}
                        <div class="lg:col-span-1">
                            <label for="client_name" class="block text-xs font-medium text-gray-600 mb-1.5 uppercase tracking-wide">
                                Cliente <span class="text-gray-400 font-normal normal-case">(opcional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="client_name" type="text" name="client_name"
                                       class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition bg-gray-50/50 focus:bg-white"
                                       placeholder="A quien corresponda">
                            </div>
                        </div>

                        {{-- Texto --}}
                        <div class="lg:col-span-2">
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="raw_input" class="block text-xs font-medium text-gray-600 uppercase tracking-wide">
                                    Texto <span class="text-red-500">*</span>
                                </label>
                                <span class="text-xs text-gray-400"><span id="charCount">0</span> caracteres</span>
                            </div>
                            <textarea id="raw_input" name="raw_input" rows="5" required
                                      class="block w-full border border-gray-200 rounded-xl px-4 py-3 text-sm resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition font-mono bg-gray-50/50 focus:bg-white leading-relaxed"
                                      placeholder="• Pista de baile en vinil impreso de 6 x 7 mts. $10,080&#10;• Tarima para DJ booth de 7 x 3 mts $6700&#10;• Espejo en texto con vinil $1800"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" id="submitBtn"
                                class="group inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-violet-600 text-white rounded-xl text-sm font-semibold hover:from-indigo-600 hover:to-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md hover:shadow-lg disabled:opacity-60 disabled:cursor-not-allowed">
                            <svg id="btnIcon" class="w-4 h-4 mr-2 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span id="btnText">Procesar con IA</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ===== HISTORIAL ===== --}}
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Historial</h3>
                    <p class="text-xs text-gray-500">Cotizaciones generadas recientemente</p>
                </div>
                <span class="text-xs text-gray-500 bg-white border border-gray-200/80 px-3 py-1.5 rounded-lg shadow-sm">
                    {{ $quotations->total() }} {{ $quotations->total() === 1 ? 'cotización' : 'cotizaciones' }}
                </span>
            </div>

            <div id="historyContainer">
                @include('quotations._history', ['quotations' => $quotations])
            </div>

        </div>
    </div>

    {{-- Overlay --}}
    <div id="loadingOverlay" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 text-center">
            <div class="relative w-20 h-20 mx-auto mb-5">
                <div class="absolute inset-0 rounded-full border-4 border-indigo-100"></div>
                <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-indigo-500 animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-7 h-7 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-base font-semibold text-gray-800 mb-1" id="loadingTitle">Procesando con IA</h3>
            <p class="text-xs text-gray-500 mb-4" id="loadingText">Analizando el texto y extrayendo los datos...</p>
            <div class="flex items-center justify-center space-x-1.5">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0s"></span>
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0.15s"></span>
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-bounce" style="animation-delay: 0.3s"></span>
            </div>
        </div>
    </div>

    <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>

    @push('js')
    <script>
        const form = document.getElementById('quotationForm');
        const overlay = document.getElementById('loadingOverlay');
        const loadingTitle = document.getElementById('loadingTitle');
        const loadingText = document.getElementById('loadingText');
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');

        const textarea = document.getElementById('raw_input');
        const charCount = document.getElementById('charCount');
        textarea.addEventListener('input', () => charCount.textContent = textarea.value.length);

        function showToast(message, type = 'success') {
            const colors = {
                success: 'bg-emerald-50 border-emerald-200 text-emerald-800',
                error: 'bg-red-50 border-red-200 text-red-800',
            };
            const icons = {
                success: '<svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
                error: '<svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>',
            };
            const toast = document.createElement('div');
            toast.className = `flex items-start space-x-3 ${colors[type]} border p-3 rounded-xl shadow-sm transform transition-all duration-300 translate-x-full opacity-0`;
            toast.innerHTML = `<div class="flex-shrink-0">${icons[type]}</div><p class="text-sm flex-1">${message}</p>`;
            document.getElementById('toastContainer').appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full', 'opacity-0'));
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        const steps = [
            { title: 'Procesando con IA', text: 'Analizando el texto y extrayendo los datos...' },
            { title: 'Generando PDF', text: 'Creando el documento maestro con tu diseño...' },
            { title: 'Convirtiendo formatos', text: 'Generando Word y Excel desde el PDF...' },
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
                const response = await fetch('{{ route('quotations.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || result.error || 'Error al procesar la cotización');
                }

                clearInterval(stepInterval);
                setLoadingStep(3);
                await new Promise(r => setTimeout(r, 600));

                overlay.classList.add('hidden');
                overlay.classList.remove('flex');

                document.getElementById('historyContainer').innerHTML = result.history;

                form.reset();
                charCount.textContent = '0';

                showToast(`Cotización ${result.quotation.folio} generada correctamente`, 'success');

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
    </script>
    @endpush
</x-app-layout>