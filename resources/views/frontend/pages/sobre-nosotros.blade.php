@extends('frontend.layouts.main')

@section('content')
<section class="bg-white relative overflow-hidden">
    <!-- Flores decorativas laterales -->
    <div class="hidden lg:block absolute left-0 top-1/3 transform -translate-y-1/2 w-24 h-24 xl:w-32 xl:h-32">
        <figure class="w-full h-full">
            <img src="{{ asset('images/flor-izquierda.png') }}" alt="Flor decorativa izquierda" class="w-full h-full object-contain opacity-70 hover:opacity-100 transition-opacity duration-300">
        </figure>
    </div>
    
    <div class="hidden lg:block absolute right-0 top-1/3 transform -translate-y-1/2 w-24 h-24 xl:w-32 xl:h-32">
        <figure class="w-full h-full">
            <img src="{{ asset('images/flor-derecha.png') }}" alt="Flor decorativa derecha" class="w-full h-full object-contain opacity-70 hover:opacity-100 transition-opacity duration-300">
        </figure>
    </div>

    <div class="container mx-auto py-4 relative z-10">
        <div class="text-center mb-8 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center my-6">
                <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <p class="text-sm sm:text-md text-gray-500 tracking-widest uppercase mx-2 sm:mx-4">
                    Nuestra Agencia de Eventos Especiales
                </p>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
            </div>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                Acerca de Nosotros
            </h2>
        </div>
    </div>
</section>
@endsection