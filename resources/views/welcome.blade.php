@extends('frontend.layouts.main')

@section('content')
<section class="bg-white relative overflow-hidden" aria-labelledby="eventos-especiales-lerma">
    <!-- Flores decorativas - Visibles en todas las resoluciones -->
    <div role="presentation" class="pointer-events-none select-none absolute -left-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-72 xl:h-72 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
        <img src="{{ asset('images/flor-izquierda.png') }}" alt="Imagen decorativa de flor izquierda" 
             class="w-full h-full object-contain object-left-top"
             style="clip-path: inset(0 0 20% 0);" 
             aria-hidden="true" decoding="async" loading="eager">
    </div>
    
    <div role="presentation" class="pointer-events-none select-none absolute -right-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-64 lg:h-64 xl:w-80 xl:h-80 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
        <img src="{{ asset('images/flor-derecha.png') }}" alt="Imagen decorativa de flor derecha" 
             class="w-full h-full object-contain object-right-top"
             style="clip-path: inset(0 0 20% 0);" 
             aria-hidden="true" decoding="async" loading="eager">
    </div>
    <div class="container mx-auto py-4 opacity-0 transition-all duration-700" data-animate>
        <article class="text-center mb-8">
            <h1 id="eventos-especiales-lerma" class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#4b8b97] mb-4">Eventos Especiales Lerma</h1>
            <div class="flex items-center justify-center my-6">
                <span class="w-36 border-t border-[#4b8b97] mx-2"></span>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <p class="text-md text-gray-500 tracking-widest uppercase mx-4">
                Tu planificador de confianza para eventos inolvidables
                </p>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <span class="w-36 border-t border-[#4b8b97] mx-2"></span>
            </div>
            <h2 class="text-2xl md:text-4xl lg:text-8xl text-[#2A4044] font-secondary text-center mt-8">
                Creando una Celebración Inolvidable
            </h2>
            <div class="flex items-center justify-center mt-8">
                <a href="/sobre-nosotros" class="btn-action text-lg py-5 px-10 rounded-md">
                    Nuestro Trabajo
                </a>
            </div>
        </article>
    </div>
    @include('frontend.partials.divider')
    @include('frontend.partials.services')
    @include('frontend.partials.divider')
    @include('frontend.partials.shortHistory')
    @include('frontend.partials.moments')
    @include('frontend.partials.subscriptionBanner')
    @include('frontend.partials.promotions')
    @include('frontend.partials.shortDescription')
    {{-- @include('frontend.partials.team') --}}
    @include('frontend.partials.contactForm')
    @include('frontend.partials.eventCards')
</section> 
@endsection
