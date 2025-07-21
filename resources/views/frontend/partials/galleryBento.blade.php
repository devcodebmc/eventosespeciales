<section class="bg-white py-16 sm:py-20 lg:py-24" aria-labelledby="galeria-eventos">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Encabezado mejorado -->
    <header class="mb-12 text-center">
      <div class="flex items-center w-full justify-center">
        <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
        </svg>
        <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
            Galeria de Eventos
        </h2>
        <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
        </svg>
        <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
      </div>
      <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
        Descubre la magia que creamos en cada celebración. Momentos únicos, emociones eternas.
      </h3>
    </header>

    <!-- Bento Grid para exactamente 6 imágenes -->
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 lg:gap-6" aria-label="Galería de eventos">
      @foreach($smallGallery as $key => $imagen)
        @php
          // Asignación de tamaños basada en la posición
          $sizeClasses = match($key) {
              0 => 'row-span-2',       // Imagen vertical alta
              1 => 'col-span-2',       // Imagen ancha
              2 => '',                  // Normal
              3 => 'row-span-2',       // Imagen vertical alta
              4 => 'col-span-2',       // Imagen ancha
              5 => '',                  // Normal
              6 => 'col-span-2',       // Imagen ancha
              default => ''            // Por defecto
          };
          
          // Bordes redondeados alternados
          $rounded = match($key % 3) {
              0 => 'rounded-xl',
              1 => 'rounded-2xl',
              2 => 'rounded-[20px]',
              default => 'rounded-xl'
          };
        @endphp

        <figure class="group relative overflow-hidden {{ $rounded }} shadow-lg transition-all duration-500 hover:shadow-xl {{ $sizeClasses }}">
          <img 
            src="{{ asset($imagen->image_path) }}"
            alt="{{ $imagen->event->title ?? 'Evento organizado por Eventos Especiales Lerma' }}"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
            loading="lazy"
            decoding="async"
          >
          <!-- Overlay con información -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4 sm:p-6">
            <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
              <h3 class="text-white text-sm sm:text-lg font-semibold">{{ $imagen->event->title ?? 'Evento Especial' }}</h3>
              <p class="text-white/90 text-xs sm:text-sm mt-1">{{ $imagen->event->date ? $imagen->event->date->format('F Y') : 'Celebración' }}</p>
            </div>
          </div>
        </figure>
      @endforeach
    </div>

    <!-- Botón Ver Más (opcional si hay más imágenes) -->
    @if($smallGallery->count() > 6)
      <div class="mt-12 text-center">
        <a href="#" class="btn-action rounded-md inline-flex items-center px-6 py-2 sm:px-8 sm:py-3">
          Ver más momentos memorables
          <svg class="ml-2 -mr-1 w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    @endif
  </div>
</section>