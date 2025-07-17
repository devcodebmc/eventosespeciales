@extends('frontend.layouts.main')

@section('title', 'Servicios | Eventos Especiales Lerma')

@section('description', 'Agencia profesional de organización de eventos en Lerma. Bodas, fiestas, eventos corporativos y más. Servicios completos para hacer tu evento memorable.')

@section('keywords', 'eventos Lerma, organización de eventos, bodas Lerma, fiestas Lerma, eventos corporativos, catering Lerma, decoración eventos, agencia eventos')

@section('canonical', 'https://eventosespecialeslerma.com/servicios')

@section('ogtitle', 'Servicios | Eventos Especiales Lerma')
@section('ogdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')
@section('ogurl', 'https://eventosespecialeslerma.com/servicios')
@section('ogimage', asset('img/og-image.jpg'))
@section('ogimage:secure_url', asset('ogimage', asset('img/og-image.jpg')))

@section('twittertitle', 'Servicios | Eventos Especiales Lerma')
@section('twitterdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')
@section('twitterimage', asset('img/og-image.jpg'))

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
                        Somos Expertos
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="acerca-de-nosotros" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Nuestros Servicios
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        @include('frontend.partials.services')
        @include('frontend.partials.packages')
        @include('frontend.partials.eventCards')
    </section>
</main>
@endsection