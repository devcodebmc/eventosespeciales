<section aria-labelledby="publicaciones-destacadas" class="py-8 px-1 max-w-full mx-auto opacity-0 transition-opacity duration-700" data-animate>
    <h2 id="publicaciones-destacadas" class="sr-only">Publicaciones destacadas</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-1">
        @foreach($cards as $card)
            <article class="relative aspect-[4/5] group">
                <a href="{{ $card->category->slug . '/' . $card->slug  }}" class="absolute inset-0 z-10" aria-label="Leer más sobre {{ $card->title }}"></a>
                
                <!-- Imagen en hover -->
                <div class="absolute inset-0 bg-cover bg-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                     style="background-image: url('{{ $card->image }}')" aria-hidden="true">
                </div>

                <!-- Contenido -->
                <div class="absolute inset-0 bg-[#263238] flex flex-col justify-end p-4 transition-all duration-300 group-hover:bg-black/60">
                    <span class="text-xs text-white/80 mb-1">
                        <time datetime="{{ date('Y-m-d', strtotime( $card->event_date)) }}">
                            {{ date('Y-m-d', strtotime( $card->event_date)) }}
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
</section>