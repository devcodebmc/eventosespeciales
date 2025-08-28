<section aria-labelledby="mobiliario-destacado" class="py-8 px-1 max-w-full mx-auto">
    <h2 id="mobiliario-destacado" class="sr-only">Mobiliario destacado</h2>

    <header class="flex flex-col sm:flex-row items-center justify-center my-6 w-full">
        <div class="flex items-center w-full justify-center">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                {{ $furnitures[0]->service->name ?? 'Servicio' }}
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>

    @if($furnitures->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-1">
            @foreach($furnitures->take(5) as $index => $card)
                <article class="relative aspect-[4/5] group overflow-hidden">
                    <a href="javascript:void(0);" class="absolute inset-0 z-10" aria-label="Leer más sobre {{ $card->name }}"></a>

                    <!-- Fondo oscuro por defecto -->
                    <div class="absolute inset-0 bg-[#263238] z-0"></div>

                    <!-- Imagen revelada con scroll -->
                    <div
                        class="absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000 ease-out z-0"
                        data-bg-reveal
                        style="background-image: url('{{ 'storage/' . $card->image }}'); transition-delay: {{ $index * 100 }}ms;"
                        aria-hidden="true">
                    </div>

                    <!-- Capa oscura para legibilidad -->
                    <div class="absolute inset-0 bg-black/50 z-[1]"></div>

                    <!-- Contenido -->
                    <div class="absolute inset-0 z-[2] flex flex-col justify-end p-4">
                        <span class="text-xs text-white/80 mb-1">
                            {{ $card->service->name ?? 'Servicio' }}
                        </span>
                        <h3 class="text-lg font-script tracking-widest text-white mb-2 leading-tight">
                            {{ $card->name }}
                        </h3>
                        <div class="w-8 h-0.5 bg-rose-400 mb-3" aria-hidden="true"></div>
                        <p class="text-xs text-white/90 hidden group-hover:block">
                            {{ substr($card->description, 0, 100) . '...' ?? $card->description }}
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