@extends('frontend.layouts.main')

@section('title', 'Términos de Servicio - Eventos Especiales Lerma')
@section('description', 'Lee nuestros Términos de Servicio para entender las condiciones bajo las cuales ofrecemos nuestros servicios en Eventos Especiales Lerma.')
@section('keywords', 'términos de servicio, condiciones de uso, eventos especiales, políticas, eventos Lerma')
@section('canonical', 'https://eventosespecialeslerma.com/terminos-de-servicio')
@section('alternate', 'https://eventosespecialeslerma.com/terminos-de-servicio')

@section('ogtitle', 'Términos de Servicio - Eventos Especiales Lerma')
@section('ogdescription', 'Lee nuestros Términos de Servicio para entender las condiciones bajo las cuales ofrecemos nuestros servicios en Eventos Especiales Lerma.')
@section('ogurl', 'https://eventosespecialeslerma.com/terminos-de-servicio')
@section('ogimage', asset('images/logo-white.png'))
@section('ogimage:secure_url', asset('images/logo-white.png'))

@section('twittertitle', 'Términos de Servicio - Eventos Especiales Lerma')
@section('twitterdescription', 'Lee nuestros Términos de Servicio para entender las condiciones bajo las cuales ofrecemos nuestros servicios en Eventos Especiales Lerma.')
@section('twitterimage', asset('images/logo-white.png'))

@section('content')
<main>
     <section class="bg-white relative overflow-hidden" aria-labelledby="terminos-de-servicio">
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
                        Acepta nuestras Condiciones
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="terminos-de-servicio" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Términos de Servicio
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        <div class="container mx-auto py-4 relative z-10 opacity-0 transition-all duration-700" data-animate>
            <article class="text-center mb-8 px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    Condiciones de Uso
                </h2>
                <p class="text-lg text-gray-500 mt-4 px-4">
                    Al utilizar nuestro sitio web y servicios, aceptas cumplir con los siguientes términos y condiciones:
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    1. Uso del Sitio Web
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Nuestro sitio web y servicios están destinados a usuarios que buscan planificar eventos especiales. Al acceder a nuestro sitio, garantizas que tienes al menos 18 años de edad o que cuentas con el consentimiento de un tutor legal.
                </p>
                <p class="text-lg text-gray-500 mb-4">
                    Nos reservamos el derecho de modificar o interrumpir, temporal o permanentemente, el sitio web (o cualquier parte del mismo) con o sin previo aviso. No seremos responsables ante ti ni ante terceros por cualquier modificación, suspensión o interrupción del sitio web.
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    2. Responsabilidad
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Nos reservamos el derecho de no proporcionar nuestros servicios si consideramos que no se cumplen con los términos y condiciones establecidos.
                </p>
                <p class="text-lg text-gray-500 mb-4">
                    No garantizamos que el sitio web esté libre de errores o que el acceso al mismo sea ininterrumpido. Hacemos todo lo posible para mantener la seguridad del sitio, pero no podemos garantizar la seguridad absoluta de la información transmitida a través de Internet.
                </p>
                <p class="text-lg text-gray-500 mb-4">
                    No seremos responsables por daños directos, indirectos, incidentales, especiales, consecuentes o punitivos que resulten del uso o la imposibilidad de usar nuestro sitio web o servicios.
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    3. Propiedad Intelectual
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Todos los derechos de propiedad intelectual y de uso del sitio web y servicios pertenecen a Eventos Especiales Lerma. Todos los derechos reservados.
                </p>
                <p class="text-lg text-gray-500 mb-4">
                    No puedes reproducir, distribuir, modificar, crear trabajos derivados, exhibir públicamente, ejecutar públicamente, republicar, descargar, almacenar o transmitir cualquier material del sitio web sin nuestro consentimiento previo por escrito.
                </p>
                <p class="text-lg text-gray-500 mb-4">
                    Cualquier uso no autorizado del sitio web o servicios puede violar leyes de derechos de autor, marcas registradas y otras leyes.
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    4. Cambios en los Términos de Servicio
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Nos reservamos el derecho de modificar estos términos de servicio en cualquier momento. Cualquier cambio será efectivo inmediatamente después de su publicación en el sitio web. Es tu responsabilidad revisar periódicamente los términos de servicio para estar al tanto de cualquier cambio.
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    5. Ley Aplicable y Jurisdicción
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Estos términos de servicio se regirán e interpretarán de acuerdo con las leyes de México. Cualquier disputa que surja en relación con estos términos de servicio estará sujeta a la jurisdicción exclusiva de los tribunales de la ciudad de Toluca.
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary mb-4">
                    6. Contacto
                </h3>                
                <p class="text-lg text-gray-500 mb-4">
                    Si tienes alguna pregunta o inquietud sobre estos términos de servicio, por favor contáctanos en <a class="text-[#4b8b97] underline hover:no-underline" href="mailto:info@eventospecialeslerma.com">info@eventospecialeslerma.com</a>
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <p class="text-lg mb-4 text-white bg-[#4b8b97] py-1 px-4 rounded-md inline-block">
                    Fecha de última actualización: 08 de Septiembre de 2025 
                </p>
            </article>
            <article class="mb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-left">
                <em class="text-lg text-gray-800 mb-4">
                    Al utilizar nuestro sitio web y servicios, aceptas estos términos de servicio en su totalidad. Si no estás de acuerdo con alguna parte de estos términos, por favor no utilices nuestro sitio web ni nuestros servicios.
                </em>
            </article>
        </div>
    </section>
</main>
@endsection