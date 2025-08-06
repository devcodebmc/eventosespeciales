@props(['cards' => [], 'excludeId' => null])

<section aria-labelledby="publicaciones-destacadas" class="py-8 px-1 max-w-full mx-auto">
    <h2 id="publicaciones-destacadas" class="sr-only">Publicaciones destacadas</h2>

    @php
        // Filtrar las tarjetas si se proporciona un ID para excluir
        $filteredCards = $excludeId 
            ? $cards->where('id', '!=', $excludeId)
            : $cards;
    @endphp

    @if($filteredCards->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-1">
            @foreach($filteredCards->take(5) as $index => $card)
                <article class="relative aspect-[4/5] group overflow-hidden">
                    <a href="{{ route('events.showEvent', $card->slug) }}" class="absolute inset-0 z-10" aria-label="Leer más sobre {{ $card->title }}"></a>

                    <!-- Fondo oscuro por defecto -->
                    <div class="absolute inset-0 bg-[#263238] z-0"></div>

                    <!-- Imagen revelada con scroll -->
                    <div
                        class="absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-out z-0"
                        data-bg-reveal
                        style="background-image: url('{{ $card->image }}'); transition-delay: {{ $index * 100 }}ms;"
                        aria-hidden="true">
                    </div>

                    <!-- Capa oscura para legibilidad -->
                    <div class="absolute inset-0 bg-black/50 z-[1]"></div>

                    <!-- Contenido -->
                    <div class="absolute inset-0 z-[2] flex flex-col justify-end p-4">
                        <span class="text-xs text-white/80 mb-1">
                            <time datetime="{{ date('Y-m-d', strtotime($card->event_date)) }}">
                                {{ date('Y-m-d', strtotime($card->event_date)) }}
                            </time> • {{ $card->category->name }}
                        </span>
                        <h3 class="text-lg font-script tracking-widest text-white mb-2 leading-tight">
                            {{ $card->title }}
                        </h3>
                        <div class="w-8 h-0.5 bg-rose-400 mb-3" aria-hidden="true"></div>
                        <p class="text-xs text-white/90 hidden group-hover:block">
                            {{ substr($card->summary, 0, 100) . '...' ?? $card->summary }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500">No hay otros eventos para mostrar</p>
        </div>
    @endif
</section>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const images = document.querySelectorAll('[data-bg-reveal]');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100');
                        entry.target.classList.remove('opacity-0');
                    } else {
                        entry.target.classList.remove('opacity-100');
                        entry.target.classList.add('opacity-0');
                    }
                });
            }, {
                threshold: 0.25
            });

            images.forEach(img => observer.observe(img));
        });
    </script>
@endpush