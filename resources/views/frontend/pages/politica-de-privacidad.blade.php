@extends('frontend.layouts.main')

@section('title', 'Política de Privacidad - Eventos Especiales Lerma')
@section('description', 'Lee nuestra Política de Privacidad para entender cómo recopilamos, usamos y protegemos tu información personal en Eventos Especiales Lerma.')
@section('keywords', 'política de privacidad, protección de datos, eventos especiales, seguridad de la información, eventos Lerma')
@section('canonical', 'https://eventosespecialeslerma.com/politica-de-privacidad')
@section('alternate', 'https://eventosespecialeslerma.com/politica-de-privacidad')

@section('ogtitle', 'Política de Privacidad - Eventos Especiales Lerma')
@section('ogdescription', 'Lee nuestra Política de Privacidad para entender cómo recopilamos, usamos y protegemos tu información personal en Eventos Especiales Lerma.')
@section('ogurl', 'https://eventosespecialeslerma.com/politica-de-privacidad')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('images/logo-white.png'))

@section('twittertitle', 'Política de Privacidad - Eventos Especiales Lerma')
@section('twitterdescription', 'Lee nuestra Política de Privacidad para entender cómo recopilamos, usamos y protegemos tu información personal en Eventos Especiales Lerma.')
@section('twitterimage', asset('images/logo-white.png'))

@section('content')
<main>
    <section class="bg-white relative overflow-hidden" aria-labelledby="politica-de-privacidad">
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
                        Comprometidos con tus Datos Personales
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="politica-de-privacidad" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Política de Privacidad
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <article class="text-center mb-12 py-8">
                <!-- Encabezado principal -->
                <div class="py-4 relative z-10 opacity-0 transition-all duration-700 mb-12" data-animate>
                    <div class="flex items-center justify-center my-6" aria-hidden="true">
                        <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                        <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                        </svg>
                        <p class="text-lg text-gray-500 tracking-widest uppercase mx-2 sm:mx-4">
                            Política de Privacidad
                        </p>
                        <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                        </svg>
                        <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-[#2A4044] font-secondary mb-6">
                        Introducción                    
                    </h1>
                    <div class="max-w-3xl mx-auto">
                        <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                            En Eventos Especiales Lerma, valoramos tu privacidad y nos comprometemos a proteger tus datos personales. Esta política de privacidad explica cómo recopilamos, usamos y protegemos tu información cuando visitas nuestro sitio web o utilizas nuestros servicios.
                        </p>
                    </div>
                </div>

                <!-- Secciones de contenido -->
                <div class="space-y-12 text-left">
                    <section class="max-w-3xl mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#2A4044] font-secondary text-start mb-6">
                            Información que Recopilamos
                        </h2>
                        <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                            Podemos recopilar información personal que nos proporcionas directamente, como tu nombre, dirección de correo electrónico, número de teléfono y detalles del evento. También podemos recopilar información automáticamente a través de cookies y tecnologías similares cuando visitas nuestro sitio web.
                        </p>
                    </section>

                    <section class="max-w-3xl mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#2A4044] font-secondary text-start mb-6">
                            Uso de la Información
                        </h2>
                        <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                            Utilizamos la información recopilada para proporcionar y mejorar nuestros servicios, comunicarnos contigo, personalizar tu experiencia y cumplir con nuestras obligaciones legales. No compartimos tu información personal con terceros sin tu consentimiento, excepto cuando sea necesario para cumplir con la ley o proteger nuestros derechos.
                        </p>
                    </section>

                    <section class="max-w-3xl mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#2A4044] font-secondary text-start mb-6">
                            Seguridad de los Datos
                        </h2>
                        <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                            Implementamos medidas de seguridad técnicas y organizativas para proteger tu información personal contra el acceso no autorizado, la alteración, divulgación o destrucción. Sin embargo, ningún método de transmisión por Internet o almacenamiento electrónico es completamente seguro.
                        </p>
                    </section>

                    <section class="max-w-3xl mx-auto">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#2A4044] font-secondary text-start mb-6">
                            Tus Derechos
                        </h2>
                        <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                            Tienes derecho a acceder, corregir y eliminar la información personal que nos proporcionas. También puedes solicitar la eliminación de tus datos personales en cualquier momento.
                        </p>
                    </section>
                </div>
            </article>
        </div>
    </section>
</main>
@endsection