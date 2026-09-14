@if($quotations->count())
    <div id="historyGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @include('quotations._quotation_cards', ['quotations' => $quotations])
    </div>

    <div id="loadMoreWrap" class="mt-8 flex flex-col items-center gap-3 {{ $hasMore ? '' : 'hidden' }}">
        <button type="button" id="loadMoreBtn" data-offset="{{ $nextOffset }}"
                class="group cz-glow inline-flex items-center gap-2 px-5 py-2.5 bg-white text-[var(--cz-brass-deep)] rounded-xl text-sm font-semibold border border-[var(--cz-brass)]/30 hover:border-[var(--cz-brass)] transition-all duration-200">
            <svg id="loadMoreIcon" class="w-4 h-4 transition-transform duration-300 group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
            <svg id="loadMoreSpinner" class="w-4 h-4 hidden animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span id="loadMoreText">Cargar más</span>
        </button>
    </div>

    <p id="historyEndMsg" class="mt-8 text-center text-xs text-[var(--cz-ink-soft)] {{ $hasMore ? 'hidden' : '' }}">
        Has visto todas tus cotizaciones
    </p>
@else
    <div class="bg-[var(--cz-surface)] rounded-2xl border border-[var(--cz-border)] p-14 text-center">
        <div class="mx-auto w-12 h-12 rounded-xl bg-[var(--cz-brass-soft)] flex items-center justify-center mb-3">
            <svg class="w-5 h-5 text-[var(--cz-brass)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-[var(--cz-ink)]">Aún no hay cotizaciones</p>
        <p class="text-xs text-[var(--cz-ink-soft)] mt-1">Comienza pegando el texto de tu primera cotización arriba</p>
    </div>
@endif