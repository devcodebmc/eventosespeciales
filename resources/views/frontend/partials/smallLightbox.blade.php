<div id="small-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-0 transition-all duration-300 ease-in-out">
    <div class="absolute inset-0 bg-black bg-opacity-90 transition-opacity duration-300 ease-in-out"></div>
    
    <button 
        class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 rounded-full p-1 z-50"
        onclick="closeLightbox()"
        aria-label="Cerrar lightbox"
    >
        &times;
    </button>
    
    <div class="relative w-full h-full flex items-center justify-center">
        <!-- Botón anterior - posicionado dentro del contenedor relativo -->
        <button 
            class="absolute left-2 md:left-4 bg-white bg-opacity-30 text-white p-2 md:p-3 rounded-full hover:bg-opacity-50 transition-all duration-200 ease-in-out transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 z-40"
            onclick="changeSlide(-1)"
            aria-label="Imagen anterior"
        >
            &larr;
        </button>
        
        <!-- Contenido de la imagen -->
        <div class="max-w-4xl w-full mx-auto px-4 relative z-30 transform transition-all duration-300 ease-in-out scale-95 opacity-0">
            <img 
                id="small-lightbox-image" 
                class="max-h-[80vh] w-auto mx-auto rounded-lg shadow-xl transform transition-transform duration-300 ease-in-out" 
                src="" 
                alt=""
                loading="lazy"
            >
            <p id="small-lightbox-caption" class="text-white text-center mt-4 text-lg opacity-0 transition-opacity duration-300 ease-in-out"></p>
        </div>
        
        <!-- Botón siguiente - posicionado dentro del contenedor relativo -->
        <button 
            class="absolute right-2 md:right-4 bg-white bg-opacity-30 text-white p-2 md:p-3 rounded-full hover:bg-opacity-50 transition-all duration-200 ease-in-out transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 z-40"
            onclick="changeSlide(1)"
            aria-label="Imagen siguiente"
        >
            &rarr;
        </button>
    </div>
</div>

@push('js')
    <script>
        // Variables globales
        let currentIndex = 0;
        let galleryImages = [];
        let isAnimating = false;

        // Inicializar la galería al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todas las imágenes de la galería ordenadas por 'order'
            const thumbnails = document.querySelectorAll('.gallery-thumbnail');
            galleryImages = Array.from(thumbnails).map(thumb => ({
                src: thumb.querySelector('img').dataset.largeSrc || thumb.querySelector('img').src,
                alt: thumb.querySelector('img').alt,
                index: parseInt(thumb.dataset.index)
            })).sort((a, b) => a.index - b.index);
        });

        // Abrir lightbox con animación
        function openLightbox(index) {
            if (isAnimating) return;
            isAnimating = true;
            
            currentIndex = index;
            const lightbox = document.getElementById('small-lightbox');
            const lightboxContent = lightbox.querySelector('div.max-w-4xl');
            const lightboxImage = document.getElementById('small-lightbox-image');
            const lightboxCaption = document.getElementById('small-lightbox-caption');
            
            // Pre-cargar imagen
            const img = new Image();
            img.src = galleryImages[currentIndex].src;
            img.onload = function() {
                lightboxImage.src = this.src;
                lightboxCaption.textContent = galleryImages[currentIndex].alt;
                
                // Mostrar lightbox
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0)';
                
                // Animar fondo
                setTimeout(() => {
                    lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
                }, 10);
                
                // Animar contenido
                setTimeout(() => {
                    lightboxContent.classList.remove('scale-95', 'opacity-0');
                    lightboxContent.classList.add('scale-100', 'opacity-100');
                    
                    // Animar caption
                    setTimeout(() => {
                        lightboxCaption.classList.remove('opacity-0');
                        lightboxCaption.classList.add('opacity-100');
                        isAnimating = false;
                    }, 200);
                }, 300);
                
                // Deshabilitar scroll de la página
                document.body.style.overflow = 'hidden';
            };
        }

        // Cerrar lightbox con animación
        function closeLightbox() {
            if (isAnimating) return;
            isAnimating = true;
            
            const lightbox = document.getElementById('small-lightbox');
            const lightboxContent = lightbox.querySelector('div.max-w-4xl');
            const lightboxCaption = document.getElementById('small-lightbox-caption');
            
            // Animar caption
            lightboxCaption.classList.remove('opacity-100');
            lightboxCaption.classList.add('opacity-0');
            
            // Animar contenido
            lightboxContent.classList.remove('scale-100', 'opacity-100');
            lightboxContent.classList.add('scale-95', 'opacity-0');
            
            // Animar fondo
            lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0)';
            
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightbox.classList.remove('flex');
                isAnimating = false;
                
                // Habilitar scroll de la página
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Cambiar slide con animación
        function changeSlide(step) {
            if (isAnimating) return;
            isAnimating = true;
            
            const lightboxImage = document.getElementById('small-lightbox-image');
            const lightboxCaption = document.getElementById('small-lightbox-caption');
            const lightboxContent = document.querySelector('#small-lightbox div.max-w-4xl');
            
            // Animación de salida
            lightboxContent.classList.remove('scale-100', 'opacity-100');
            lightboxContent.classList.add('scale-95', 'opacity-0');
            lightboxCaption.classList.remove('opacity-100');
            lightboxCaption.classList.add('opacity-0');
            
            setTimeout(() => {
                currentIndex += step;
                
                // Circular navigation
                if (currentIndex >= galleryImages.length) {
                    currentIndex = 0;
                } else if (currentIndex < 0) {
                    currentIndex = galleryImages.length - 1;
                }
                
                // Pre-cargar nueva imagen
                const img = new Image();
                img.src = galleryImages[currentIndex].src;
                img.onload = function() {
                    lightboxImage.src = this.src;
                    lightboxCaption.textContent = galleryImages[currentIndex].alt;
                    
                    // Animación de entrada
                    setTimeout(() => {
                        lightboxContent.classList.remove('scale-95', 'opacity-0');
                        lightboxContent.classList.add('scale-100', 'opacity-100');
                        
                        setTimeout(() => {
                            lightboxCaption.classList.remove('opacity-0');
                            lightboxCaption.classList.add('opacity-100');
                            isAnimating = false;
                        }, 200);
                    }, 10);
                };
            }, 300);
        }

        // Navegación con teclado
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('small-lightbox');
            if (!lightbox.classList.contains('hidden')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowLeft') {
                    changeSlide(-1);
                } else if (e.key === 'ArrowRight') {
                    changeSlide(1);
                }
            }
        });
    </script>
@endpush