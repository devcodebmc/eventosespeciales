@if($quotations->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3">
        @foreach($quotations as $q)
            <div class="group bg-white rounded-xl border border-gray-200/80 shadow-sm hover:shadow-md hover:border-indigo-300/60 transition-all duration-300 overflow-hidden flex flex-col">

                {{-- Header --}}
                <div class="px-4 pt-3.5 pb-3">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 text-[11px] font-bold tracking-wide border border-indigo-100">
                            {{ $q->folio }}
                        </span>
                        <span class="text-[10px] text-gray-400 font-medium">
                            {{ $q->quotation_date->format('d/m/Y') }}
                        </span>
                    </div>

                    {{-- Cliente --}}
                    <p class="text-xs text-gray-600 truncate mb-3 leading-tight" title="{{ $q->client_name }}">
                        {{ $q->client_name }}
                    </p>

                    {{-- Total + iconos de descarga --}}
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold leading-none mb-1">Total</p>
                            <p class="text-base font-bold text-gray-900 leading-none">${{ number_format($q->total, 2) }}</p>
                        </div>

                        <div class="flex items-center gap-1">
                            {{-- PDF --}}
                            <a href="{{ route('quotations.download', [$q, 'pdf']) }}"
                               data-format="pdf"
                               title="Descargar PDF"
                               class="quotation-download inline-flex items-center justify-center w-7 h-7 rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white border border-red-100 hover:border-red-500 transition-all duration-200">
                                <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                </svg>
                                <svg class="w-3.5 h-3.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </a>

                            {{-- Word --}}
                            <a href="{{ route('quotations.download', [$q, 'word']) }}"
                               data-format="word"
                               title="Descargar Word"
                               class="quotation-download inline-flex items-center justify-center w-7 h-7 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white border border-blue-100 hover:border-blue-500 transition-all duration-200">
                                <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                </svg>
                                <svg class="w-3.5 h-3.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </a>

                            {{-- Excel --}}
                            <a href="{{ route('quotations.download', [$q, 'excel']) }}"
                               data-format="excel"
                               title="Descargar Excel"
                               class="quotation-download inline-flex items-center justify-center w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white border border-emerald-100 hover:border-emerald-500 transition-all duration-200">
                                <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                </svg>
                                <svg class="w-3.5 h-3.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $quotations->links() }}
    </div>
@else
    <div class="bg-white rounded-xl border border-gray-200/80 p-12 text-center">
        <div class="mx-auto w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-50 to-violet-100 flex items-center justify-center mb-3">
            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-gray-700">Aún no hay cotizaciones</p>
        <p class="text-xs text-gray-400 mt-1">Comienza pegando el texto de tu primera cotización arriba</p>
    </div>
@endif