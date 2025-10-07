<section class="relative flex justify-center items-center my-12 md:my-20">
    <div class="w-full max-w-5xl mx-auto relative">
        <!-- Contenedor principal con animación scale-in -->
        <div class="relative flex justify-center gap-2 md:gap-4 lg:gap-6 items-end z-10" data-animate-scale>
            <!-- Left image -->
            <div class="relative">
                <img src="{{ asset('images/pla1.jpg') }}" alt="Imagen de playa" class="w-28 h-40 md:w-40 md:h-56 lg:w-56 lg:h-80 object-cover object-center rounded-t-full rounded-b-[40px] shadow-2xl opacity-95" loading="lazy" decoding="async"/>
            </div>
            <!-- Center image -->
            <div class="relative z-20">
                <img src="{{ asset('images/pare.jpg') }}" alt="Pareja en la playa" class="w-36 h-52 md:w-52 md:h-72 lg:w-72 lg:h-[22rem] object-cover object-center rounded-t-full rounded-b-[60px] shadow-2xl opacity-95" loading="lazy" decoding="async"/>
            </div>
            <!-- Right image -->
            <div class="relative">
                <img src="{{ asset('images/pla2.jpg') }}" alt="Imagen de playa 2" class="w-28 h-40 md:w-40 md:h-56 lg:w-56 lg:h-80 object-cover object-center rounded-t-full rounded-b-[40px] shadow-2xl opacity-95" loading="lazy" decoding="async"/>
            </div>
        </div>
        
        <!-- Hojas con animación scale-in - Solo visible en resoluciones grandes (lg y superior) -->
        <!-- Hoja superior izquierda -->
        <div class="hidden lg:block pointer-events-none select-none absolute top-0 left-0 w-16 h-16 sm:w-24 sm:h-24 md:w-40 md:h-40 lg:w-64 lg:h-64 opacity-80 z-0" 
             style="transform: translate(-25%, -25%) rotate(-15deg);" 
             data-animate-scale>
            <img src="{{ asset('images/hoja-izquierda.svg') }}" alt="Imagen decorativa de hoja izquierda" class="w-full h-full" loading="lazy" decoding="async"/>
        </div>
        
        <!-- Hoja superior derecha -->
        <div class="hidden lg:block pointer-events-none select-none absolute top-0 right-0 w-16 h-16 sm:w-24 sm:h-24 md:w-40 md:h-40 lg:w-64 lg:h-64 opacity-80 z-0 overflow-x-hidden" 
             style="transform: translate(25%, -25%) rotate(15deg) scaleX(-1);" 
             data-animate-scale>
            <img src="{{ asset('images/hoja-derecha.svg') }}" alt="Imagen decorativa de hoja derecha" class="w-full h-full" loading="lazy" decoding="async"/>
        </div>
        
        <!-- Hoja inferior izquierda -->
        <div class="hidden lg:block pointer-events-none select-none absolute bottom-0 left-[25%] w-8 h-8 sm:w-12 sm:h-12 md:w-24 md:h-24 lg:w-40 lg:h-40 opacity-60 z-0" 
             style="transform: translateY(25%) rotate(45deg);" 
             data-animate-scale>
            <img src="{{ asset('images/hoja-izquierda.svg') }}" alt="Imagen decorativa de hoja izquierda superior" class="w-full h-full" loading="lazy" decoding="async"/>
        </div>
        
        <!-- Hoja inferior derecha -->
        <div class="hidden lg:block pointer-events-none select-none absolute bottom-0 right-[25%] w-8 h-8 sm:w-12 sm:h-12 md:w-24 md:h-24 lg:w-40 lg:h-40 opacity-60 z-0" 
             style="transform: translateY(25%) rotate(-45deg) scaleX(-1);" 
             data-animate-scale>
            <img src="{{ asset('images/hoja-derecha.svg') }}" alt="Imagen decorativa de hoja derecha inferior" class="w-full h-full" loading="lazy" decoding="async"/>
        </div>
    </div>
</section>
