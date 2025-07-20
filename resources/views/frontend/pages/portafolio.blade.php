@extends('frontend.layouts.main')

@section('title', 'Portafolio | Eventos Especiales Lerma')

@section('description', 'Agencia profesional de organización de eventos en Lerma. Bodas, fiestas, eventos corporativos y más. Servicios completos para hacer tu evento memorable.')

@section('keywords', 'eventos Lerma, organización de eventos, bodas Lerma, fiestas Lerma, eventos corporativos, catering Lerma, decoración eventos, agencia eventos')

@section('canonical', 'https://eventosespecialeslerma.com/portafolio')

@section('ogtitle', 'Portafolio | Eventos Especiales Lerma')
@section('ogdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')
@section('ogurl', 'https://eventosespecialeslerma.com/portafolio')
@section('ogimage', asset('images/Logo-white.png'))
@section('ogimage:secure_url', asset('ogimage', asset('images/Logo-white.png')))

@section('twittertitle', 'Portafolio | Eventos Especiales Lerma')
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
                        Nuestro Trabajo en Acción
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="acerca-de-nosotros" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Portafolio
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        <section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0" data-animate>
            <header class="flex flex-col sm:flex-row items-center justify-center my-6 w-full">
                <div class="flex items-center w-full justify-center">
                    <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
                    <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                        El Mejor Recuerdo
                    </h2>
                    <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
                </div>
            </header>
            <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
                Cada evento es un recuerdo inolvidable.
            </h3>
            <p class="max-w-5xl mx-auto mt-4 text-sm sm:text-base md:text-lg text-gray-500 text-center px-2">
                Nuestro compromiso es crear momentos con significado y amor en cada minuto de su evento, dejando un recuerdo inolvidable para toda la vida.
            </p>
        </section>
        <section class="max-w-7xl mx-auto px-4 py-12">
            <h2 class="sr-only">Eventos destacados</h2>
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach($events as $event)
                    <article class="group relative break-inside-avoid overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 mb-6">
                        <a href="{{ route('events.show', $event->id) }}" class="block h-full focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg">
                            <figure class="relative w-full">
                                <img 
                                    src="{{ asset($event->image) }}" 
                                    alt="{{ $event->title }}" 
                                    class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                >
                                
                                <!-- Overlay con información -->
                                <figcaption class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                                    <div class="text-white space-y-2">
                                        <h3 class="text-xl font-script leading-tight">{{ $event->title }}</h3>

                                        <div class="flex items-center space-x-2 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <time datetime="{{ $event->event_date }}">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('F Y') }}
                                            </time>
                                        </div>
                                        
                                        @if($event->location)
                                        <div class="flex items-center space-x-2 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                        @endif
                                        
                                        <div class="pt-2">
                                            <span class="inline-block px-2 py-1 bg-primary-600 text-xs rounded-full">
                                                {{ $event->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                                                
                                    <!-- Icono de categoría (original) -->
                                    <div class="absolute top-4 right-4 transition-all duration-300 opacity-80 group-hover:opacity-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                                        </svg>
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    </section>
</main>
@endsection