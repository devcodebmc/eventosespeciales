<footer class="bg-gray-100 text-[#2A4044] py-16 px-4 sm:px-8">
    <div class="text-center mb-8">
        <!-- Encabezado semántico usando h1 ya que es el título principal del footer -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-script text-[#4b8b97] mb-2">
            Eventos Especiales Lerma
        </h1>
        <!-- Subtítulo con heading apropiado -->
        <h2 class="text-md text-gray-800 tracking-[.8em] uppercase mx-4">
            Agencia de Eventos
        </h2>
        <!-- Descripción -->
        <p class="max-w-4xl mx-auto mt-4 text-sm sm:text-base md:text-lg text-gray-600 text-center px-2">
           Somos más que una agencia de eventos, somos tu agencia de eventos; estamos comprometidos en la creación de un día que capture la esencia de tu evento y lo haga inolvidable.
        </p>
        
        <!-- Redes sociales - Mejorado con accesibilidad -->
        <nav aria-label="Redes sociales" class="flex justify-center mt-6 space-x-3">
            <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-gray-200 hover:border-[#4b8b97] transition-colors group focus:outline-none focus:ring-2 focus:ring-[#4b8b97]">
                <svg class="w-6 h-6 text-gray-600 group-hover:text-[#4b8b97]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                </svg>
            </a>
            <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-gray-200 hover:border-[#4b8b97] transition-colors group focus:outline-none focus:ring-2 focus:ring-[#4b8b97]">
                <svg class="w-6 h-6 text-gray-600 group-hover:text-[#4b8b97]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                </svg>
            </a>
            <a href="#" aria-label="Twitter/X" class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-gray-200 hover:border-[#4b8b97] transition-colors group focus:outline-none focus:ring-2 focus:ring-[#4b8b97]">
                <svg class="w-4 h-4 text-gray-600 group-hover:text-[#4b8b97]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/>
                </svg>
            </a>
            <a href="#" aria-label="YouTube" class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-gray-200 hover:border-[#4b8b97] transition-colors group focus:outline-none focus:ring-2 focus:ring-[#4b8b97]">
                <svg class="w-6 h-6 text-gray-600 group-hover:text-[#4b8b97]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/>
                </svg>
            </a>
        </nav>
    </div>

    <!-- Divider -->
    @include('frontend.partials.divider')
    
    <div class="max-w-6xl mx-auto mt-8">
        <!-- Sección superior del footer - mejor estructura semántica -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <!-- Columna 1 - Enlaces rápidos -->
            <section aria-labelledby="quick-links-heading">
                <h3 id="quick-links-heading" class="text-lg font-secondary tracking-wider text-[#2A4044] mb-4">
                    Enlaces Rápidos
                </h3>
                <nav aria-label="Enlaces rápidos">
                    <ul class="space-y-2">
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Home</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">About Us</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Services</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Portfolio</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Blog</a></li>
                    </ul>
                </nav>
            </section>

            <!-- Columna 2 - Otros links -->
            <section aria-labelledby="other-links-heading">
                <h3 id="other-links-heading" class="text-lg font-secondary tracking-wider text-[#2A4044] mb-4">Otros Links</h3>
                <nav aria-label="Otros enlaces">
                    <ul class="space-y-2">
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">About Us</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Services</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Portfolio</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Blog</a></li>
                        <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Contact</a></li>
                    </ul>
                </nav>
            </section>

            <!-- Columna 3 - Contacto -->
            <section aria-labelledby="contact-heading">
                <h3 id="contact-heading" class="text-lg font-secondary tracking-wider text-[#2A4044] mb-4">Contacto</h3>
                <address class="not-italic text-md space-y-2">
                    <p>123 Wedding Street</p>
                    <p>New York, NY 10001</p>
                    <p>
                        <a href="mailto:hello@dreamweds.com" class="hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">hello@dreamweds.com</a>
                    </p>
                    <p>
                        <a href="tel:+11234567890" class="hover:text-[#4b8b97] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">+1 (123) 456-7890</a>
                    </p>
                </address>
            </section>

            <!-- Columna 4 - Galería -->
            <section aria-labelledby="gallery-heading" class="mb-8">
                <h3 id="gallery-heading" class="text-lg font-secondary tracking-wider text-[#2A4044] mb-4">Galería</h3>
                <div class="grid grid-cols-3 gap-2" id="gallery-container">
                    @foreach ($smallGallery->sortBy('order') as $gallery)
                        <button 
                            class="gallery-thumbnail focus:outline-none focus:ring-2 focus:ring-[#4b8b97] rounded overflow-hidden"
                            data-index="{{ $loop->index }}"
                            onclick="openLightbox({{ $loop->index }})"
                        >
                            <img 
                                src="{{ asset($gallery->image_path) }}" 
                                alt="{{ $gallery->event->title ?? 'Imagen de galería' }}" 
                                class="w-full h-24 object-cover hover:opacity-90 transition-opacity" 
                                loading="lazy"
                            >
                        </button>
                    @endforeach
                </div>

                <!-- Lightbox/Slider -->
                <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center">
                    <button class="absolute top-4 right-4 text-white text-3xl" onclick="closeLightbox()">&times;</button>
                    
                    <button 
                        class="absolute left-4 bg-white bg-opacity-30 text-white p-2 rounded-full hover:bg-opacity-50 transition-all"
                        onclick="changeSlide(-1)"
                    >
                        &larr;
                    </button>
                    
                    <div class="max-w-4xl mx-auto px-4">
                        <img id="lightbox-image" class="max-h-[80vh] mx-auto" src="" alt="">
                        <p id="lightbox-caption" class="text-white text-center mt-2"></p>
                    </div>
                    
                    <button 
                        class="absolute right-4 bg-white bg-opacity-30 text-white p-2 rounded-full hover:bg-opacity-50 transition-all"
                        onclick="changeSlide(1)"
                    >
                        &rarr;
                    </button>
                </div>
            </section>
        </div>

        <!-- Línea divisoria -->
        <div class="border-t border-[#e0dcd5] mb-8"></div>

        <!-- Sección inferior del footer -->
        <div class="flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; 2023 Eventos Especiales Lerma. Todos los derechos reservados.</p>
            <nav aria-label="Enlaces legales" class="flex flex-wrap justify-center gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-[#333] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Política de Privacidad</a>
                <a href="#" class="hover:text-[#333] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Términos de Servicio</a>
                <a href="#" class="hover:text-[#333] transition-colors focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 focus:ring-offset-gray-100 rounded">Configuración de Cookies</a>
            </nav>
        </div>
    </div>
</footer>

@push('js')
    <script>
        // Variables globales
        let currentIndex = 0;
        let galleryImages = [];

        // Inicializar la galería al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todas las imágenes de la galería ordenadas por 'order'
            const thumbnails = document.querySelectorAll('.gallery-thumbnail');
            galleryImages = Array.from(thumbnails).map(thumb => ({
                src: thumb.querySelector('img').src,
                alt: thumb.querySelector('img').alt,
                index: parseInt(thumb.dataset.index)
            })).sort((a, b) => a.index - b.index);
        });

        // Abrir lightbox
        function openLightbox(index) {
            currentIndex = index;
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxCaption = document.getElementById('lightbox-caption');
            
            lightboxImage.src = galleryImages[currentIndex].src;
            lightboxCaption.textContent = galleryImages[currentIndex].alt;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            
            // Deshabilitar scroll de la página
            document.body.style.overflow = 'hidden';
        }

        // Cerrar lightbox
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            
            // Habilitar scroll de la página
            document.body.style.overflow = 'auto';
        }

        // Cambiar slide
        function changeSlide(step) {
            currentIndex += step;
            
            // Circular navigation
            if (currentIndex >= galleryImages.length) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = galleryImages.length - 1;
            }
            
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxCaption = document.getElementById('lightbox-caption');
            
            lightboxImage.src = galleryImages[currentIndex].src;
            lightboxCaption.textContent = galleryImages[currentIndex].alt;
        }

        // Navegación con teclado
        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('lightbox');
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