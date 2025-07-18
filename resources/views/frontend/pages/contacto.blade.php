@extends('frontend.layouts.main')

@section('title', 'Contacto | Eventos Especiales Lerma')

@section('description', 'Agencia profesional de organización de eventos en Lerma. Bodas, fiestas, eventos corporativos y más. Servicios completos para hacer tu evento memorable.')

@section('keywords', 'eventos Lerma, organización de eventos, bodas Lerma, fiestas Lerma, eventos corporativos, catering Lerma, decoración eventos, agencia eventos')

@section('canonical', 'https://eventosespecialeslerma.com/contacto')

@section('ogtitle', 'Contacto | Eventos Especiales Lerma')
@section('ogdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')
@section('ogurl', 'https://eventosespecialeslerma.com/contacto')
@section('ogimage', asset('images/Logo-white.png'))
@section('ogimage:secure_url', asset('ogimage', asset('images/Logo-white.png')))

@section('twittertitle', 'Contacto | Eventos Especiales Lerma')
@section('twitterdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')
@section('twitterimage', asset('images/Logo-white.png'))


@section('content')
<main>
    <section class="bg-white relative overflow-hidden" aria-labelledby="acerca-de-nosotros">
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
                        Contacto
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="acerca-de-nosotros" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Conecta con Nosotros
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
    </section>
    <section class="relative py-12 md:py-20 bg-white"> <!-- Overflow-hidden eliminado -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <!-- Imagen (entra desde derecha) - Ajustes responsive -->
            <div class="relative h-64 sm:h-80 md:h-96 lg:h-[48rem] w-full overflow-hidden rounded-lg shadow-lg transform transition-all duration-1000 ease-[cubic-bezier(0.12,0.8,0.32,1)] translate-x-16 opacity-0" 
                data-animate-image
                style="transition-property: transform, opacity; will-change: transform, opacity;">
                <img src="{{ asset('images/montaje-vintage.jpg') }}" alt="Contacto"
                    class="w-full h-full object-cover object-center">
            </div>

            <!-- Card (entra desde izquierda) - Ajustes para mobile -->
            <div class="bg-[#f1f7f6] rounded-md shadow-md p-6 sm:p-8 lg:p-12 lg:ml-[-6rem] z-10 relative w-full h-auto lg:min-h-[36rem] flex flex-col justify-center transform transition-all duration-1000 ease-[cubic-bezier(0.12,0.8,0.32,1)] -translate-x-16 opacity-0" 
                data-animate-image
                style="transition-property: transform, opacity; will-change: transform, opacity;">
                
                <!-- Header ajustado para mobile -->
                <header class="flex flex-col items-center sm:items-start justify-start my-4 sm:my-6 w-full">
                    <div class="flex items-center w-full justify-center sm:justify-start gap-3">
                        <span class="w-8 sm:w-10 border-t border-[#4b8b97]"></span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                        </svg>
                        <h2 class="text-sm sm:text-base md:text-lg text-gray-500 tracking-widest uppercase text-center sm:text-left">
                            Hablemos
                        </h2>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                        </svg>
                        <span class="w-8 sm:w-10 border-t border-[#4b8b97]"></span>
                    </div>
                </header>

                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] text-left px-0 sm:px-2">
                    Contáctanos
                </h3>
                <p class="mt-2 sm:mt-4 text-sm sm:text-base md:text-lg text-gray-500 text-left px-0 sm:px-2">
                    Nuestras puertas nunca están cerradas. Iniciemos un diálogo y emprendamos una aventura juntos.
                </p>

                <!-- Lista de contactos optimizada para mobile -->
                <ul class="space-y-4 sm:space-y-6 mt-6 sm:mt-8 px-0 sm:px-2">
                    <!-- Cada ítem de contacto -->
                    <li class="flex flex-col xs:flex-row items-start xs:items-baseline gap-3 sm:gap-6">
                        <div class="flex items-center gap-3 sm:gap-6">
                            <!-- Contenedor del icono (tamaños responsivos) -->
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-gray-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
                                </svg>
                            </div>
                            <!-- Texto alineado con el icono -->
                            <span class="text-base sm:text-lg text-gray-800 mt-0 sm:mt-[2px]">728 281 35 14</span>
                        </div>
                    </li>
                    
                    <!-- Repetir para los otros ítems -->
                    <li class="flex flex-col xs:flex-row items-start xs:items-baseline gap-3 sm:gap-6">
                        <div class="flex items-center gap-3 sm:gap-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-gray-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                                </svg>
                            </div>
                            <span class="text-base sm:text-lg text-gray-800 mt-0 sm:mt-[2px] break-words">info@eventosespecialeslerma.com</span>
                        </div>
                    </li>
                    
                    <li class="flex flex-col xs:flex-row items-start xs:items-baseline gap-3 sm:gap-6">
                        <div class="flex items-center gap-3 sm:gap-6">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-full border border-gray-500 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a6 6 0 1 0 0-12 6 6 0 0 0 0 12Zm0 0v6M9.5 9A2.5 2.5 0 0 1 12 6.5"/>
                                </svg>
                            </div>
                            <span class="text-base sm:text-lg text-gray-800 mt-0 sm:mt-[2px]">Av. Circunvalación, 15, Lerma, Edo de México</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    @include('frontend.partials.contactForm')
</main>
@endsection

