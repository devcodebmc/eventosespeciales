@foreach($quotations as $q)
    <div class="cz-card group relative bg-[var(--cz-surface)] rounded-2xl border border-[var(--cz-border)] overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-[3px] hover:border-[var(--cz-brass)]/50 hover:shadow-[0_14px_28px_-14px_rgba(147,51,234,0.38),0_20px_40px_-24px_rgba(37,99,235,0.3)]">

        <div class="px-4 sm:px-5 pt-4 sm:pt-5 pb-4">
            {{-- Folio + fecha --}}
            <div class="flex items-center justify-between gap-2 mb-3 sm:mb-4">
                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-[var(--cz-brass-soft)] cz-grad-text cz-display text-[11px] sm:text-[12px] font-bold tracking-wide tabular-nums truncate">
                    {{ $q->folio }}
                </span>
                <span class="text-[11px] text-[var(--cz-ink-soft)] font-medium tabular-nums whitespace-nowrap flex-shrink-0">
                    {{ $q->quotation_date->format('d/m/Y') }}
                </span>
            </div>

            {{-- Cliente --}}
            <p class="text-sm text-[var(--cz-ink)] truncate mb-3 sm:mb-4 leading-tight" title="{{ $q->client_name }}">
                {{ $q->client_name }}
            </p>

            {{-- Talón punteado --}}
            <div class="cz-perforation mb-3 sm:mb-4"></div>

            {{-- Bloque total + acciones: en móvil apilado, en >=380px lado a lado --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex-shrink-0">
                    <p class="text-[10px] text-[var(--cz-ink-soft)] font-medium leading-none mb-1.5">Total</p>
                    <p class="text-lg sm:text-xl cz-display font-semibold text-[var(--cz-ink)] leading-none tabular-nums">
                        ${{ number_format($q->total, 2) }}
                    </p>
                </div>

                {{-- Grid de acciones: 5 columnas parejas, se ajusta solo --}}
                <div class="grid grid-cols-5 gap-1 sm:gap-1.5 w-full sm:w-auto sm:flex sm:items-center">
                    {{-- PDF --}}
                    <a href="{{ route('quotations.download', [$q, 'pdf']) }}"
                       data-format="pdf"
                       title="Descargar PDF"
                       aria-label="Descargar PDF"
                       class="quotation-download inline-flex items-center justify-center w-full sm:w-8 h-8 rounded-lg bg-[var(--cz-rust-soft)] text-[var(--cz-rust)] hover:bg-[var(--cz-rust)] hover:text-white border border-[var(--cz-rust)]/15 hover:border-[var(--cz-rust)] transition-all duration-200">
                        <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
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
                       aria-label="Descargar Word"
                       class="quotation-download inline-flex items-center justify-center w-full sm:w-8 h-8 rounded-lg bg-[var(--cz-steel-soft)] text-[var(--cz-steel)] hover:bg-[var(--cz-steel)] hover:text-white border border-[var(--cz-steel)]/15 hover:border-[var(--cz-steel)] transition-all duration-200">
                        <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
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
                       aria-label="Descargar Excel"
                       class="quotation-download inline-flex items-center justify-center w-full sm:w-8 h-8 rounded-lg bg-[var(--cz-moss-soft)] text-[var(--cz-moss)] hover:bg-[var(--cz-moss)] hover:text-white border border-[var(--cz-moss)]/15 hover:border-[var(--cz-moss)] transition-all duration-200">
                        <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        <svg class="w-3.5 h-3.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </a>

                    {{-- Editar --}}
                    <button type="button"
                            data-id="{{ $q->id }}"
                            data-folio="{{ $q->folio }}"
                            title="Editar cotización"
                            aria-label="Editar cotización"
                            class="quotation-edit inline-flex items-center justify-center w-full sm:w-8 h-8 rounded-lg bg-[var(--cz-brass-soft)] text-[var(--cz-brass-deep)] hover:bg-[var(--cz-brass)] hover:text-white border border-[var(--cz-brass)]/20 hover:border-[var(--cz-brass)] transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.172-8.172z"/>
                        </svg>
                    </button>

                    {{-- Eliminar --}}
                    <button type="button"
                            data-id="{{ $q->id }}"
                            data-folio="{{ $q->folio }}"
                            title="Eliminar cotización"
                            aria-label="Eliminar cotización"
                            class="quotation-delete inline-flex items-center justify-center w-full sm:w-8 h-8 rounded-lg bg-gray-100 text-gray-400 hover:bg-red-500 hover:text-white border border-gray-200/50 hover:border-red-500 transition-all duration-200">
                        <svg class="w-3.5 h-3.5 icon-default" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <svg class="w-3.5 h-3.5 icon-loading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach