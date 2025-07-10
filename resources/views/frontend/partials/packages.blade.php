<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-8 bg-gray-100" data-animate>
    <header class="flex flex-col sm:flex-row items-center justify-center my-8 w-full">
        <div class="flex items-center w-full justify-center mt-12">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                Elige tu mejor paquete
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
       Precio y Plan Cómodos para Todos
    </h3>
</section>

<section class="bg-gray-100 py-8 md:py-16 px-4 relative">
    <!-- Flor izquierda -->
    <img src="{{ asset('images/flor-izquierda.png') }}" 
         alt="Flor izquierda" 
         class="absolute left-0 top-0 w-24 md:w-32 opacity-0 pointer-events-none z-0" 
         data-animate />

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach ($packages as $package)
                <div class="relative w-full group">
                    <div class="relative h-80 md:h-96 w-full rounded-xl overflow-hidden shadow-md">
                        <img src="{{ asset($package->image) }}"
                             alt="{{ $package->title }}"
                             class="w-full h-full object-cover" />
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                                    w-4/5 md:w-3/4 transition-all duration-500 group-hover:-translate-y-1/3 z-10">
                            <div class="bg-white rounded-xl shadow-xl p-5 md:p-6 text-center min-h-[180px] 
                                        flex flex-col border border-gray-100">
                                <h2 class="text-lg md:text-xl font-secondary text-[#F6BBA9] mb-2">
                                    {{ $package->title }}
                                </h2>
                                <h3 class="text-[#2A4044] font-secondary text-sm md:text-base mb-2">
                                    {{ $package->summary }}
                                </h3>
                                <div class="text-gray-700 text-sm md:text-base mb-3 flex-grow line-clamp-3">
                                    {!! $package->content !!}
                                </div>
                                <a href="#" class="btn-action inline-block px-3 py-1 md:px-4 md:py-2 
                                                 transition text-sm md:text-base mt-auto">
                                    Ver más
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Flor derecha -->
    <img src="{{ asset('images/flor-derecha.png') }}" 
         alt="Flor derecha" 
         class="absolute right-0 bottom-0 w-24 md:w-32 opacity-0 pointer-events-none z-0" 
         data-animate />
</section>