@extends('frontend.layouts.main')

@section('title', 'Temazcal - Eventos Especiales Lerma')
@section('description', 'Descubre la experiencia única del temazcal en Eventos Especiales Lerma. Un ritual ancestral para la purificación y renovación espiritual. Ideal para eventos especiales y retiros de bienestar.')
@section('keywords', 'temazcal, eventos especiales, bienestar, ritual ancestral, purificación, renovación espiritual, eventos Lerma, retiros de bienestar')
@section('canonical', 'https://eventosespecialeslerma.com/temazcal')
@section('alternate', 'https://eventosespecialeslerma.com/temazcal')

@section('ogtitle', 'Temazcal - Eventos Especiales Lerma')
@section('ogdescription', 'Descubre la experiencia única del temazcal en Eventos Especiales Lerma. Un ritual ancestral para la purificación y renovación espiritual. Ideal para eventos especiales y retiros de bienestar.')
@section('ogurl', 'https://eventosespecialeslerma.com/temazcal')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('images/logo-white.png'))

@section('twittertitle', 'Temazcal - Eventos Especiales Lerma')
@section('twitterdescription', 'Descubre la experiencia única del temazcal en Eventos Especiales Lerma. Un ritual ancestral para la purificación y renovación espiritual. Ideal para eventos especiales y retiros de bienestar.')
@section('twitterimage', asset('images/logo-white.png'))

@section('content')
<main>

    {{-- ========================================================
         HERO — Título principal
    ========================================================= --}}
    <section class="bg-white relative overflow-hidden" aria-labelledby="temazcal-titulo">

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
                        Ancestral Ritual de Purificación
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="temazcal-titulo" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Temazcal
                </h1>
            </article>
        </div>

        @include('frontend.partials.divider')
    </section>

    {{-- ¿QUÉ ES EL TEMAZCAL? --}}
    <section class="bg-white py-12 lg:py-24 relative overflow-hidden" aria-labelledby="que-es-temazcal">

        {{-- Hojas decorativas --}}
        <div role="presentation" class="pointer-events-none select-none absolute left-0 top-0 w-32 lg:w-48 opacity-20 z-0" aria-hidden="true">
            <img src="{{ asset('images/hoja-izquierda.svg') }}" alt="" class="w-full" loading="lazy">
        </div>
        <div role="presentation" class="pointer-events-none select-none absolute right-0 bottom-0 w-32 lg:w-48 opacity-20 z-0" aria-hidden="true">
            <img src="{{ asset('images/hoja-derecha.svg') }}" alt="" class="w-full" loading="lazy">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

                {{-- Imagen --}}
                <div class="opacity-0 transition-all duration-700" data-animate>
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-full h-full border-2 border-[#4b8b97] opacity-30 rounded-sm"></div>
                        <img src="{{ asset('images/temazcal-ritual.jpg') }}"
                             alt="Ritual de temazcal ancestral"
                             class="w-full h-80 lg:h-[500px] object-cover relative z-10 shadow-xl"
                             loading="lazy" decoding="async">
                    </div>
                </div>

                {{-- Texto --}}
                <div class="opacity-0 transition-all duration-700" data-animate>
                    <div class="flex items-center mb-6" aria-hidden="true">
                        <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                        <svg width="16" height="16" viewBox="0 0 20 20">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                        </svg>
                        <span class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 ml-3">Origen Ancestral</span>
                    </div>

                    <h2 id="que-es-temazcal" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mb-6 leading-tight">
                        ¿Qué es el Temazcal?
                    </h2>

                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        El <strong class="text-[#2A4044]">temazcal</strong> es un baño de vapor ceremonial con raíces profundas en las culturas mesoamericanas. Su nombre proviene del náhuatl <em>temazcalli</em>: «casa de vapor». Durante siglos fue utilizado por pueblos indígenas como espacio de sanación física, purificación espiritual y renacimiento.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        En Eventos Especiales Lerma lo ofrecemos como una vivencia auténtica, guiada por facilitadores con formación en la tradición, para que cada participante pueda conectar con lo esencial: el calor de la tierra, el vapor del agua y el silencio interior.
                    </p>

                    <a href="https://wa.me/527293738830?text=Hola,%20me%20gustaría%20vivir%20la%20experiencia%20del%20temazcal.%20Quiero%20conocer%20disponibilidad,%20precios%20e%20información%20sobre%20este%20ritual%20sagrado."
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 bg-[#2A4044] hover:bg-[#4b8b97] text-white text-sm tracking-widest uppercase px-8 py-4 transition-colors duration-300">
                        Reservar Experiencia
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
            @include('frontend.partials.divider')
    </section>


    {{-- BENEFICIOS  --}}
    <section class="bg-[#f9f7f4] py-12 lg:py-18 relative overflow-hidden" aria-labelledby="beneficios-temazcal">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <div class="flex items-center justify-center mb-4" aria-hidden="true">
                    <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest mx-0 sm:mx-4 uppercase ml-3">Bienestar Integral</span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-16 border-t border-[#4b8b97] ml-3"></span>
                </div>
                <h2 id="beneficios-temazcal" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary">
                    Beneficios de la Experiencia
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1">

                @php
                    $beneficios = [
                        [
                            'imagen'  => asset('images/temazcal-purificacion.jpg'),
                            'titulo'  => 'Purificación Espiritual',
                            'tag'     => 'Alma',
                            'desc'    => 'El calor y los vapores de plantas medicinales liberan tensiones acumuladas y favorecen un estado profundo de calma interior.',
                        ],
                        [
                            'imagen'  => asset('images/temazcal-desintoxicacion.jpg'),
                            'titulo'  => 'Desintoxicación Natural',
                            'tag'     => 'Cuerpo',
                            'desc'    => 'La sudoración intensa ayuda al organismo a eliminar toxinas, mejorando la circulación y la vitalidad general.',
                        ],
                        [
                            'imagen'  => asset('images/temazcal-comunidad.jpg'),
                            'titulo'  => 'Conexión en Grupo',
                            'tag'     => 'Comunidad',
                            'desc'    => 'Compartir el ritual en comunidad fortalece vínculos, fomenta la empatía y crea memorias colectivas únicas.',
                        ],
                        [
                            'imagen'  => asset('images/temazcal-naturaleza.jpg'),
                            'titulo'  => 'Reconexión con la Naturaleza',
                            'tag'     => 'Tierra',
                            'desc'    => 'El fuego, el agua, la tierra y el aire como elementos centrales devuelven al participante su lugar en el ciclo natural.',
                        ],
                        [
                            'imagen'  => asset('images/temazcal-relajacion.jpg'),
                            'titulo'  => 'Relajación Profunda',
                            'tag'     => 'Mente',
                            'desc'    => 'Los cantos, la oscuridad y el vapor inducen un estado meditativo que reduce el estrés y restablece el equilibrio emocional.',
                        ],
                        [
                            'imagen'  => asset('images/temazcal-memorable.jpg'),
                            'titulo'  => 'Experiencia Memorable',
                            'tag'     => 'Celebración',
                            'desc'    => 'Ideal para integrar en retiros, bodas, despedidas de soltera o cualquier evento especial que busque trascendencia.',
                        ],
                    ];
                @endphp

                @foreach($beneficios as $beneficio)
                <article class="relative h-80 lg:h-96 overflow-hidden group cursor-default opacity-0 transition-all duration-700" data-animate>

                    {{-- Imagen de fondo --}}
                    <img src="{{ $beneficio['imagen'] }}"
                        alt="{{ $beneficio['titulo'] }}"
                        class="absolute inset-0 w-full h-full object-cover scale-105 group-hover:scale-110 transition-transform duration-700 ease-out"
                        loading="lazy" decoding="async">

                    {{-- Gradiente base — siempre visible desde abajo --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0d1f22]/90 via-[#0d1f22]/40 to-transparent transition-all duration-500"></div>

                    {{-- Gradiente hover — oscurece todo el card al pasar --}}
                    <div class="absolute inset-0 bg-[#2A4044]/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Contenido --}}
                    <div class="absolute inset-0 flex flex-col justify-end p-7 z-10">

                        {{-- Tag elegante --}}
                        <span class="inline-block self-start text-[10px] tracking-[0.2em] uppercase text-[#4b8b97] border border-[#4b8b97]/60 px-3 py-1 mb-3 bg-black/20 backdrop-blur-sm
                                    translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-75">
                            {{ $beneficio['tag'] }}
                        </span>

                        <h3 class="text-xl lg:text-2xl text-white font-secondary leading-tight mb-0
                                group-hover:mb-3 transition-all duration-500">
                            {{ $beneficio['titulo'] }}
                        </h3>

                        {{-- Descripción oculta — aparece en hover deslizándose --}}
                        <p class="text-gray-300 text-sm leading-relaxed
                                max-h-0 overflow-hidden opacity-0
                                group-hover:max-h-24 group-hover:opacity-100
                                transition-all duration-500 delay-100">
                            {{ $beneficio['desc'] }}
                        </p>

                        {{-- Línea decorativa inferior --}}
                        <div class="mt-4 w-0 group-hover:w-12 border-t border-[#4b8b97] transition-all duration-500 delay-150"></div>
                    </div>
                </article>
                @endforeach

            </div>
        </div>
            @include('frontend.partials.divider')
    </section>

    {{--CÓMO FUNCIONA — Pasos del ritual --}}
    <section class="bg-white py-16 lg:py-24 relative overflow-hidden" aria-labelledby="como-funciona">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <div class="flex items-center justify-center mb-4" aria-hidden="true">
                    <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest mx-0 sm:mx-4 uppercase ml-3">El Proceso</span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-16 border-t border-[#4b8b97] ml-3"></span>
                </div>
                <h2 id="como-funciona" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary">
                    ¿Cómo Vivir el Ritual?
                </h2>
            </div>

            <div class="relative">
                {{-- Línea conectora (solo desktop) --}}
                <div class="hidden lg:block absolute top-10 left-0 right-0 h-px bg-[#4b8b97]/20 z-0" aria-hidden="true"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 relative z-10">
                    @php
                        $pasos = [
                            ['num' => '01', 'titulo' => 'Bienvenida y Preparación', 'desc' => 'El facilitador explica la historia del ritual y las intenciones del círculo. Se realiza una limpia energética con copal y plantas aromáticas.'],
                            ['num' => '02', 'titulo' => 'Entrada a la Oscuridad', 'desc' => 'Los participantes ingresan al domo de manera ceremonial. La oscuridad y el calor comienzan a invitar al silencio interior.'],
                            ['num' => '03', 'titulo' => 'Las Cuatro Puertas', 'desc' => 'El ritual se divide en cuatro rondas o «puertas», cada una con intenciones distintas: tierra, agua, fuego y aire.'],
                            ['num' => '04', 'titulo' => 'Renacimiento y Cierre', 'desc' => 'Al salir del temazcal, se comparte un momento de reflexión, hidratación y gratitud para integrar la experiencia.'],
                        ];
                    @endphp

                    @foreach($pasos as $paso)
                    <article class="text-center opacity-0 transition-all duration-700" data-animate>
                        <div class="w-20 h-20 rounded-full bg-[#2A4044] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-secondary shadow-lg">
                            {{ $paso['num'] }}
                        </div>
                        <h3 class="text-xl text-[#2A4044] font-script mb-3">{{ $paso['titulo'] }}</h3>
                        <p class="text-gray-500 leading-relaxed text-sm px-2">{{ $paso['desc'] }}</p>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ========================================================
         IDEAL PARA — Tipos de evento
    ========================================================= --}}
    <section class="bg-[#2A4044] py-16 lg:py-24 relative overflow-hidden" aria-labelledby="ideal-para">

        {{-- Flores decorativas en color claro --}}
        <div role="presentation" class="pointer-events-none select-none absolute -left-4 -bottom-4 w-48 lg:w-64 opacity-10 z-0" aria-hidden="true">
            <img src="{{ asset('images/flor-izquierda.png') }}" alt="" class="w-full" loading="lazy">
        </div>
        <div role="presentation" class="pointer-events-none select-none absolute -right-4 -top-4 w-48 lg:w-64 opacity-10 z-0" aria-hidden="true">
            <img src="{{ asset('images/flor-derecha.png') }}" alt="" class="w-full" loading="lazy">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <div class="flex items-center justify-center mb-4" aria-hidden="true">
                  <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="text-base sm:text-lg md:text-xl text-gray-50 tracking-widest mx-0 sm:mx-4 uppercase ml-3">Para Toda Ocasión</span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-16 border-t border-[#4b8b97] ml-3"></span>
                </div>
                <h2 id="ideal-para" class="text-3xl sm:text-4xl lg:text-5xl text-white font-secondary">
                    Ideal para tu Evento Especial
                </h2>
                <p class="text-gray-300 mt-4 max-w-2xl mx-auto text-lg">
                    El temazcal se adapta a distintas celebraciones, añadiendo una dimensión espiritual y memorable a cualquier ocasión.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $ocasiones = [
                        ['emoji' => '💒', 'titulo' => 'Bodas & Pre-bodas',         'desc' => 'Una vivencia única para la pareja y sus invitados, cargada de simbolismo y unión.'],
                        ['emoji' => '✨', 'titulo' => 'Despedidas de Soltera/o',   'desc' => 'Celebra el inicio de una nueva etapa con una ceremonia de purificación y alegría colectiva.'],
                        ['emoji' => '🌿', 'titulo' => 'Retiros de Bienestar',      'desc' => 'Integra el temazcal en programas de yoga, meditación o retiros espirituales.'],
                        ['emoji' => '🎂', 'titulo' => 'Cumpleaños Especiales',     'desc' => 'Una celebración diferente que conecta a las personas de manera profunda y auténtica.'],
                        ['emoji' => '🤝', 'titulo' => 'Eventos Corporativos',      'desc' => 'Team building con propósito: fortalece equipos a través de una experiencia compartida única.'],
                        ['emoji' => '🌸', 'titulo' => 'Ceremonias Familiares',     'desc' => 'Bautizos, aniversarios o reuniones donde el ritual actúa como eje de unión familiar.'],
                    ];
                @endphp

                @foreach($ocasiones as $ocasion)
                <article class="border border-white/10 p-7 hover:bg-white/5 transition-colors duration-300 opacity-0 transition-all duration-700" data-animate>
                    <span class="text-4xl mb-4 block" aria-hidden="true">{{ $ocasion['emoji'] }}</span>
                    <h3 class="text-xl text-white font-script mb-2">{{ $ocasion['titulo'] }}</h3>
                    <p class="text-gray-400 leading-relaxed text-sm">{{ $ocasion['desc'] }}</p>
                </article>
                @endforeach
            </div>

        </div>
    </section>

    @include('frontend.partials.divider')

    {{-- UBICACIÓN --}}
    <section class="bg-white py-12 lg:py-18 relative overflow-hidden" aria-labelledby="ubicacion-temazcal">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <div class="flex items-center justify-center mb-4" aria-hidden="true">
                    <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest mx-0 sm:mx-4 uppercase ml-3">¿Dónde encontrarnos?</span>
                    <svg width="16" height="16" viewBox="0 0 20 20">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-16 border-t border-[#4b8b97] ml-3"></span>
                </div>
                <h2 id="ubicacion-temazcal" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary">
                    Ubicación
                </h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto text-base leading-relaxed">
                    El temazcal forma parte de las amenidades de <strong class="text-[#2A4044] font-script">Finca Isabela</strong>, nuestro espacio principal para eventos especiales en Lerma, Estado de México.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 shadow-xl overflow-hidden opacity-0 transition-all duration-700" data-animate>

                {{-- Panel izquierdo — Datos y vínculo a Finca Isabela --}}
                <div class="lg:col-span-2 bg-[#2A4044] p-10 flex flex-col justify-between">

                    <div>
                        {{-- Encabezado Finca Isabela --}}
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 bg-[#4b8b97]/20 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[#4b8b97] text-xs tracking-widest uppercase">Amenidad de</p>
                                <h3 class="text-white text-xl font-secondary">Finca Isabela</h3>
                            </div>
                        </div>

                        {{-- Datos de contacto / dirección --}}
                        <ul class="space-y-5 mb-8" role="list">
                            <li class="flex items-start gap-4 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97] mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm leading-relaxed">Reforma Primera Secc. 4-MZ 014, 52054 San Francisco Xochicuautla, Méx.</span>
                            </li>
                            <li class="flex items-center gap-4 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <a href="tel:+527293738830" class="text-sm hover:text-[#4b8b97] transition-colors">729 373 8830</a>
                            </li>
                            <li class="flex items-center gap-4 text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#4b8b97] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <a href="mailto:salonfincaisabela@eventosespecialeslerma.com" class="text-sm hover:text-[#4b8b97] transition-colors">salonfincaisabela@eventosespecialeslerma.com</a>
                            </li>
                        </ul>

                        {{-- Separador --}}
                        <div class="border-t border-white/10 my-6"></div>

                        {{-- Descripción del vínculo --}}
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">
                            El temazcal es solo una de las experiencias que puedes disfrutar en Finca Isabela. Descubre todos nuestros espacios, salones y amenidades diseñadas para hacer de tu evento algo verdaderamente especial.
                        </p>
                    </div>

                    {{-- Botón a Finca Isabela --}}
                    <a href="{{ url('finca-isabela') }}"
                    class="inline-flex items-center justify-center gap-3 w-full border border-[#4b8b97] text-gray-50 hover:bg-[#4b8b97] hover:text-white text-sm tracking-widest uppercase px-6 py-4 transition-all duration-300 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Conocer Finca Isabela
                    </a>
                </div>

                {{-- Panel derecho — Google Maps embed --}}
                <div class="lg:col-span-3 relative min-h-[350px] lg:min-h-0">
                    <iframe
                        title="Ubicación de Finca Isabela — Temazcal en Lerma, Estado de México"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.931419352331!2d-99.4488789247872!3d19.3721219818944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2096484d12aa5%3A0x7b9e227912bcfd33!2sSAL%C3%93N%20FINCA%20ISABELA!5e0!3m2!1ses!2smx!4v1783553396225!5m2!1ses!2smx"
                        class="absolute inset-0 w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        aria-label="Mapa de ubicación de Finca Isabela en Lerma, Estado de México">
                    </iframe>

                    {{-- Botón "Cómo llegar" sobre el mapa --}}
                    <a href="https://maps.app.goo.gl/Agp91E7iuNEcZYoq5"
                    target="_blank" rel="noopener noreferrer"
                    class="absolute bottom-4 right-4 z-10 inline-flex items-center gap-2 bg-white text-[#2A4044] hover:bg-[#2A4044] hover:text-white text-xs tracking-widest uppercase px-4 py-3 shadow-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Cómo llegar
                    </a>
                </div>

            </div>
        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- RECOMENDACIONES — Qué llevar / qué esperar --}}
    <section class="bg-white py-12 lg:py-18 relative overflow-hidden" aria-labelledby="recomendaciones">

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

                {{-- Lista de recomendaciones --}}
                <div class="opacity-0 transition-all duration-700" data-animate>
                    <div class="flex items-center mb-6" aria-hidden="true">
                        <span class="w-16 border-t border-[#4b8b97] mr-3"></span>
                        <svg width="16" height="16" viewBox="0 0 20 20">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"></polygon>
                        </svg>
                        <span class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 ml-3">Prepárate</span>
                    </div>
                    <h2 id="recomendaciones" class="text-3xl sm:text-4xl text-[#2A4044] font-secondary mb-8">
                        Recomendaciones para tu Visita
                    </h2>
                    <ul class="space-y-4" role="list">
                        @php
                            $recomendaciones = [
                                'Llega con ropa cómoda y holgada; se proporciona manta ceremonial.',
                                'Ayuna al menos 2 horas antes de la ceremonia.',
                                'Hidratación: bebe suficiente agua antes y después del ritual.',
                                'Retira joyería, lentes y cualquier accesorio metálico.',
                                'Informa al facilitador si tienes condiciones médicas previas.',
                                'Llega con apertura y disposición; el silencio interior es parte del proceso.',
                                'Se recomienda no consumir alcohol ni sustancias el día previo.',
                            ];
                        @endphp
                        @foreach($recomendaciones as $rec)
                        <li class="flex items-start gap-4 text-gray-600">
                            <span class="mt-1 flex-shrink-0 w-5 h-5 rounded-full bg-[#4b8b97]/15 flex items-center justify-center" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-[#4b8b97]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </span>
                            {{ $rec }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Cita inspiracional + CTA --}}
                <div class="opacity-0 transition-all duration-700" data-animate>
                    <blockquote class="relative bg-[#f9f7f4] p-10 border-l-4 border-[#4b8b97] mb-10">
                        <svg class="absolute top-6 left-6 w-10 h-10 text-[#4b8b97]/20" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                            <path d="M10 8C5.6 8 2 11.6 2 16s3.6 8 8 8c1.6 0 3-.4 4.2-1.2-.6 3.2-3.4 5.6-6.8 6H6v2h1.4C12.4 30.4 16 26.6 16 22V16c0-4.4-2.4-8-6-8zm16 0c-4.4 0-8 3.6-8 8s3.6 8 8 8c1.6 0 3-.4 4.2-1.2-.6 3.2-3.4 5.6-6.8 6H22v2h1.4C28.4 30.4 32 26.6 32 22V16c0-4.4-2.4-8-6-8z"/>
                        </svg>
                        <p class="text-xl text-[#2A4044] font-secondary italic leading-relaxed pt-4">
                            "Entrar al temazcal es regresar al vientre de la Madre Tierra. Salir de él es nacer de nuevo."
                        </p>
                        <footer class="mt-4 text-sm text-gray-400 tracking-widest uppercase">— Tradición Náhuatl</footer>
                    </blockquote>

                    <div class="bg-[#2A4044] p-8 text-center">
                        <h3 class="text-2xl text-white font-secondary mb-3">¿Listo para la Experiencia?</h3>
                        <p class="text-gray-300 mb-6 text-sm leading-relaxed">
                            Contáctanos para conocer disponibilidad, paquetes y precios. Cupos limitados para garantizar una vivencia íntima y auténtica.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20vivir%20la%20experiencia%20del%20temazcal.%20¿Podrían%20brindarme%20información%20sobre%20disponibilidad,%20paquetes%20y%20precios?"
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 bg-[#4b8b97] hover:bg-white hover:text-[#2A4044] text-white text-sm tracking-widest uppercase px-6 py-3 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                WhatsApp
                            </a>
                            <button type="button"
                               id="openContactModal"
                               class="inline-flex items-center justify-center gap-2 border border-white/30 hover:bg-white hover:text-[#2A4044] text-white text-sm tracking-widest uppercase px-6 py-3 transition-colors duration-300">
                                Formulario de Contacto
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- MODAL CONTACTO — Lightbox con partial escalado --}}
    <div id="contactModal"
        class="fixed inset-0 z-50 hidden items-center justify-center"
        role="dialog" aria-modal="true">

        {{-- Backdrop --}}
        <div id="modalBackdrop"
            class="absolute inset-0 bg-[#0d1f22]/75 backdrop-blur-sm
                    transition-opacity duration-300 opacity-0 cursor-pointer">
        </div>

        {{-- Panel --}}
        <div id="modalPanel"
            class="relative z-10 overflow-hidden
                    transition-all duration-300 ease-out
                    opacity-0 translate-y-6 scale-95
                    w-[90vw] max-w-lg">

            {{-- Cabecera --}}
            <div class="flex items-center justify-between px-6 pt-2 pb-3">
                <div>
                    <p class="text-[10px] tracking-[0.2em] uppercase text-[#4b8b97] mb-0.5">
                    <h2 class="text-2xl text-white font-secondary leading-none">Contáctanos</h2>
                </div>
                <button type="button" id="closeContactModal" aria-label="Cerrar"
                        class="w-9 h-9 flex items-center justify-center border border-white/30
                            text-white hover:border-[#4b8b97] hover:text-[#4b8b97]
                            transition-colors duration-200 flex-shrink-0 ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Partial escalado --}}
            <div class="relative overflow-hidden" style="height: 420px;">
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

            {{-- Franja inferior --}}
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
            document.body.classList.add('overflow-hidden');
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('opacity-0', 'translate-y-6', 'scale-95');
                    panel.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                });
            });
        }

        function closeModal() {
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            panel.classList.add('opacity-0', 'translate-y-6', 'scale-95');
            document.body.classList.remove('overflow-hidden');
            setTimeout(function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }

        if (openBtn)  openBtn.addEventListener('click', openModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        if (backdrop) backdrop.addEventListener('click', closeModal);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    });
    </script>

</main>
@endsection