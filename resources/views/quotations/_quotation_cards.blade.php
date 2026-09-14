@foreach($quotations as $q)
    <div class="cz-card group relative bg-[var(--cz-surface)] rounded-2xl border border-[var(--cz-border)] overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-[3px] hover:border-[var(--cz-brass)]/50 hover:shadow-[0_14px_28px_-14px_rgba(147,51,234,0.38),0_20px_40px_-24px_rgba(37,99,235,0.3)]">

        <div class="px-5 pt-5 pb-4">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-[var(--cz-brass-soft)] cz-grad-text cz-display text-[12px] font-bold tracking-wide tabular-nums">
                    {{ $q->folio }}
                </span>
                <span class="text-[11px] text-[var(--cz-ink-soft)] font-medium tabular-nums">
                    {{ $q->quotation_date->format('d/m/Y') }}
                </span>
            </div>

            <p class="text-sm text-[var(--cz-ink)] truncate mb-4 leading-tight" title="{{ $q->client_name }}">
                {{ $q->client_name }}
            </p>

            {{-- talón punteado, eco del ticket del formulario --}}
            <div class="cz-perforation mb-4"></div>

            <div class="flex items-end justify-between">
                <div>
                    <p class="text-[10px] text-[var(--cz-ink-soft)] font-medium leading-none mb-1.5">Total</p>
                    <p class="text-xl cz-display font-semibold text-[var(--cz-ink)] leading-none tabular-nums">
                        ${{ number_format($q->total, 2) }}
                    </p>
                </div>

                <div class="flex items-center gap-1.5">
                    {{-- PDF --}}
                    <a href="{{ route('quotations.download', [$q, 'pdf']) }}"
                       data-format="pdf"
                       title="Descargar PDF"
                       class="quotation-download inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[var(--cz-rust-soft)] text-[var(--cz-rust)] hover:bg-[var(--cz-rust)] hover:text-white border border-[var(--cz-rust)]/15 hover:border-[var(--cz-rust)] transition-all duration-200">
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
                       class="quotation-download inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[var(--cz-steel-soft)] text-[var(--cz-steel)] hover:bg-[var(--cz-steel)] hover:text-white border border-[var(--cz-steel)]/15 hover:border-[var(--cz-steel)] transition-all duration-200">
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
                       class="quotation-download inline-flex items-center justify-center w-8 h-8 rounded-lg bg-[var(--cz-moss-soft)] text-[var(--cz-moss)] hover:bg-[var(--cz-moss)] hover:text-white border border-[var(--cz-moss)]/15 hover:border-[var(--cz-moss)] transition-all duration-200">
                        <svg class="w-3.5 h-3.5 icon-default" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
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