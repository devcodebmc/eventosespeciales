@extends('frontend.layouts.main')

@section('title', 'Cabañas - Eventos Especiales Lerma')
@section('description', 'Descubre nuestras cabañas en Eventos Especiales Lerma. Espacios acogedores rodeados de naturaleza, ideales para hospedaje durante tu evento, retiro o celebración especial.')
@section('keywords', 'cabañas, hospedaje, eventos especiales, retiros, alojamiento, Lerma, Finca Isabela, cabañas rústicas')
@section('canonical', 'https://eventosespecialeslerma.com/cabanas')
@section('alternate', 'https://eventosespecialeslerma.com/cabanas')

@section('ogtitle', 'Cabañas - Eventos Especiales Lerma')
@section('ogdescription', 'Descubre nuestras cabañas en Eventos Especiales Lerma. Espacios acogedores rodeados de naturaleza, ideales para hospedaje durante tu evento, retiro o celebración especial.')
@section('ogurl', 'https://eventosespecialeslerma.com/cabanas')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('images/logo-white.png'))

@section('twittertitle', 'Cabañas - Eventos Especiales Lerma')
@section('twitterdescription', 'Descubre nuestras cabañas en Eventos Especiales Lerma. Espacios acogedores rodeados de naturaleza, ideales para hospedaje durante tu evento, retiro o celebración especial.')
@section('twitterimage', asset('images/logo-white.png'))

@section('content')
<main>

    {{-- ========================================================
         HERO — se conserva igual a temazcal
    ========================================================= --}}
    <section class="bg-white relative overflow-hidden" aria-labelledby="cabanas-titulo">

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
                        Descanso Rodeado de Naturaleza
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="cabanas-titulo" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Cabañas
                </h1>
            </article>
        </div>

        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         COLLAGE DE BIENVENIDA — 3 fotos asimétricas + panel de texto
         (reemplaza el bloque "imagen + texto a la par" de temazcal)
    ========================================================= --}}
    <section class="bg-white py-12 lg:py-24 relative overflow-hidden" aria-labelledby="bienvenida-cabanas">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                {{-- Collage de fotos, columna izquierda --}}
                <div class="lg:col-span-7 grid grid-cols-2 gap-4 opacity-0 transition-all duration-700" data-animate>
                    <div class="relative col-span-2 h-56 sm:h-72 overflow-hidden">
                        <div class="absolute inset-0 bg-[#263238] z-0"></div>
                        <img src="{{ asset('images/cabana-collage-1.jpg') }}" alt="Vista exterior de las cabañas al atardecer"
                             decoding="async" loading="lazy" fetchpriority="low"
                             class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-out hover:scale-105 transition-transform"
                             data-bg-reveal>
                    </div>
                    <div class="relative h-48 sm:h-64 overflow-hidden">
                        <div class="absolute inset-0 bg-[#263238] z-0"></div>
                        <img src="{{ asset('images/cabana-collage-2.jpg') }}" alt="Detalle de terraza de madera"
                             decoding="async" loading="lazy" fetchpriority="low"
                             class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-out hover:scale-105 transition-transform"
                             data-bg-reveal style="transition-delay: 100ms;">
                    </div>
                    <div class="relative h-48 sm:h-64 overflow-hidden">
                        <div class="absolute inset-0 bg-[#263238] z-0"></div>
                        <img src="{{ asset('images/cabana-collage-3.jpg') }}" alt="Interior cálido con chimenea"
                             decoding="async" loading="lazy" fetchpriority="low"
                             class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 ease-out hover:scale-105 transition-transform"
                             data-bg-reveal style="transition-delay: 200ms;">
                    </div>
                </div>

                {{-- Panel de texto, columna derecha --}}
                <div class="lg:col-span-5 bg-[#2A4044] p-10 lg:p-12 flex flex-col justify-center opacity-0 transition-all duration-700" data-animate>
                    <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase mb-4">Un refugio propio</span>
                    <h2 id="bienvenida-cabanas" class="text-3xl lg:text-4xl text-white font-secondary mb-6 leading-tight">
                        Tu descanso, a un paso del evento
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-4 text-base">
                        Dentro de <strong class="text-white font-script">Finca Isabela</strong> construimos un pequeño conjunto de cabañas para que la celebración no termine cuando cae la noche: madera, calidez y silencio a pasos de donde todo sucede.
                    </p>
                    <p class="text-gray-400 leading-relaxed mb-8 text-sm">
                        Perfectas para hospedar a la pareja, a la familia o a los invitados que se quedan a dormir después de la fiesta.
                    </p>
                    <a href="https://wa.me/527293738830?text=Hola,%20me%20gustaría%20conocer%20disponibilidad,%20precios%20e%20información%20sobre%20las%20cabañas."
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 self-start border border-[#4b8b97] text-white hover:bg-[#4b8b97] text-sm tracking-widest uppercase px-6 py-3 transition-colors duration-300">
                        Consultar disponibilidad
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         SELECTOR DE CABAÑAS — Tabs interactivos con Vanilla JS
         (no grid de cards, sin dependencias externas)
    ========================================================= --}}
    <section class="bg-[#f9f7f4] py-16 lg:py-24 relative overflow-hidden" aria-labelledby="selector-cabanas" id="cabanaTabsSection">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Opciones de hospedaje</span>
                <h2 id="selector-cabanas" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Encuentra tu Cabaña
                </h2>
            </div>

            @php
                $cabanas = [
                    [
                        'nombre' => 'Cabaña Manzanillo',
                        'capacidad' => '2 personas',
                        'imagen' => asset('images/cabana-manzanillo.jpg'),
                        'detalles' => ['1 cama King size', 'Baño privado', 'Terraza con vista al bosque', 'Chimenea interior'],
                        'desc' => 'Pensada para parejas: un espacio íntimo, silencioso y cálido, ideal para el después de una boda.',
                    ],
                    [
                        'nombre' => 'Cabaña Ocotillo',
                        'capacidad' => '4 personas',
                        'imagen' => asset('images/cabana-ocotillo.jpg'),
                        'detalles' => ['2 recámaras', 'Baño completo', 'Sala pequeña', 'Estacionamiento privado'],
                        'desc' => 'La opción familiar: espacio de estar separado de las habitaciones para mayor comodidad.',
                    ],
                    [
                        'nombre' => 'Cabaña Encino',
                        'capacidad' => '8 personas',
                        'imagen' => asset('images/cabana-encino.jpg'),
                        'detalles' => ['4 camas', '2 baños', 'Terraza amplia', 'Área de asador'],
                        'desc' => 'Para grupos grandes: amigos, comitivas o quienes prefieren hospedarse todos juntos.',
                    ],
                ];
            @endphp

            {{-- Botones de pestaña --}}
            <div class="flex flex-wrap justify-center gap-3 mb-10 opacity-0 transition-all duration-700" data-animate>
                @foreach($cabanas as $i => $c)
                <button type="button"
                        class="cabana-tab-btn px-6 py-3 text-sm tracking-widest uppercase transition-colors duration-300 {{ $i === 0 ? 'bg-[#2A4044] text-white' : 'bg-white text-[#2A4044] border border-[#2A4044]/20' }}"
                        data-tab-index="{{ $i }}">
                    {{ $c['nombre'] }}
                </button>
                @endforeach
            </div>

            {{-- Panel de contenido por pestaña --}}
            @foreach($cabanas as $i => $c)
            <div class="cabana-tab-panel {{ $i === 0 ? '' : 'hidden' }} opacity-0 transition-all duration-700" data-animate data-tab-panel="{{ $i }}">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center bg-white shadow-lg p-4 lg:p-0">
                    <img src="{{ $c['imagen'] }}" alt="{{ $c['nombre'] }}" class="w-full h-72 lg:h-[420px] object-cover" loading="lazy" decoding="async">
                    <div class="p-6 lg:pr-12 lg:py-10">
                        <span class="inline-block bg-[#4b8b97]/15 text-[#2A4044] text-xs tracking-widest uppercase px-3 py-1 mb-4">
                            {{ $c['capacidad'] }}
                        </span>
                        <h3 class="text-2xl lg:text-3xl text-[#2A4044] font-secondary mb-4">{{ $c['nombre'] }}</h3>
                        <p class="text-gray-600 leading-relaxed mb-6">{{ $c['desc'] }}</p>
                        <ul class="grid grid-cols-2 gap-3" role="list">
                            @foreach($c['detalles'] as $detalle)
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#4b8b97] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $detalle }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         TIRA DE AMENIDADES — íconos en línea, no cards con hover
    ========================================================= --}}
    <section class="bg-white py-14 relative overflow-hidden" aria-labelledby="amenidades-cabanas">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 id="amenidades-cabanas" class="sr-only">Amenidades incluidas</h2>
            <div class="flex flex-wrap justify-center lg:justify-between gap-8 lg:gap-4 opacity-0 transition-all duration-700" data-animate>
                @php
                    $amenidades = [
                        ['icono' => 'M12 3v18M3 12h18', 'texto' => 'Wifi'],
                        ['icono' => 'M5 13l4 4L19 7', 'texto' => 'Ropa de cama incluida'],
                        ['icono' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'texto' => 'Estacionamiento privado'],
                        ['icono' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'texto' => 'A 5 min del salón'],
                        ['icono' => 'M13 10V3L4 14h7v7l9-11h-7z', 'texto' => 'Calefacción'],
                        ['icono' => 'M12 8v4l3 3', 'texto' => 'Check-in flexible'],
                    ];
                @endphp
                @foreach($amenidades as $a)
                <div class="flex flex-col items-center text-center w-24">
                    <div class="w-14 h-14 rounded-full border border-[#4b8b97]/40 flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#4b8b97]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['icono'] }}"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 leading-snug">{{ $a['texto'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         PAQUETES / TARIFAS — tabla de precios, sección nueva
    ========================================================= --}}
    <section class="bg-[#2A4044] py-16 lg:py-24 relative overflow-hidden" aria-labelledby="paquetes-cabanas">
        <div role="presentation" class="pointer-events-none select-none absolute -right-4 -top-4 w-48 lg:w-64 opacity-10 z-0" aria-hidden="true">
            <img src="{{ asset('images/flor-derecha.png') }}" alt="" class="w-full" loading="lazy">
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Tarifas de temporada</span>
                <h2 id="paquetes-cabanas" class="text-3xl sm:text-4xl lg:text-5xl text-white font-secondary mt-3">
                    Paquetes de Hospedaje
                </h2>
                <p class="text-gray-400 mt-3 text-sm">*Precios de referencia, sujetos a temporada y disponibilidad.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-white/10 opacity-0 transition-all duration-700" data-animate>
                @php
                    $paquetes = [
                        ['nombre' => 'Noche Sencilla', 'precio' => '$1,800', 'periodo' => '/ noche', 'items' => ['1 cabaña Manzanillo', 'Check-in 15:00 · Check-out 12:00', 'Sin desayuno']],
                        ['nombre' => 'Fin de Semana', 'precio' => '$3,200', 'periodo' => '/ 2 noches', 'items' => ['1 cabaña a elegir', 'Desayuno incluido', 'Acceso a áreas comunes'], 'destacado' => true],
                        ['nombre' => 'Grupo Completo', 'precio' => 'Cotización', 'periodo' => 'a medida', 'items' => ['Todas las cabañas', 'Ideal para bodas y retiros', 'Paquete personalizado']],
                    ];
                @endphp
                @foreach($paquetes as $p)
                <div class="bg-[#2A4044] {{ !empty($p['destacado']) ? 'ring-2 ring-[#4b8b97]' : '' }} p-8 flex flex-col">
                    @if(!empty($p['destacado']))
                    <span class="self-start bg-[#4b8b97] text-white text-[10px] tracking-widest uppercase px-3 py-1 mb-4">Más solicitado</span>
                    @endif
                    <h3 class="text-xl text-white font-secondary mb-2">{{ $p['nombre'] }}</h3>
                    <div class="mb-6">
                        <span class="text-3xl text-white font-secondary">{{ $p['precio'] }}</span>
                        <span class="text-gray-400 text-sm ml-1">{{ $p['periodo'] }}</span>
                    </div>
                    <ul class="space-y-3 mb-8 flex-1" role="list">
                        @foreach($p['items'] as $item)
                        <li class="flex items-start gap-2 text-sm text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#4b8b97] mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20el%20paquete%20{{ urlencode($p['nombre']) }}%20de%20cabañas."
                       target="_blank" rel="noopener noreferrer"
                       class="text-center border border-[#4b8b97] text-white hover:bg-[#4b8b97] text-sm tracking-widest uppercase px-4 py-3 transition-colors duration-300">
                        Cotizar
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         TESTIMONIOS — carrusel simple con Vanilla JS, sección nueva
    ========================================================= --}}
    <section class="bg-white py-16 lg:py-24 relative overflow-hidden" aria-labelledby="testimonios-cabanas" id="testimoniosSection">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl text-center">

            <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Lo que dicen nuestros huéspedes</span>
            <h2 id="testimonios-cabanas" class="text-3xl sm:text-4xl text-[#2A4044] font-secondary mt-3 mb-12">
                Experiencias Reales
            </h2>

            @php
                $testimonios = [
                    ['texto' => 'Nos quedamos la noche de la boda y fue el cierre perfecto: silencio, chimenea y un cielo lleno de estrellas.', 'autor' => 'Ana & Roberto'],
                    ['texto' => 'La cabaña Encino nos alcanzó perfecto para las 8 personas del grupo. Muy limpia y cómoda.', 'autor' => 'Grupo de amigas, CDMX'],
                    ['texto' => 'Ideal para el retiro de fin de semana: cerca del salón, pero con la tranquilidad del bosque.', 'autor' => 'Retiro de yoga Namaste'],
                ];
            @endphp

            <div class="relative min-h-[180px]">
                @foreach($testimonios as $i => $t)
                <div class="testimonio-slide {{ $i === 0 ? '' : 'hidden' }} opacity-0 transition-all duration-700" data-animate data-slide-index="{{ $i }}">
                    <p class="text-xl lg:text-2xl text-[#2A4044] font-secondary italic leading-relaxed mb-6">
                        "{{ $t['texto'] }}"
                    </p>
                    <span class="text-sm text-gray-400 tracking-widest uppercase">— {{ $t['autor'] }}</span>
                </div>
                @endforeach
            </div>

            <div class="flex justify-center gap-2 mt-8">
                @foreach($testimonios as $i => $t)
                <button type="button"
                        class="testimonio-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-[#4b8b97] w-8' : 'bg-gray-300 w-2' }}"
                        data-dot-index="{{ $i }}"
                        aria-label="Testimonio {{ $i + 1 }}"></button>
                @endforeach
            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         UBICACIÓN — se conserva la información de contacto/mapa
         (mismo dato en todo el sitio), pero con layout invertido
    ========================================================= --}}
    <section class="bg-[#f9f7f4] py-12 lg:py-18 relative overflow-hidden" aria-labelledby="ubicacion-cabanas">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 shadow-xl overflow-hidden opacity-0 transition-all duration-700" data-animate>

                {{-- Panel izquierdo — mapa --}}
                <div class="lg:col-span-3 relative min-h-[300px] lg:min-h-0 order-2 lg:order-1">
                    <iframe
                        title="Ubicación de Finca Isabela — Cabañas en Lerma, Estado de México"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.931419352331!2d-99.4488789247872!3d19.3721219818944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2096484d12aa5%3A0x7b9e227912bcfd33!2sSAL%C3%93N%20FINCA%20ISABELA!5e0!3m2!1ses!2smx!4v1783553396225!5m2!1ses!2smx"
                        class="absolute inset-0 w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        aria-label="Mapa de ubicación de Finca Isabela en Lerma, Estado de México">
                    </iframe>
                </div>

                {{-- Panel derecho — datos --}}
                <div class="lg:col-span-2 bg-white p-10 flex flex-col justify-center order-1 lg:order-2">
                    <span class="text-[#4b8b97] text-xs tracking-widest uppercase mb-2">Cómo llegar</span>
                    <h2 id="ubicacion-cabanas" class="text-2xl lg:text-3xl text-[#2A4044] font-secondary mb-6">
                        Finca Isabela, Lerma
                    </h2>
                    <ul class="space-y-4 mb-6" role="list">
                        <li class="flex items-start gap-3 text-gray-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97] mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Reforma Primera Secc. 4-MZ 014, 52054 San Francisco Xochicuautla, Méx.
                        </li>
                        <li class="flex items-center gap-3 text-gray-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:+527293738830" class="hover:text-[#4b8b97] transition-colors">729 373 8830</a>
                        </li>
                    </ul>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="https://maps.app.goo.gl/Agp91E7iuNEcZYoq5" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 bg-[#2A4044] hover:bg-[#4b8b97] text-white text-xs tracking-widest uppercase px-5 py-3 transition-colors duration-300">
                            Cómo llegar
                        </a>
                        <a href="{{ url('finca-isabela') }}"
                           class="inline-flex items-center justify-center gap-2 border border-[#2A4044]/30 text-[#2A4044] hover:bg-[#2A4044] hover:text-white text-xs tracking-widest uppercase px-5 py-3 transition-colors duration-300">
                            Conocer Finca Isabela
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================================
         CTA FINAL — franja simple, abre el mismo modal de contacto
    ========================================================= --}}
    <section class="bg-white py-16 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center opacity-0 transition-all duration-700" data-animate>
            <h2 class="text-2xl lg:text-3xl text-[#2A4044] font-secondary mb-4">¿Lista tu próxima estancia?</h2>
            <p class="text-gray-500 max-w-xl mx-auto mb-8 text-sm leading-relaxed">
                Cupo limitado por temporada. Escríbenos y te ayudamos a elegir la cabaña ideal para tu grupo.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20hospedarme%20en%20las%20cabañas.%20¿Podrían%20brindarme%20información%20sobre%20disponibilidad,%20paquetes%20y%20precios?"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 bg-[#4b8b97] hover:bg-[#2A4044] text-white text-sm tracking-widest uppercase px-8 py-4 transition-colors duration-300">
                    WhatsApp
                </a>
                <button type="button" id="openContactModal"
                        class="inline-flex items-center justify-center gap-2 border border-[#2A4044]/30 hover:bg-[#2A4044] hover:text-white text-[#2A4044] text-sm tracking-widest uppercase px-8 py-4 transition-colors duration-300">
                    Formulario de Contacto
                </button>
            </div>
        </div>
    </section>

    {{-- MODAL CONTACTO — se conserva igual al de temazcal --}}
    <div id="contactModal"
        class="fixed inset-0 z-50 hidden items-center justify-center"
        role="dialog" aria-modal="true" aria-labelledby="contactModalTitle"
        aria-describedby="contactModalDescription" aria-hidden="true" tabindex="-1">

        <div id="modalBackdrop"
            class="absolute inset-0 bg-[#0d1f22]/75 backdrop-blur-sm
                    transition-opacity duration-300 opacity-0 cursor-pointer">
        </div>

        <div id="modalPanel"
            class="relative z-10 overflow-hidden
                    transition-all duration-300 ease-out
                    opacity-0 translate-y-6 scale-95
                    w-[90vw] max-w-2xl bg-white rounded-lg focus:outline-none"
            tabindex="-1">

            <div class="flex items-center justify-between px-6 pt-2">
                <div>
                    <h2 id="contactModalTitle" class="text-2xl text-[#2A4044] font-secondary leading-none">
                        Conecta con Nosotros
                    </h2>
                </div>
                <button type="button" id="closeContactModal" aria-label="Cerrar"
                        class="w-9 h-9 flex items-center justify-center border border-white/30
                            text-[#2A4044] hover:border-[#4b8b97] hover:text-[#4b8b97]
                            transition-colors duration-200 flex-shrink-0 ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <p id="contactModalDescription" class="px-6 text-sm text-[#4b8b97] mb-4">
                Envía tu consulta y recibe una respuesta rápida para reservar tu cabaña.
            </p>

            <div class="relative overflow-hidden" style="height: 460px;">
                <div style="
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) scale(0.62);
                    transform-origin: center center;
                    width: 700px;
                    pointer-events: auto;
                ">
                    @include('frontend.partials.contactForm')
                </div>
            </div>

            <div class="h-px w-full bg-gradient-to-r from-transparent via-[#4b8b97]/30 to-transparent"></div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal    = document.getElementById('contactModal');
        var backdrop = document.getElementById('modalBackdrop');
        var panel    = document.getElementById('modalPanel');
        var openBtn  = document.getElementById('openContactModal');
        var closeBtn = document.getElementById('closeContactModal');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');

            requestAnimationFrame(function () {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                panel.classList.remove('opacity-0', 'translate-y-6', 'scale-95');
                panel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            });

            if (closeBtn) {
                closeBtn.focus();
            } else if (panel) {
                panel.focus();
            }
        }

        function closeModal() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            panel.classList.add('opacity-0', 'translate-y-6', 'scale-95');
            document.body.classList.remove('overflow-hidden');
            modal.setAttribute('aria-hidden', 'true');

            setTimeout(function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        if (openBtn)  openBtn.addEventListener('click', openModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (backdrop) backdrop.addEventListener('click', closeModal);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });

        // --- Tabs de cabañas (Vanilla JS) ---
        var tabsSection = document.getElementById('cabanaTabsSection');
        if (tabsSection) {
            var tabBtns   = tabsSection.querySelectorAll('.cabana-tab-btn');
            var tabPanels = tabsSection.querySelectorAll('.cabana-tab-panel');

            var activeClasses   = ['bg-[#2A4044]', 'text-white'];
            var inactiveClasses = ['bg-white', 'text-[#2A4044]', 'border', 'border-[#2A4044]/20'];

            tabBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var index = btn.getAttribute('data-tab-index');

                    tabBtns.forEach(function (b) {
                        b.classList.remove.apply(b.classList, activeClasses);
                        b.classList.add.apply(b.classList, inactiveClasses);
                    });
                    btn.classList.remove.apply(btn.classList, inactiveClasses);
                    btn.classList.add.apply(btn.classList, activeClasses);

                    tabPanels.forEach(function (panel) {
                        if (panel.getAttribute('data-tab-panel') === index) {
                            panel.classList.remove('hidden');
                        } else {
                            panel.classList.add('hidden');
                        }
                    });
                });
            });
        }

        // --- Carrusel de testimonios (Vanilla JS) ---
        var testimoniosSection = document.getElementById('testimoniosSection');
        if (testimoniosSection) {
            var slides = testimoniosSection.querySelectorAll('.testimonio-slide');
            var dots   = testimoniosSection.querySelectorAll('.testimonio-dot');

            function goToSlide(index) {
                slides.forEach(function (slide) {
                    slide.classList.toggle('hidden', slide.getAttribute('data-slide-index') !== index);
                });
                dots.forEach(function (dot) {
                    var isActive = dot.getAttribute('data-dot-index') === index;
                    dot.classList.toggle('bg-[#4b8b97]', isActive);
                    dot.classList.toggle('w-8', isActive);
                    dot.classList.toggle('bg-gray-300', !isActive);
                    dot.classList.toggle('w-2', !isActive);
                });
            }

            dots.forEach(function (dot) {
                dot.addEventListener('click', function () {
                    goToSlide(dot.getAttribute('data-dot-index'));
                });
            });

            // Autoplay opcional, cambia de testimonio cada 6s
            var currentSlide = 0;
            setInterval(function () {
                currentSlide = (currentSlide + 1) % slides.length;
                goToSlide(String(currentSlide));
            }, 6000);
        }

        // --- Revelado de imágenes al hacer scroll (data-bg-reveal) ---
        var revealImages = document.querySelectorAll('[data-bg-reveal]');
        if (revealImages.length) {
            var revealObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
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

            revealImages.forEach(function (img) {
                revealObserver.observe(img);
            });
        }
    });
    </script>

</main>
@endsection