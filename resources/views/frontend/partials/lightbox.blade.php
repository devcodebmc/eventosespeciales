<section class="bg-white relative px-4 sm:px-6 lg:px-0 overflow-hidden" aria-labelledby="galeria-imagenes">
    <div class="w-full max-w-4xl mx-auto mt-10 relative">
        <!-- Galería de imágenes -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($post->images->take(6) as $index => $image)
            <figure class="aspect-square rounded-xl overflow-hidden shadow-md border border-gray-200 bg-white group relative">
                <!-- Ícono de expandir visible al hacer hover -->
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10">
                    <svg class="h-8 w-8 text-white drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H4m0 0v4m0-4 5 5m7-5h4m0 0v4m0-4-5 5M8 20H4m0 0v-4m0 4 5-5m7 5h4m0 0v-4m0 4-5-5"/>
                    </svg>
                </div>
                
                <button 
                    type="button"
                    class="w-full h-full open-lightbox-btn focus:outline-none"
                    data-index="{{ $index }}"
                    aria-label="Ver imagen ampliada"
                >
                    <!-- Preload de imágenes -->
                    <link rel="preload" as="image" href="{{ asset($image->image_path) }}">
                    <!-- Imagen con carga prioritaria -->
                    <img 
                        src="{{ asset($image->image_path) }}" 
                        alt="Imagen relacionada al servicio" 
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" 
                        decoding="async" 
                        loading="eager"  <!-- Cambiado de lazy a eager -->
                        width="300"       <!-- Añadido para CLS -->
                        height="300"      <!-- Añadido para CLS -->
                    >
                </button>
                <figcaption class="sr-only">Imagen relacionada al servicio</figcaption>
                <!-- Efecto de carga suave -->
                <div class="absolute inset-0 bg-gray-100 animate-pulse opacity-0 transition-opacity duration-300 pointer-events-none image-loading-placeholder"></div>
            </figure>
            @endforeach
        </div>
        
        <!-- Lightbox Modal -->
        <dialog id="lightbox-modal" class="fixed inset-0 z-90 bg-black/90 flex items-center justify-center w-full h-full p-0 m-0 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out" aria-modal="true" aria-labelledby="lightbox-title">
            <div class="relative max-w-4xl w-full mx-4 bg-transparent flex flex-col items-center transition-opacity duration-300 ease-in-out">
                <!-- Botón de cerrar -->
                <button id="lightbox-close" class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none transition-colors duration-200 ease-in-out" aria-label="Cerrar lightbox" style="z-index:2;">
                    <svg class="h-8 w-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9h4m0 0V5m0 4L4 4m15 5h-4m0 0V5m0 4 5-5M5 15h4m0 0v4m0-4-5 5m15-5h-4m0 0v4m0-4 5 5"/>
                    </svg>
                </button>
                
                <figure class="w-full flex flex-col items-center transition-opacity duration-300 ease-in-out">
                    <!-- Precargar imagen del lightbox -->
                    <div id="lightbox-preloader" class="hidden"></div>
                    <img 
                        id="lightbox-image" 
                        src="" 
                        alt="Imagen ampliada" 
                        class="w-full h-auto rounded-lg shadow-lg object-contain max-h-[80vh] mx-auto transition-opacity duration-300 ease-in-out"
                        width="1200" 
                        height="800"
                    >
                    <figcaption id="lightbox-title" class="sr-only">Imagen ampliada</figcaption>
                </figure>
                
                <nav class="w-full flex items-center justify-between mt-4 px-2 relative transition-opacity duration-300 ease-in-out" style="height:80px;">
                    <!-- Botón anterior -->
                    <button id="lightbox-prev" class="absolute left-0 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 focus:outline-none transition-colors duration-200 ease-in-out" aria-label="Imagen anterior">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                   <div id="lightbox-thumbs" class="flex flex-wrap gap-2 mx-auto px-2 sm:px-12 transition-opacity duration-300 ease-in-out justify-center"></div>
                    
                    <!-- Botón siguiente -->
                    <button id="lightbox-next" class="absolute right-0 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 focus:outline-none transition-colors duration-200 ease-in-out" aria-label="Imagen siguiente">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </nav>
            </div>
        </dialog>
    </div>
</section>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = @json($post->images->take(6)->pluck('image_path'));
            const modal = document.getElementById('lightbox-modal');
            const modalContent = modal.querySelector('div');
            const modalImg = document.getElementById('lightbox-image');
            const closeBtn = document.getElementById('lightbox-close');
            const prevBtn = document.getElementById('lightbox-prev');
            const nextBtn = document.getElementById('lightbox-next');
            const thumbs = document.getElementById('lightbox-thumbs');
            const preloader = document.getElementById('lightbox-preloader');
            let currentIndex = 0;

            // Precargar imágenes en segundo plano
            function preloadImages() {
                images.forEach(img => {
                    const preloadImg = new Image();
                    preloadImg.src = '{{ asset('') }}' + img.replace(/^\/+/, '');
                    preloadImg.style.display = 'none';
                    preloader.appendChild(preloadImg);
                });
            }
            
            // Ocultar placeholders cuando las imágenes cargan
            function hidePlaceholders() {
                document.querySelectorAll('.image-loading-placeholder').forEach(el => {
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 300); // Coincide con la duración de la transición
                });
            }
            
            // Verificar si las imágenes ya están cargadas
            function checkImagesLoaded() {
                let allLoaded = true;
                document.querySelectorAll('img[loading="eager"]').forEach(img => {
                    if (!img.complete) allLoaded = false;
                });
                
                if (allLoaded) {
                    hidePlaceholders();
                } else {
                    window.addEventListener('load', hidePlaceholders);
                }
            }
            
            preloadImages();
            checkImagesLoaded();

            function openModal(index) {
                currentIndex = index;
                const imgPath = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
                modalImg.src = imgPath;
                
                // Resetear opacidades
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalImg.style.opacity = '0';
                
                // Mostrar modal
                modal.classList.remove('pointer-events-none');
                modal.setAttribute('open', '');
                
                // Animaciones en secuencia
                setTimeout(() => {
                    modal.style.opacity = '1';
                    setTimeout(() => {
                        modalContent.style.opacity = '1';
                        modalImg.style.opacity = '1';
                    }, 50);
                }, 10);
                
                renderThumbs();
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalImg.style.opacity = '0';
                
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    modal.removeAttribute('open');
                    document.body.style.overflow = '';
                }, 300);
            }

            function showImage(index) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                currentIndex = index;
                
                // Precargar siguiente/anterior imagen
                const nextImg = new Image();
                nextImg.src = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
                
                modalImg.style.opacity = '0';
                setTimeout(() => {
                    modalImg.src = nextImg.src;
                    modalImg.style.opacity = '1';
                }, 200);
                
                renderThumbs();
            }

            function renderThumbs() {
                thumbs.innerHTML = '';
                images.forEach((img, idx) => {
                    const thumb = document.createElement('img');
                    thumb.src = '{{ asset('') }}' + img.replace(/^\/+/, '');
                    thumb.alt = 'Miniatura ' + (idx + 1);
                    thumb.className = 'w-12 h-12 object-cover rounded cursor-pointer border-2 transition-all duration-200 ' + 
                                      (idx === currentIndex ? 'border-[#4b8b97] scale-105' : 'border-transparent hover:border-gray-300');
                    thumb.onclick = () => showImage(idx);
                    thumbs.appendChild(thumb);
                });
            }

            document.querySelectorAll('.open-lightbox-btn').forEach((btn, idx) => {
                btn.addEventListener('click', () => openModal(idx));
            });

            closeBtn.addEventListener('click', closeModal);
            prevBtn.addEventListener('click', () => showImage(currentIndex - 1));
            nextBtn.addEventListener('click', () => showImage(currentIndex + 1));

            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });

            document.addEventListener('keydown', function (e) {
                if (modal.hasAttribute('open')) {
                    if (e.key === 'Escape') closeModal();
                    if (e.key === 'ArrowLeft') showImage(currentIndex - 1);
                    if (e.key === 'ArrowRight') showImage(currentIndex + 1);
                }
            });
        });
    </script>
@endpush