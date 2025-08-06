<!-- Componente de Galería Cinematográfica -->
<section class="px-4 py-4 sm:px-4 md:px-10 lg:px-16 max-w-7xl mx-auto relative">
    <h2 class="sr-only">Galería de imágenes</h2>
    
    <!-- Grid de imágenes con hover mejorado -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8 post-gallery-elegant relative z-20 group">
        @foreach($post->images as $index => $image)
        <figure class="relative overflow-hidden rounded-lg shadow-sm hover:shadow-xl transition-all duration-500 ease-out cursor-pointer"
                data-gallery-elegant-image="{{ asset($image->image_path) }}"
                data-gallery-elegant-index="{{ $index }}"
                data-gallery-elegant-thumbnail="{{ asset($image->image_path) }}"
                onclick="openElegantLightbox({{ $index }})">
            
            <!-- Imagen con transición suave -->
            <div class="relative overflow-hidden aspect-[4/3]">
                <img src="{{ asset($image->image_path) }}" 
                     alt="Imagen del evento {{ $post->title }}"
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-[cubic-bezier(0.33,1,0.68,1)]"
                     loading="lazy">
                
                <!-- Efecto de grano cinematográfico -->
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MDAiIGhlaWdodD0iNDAwIj48ZmlsdGVyIGlkPSJub2lzZSIgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSI+PGZlVHVyYnVsZW5jZSB0eXBlPSJmcmFjdGFsTm9pc2UiIGJhc2VGcmVxdWVuY3k9IjAuOTUiIG51bU9jdGF2ZXM9IjUiIHN0aXRjaFRpbGVzPSJzdGl0Y2giLz48L2ZpbHRlcj48cmVjdCB3aWR0aD0iNDAwIiBoZWlnaHQ9IjQwMCIgZmlsdGVyPSJ1cmwoI25vaXNlKSIgb3BhY2l0eT0iMC4wMiIvPjwvc3ZnPg==')] opacity-10 pointer-events-none"></div>
            </div>

            <!-- Indicador de lightbox simpre  visible con icono minimalista al centro -->
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-8 h-8 text-white bg-[#F6BBA9]/50 rounded-full px-1 py-1" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H4m0 0v4m0-4 5 5m7-5h4m0 0v4m0-4-5 5M8 20H4m0 0v-4m0 4 5-5m7 5h4m0 0v-4m0 4-5-5"/>
                </svg>
            </div>
            
            <!-- Overlay con título -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4">
                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 ease-out">
                    <p class="text-white text-shadow text-sm sm:text-base">
                       {{ $post->title }} - {{ \Carbon\Carbon::parse($post->event_date)->format('F Y') }}
                    </p>
                    <div class="w-8 h-0.5 bg-white/80 mt-2 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 delay-100"></div>
                </div>
            </div>
        </figure>
        @endforeach
    </div>
</section>

<!-- Lightbox Cinematográfico Responsive -->
<div id="elegant-lightbox" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/95 transition-opacity duration-500 ease-in-out opacity-0">
    <!-- Controles superiores -->
    <div class="absolute top-0 left-0 right-0 flex justify-between items-center p-3 sm:p-4 md:p-6 z-20">
        <div class="flex items-center space-x-2 sm:space-x-4">
            <span id="elegant-lightbox-counter" class="text-white/80 text-xs sm:text-sm font-medium bg-black/30 px-2 sm:px-3 py-1 rounded-full backdrop-blur-sm"></span>
            
            <!-- Botón de autoplay -->
            <button id="autoplay-toggle" 
                    class="text-white/80 hover:text-white transition-all duration-200 focus:outline-none bg-black/30 p-1 sm:p-2 rounded-full backdrop-blur-sm hover:bg-white/10"
                    aria-label="Activar autoplay"
                    data-playing="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>
        
        <button class="text-white hover:text-gray-300 transition-all duration-200 focus:outline-none bg-black/30 p-1 sm:p-2 rounded-full backdrop-blur-sm hover:bg-white/10"
                aria-label="Cerrar lightbox"
                onclick="closeElegantLightbox()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <!-- Contenedor principal de imagen -->
    <div class="relative w-full h-full max-w-6xl px-2 sm:px-4 flex items-center justify-center">
        <!-- Navegación izquierda -->
        <button class="absolute left-1 sm:left-2 md:left-4 text-white p-2 sm:p-3 rounded-full bg-black/30 hover:bg-white/10 backdrop-blur-sm transition-all duration-200 focus:outline-none z-20"
                aria-label="Imagen anterior"
                onclick="navigateElegantLightbox(-1)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        
        <!-- Imagen ampliada con marco cinematográfico -->
        <div class="relative w-full h-full flex items-center justify-center p-2 sm:p-4 md:p-8">
            <div class="absolute inset-0 border border-white/10 rounded-lg pointer-events-none"></div>
            <div class="absolute inset-0 border-4 sm:border-8 border-transparent pointer-events-none"></div>
            
            <img id="elegant-lightbox-image" 
                 class="max-h-[70vh] sm:max-h-[80vh] max-w-full mx-auto rounded-sm object-contain transform scale-95 transition-all duration-500 ease-[cubic-bezier(0.33,1,0.68,1)]" 
                 src="" 
                 alt=""
                 loading="eager">
        </div>
        
        <!-- Navegación derecha -->
        <button class="absolute right-1 sm:right-2 md:right-4 text-white p-2 sm:p-3 rounded-full bg-black/30 hover:bg-white/10 backdrop-blur-sm transition-all duration-200 focus:outline-none z-20"
                aria-label="Imagen siguiente"
                onclick="navigateElegantLightbox(1)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
    
    <!-- Miniaturas en lightbox - Siempre visibles como imágenes -->
    <div id="elegant-lightbox-thumbnails" class="absolute bottom-2 sm:bottom-4 left-0 right-0 mx-auto flex justify-center space-x-1 sm:space-x-2 overflow-x-auto py-1 sm:py-2 px-2 sm:px-4 max-w-full">
        <!-- Las miniaturas se generarán dinámicamente con JS -->
    </div>
</div>

@push('styles')
<style>
/* Efectos personalizados */
.text-shadow {
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

/* Transición personalizada para efectos cinematográficos */
.transition-cinematic {
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

/* Estilos para miniaturas responsivas */
#elegant-lightbox-thumbnails {
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) transparent;
}

#elegant-lightbox-thumbnails::-webkit-scrollbar {
    height: 4px;
}

#elegant-lightbox-thumbnails::-webkit-scrollbar-track {
    background: transparent;
}

#elegant-lightbox-thumbnails::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.3);
    border-radius: 2px;
}

#elegant-lightbox-thumbnails button {
    flex-shrink: 0;
    border-radius: 0.25rem;
    overflow: hidden;
    cursor: pointer;
    border-width: 2px;
    transition: all 0.2s ease;
    opacity: 0.7;
}

#elegant-lightbox-thumbnails button:hover {
    opacity: 1;
}

#elegant-lightbox-thumbnails button.border-white {
    border-color: white;
    transform: scale(1.05);
    opacity: 1;
}

/* Tamaños de miniaturas por breakpoint */
#elegant-lightbox-thumbnails button {
    width: 40px;
    height: 40px;
}

@media (min-width: 480px) {
    #elegant-lightbox-thumbnails button {
        width: 50px;
        height: 50px;
    }
}

@media (min-width: 640px) {
    #elegant-lightbox-thumbnails button {
        width: 60px;
        height: 60px;
    }
}

@media (min-width: 768px) {
    #elegant-lightbox-thumbnails button {
        width: 70px;
        height: 70px;
    }
}

/* Ajuste para pantallas muy pequeñas */
@media (max-width: 400px) {
    #elegant-lightbox .absolute.left-1, 
    #elegant-lightbox .absolute.right-1 {
        top: 50%;
        transform: translateY(-50%);
    }
    
    #elegant-lightbox-image {
        max-height: 60vh;
    }
    
    #elegant-lightbox-thumbnails button {
        width: 32px;
        height: 32px;
    }
}
</style>
@endpush

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const elegantLightbox = document.getElementById('elegant-lightbox');
    const elegantLightboxImage = document.getElementById('elegant-lightbox-image');
    const elegantLightboxThumbnails = document.getElementById('elegant-lightbox-thumbnails');
    const elegantLightboxCounter = document.getElementById('elegant-lightbox-counter');
    const autoplayToggle = document.getElementById('autoplay-toggle');
    
    const elegantGalleryImages = Array.from(document.querySelectorAll('[data-gallery-elegant-image]'));
    let currentElegantIndex = 0;
    let autoplayInterval = null;
    const autoplayDelay = 2000; // 2 segundos
    
    // Función para iniciar autoplay
    function startAutoplay() {
        if (autoplayInterval) clearInterval(autoplayInterval);
        autoplayInterval = setInterval(() => {
            navigateElegantLightbox(1);
        }, autoplayDelay);
        autoplayToggle.setAttribute('data-playing', 'true');
        autoplayToggle.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        `;
        autoplayToggle.setAttribute('aria-label', 'Desactivar autoplay');
    }
    
    // Función para detener autoplay
    function stopAutoplay() {
        if (autoplayInterval) clearInterval(autoplayInterval);
        autoplayToggle.setAttribute('data-playing', 'false');
        autoplayToggle.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        `;
        autoplayToggle.setAttribute('aria-label', 'Activar autoplay');
    }
    
    // Toggle autoplay
    autoplayToggle.addEventListener('click', function() {
        if (this.getAttribute('data-playing') === 'false') {
            startAutoplay();
        } else {
            stopAutoplay();
        }
    });
    
    // Función para abrir el lightbox con animación
    window.openElegantLightbox = function(index) {
        currentElegantIndex = index;
        const imageElement = elegantGalleryImages[currentElegantIndex];
        
        // Detener autoplay si está activo
        stopAutoplay();
        
        // Preload image before showing
        const img = new Image();
        img.src = imageElement.dataset.galleryElegantImage;
        img.onload = function() {
            elegantLightboxImage.src = this.src;
            elegantLightboxImage.alt = imageElement.querySelector('img').alt;
            
            // Actualizar contador
            elegantLightboxCounter.textContent = `${currentElegantIndex + 1} / ${elegantGalleryImages.length}`;
            
            // Generar miniaturas
            elegantLightboxThumbnails.innerHTML = '';
            elegantGalleryImages.forEach((img, idx) => {
                const thumb = document.createElement('button');
                thumb.className = `flex-shrink-0 rounded-md overflow-hidden cursor-pointer border-2 transition-all duration-200 ${idx === currentElegantIndex ? 'border-white scale-105 opacity-100' : 'border-transparent opacity-70 hover:opacity-100'}`;
                thumb.innerHTML = `<img src="${img.dataset.galleryElegantThumbnail}" class="w-full h-full object-cover" alt="" loading="lazy">`;
                thumb.addEventListener('click', () => {
                    elegantLightboxImage.classList.remove('scale-95');
                    elegantLightboxImage.classList.add('scale-90');
                    setTimeout(() => {
                        openElegantLightbox(idx);
                    }, 150);
                });
                thumb.setAttribute('aria-label', `Ver imagen ${idx + 1}`);
                elegantLightboxThumbnails.appendChild(thumb);
            });
            
            // Mostrar lightbox con animación
            elegantLightbox.classList.remove('hidden');
            elegantLightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                elegantLightbox.classList.remove('opacity-0');
                elegantLightboxImage.classList.remove('scale-95');
                elegantLightboxImage.classList.add('scale-100');
            }, 10);
        };
    };
    
    // Función para cerrar el lightbox con animación
    window.closeElegantLightbox = function() {
        stopAutoplay();
        elegantLightbox.classList.add('opacity-0');
        elegantLightboxImage.classList.remove('scale-100');
        elegantLightboxImage.classList.add('scale-95');
        
        setTimeout(() => {
            elegantLightbox.classList.remove('flex');
            elegantLightbox.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 500);
    };
    
    // Navegación entre imágenes con animación
    window.navigateElegantLightbox = function(direction) {
        elegantLightboxImage.classList.remove('scale-100');
        elegantLightboxImage.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            currentElegantIndex = (currentElegantIndex + direction + elegantGalleryImages.length) % elegantGalleryImages.length;
            const imageElement = elegantGalleryImages[currentElegantIndex];
            
            // Preload next image
            const img = new Image();
            img.src = imageElement.dataset.galleryElegantImage;
            img.onload = function() {
                elegantLightboxImage.src = this.src;
                elegantLightboxImage.alt = imageElement.querySelector('img').alt;
                elegantLightboxCounter.textContent = `${currentElegantIndex + 1} / ${elegantGalleryImages.length}`;
                
                // Actualizar miniaturas activas
                document.querySelectorAll('#elegant-lightbox-thumbnails button').forEach((thumb, idx) => {
                    thumb.className = `flex-shrink-0 rounded-md overflow-hidden cursor-pointer border-2 transition-all duration-200 ${idx === currentElegantIndex ? 'border-white scale-105 opacity-100' : 'border-transparent opacity-70 hover:opacity-100'}`;
                });
                
                elegantLightboxImage.classList.remove('opacity-0');
                elegantLightboxImage.classList.add('scale-100');
            };
        }, 300);
    };
    
    // Navegación con teclado
    document.addEventListener('keydown', (e) => {
        if (!elegantLightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeElegantLightbox();
            if (e.key === 'ArrowLeft') navigateElegantLightbox(-1);
            if (e.key === 'ArrowRight') navigateElegantLightbox(1);
            if (e.key === ' ') {
                e.preventDefault();
                if (autoplayToggle.getAttribute('data-playing') === 'false') {
                    startAutoplay();
                } else {
                    stopAutoplay();
                }
            }
        }
    });
    
    // Soporte para gestos táctiles (swipe)
    let elegantTouchStartX = 0;
    elegantLightbox.addEventListener('touchstart', (e) => {
        elegantTouchStartX = e.changedTouches[0].clientX;
    }, { passive: true });
    
    elegantLightbox.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const diff = elegantTouchStartX - touchEndX;
        
        if (Math.abs(diff) > 50) {
            if (diff > 0) navigateElegantLightbox(1);  // Swipe izquierda
            else navigateElegantLightbox(-1);         // Swipe derecha
        }
    }, { passive: true });
    
    // Cerrar al hacer clic en el fondo oscuro
    elegantLightbox.addEventListener('click', (e) => {
        if (e.target === elegantLightbox) {
            closeElegantLightbox();
        }
    });
    
    // Manejar cambios de tamaño de pantalla
    window.addEventListener('resize', function() {
        if (!elegantLightbox.classList.contains('hidden')) {
            // Regenerar miniaturas si cambia el tamaño
            const currentIndex = currentElegantIndex;
            openElegantLightbox(currentIndex);
        }
    });
});
</script>
@endpush