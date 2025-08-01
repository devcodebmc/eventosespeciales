@extends('frontend.layouts.main')

@section('title', 'Finca Isabela - Eventos Especiales Lerma')
@section('description', 'Descubre Finca Isabela, un lugar mágico para tus eventos en Lerma. Perfecto para bodas, fiestas y eventos corporativos. Espacios únicos y servicios personalizados para una celebración inolvidable.')
@section('keywords', 'Finca Isabela, eventos Lerma, organización de eventos, bodas Lerma, fiestas Lerma, eventos corporativos, catering Lerma, decoración eventos, agencia eventos')
@section('canonical', 'https://eventosespecialeslerma.com/finca-isabela')  

@section('ogtitle', 'Finca Isabela - Eventos Especiales Lerma')
@section('ogdescription', 'Descubre Finca Isabela, un lugar mágico para tus eventos en Lerma. Perfecto para bodas, fiestas y eventos corporativos. Espacios únicos y servicios personalizados para una celebración inolvidable.')
@section('ogurl', 'https://eventosespecialeslerma.com/finca-isabela')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('ogimage', asset('images/Logo-white.png')))

@section('twittertitle', 'Finca Isabela - Eventos Especiales Lerma')
@section('twitterdescription', 'Descubre Finca Isabela, un lugar mágico para tus eventos en Lerma. Perfecto para bodas, fiestas y eventos corporativos. Espacios únicos y servicios personalizados para una celebración inolvidable.')
@section('twitterimage', asset('images/logo-white.png'))

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
                        Su lugar ideal para eventos
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="acerca-de-nosotros" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Finca Isabela
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
    </section>
</main>
@endsection