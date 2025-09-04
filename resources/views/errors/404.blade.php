@extends('errors::maximal')

@section('title', __('Pagina No Encontrada - 404'))

@section('content')
<section class="bg-white relative overflow-hidden" aria-labelledby="pagina-no-encontrada">
        <!-- Flores decorativas - Visibles en todas las resoluciones -->
        <div role="presentation" class="pointer-events-none select-none absolute -left-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-72 xl:h-72 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-izquierda.png') }}" alt="" 
                 class="w-full h-full object-contain object-left-top"
                 style="clip-path: inset(0 0 20% 0);" 
                 aria-hidden="true" decoding="async" loading="lazy">
        </div>
        
        <div role="presentation" class="pointer-events-none select-none absolute -right-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-64 lg:h-64 xl:w-80 xl:h-80 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-derecha.png') }}" alt="" 
                 class="w-full h-full object-contain object-right-top"
                 style="clip-path: inset(0 0 20% 0);" 
                 aria-hidden="true" decoding="async" loading="lazy">
        </div>

        <div class="container mx-auto py-4 relative z-10 opacity-0 transition-all duration-700" data-animate>
            <article class="text-center mb-8 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center my-6" aria-hidden="true">
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <p class="text-lg text-gray-500 tracking-widest uppercase mx-2 sm:mx-4">
                        Página No Encontrada
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="pagina-no-encontrada" class="text-8xl md:text-9xl lg:text-[12rem] text-[#2A4044] font-secondary text-center px-4">
                    4 <abbr class="text-[#F6BBA9]">0</abbr> 4
                </h1>
                @include('frontend.partials.divider')
                <h2 class="text-base md:text-2xl lg:text-4xl text-[#2A4044] font-secondary text-center mt-8 px-4">¡Ups! Página no encontrada.</h2>
                <p class="text-sm md:text-base lg:text-lg text-gray-600 mt-4 px-4">
                    Lo sentimos, pero la página que buscas no existe, ha sido eliminada o está temporalmente no disponible.
                </p>
                <a href="{{ url('/') }}" class="inline-block mt-6 px-6 py-3 bg-[#4b8b97] text-white font-medium rounded hover:bg-[#3a6f75] transition" aria-label="Volver a la página principal">
                    Volver a la página principal
                </a>   
            </article>
        </div>
    </section>
@endsection