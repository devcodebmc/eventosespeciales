@extends('frontend.layouts.main')

@section('title', 'Vive Isabela - Eventos Especiales Lerma')
@section('description', 'Vive tu evento de principio a fin en un solo lugar: salón, hospedaje en cabañas y temazcal en Finca Isabela. Todo organizado por Eventos Especiales Lerma para que solo disfrutes.')
@section('keywords', 'experiencia completa, paquete evento, salón finca isabela, cabañas, temazcal, bodas, despedida solteros, retiro, todo incluido, Lerma, Estado de México')
@section('canonical', 'https://eventosespecialeslerma.com/experiencia')
@section('alternate', 'https://eventosespecialeslerma.com/experiencia')

@section('ogtitle', 'Vive Isabela - Eventos Especiales Lerma')
@section('ogdescription', 'Mucho más que un salón de eventos: celebra, hospédate y renueva energía en un mismo lugar. Vive Isabela con Eventos Especiales Lerma.')
@section('ogurl', 'https://eventosespecialeslerma.com/experiencia')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('images/logo-white.png'))

@section('twittertitle', 'Vive Isabela - Eventos Especiales Lerma')
@section('twitterdescription', 'Mucho más que un salón de eventos: celebra, hospédate y renueva energía en un mismo lugar.')
@section('twitterimage', asset('images/logo-white.png'))

@section('content')
<main>

    {{-- =============================================
         SECCIÓN: VIVE ISABELA — Hero emocional
    ============================================= --}}
    <section class="bg-white relative overflow-hidden" aria-labelledby="vive-isabela-titulo" id="vive-isabela">

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
                        Mucho más que un salón de eventos
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="vive-isabela-titulo" class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Vive Isabela
                </h1>
                <p class="mt-6 text-gray-500 max-w-2xl mx-auto text-base lg:text-lg leading-relaxed px-4">
                    Celebra, hospédate, relájate y crea recuerdos inolvidables en un mismo lugar.
                    Desde bodas y XV años hasta retiros, escapadas y fines de semana especiales.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 justify-center mt-10 px-4">
                    <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20agendar%20una%20visita%20a%20Finca%20Isabela."
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center gap-2 bg-[#2A4044] hover:bg-[#4b8b97] text-white text-sm tracking-widest uppercase px-8 py-4 transition-colors duration-300">
                        Reservar Visita
                    </a>
                    <button type="button" id="openContactModal"
                            class="inline-flex items-center justify-center gap-2 border border-[#2A4044]/30 hover:bg-[#2A4044] hover:text-white text-[#2A4044] text-sm tracking-widest uppercase px-8 py-4 transition-colors duration-300">
                        Cotizar Mi Evento
                    </button>
                </div>
            </article>
        </div>

    </section>

    {{-- NÚMEROS DE CONFIANZA --}}
    <section class="bg-[#2A4044] py-16 lg:py-24 relative overflow-hidden" aria-labelledby="promesa-titulo">

        <div role="presentation" class="pointer-events-none select-none absolute -right-4 -top-4 w-48 lg:w-72 opacity-10 z-0" aria-hidden="true">
            <img src="{{ asset('images/flor-derecha.png') }}" alt="" class="w-full" loading="lazy">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h2 id="numeros-titulo" class="sr-only">Números que respaldan a Finca Isabela</h2>

            @php
                $numeros = [
                    ['cifra' => '20+', 'etiqueta' => 'años creando eventos'],
                    ['cifra' => '300+', 'etiqueta' => 'invitados por evento'],
                    ['cifra' => '1000+', 'etiqueta' => 'montajes realizados'],
                    ['cifra' => '100%', 'etiqueta' => 'atención personalizada'],
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4 opacity-0 transition-all duration-700" data-animate>
                @foreach($numeros as $n)
                <div class="text-center">
                    <span class="counter-num block text-4xl sm:text-5xl lg:text-6xl text-white font-secondary" data-target="{{ $n['cifra'] }}">0</span>
                    <span class="text-xs text-[#4b8b97] tracking-widest uppercase mt-2 block">{{ $n['etiqueta'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        @include('frontend.partials.divider')
    </section>

    {{-- 5 MOMENTOS --}}
    <section class="bg-[#f9f7f4] py-8 lg:py-16 relative overflow-hidden" aria-labelledby="ciclo-titulo" id="cicloSection">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Cómo funciona</span>
                <h2 id="ciclo-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Vive Isabela en 5 Momentos
                </h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto text-sm leading-relaxed">
                    Un ciclo pensado para que la celebración fluya de manera natural, sin cortes, sin estrés y sin traslados.
                </p>
            </div>

            @php
                $momentos = [
                    [
                        'titulo'  => 'Planeamos contigo',
                        'icono'   => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'desc'    => 'Asesoría personalizada y coordinador asignado desde el primer contacto.',
                    ],
                    [
                        'titulo'  => 'Celebramos',
                        'icono'   => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                        'desc'    => 'Salón equipado, mobiliario completo y coordinación en sitio.',
                    ],
                    [
                        'titulo'  => 'Descansas',
                        'icono'   => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10',
                        'desc'    => 'Cabañas y habitaciones a pasos del salón para quien se quede.',
                    ],
                    [
                        'titulo'  => 'Compartes',
                        'icono'   => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z',
                        'desc'    => 'Desayuno grupal en la finca antes de que cada quien tome su rumbo.',
                    ],
                    [
                        'titulo'  => 'Renuevas energía',
                        'icono'   => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'desc'    => 'Temazcal de cierre: el sello que convierte un evento en un recuerdo.',
                    ],
                ];
            @endphp

            <div class="relative">
                {{-- Anillo de ciclo, visible solo en lg+, decorativo --}}
                <div class="hidden lg:block absolute inset-x-0 top-1/2 h-px bg-[#4b8b97]/20 -translate-y-1/2" aria-hidden="true"></div>

                <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-4" role="list">
                    @foreach($momentos as $i => $m)
                    <li class="relative flex flex-col items-center text-center opacity-0 transition-all duration-700" data-animate>
                        <div class="w-20 h-20 rounded-full bg-white border-2 border-[#4b8b97] flex items-center justify-center shadow-md relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#4b8b97]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $m['icono'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-base text-[#2A4044] font-secondary mt-5 mb-2">{{ $m['titulo'] }}</h3>
                        <p class="text-gray-500 text-xs leading-relaxed max-w-[180px]">{{ $m['desc'] }}</p>

                        @if(!$loop->last)
                        <svg class="hidden lg:block absolute top-9 -right-4 w-8 h-8 text-[#4b8b97]/40 z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        @else
                        {{-- Flecha de retorno que cierra el ciclo hacia el primer momento --}}
                        <svg class="hidden lg:block absolute top-9 -left-4 w-8 h-8 text-[#4b8b97]/25 rotate-[135deg] z-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                        @endif
                    </li>
                    @endforeach
                </ol>
            </div>

        </div>
    </section>

    {{-- ¿POR QUÉ ELEGIR FINCA ISABELA? + IDEAL PARA... --}}
    <section class="bg-white py-8 lg:py-16 relative overflow-hidden" aria-labelledby="porque-idealpara-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Nuestra diferencia</span>
                <h2 id="porque-idealpara-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    ¿Por qué elegir Finca Isabela?
                </h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto text-sm leading-relaxed">
                    Todo lo que necesitas para tu celebración: salón, jardín, hospedaje y temazcal, además de espacios ideales para bodas, XV años, eventos empresariales y más.
                </p>
            </div>

            @php
                $porque = [
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8.737 8.737a21.49 21.49 0 0 1 3.308-2.724m0 0c3.063-2.026 5.99-2.641 7.331-1.3 1.827 1.828.026 6.591-4.023 10.64-4.049 4.049-8.812 5.85-10.64 4.023-1.33-1.33-.736-4.218 1.249-7.253m6.083-6.11c-3.063-2.026-5.99-2.641-7.331-1.3-1.827 1.828-.026 6.591 4.023 10.64m3.308-9.34a21.497 21.497 0 0 1 3.308 2.724m2.775 3.386c1.985 3.035 2.579 5.923 1.248 7.253-1.336 1.337-4.245.732-7.295-1.275M14 12a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/></svg>',
                        'titulo' => 'Todo en un mismo lugar',
                        'desc' => 'Salón, jardín, hospedaje y temazcal conectados entre sí.'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg>',
                        'titulo' => 'Eventos únicos',
                        'desc' => 'Bodas, XV años, aniversarios y eventos empresariales.'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
                        'titulo' => 'Hospedaje',
                        'desc' => 'Cabañas totalmente equipadas a pasos del salón.'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M8.597 3.2A1 1 0 0 0 7.04 4.289a3.49 3.49 0 0 1 .057 1.795 3.448 3.448 0 0 1-.84 1.575.999.999 0 0 0-.077.094c-.596.817-3.96 5.6-.941 10.762l.03.049a7.73 7.73 0 0 0 2.917 2.602 7.617 7.617 0 0 0 3.772.829 8.06 8.06 0 0 0 3.986-.975 8.185 8.185 0 0 0 3.04-2.864c1.301-2.2 1.184-4.556.588-6.441-.583-1.848-1.68-3.414-2.607-4.102a1 1 0 0 0-1.594.757c-.067 1.431-.363 2.551-.794 3.431-.222-2.407-1.127-4.196-2.224-5.524-1.147-1.39-2.564-2.3-3.323-2.788a8.487 8.487 0 0 1-.432-.287Z"/></svg>',
                        'titulo' => 'Temazcal',
                        'desc' => 'Una experiencia de bienestar para cerrar tu celebración.'
                    ],
                ];

                $idealPara = [
                    [
                        'icono' => '<svg class="w-8 h-8 text-[#4b8b97] mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/></svg>',
                        'titulo' => 'Bodas'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97] mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C10.4 2.842 8.949 2 7.5 2A3.5 3.5 0 0 0 4 5.5c.003.52.123 1.033.351 1.5H4a2 2 0 0 0-2 2v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9a2 2 0 0 0-2-2Zm-9.942 0H7.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM13 14h-2v8h2v-8Zm-4 0H4v6a2 2 0 0 0 2 2h3v-8Zm6 0v8h3a2 2 0 0 0 2-2v-6h-5Z"/></svg>',
                        'titulo' => 'XV Años'
                    ],
                    [
                        'icono' => '<svg class="w-7 h-7 text-[#4b8b97] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
                        'titulo' => 'Empresas'
                    ],
                    [
                        'icono' => '<svg class="w-8 h-8 text-[#4b8b97] mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8.5 2c-.42794 0-.80845.2723-.94652.67736-.03443.10101-.07815.2268-.12882.3726-.1952.56172-.4936 1.42039-.76192 2.30283C6.33766 6.42192 6 7.69926 6 8.57072c0 .10149.00259.20301.00772.30444C6.00262 8.91606 6 8.95772 6 9c0 .10098.01497.19846.0428.29034C6.35415 11.9216 8.33422 14.4001 11 14.9062V20H9c-.55228 0-1 .4477-1 1s.44772 1 1 1h6c.5523 0 1-.4477 1-1s-.4477-1-1-1h-2v-5.0938c2.908-.552 5-3.4513 5-6.33548 0-.86275-.3278-2.12695-.6497-3.1952-.3348-1.11124-.7167-2.17674-.9075-2.70901l-.0015-.00395C16.2989 2.26514 15.9222 2 15.5 2h-7Zm-.44291 6h7.88661c-.088-.54205-.2729-1.26599-.5084-2.0475-.2149-.71327-.4515-1.41069-.6413-1.9525H9.21208c-.18553.53611-.41939 1.22278-.63584 1.93462C8.33663 6.72266 8.14708 7.4535 8.05709 8Z" clip-rule="evenodd"/></svg>',
                        'titulo' => 'Aniversarios'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97] mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 0 1-.5-17.986V3c-.354.966-.5 1.911-.5 3a9 9 0 0 0 9 9c.239 0 .254.018.488 0A9.004 9.004 0 0 1 12 21Z"/></svg>',
                        'titulo' => 'Retiros'
                    ],
                    [
                        'icono' => '<svg class="w-6 h-6 text-[#4b8b97] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path></svg>',
                        'titulo' => 'Cumpleaños'
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 opacity-0 transition-all duration-700" data-animate>
                @foreach($porque as $p)
                <div class="rounded-2xl bg-gray-100 p-8 text-center hover:shadow-lg transition-shadow duration-300">
                    <div class="flex justify-center mb-4">{!! $p['icono'] !!}</div>
                    <h3 class="text-lg text-[#2A4044] font-secondary mb-2">{{ $p['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $p['desc'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16 mb-10 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Para cada ocasión</span>
                <h3 class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Ideal Para...
                </h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 opacity-0 transition-all duration-700" data-animate>
                @foreach($idealPara as $ip)
                <div class="rounded-2xl border border-[#2A4044]/10 p-6 text-center hover:border-[#4b8b97] hover:shadow-md transition-all duration-300">
                    <div class="mb-3">{!! $ip['icono'] !!}</div>
                    <span class="text-sm text-[#2A4044] tracking-wide">{{ $ip['titulo'] }}</span>
                </div>
                @endforeach
            </div>

        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- ESCENARIOS --}}
    <section class="bg-white py-8 lg:py-16 relative overflow-hidden" aria-labelledby="escenarios-titulo" id="escenariosSection">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Casos reales</span>
                <h2 id="escenarios-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    ¿Cuál es tu Celebración?
                </h2>
                <p class="text-gray-500 mt-4 max-w-xl mx-auto text-sm leading-relaxed">
                    Selecciona el tipo de evento y conoce cómo armamos el ciclo completo para ti.
                </p>
            </div>

            @php
                $escenarios = [
                    [
                        'tipo'    => 'Despedida de Solteros',
                        'emoji'   => '🥂',
                        'resumen' => 'La noche épica que merece la situación, sin límite de tiempo ni de diversión.',
                        'ruta'    => [
                            'Salón privado con decoración temática y barra libre',
                            'Música hasta donde quieran — no hay vecinos molestos',
                            'Cabañas para quien decida quedarse a dormir',
                            'Desayuno grupal a la mañana siguiente',
                            'Temazcal de recuperación para cerrar el fin de semana',
                        ],
                    ],
                    [
                        'tipo'    => 'Boda',
                        'emoji'   => '💍',
                        'resumen' => 'El día más importante, sin correr al hotel ni coordinar traslados.',
                        'ruta'    => [
                            'Ceremonia y banquete en salón equipado con todo el mobiliario',
                            'Coordinación de proveedores: catering, música, foto/video',
                            'Habitaciones y cabañas para novios e invitados',
                            'Desayuno nupcial al día siguiente en la finca',
                            'Temazcal romántico para los novios como regalo de bodas',
                        ],
                    ],
                    [
                        'tipo'    => 'Retiro de Bienestar',
                        'emoji'   => '🌿',
                        'resumen' => 'Un fin de semana de reconexión para tu grupo, empresa o comunidad.',
                        'ruta'    => [
                            'Área de reunión con mobiliario para talleres o meditación',
                            'Alojamiento en cabañas con naturaleza al rededor',
                            'Desayunos y cenas saludables preparados en la finca',
                            'Sesión de temazcal como actividad central del retiro',
                            'Cierre grupal al aire libre antes de partir',
                        ],
                    ],
                    [
                        'tipo'    => 'XV Años',
                        'emoji'   => '✨',
                        'resumen' => 'La fiesta que todos recuerdan, organizada para que papá y mamá solo disfruten.',
                        'ruta'    => [
                            'Salón decorado con el tema elegido, pista de baile y vals',
                            'Coordinación de DJ, catering y protocolo incluidos',
                            'Cabañas para familia que viaja desde otro estado',
                            'Desayuno familiar al día siguiente dentro de la finca',
                            'Temazcal opcional para el grupo de adultos',
                        ],
                    ],
                ];
            @endphp

            <div class="flex flex-wrap justify-center gap-3 mb-10 opacity-0 transition-all duration-700" data-animate>
                @foreach($escenarios as $i => $e)
                <button type="button"
                        class="escenario-tab-btn px-5 py-3 text-sm tracking-widest uppercase transition-colors duration-300 {{ $i === 0 ? 'bg-[#2A4044] text-white' : 'bg-[#f9f7f4] text-[#2A4044] border border-[#2A4044]/20' }}"
                        data-escenario="{{ $i }}">
                    <span class="mr-2">{{ $e['emoji'] }}</span>{{ $e['tipo'] }}
                </button>
                @endforeach
            </div>

            @foreach($escenarios as $i => $e)
            <div class="escenario-panel {{ $i === 0 ? '' : 'hidden' }}" data-escenario-panel="{{ $i }}">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 shadow-lg overflow-hidden rounded-2xl">

                    <div class="lg:col-span-1 bg-[#2A4044] p-8 flex flex-col items-center justify-center text-center">
                        <span class="text-5xl mb-4 block" aria-hidden="true">{{ $e['emoji'] }}</span>
                        <h3 class="text-white font-secondary text-xl leading-tight">{{ $e['tipo'] }}</h3>
                        <p class="text-gray-400 text-xs mt-3 leading-relaxed">{{ $e['resumen'] }}</p>
                    </div>

                    <div class="lg:col-span-4 bg-white p-8 lg:p-12">
                        <p class="text-xs text-[#4b8b97] tracking-[0.3em] uppercase mb-6">Tu ruta completa</p>
                        <ol class="space-y-4" role="list">
                            @foreach($e['ruta'] as $paso => $item)
                            <li class="flex items-start gap-4">
                                <span class="flex-shrink-0 w-7 h-7 rounded-full bg-[#4b8b97]/15 text-[#4b8b97] text-xs font-secondary flex items-center justify-center mt-0.5">
                                    {{ $paso + 1 }}
                                </span>
                                <span class="text-gray-600 text-sm leading-relaxed pt-1">{{ $item }}</span>
                            </li>
                            @endforeach
                        </ol>
                        <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20el%20paquete%20de%20{{ urlencode($e['tipo']) }}%20con%20experiencia%20completa%20en%20Finca%20Isabela."
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 mt-8 border border-[#2A4044] text-[#2A4044] hover:bg-[#2A4044] hover:text-white text-xs tracking-widest uppercase px-6 py-3 transition-colors duration-300">
                            Cotizar este paquete
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>

    </section>

    {{-- =============================================
         TODO ESTÁ PENSADO PARA TI (antes "Lo que incluye")
    ============================================= --}}
    <section class="bg-[#f9f7f4] py-8 lg:py-16 relative overflow-hidden" aria-labelledby="servicios-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Todo en un solo lugar</span>
                <h2 id="servicios-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Todo Está Pensado Para Ti
                </h2>
            </div>

            @php
                $servicios = [
                    [
                        'titulo' => 'Salón de Eventos',
                        'imagen' => 'servicio-salon.jpg',
                        'items'  => ['Capacidad hasta 300 personas', 'Mobiliario completo incluido', 'Sistema de iluminación', 'Estacionamiento privado'],
                        'link'   => url('finca-isabela'),
                        'label'  => 'Conocer más'
                    ],
                    [
                        'titulo' => 'Hospedaje',
                        'imagen' => 'servicio-cabanas.jpg',
                        'items'  => ['Cabaña Manzanillo (2 personas)', 'Cabaña Ocotillo (4 personas)', 'Cabaña Encino (8 personas)', 'Habitaciones dobles disponibles'],
                        'link'   => url('cabanas'),
                        'label'  => 'Conocer más'
                    ],
                    [
                        'titulo' => 'Temazcal',
                        'imagen' => 'servicio-temazcal.jpg',
                        'items'  => ['Ceremonia guiada por especialista', 'Plantas medicinales tradicionales', 'Grupos de 4 a 20 personas', 'Espacio de relajación post-sesión'],
                        'link'   => url('temazcal'),
                        'label'  => 'Conocer más'
                    ],
                    [
                        'titulo' => 'Organización Integral',
                        'imagen' => 'servicio-organizacion.jpg',
                        'items'  => ['Asesor personal desde el inicio', 'Enlace con proveedores externos', 'Supervisión el día del evento', 'Cotización sin compromiso'],
                        'link'   => null,
                        'label'  => null
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 opacity-0 transition-all duration-700" data-animate>
                @foreach($servicios as $s)
                <div class="group rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition-shadow duration-300 flex flex-col">
                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ asset('images/' . $s['imagen']) }}" alt="{{ $s['titulo'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg text-[#2A4044] font-secondary mb-3">{{ $s['titulo'] }}</h3>
                        <ul class="space-y-1.5 flex-1 mb-4" role="list">
                            @foreach($s['items'] as $item)
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#4b8b97] mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $item }}
                            </li>
                            @endforeach
                        </ul>
                        @if($s['link'])
                        <a href="{{ $s['link'] }}"
                        class="text-xs text-[#4b8b97] hover:text-[#2A4044] tracking-widest uppercase transition-colors duration-200 inline-flex items-center gap-1 mt-auto">
                            {{ $s['label'] }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        @else
                        <p class="text-xs text-gray-400 tracking-widest uppercase mt-auto">Asesor personal desde el inicio</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        @include('frontend.partials.divider')
    </section>

    {{--ASÍ SE VIVE ISABELA --}}
    <section class="bg-[#f9f7f4] py-8 lg:py-16 relative overflow-hidden" aria-labelledby="galeria-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Galería</span>
                <h2 id="galeria-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Así Se Vive Isabela
                </h2>
            </div>

            @php
                $galeria = [
                    ['archivo' => 'galeria-boda-1.jpg',      'alt' => 'Montaje de boda en el jardín de Finca Isabela',      'span' => 'lg:col-span-2 lg:row-span-2'],
                    ['archivo' => 'galeria-cabana-1.jpg',    'alt' => 'Interior de una de las cabañas de Finca Isabela',    'span' => ''],
                    ['archivo' => 'galeria-temazcal-1.jpg',  'alt' => 'Ceremonia de temazcal en Finca Isabela',             'span' => ''],
                    ['archivo' => 'galeria-jardin-1.jpg',    'alt' => 'Jardín principal de Finca Isabela',                  'span' => ''],
                    ['archivo' => 'galeria-montaje-1.jpg',   'alt' => 'Montaje de salón para evento social',                'span' => ''],
                    ['archivo' => 'galeria-comida-1.jpg',    'alt' => 'Servicio de banquete en Finca Isabela',              'span' => 'lg:col-span-2'],
                    ['archivo' => 'galeria-fiesta-1.jpg',    'alt' => 'Pista de baile durante una celebración',             'span' => ''],
                ];
            @endphp

            <div class="grid grid-cols-2 lg:grid-cols-4 lg:grid-rows-2 gap-3 opacity-0 transition-all duration-700" data-animate>
                @foreach($galeria as $g)
                <div class="relative overflow-hidden rounded-2xl h-40 lg:h-auto {{ $g['span'] }}">
                    <img src="{{ asset('images/' . $g['archivo']) }}" alt="{{ $g['alt'] }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy">
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- =============================================
         UN DESTINO PARA CELEBRAR — Sección premium
    ============================================= --}}
    <section class="bg-[#2A4044] py-16 lg:py-24 relative overflow-hidden" aria-labelledby="destino-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <div class="relative h-72 lg:h-[520px] rounded-2xl overflow-hidden order-2 lg:order-1 opacity-0 transition-all duration-700" data-animate>
                    <img src="{{ asset('images/destino-premium.jpg') }}"
                         alt="Vista completa de Finca Isabela como destino para celebrar"
                         class="w-full h-full object-cover" loading="lazy">
                </div>

                <div class="order-1 lg:order-2 opacity-0 transition-all duration-700" data-animate>
                    <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Más que un salón</span>
                    <h2 id="destino-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-white font-secondary mt-3 mb-6 leading-tight">
                        Un Destino Para Celebrar
                    </h2>
                    <p class="text-gray-300 leading-relaxed mb-8 text-base">
                        No solo rentas un salón. Vives una experiencia completa, pensada de principio a fin.
                    </p>

                    @php
                        $destinoItems = ['Jardín', 'Salón', 'Hospedaje', 'Temazcal', 'Mobiliario', 'Organización', 'Decoración', 'Atención personalizada'];
                    @endphp
                    <ul class="grid grid-cols-2 gap-x-6 gap-y-3" role="list">
                        @foreach($destinoItems as $item)
                        <li class="flex items-center gap-2 text-sm text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#4b8b97] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
         RESEÑAS REALES — en vez de testimonios inventados
    ============================================= --}}
    <section class="bg-white py-16 lg:py-20 relative overflow-hidden" aria-labelledby="resenas-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl text-center opacity-0 transition-all duration-700" data-animate>
            <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">Quienes ya lo vivieron</span>
            <h2 id="resenas-titulo" class="text-2xl sm:text-3xl text-[#2A4044] font-secondary mt-3 mb-6">
                Más de 1000 eventos realizados
            </h2>
            <div class="flex items-center justify-center gap-1 mb-4" aria-hidden="true">
                @for ($i = 0; $i < 5; $i++)
                <svg class="w-6 h-6 text-[#4b8b97]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.447a1 1 0 00-.363 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.367-2.446a1 1 0 00-1.176 0l-3.367 2.446c-.783.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.363-1.118L2.062 9.385c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.958z"/>
                </svg>
                @endfor
            </div>
            <p class="text-gray-500 text-sm leading-relaxed">
                Próximamente integraremos aquí nuestras reseñas verificadas de Google para que conozcas
                la experiencia de quienes ya celebraron en Finca Isabela.
            </p>
        </div>

        @include('frontend.partials.divider')
    </section>

    {{-- PROCESO DE CONTRATACIÓN --}}
    <section class="bg-white py-16 lg:py-24 relative overflow-hidden" aria-labelledby="proceso-titulo">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 opacity-0 transition-all duration-700" data-animate>
                <span class="text-[#4b8b97] text-xs tracking-[0.3em] uppercase">¿Cómo empezar?</span>
                <h2 id="proceso-titulo" class="text-3xl sm:text-4xl lg:text-5xl text-[#2A4044] font-secondary mt-3">
                    Tres pasos para reservar
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-[#f9f7f4] opacity-0 transition-all duration-700" data-animate>
                @php
                    $pasos = [
                        ['num' => '1', 'titulo' => 'Cuéntanos tu idea', 'desc' => 'Escríbenos por WhatsApp o llena el formulario de contacto. Sin compromiso, sin formularios complicados.'],
                        ['num' => '2', 'titulo' => 'Recibe tu propuesta', 'desc' => 'En menos de 24 horas te enviamos una cotización personalizada con las opciones que mejor se ajustan a tu evento.'],
                        ['num' => '3', 'titulo' => 'Reserva y disfruta', 'desc' => 'Confirmamos tu fecha, asignamos tu coordinador y nosotros nos encargamos del resto. Tú solo llega y celebra.'],
                    ];
                @endphp
                @foreach($pasos as $p)
                <div class="bg-white p-10 text-center border-t-4 border-[#4b8b97]">
                    <span class="text-6xl text-[#4b8b97]/20 font-secondary block mb-4">{{ $p['num'] }}</span>
                    <h3 class="text-lg text-[#2A4044] font-secondary mb-3">{{ $p['titulo'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $p['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
        @include('frontend.partials.divider')
    </section>

    {{-- =============================================
         UBICACIÓN
    ============================================= --}}
    <section class="bg-white py-12 lg:py-16 relative overflow-hidden" aria-labelledby="ubicacion-exp">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-0 shadow-xl overflow-hidden rounded-2xl opacity-0 transition-all duration-700" data-animate>

                <div class="lg:col-span-3 relative min-h-[300px] lg:min-h-0 order-2 lg:order-1">
                    <iframe
                        title="Ubicación de Finca Isabela — Eventos Especiales Lerma"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.931419352331!2d-99.4488789247872!3d19.3721219818944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2096484d12aa5%3A0x7b9e227912bcfd33!2sSAL%C3%93N%20FINCA%20ISABELA!5e0!3m2!1ses!2smx!4v1783553396225!5m2!1ses!2smx"
                        class="absolute inset-0 w-full h-full border-0 grayscale hover:grayscale-0 transition-all duration-700"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        aria-label="Mapa de ubicación de Finca Isabela en Lerma, Estado de México">
                    </iframe>
                </div>

                <div class="lg:col-span-2 bg-[#f9f7f4] p-10 flex flex-col justify-center order-1 lg:order-2">
                    <span class="text-[#4b8b97] text-xs tracking-widest uppercase mb-2">Encuéntranos</span>
                    <h2 id="ubicacion-exp" class="text-2xl lg:text-3xl text-[#2A4044] font-secondary mb-6">
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
                            Conocer la Finca
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- =============================================
         CTA FINAL
    ============================================= --}}
    <section class="bg-[#f9f7f4] py-16 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center opacity-0 transition-all duration-700" data-animate>
            <h2 class="text-2xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                Tu Celebración Comienza Aquí
            </h2>
            <p class="text-gray-500 max-w-xl mx-auto mb-8 text-sm leading-relaxed">
                Permítenos ayudarte a crear un evento que tú y tus invitados recordarán para siempre.
            </p>
            <div class="flex justify-center">
                <a href="https://wa.me/527293738830?text=Hola,%20me%20interesa%20conocer%20los%20paquetes%20de%20experiencia%20completa%20en%20Finca%20Isabela.%20¿Podrían%20orientarme?"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 bg-[#4b8b97] hover:bg-[#2A4044] text-white text-sm tracking-widest uppercase px-10 py-5 transition-colors duration-300">
                    Cotizar por WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- MODAL CONTACTO --}}
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
                <h2 id="contactModalTitle" class="text-2xl text-[#2A4044] font-secondary leading-none">
                    Cuéntanos Tu Idea
                </h2>
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
                Recibe tu propuesta personalizada en menos de 24 horas.
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

    {{-- =============================================
         SCRIPTS
    ============================================= --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // --- Modal de contacto ---
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
            if (closeBtn) closeBtn.focus();
            else if (panel) panel.focus();
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
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        // --- Tabs de escenarios ---
        var scenarioBtns   = document.querySelectorAll('.escenario-tab-btn');
        var scenarioPanels = document.querySelectorAll('.escenario-panel');

        var activeScenario   = ['bg-[#2A4044]', 'text-white'];
        var inactiveScenario = ['bg-[#f9f7f4]', 'text-[#2A4044]', 'border', 'border-[#2A4044]/20'];

        scenarioBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var idx = btn.getAttribute('data-escenario');

                scenarioBtns.forEach(function (b) {
                    b.classList.remove.apply(b.classList, activeScenario);
                    b.classList.add.apply(b.classList, inactiveScenario);
                });
                btn.classList.remove.apply(btn.classList, inactiveScenario);
                btn.classList.add.apply(btn.classList, activeScenario);

                scenarioPanels.forEach(function (p) {
                    if (p.getAttribute('data-escenario-panel') === idx) {
                        p.classList.remove('hidden');
                    } else {
                        p.classList.add('hidden');
                    }
                });
            });
        });

        // --- Contador de números de confianza (se dispara una sola vez, al entrar en viewport) ---
        var counters = document.querySelectorAll('.counter-num');
        var countersAnimated = false;

        function animateCounters() {
            if (countersAnimated) return;
            countersAnimated = true;

            counters.forEach(function (el) {
                var raw = el.getAttribute('data-target');
                var suffix = raw.replace(/[0-9]/g, '');
                var target = parseInt(raw.replace(/[^0-9]/g, ''), 10) || 0;
                var current = 0;
                var duration = 1200;
                var stepTime = Math.max(Math.floor(duration / target), 15);

                var timer = setInterval(function () {
                    current += Math.ceil(target / (duration / stepTime));
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    el.textContent = current + suffix;
                }, stepTime);
            });
        }

        var numerosSection = document.getElementById('numeros-titulo');
        if (numerosSection && 'IntersectionObserver' in window) {
            var counterObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        animateCounters();
                        counterObserver.disconnect();
                    }
                });
            }, { threshold: 0.4 });
            counterObserver.observe(numerosSection.closest('section'));
        } else {
            animateCounters();
        }

    });
    </script>

</main>
@endsection