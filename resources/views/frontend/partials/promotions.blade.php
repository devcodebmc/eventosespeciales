<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-8 bg-gray-100" data-animate>
    <header class="flex flex-col sm:flex-row items-center justify-center my-8 w-full">
        <div class="flex items-center w-full justify-center mt-12">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                Promociones Especiales
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
        Cupones, descuentos y promociones exclusivas para hacer de tu evento una experiencia inolvidable.
    </h3>
</section>

<section class="bg-gray-100 py-8 md:py-16 px-4 relative">
    <!-- Flor izquierda -->
    <img src="{{ asset('images/flor-izquierda.png') }}" 
         alt="Flor izquierda" 
         class="absolute left-0 top-0 w-24 md:w-32 opacity-0 pointer-events-none z-0" 
         data-animate />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        @if($promotions->isEmpty())
            <!-- Mensaje cuando no hay promociones -->
            <div class="flex flex-col items-center justify-center py-6 md:py-12">
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 max-w-2xl text-center 
                            border-2 border-[#F6BBA9]/30">
                    <!-- Icono decorativo -->
                    <div class="mb-6">
                        <svg class="w-16 h-16 md:w-20 md:h-20 mx-auto text-[#4b8b97]" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                  d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl md:text-3xl font-secondary text-[#2A4044] mb-4">
                        Próximamente nuevas promociones
                    </h3>
                    
                    <p class="text-gray-600 text-base md:text-lg mb-8 leading-relaxed">
                        Estamos preparando ofertas especiales increíbles para ti. 
                        Contáctanos para conocer nuestras opciones personalizadas y hacer de tu evento 
                        algo extraordinario.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('contacto') }}" 
                           class="inline-flex items-center justify-center px-8 py-3.5 
                                  bg-[#4b8b97] hover:bg-[#3d7480] 
                                  text-white font-medium rounded-full 
                                  transition-all duration-300 
                                  shadow-lg hover:shadow-xl 
                                  transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contáctanos
                        </a>
                        
                        <a href="https://wa.me/527222259365?text=Hola%2C%20me%20gustar%C3%ADa%20saber%20m%C3%A1s%20sobre%20las%20promociones%20disponibles." 
                           target="_blank"
                           class="inline-flex items-center justify-center px-8 py-3.5 
                                  bg-white hover:bg-gray-50 
                                  text-[#2A4044] font-medium rounded-full 
                                  border-2 border-[#4b8b97]
                                  transition-all duration-300 
                                  shadow-md hover:shadow-lg 
                                  transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Grid de promociones centrado -->
            <div class="grid gap-6 md:gap-8 
                        {{ $promotions->count() === 1 ? 'grid-cols-1 max-w-md mx-auto' : '' }}
                        {{ $promotions->count() === 2 ? 'grid-cols-1 sm:grid-cols-2 max-w-3xl mx-auto' : '' }}
                        {{ $promotions->count() >= 3 ? 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3' : '' }}">
                @foreach ($promotions as $promotion)
                        <div class="relative w-full group cursor-pointer" 
                             onclick="expandImage('{{ asset('storage/' . $promotion->image) }}', '{{ $promotion->title }}', '{{ addslashes($promotion->description ?? '') }}')">
                            <!-- Contenedor cuadrado con bordes elegantes -->
                            <div class="relative w-full aspect-square rounded-2xl overflow-hidden 
                                        shadow-lg hover:shadow-2xl transition-all duration-500 
                                        transform hover:-translate-y-2
                                        bg-gray-200">
                                <!-- Imagen responsive -->
                                <img src="{{ asset('storage/' . $promotion->image) }}"
                                     alt="{{ $promotion->title }}"
                                     class="absolute inset-0 w-full h-full object-cover 
                                            transition-transform duration-700 group-hover:scale-105 
                                            rounded-2xl" />
                                
                                <!-- Overlay gradient elegante -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent 
                                            opacity-0 group-hover:opacity-100 transition-opacity duration-500 
                                            rounded-2xl"></div>
                                
                                <!-- Contenedor de icono centrado con animación mejorada -->
                                <div class="absolute inset-0 flex items-center justify-center 
                                            opacity-0 group-hover:opacity-100 
                                            transition-all duration-500 z-20">
                                    <!-- Icono de expandir elegante con efecto glassmorphism -->
                                    <div class="relative">
                                        <!-- Círculo de fondo con blur -->
                                        <div class="absolute inset-0 bg-white/20 backdrop-blur-md rounded-full 
                                                    transform scale-0 group-hover:scale-100 
                                                    transition-transform duration-500"></div>
                                        
                                        <!-- Icono SVG -->
                                        <div class="relative p-4 transform scale-90 group-hover:scale-100 
                                                    transition-all duration-300">
                                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </div>
                                        
                                        <!-- Anillo decorativo animado -->
                                        <div class="absolute inset-0 border-2 border-white/40 rounded-full 
                                                    transform scale-100 group-hover:scale-125 
                                                    opacity-100 group-hover:opacity-0
                                                    transition-all duration-500"></div>
                                    </div>
                                </div>
                                
                                <!-- Título en la parte inferior con fade in -->
                                <div class="absolute bottom-0 left-0 right-0 
                                            bg-gradient-to-t from-black/80 via-black/50 to-transparent 
                                            p-6 pb-5
                                            transform translate-y-full group-hover:translate-y-0 
                                            transition-transform duration-500
                                            rounded-b-2xl">
                                    <h3 class="text-white text-base md:text-lg lg:text-2xl font-script text-center 
                                               tracking-wide">
                                        {{ $promotion->title }}
                                    </h3>
                                </div>

                                <!-- Borde decorativo elegante -->
                                <div class="absolute inset-0 border-2 border-white/0 rounded-2xl 
                                            group-hover:border-white/20 transition-all duration-500 
                                            pointer-events-none"></div>
                            </div>
                        </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Flor derecha -->
    <img src="{{ asset('images/flor-derecha.png') }}" 
         alt="Flor derecha" 
         class="absolute right-0 bottom-0 w-24 md:w-32 opacity-0 pointer-events-none z-0 rounded-md" 
         data-animate />
</section>

<!-- Modal elegante con Flip Card -->
<div id="imageModal" 
     class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 hidden items-center justify-center p-4 md:p-8"
     onclick="closeModal()">
    <div class="relative max-w-5xl w-full" onclick="event.stopPropagation()">
        <!-- Botón cerrar -->
        <button onclick="closeModal()" 
                class="absolute -top-4 right-0 md:top-6 md:-right-6 
                       text-white bg-white/20 hover:bg-white/30 
                       backdrop-blur-md rounded-full p-3 md:p-3.5
                       transition-all duration-300 shadow-lg hover:shadow-xl z-50"
                aria-label="Cerrar">
            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        
        <!-- Contenedor del Flip Card -->
        <div class="flip-card-container" style="perspective: 1500px;">
            <div id="flipCard" class="flip-card-inner" style="position: relative; width: 100%; transform-style: preserve-3d; transition: transform 0.8s cubic-bezier(0.4, 0.0, 0.2, 1);">
                
                <!-- Frente de la tarjeta (Imagen) -->
                <div class="flip-card-front" style="backface-visibility: hidden; position: relative;">
                    <div class="bg-white/5 backdrop-blur-md rounded-3xl p-3 md:p-4 shadow-2xl">
                        <img id="modalImage" 
                             src="" 
                             alt="" 
                             class="w-full h-auto max-h-[70vh] md:max-h-[75vh] object-contain rounded-2xl">
                        
                        <p id="modalTitle" 
                           class="text-white text-center mt-4 md:mt-6 text-base md:text-2xl font-script 
                                  tracking-wide px-2"></p>
                        
                        <!-- Botón de información con tooltip -->
                        <div id="infoButtonContainer" class="flex justify-center mt-4 md:mt-6" style="display: none;">
                            <button onclick="flipCard(event)" 
                                    class="group relative inline-flex items-center gap-2 px-6 py-3 
                                           bg-gradient-to-r from-[#4b8b97] to-[#3d7480] 
                                           hover:from-[#3d7480] hover:to-[#4b8b97]
                                           text-white font-medium rounded-full 
                                           transition-all duration-300 
                                           shadow-lg hover:shadow-xl 
                                           transform hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Ver Detalles</span>
                                
                                <!-- Tooltip -->
                                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 
                                            bg-white/95 backdrop-blur-sm text-gray-800 text-xs 
                                            px-3 py-2 rounded-lg shadow-xl
                                            opacity-0 group-hover:opacity-100 
                                            transition-opacity duration-300 pointer-events-none
                                            whitespace-nowrap">
                                    Haz clic para ver la descripción
                                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 rotate-45 
                                                w-2 h-2 bg-white/95"></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Reverso de la tarjeta (Descripción) -->
                <div class="flip-card-back" 
                     style="backface-visibility: hidden; position: absolute; top: 0; left: 0; width: 100%; height: 100%; transform: rotateY(180deg);">
                    <div class="bg-white/5 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-2xl h-full 
                                flex flex-col justify-center items-center">
                        
                        <!-- Decoración superior -->
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-1 bg-gradient-to-r from-transparent to-[#4b8b97] rounded-full"></div>
                            <svg class="w-10 h-10 text-[#4b8b97]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <div class="w-12 h-1 bg-gradient-to-l from-transparent to-[#4b8b97] rounded-full"></div>
                        </div>
                        
                        <!-- Título -->
                        <h3 class="text-white text-xl md:text-3xl font-script text-center mb-4">
                            Detalles de la Promoción
                        </h3>
                        
                        <!-- Descripción con scroll -->
                        <div class="max-h-[50vh] overflow-y-auto custom-scrollbar px-4 mb-6">
                            <p id="modalDescription" 
                               class="text-white/90 text-sm md:text-lg leading-relaxed text-center
                                      font-light tracking-wide"></p>
                        </div>
                        
                        <!-- Botón para regresar -->
                        <button onclick="flipCard(event)" 
                                class="inline-flex items-center gap-2 px-6 py-3 
                                       bg-white/20 hover:bg-white/30 backdrop-blur-sm
                                       text-white font-medium rounded-full 
                                       transition-all duration-300 
                                       shadow-lg hover:shadow-xl 
                                       transform hover:scale-105
                                       border border-white/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Volver a la imagen</span>
                        </button>
                        
                        <!-- Decoración inferior -->
                        <div class="flex justify-center mt-6 gap-2">
                            <span class="w-2 h-2 bg-[#4b8b97] rounded-full animate-pulse"></span>
                            <span class="w-2 h-2 bg-[#F6BBA9] rounded-full animate-pulse" style="animation-delay: 0.2s;"></span>
                            <span class="w-2 h-2 bg-[#4b8b97] rounded-full animate-pulse" style="animation-delay: 0.4s;"></span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
let isFlipped = false;

function expandImage(imageUrl, title, description) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalDescription = document.getElementById('modalDescription');
    const infoButtonContainer = document.getElementById('infoButtonContainer');
    const flipCard = document.getElementById('flipCard');
    
    // Reset flip
    isFlipped = false;
    flipCard.style.transform = 'rotateY(0deg)';
    
    modalImage.src = imageUrl;
    modalImage.alt = title;
    modalTitle.textContent = title;
    
    // Mostrar u ocultar botón de info según si hay descripción
    if (description && description.trim() !== '') {
        modalDescription.textContent = description;
        infoButtonContainer.style.display = 'flex';
    } else {
        infoButtonContainer.style.display = 'none';
    }
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

function flipCard(event) {
    event.stopPropagation();
    const flipCard = document.getElementById('flipCard');
    isFlipped = !isFlipped;
    
    if (isFlipped) {
        flipCard.style.transform = 'rotateY(180deg)';
    } else {
        flipCard.style.transform = 'rotateY(0deg)';
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    const flipCard = document.getElementById('flipCard');
    
    modal.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        // Reset flip
        isFlipped = false;
        flipCard.style.transform = 'rotateY(0deg)';
    }, 300);
}

// Cerrar modal con tecla ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>

<style>
#imageModal {
    transition: opacity 0.3s ease-in-out;
    opacity: 0;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.5;
        transform: scale(1.1);
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Custom scrollbar para la descripción */
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(75, 139, 151, 0.6);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(75, 139, 151, 0.8);
}
</style>