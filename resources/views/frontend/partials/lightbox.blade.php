<section class="bg-white relative px-4 sm:px-6 lg:px-0 overflow-hidden" aria-labelledby="galeria-imagenes">
    <div class="w-full max-w-4xl mx-auto mt-10 relative">
        <!-- Galería de imágenes -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($post->images as $index => $image)
            <figure class="aspect-square rounded-xl overflow-hidden shadow-md hover:shadow-xl border border-gray-200 bg-white group relative transition-all duration-300">
                <!-- Overlay con gradiente sutil -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 pointer-events-none z-10"></div>
                
                <!-- Ícono de lupa centrado -->
                <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none transition-all duration-300">
                    <div class="bg-white/65 backdrop-blur-md rounded-full p-2 sm:p-3 shadow-2xl transform scale-90 group-hover:scale-100 transition-transform duration-300">
                        <svg class="h-6 w-6 sm:h-7 sm:w-7 text-[#4b8b97]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2.5" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                </div>
                
                <button 
                    type="button"
                    class="w-full h-full open-lightbox-btn focus:outline-none focus:ring-2 focus:ring-[#4b8b97] focus:ring-offset-2 rounded-xl transition-all duration-300"
                    data-index="{{ $index }}"
                    aria-label="Ver imagen ampliada {{ $index + 1 }}"
                >
                    <link rel="preload" as="image" href="{{ asset($image->image_path) }}">
                    <img 
                        src="{{ asset($image->image_path) }}" 
                        alt="Imagen ilustrativa ({{ $index + 1 }}) del servicio {{ $post->title ?? '' }}" 
                        class="w-full h-full object-cover transition-all duration-500 ease-out group-hover:scale-110 group-hover:brightness-90" 
                        decoding="async" 
                        loading="eager"
                        fetchpriority="high"
                        width="300"       
                        height="300"   
                    >
                </button>
                <figcaption class="sr-only">Imagen {{ $index + 1 }} relacionada al servicio</figcaption>
            </figure>
            @endforeach
        </div>
        
        <!-- Lightbox Modal -->
        <dialog id="lightbox-modal" class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-sm flex items-center justify-center w-full h-full p-0 m-0 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out" aria-modal="true" aria-labelledby="lightbox-title">
            <div class="relative max-w-7xl w-full h-full flex flex-col items-center justify-center p-4 transition-transform duration-300 ease-in-out">
                <!-- Barra de controles superior -->
                <div class="absolute top-0 left-0 right-0 bg-gradient-to-b from-black/70 via-black/40 to-transparent p-4 sm:p-6 flex items-center justify-between z-30 transition-opacity duration-300">
                    <!-- Controles izquierda: Play/Pause -->
                    <div class="flex items-center gap-4">
                        <button id="lightbox-play-pause" class="group relative text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#4b8b97] rounded-lg transition-all duration-200 ease-in-out p-2.5 hover:bg-white/10 active:scale-95" aria-label="Play/Pause presentación">
                            <svg id="play-icon" class="h-6 w-6 sm:h-7 sm:w-7 drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>
                            </svg>
                            <svg id="pause-icon" class="h-6 w-6 sm:h-7 sm:w-7 drop-shadow-lg hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8Zm7 0a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1Z" clip-rule="evenodd"/>
                            </svg>
                            <span class="absolute left-full ml-3 px-3 py-1.5 bg-black/90 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none backdrop-blur-sm">
                                Reproducción automática
                            </span>
                        </button>
                        
                        <!-- Contador de imágenes -->
                        <span id="image-counter" class="hidden sm:flex items-center gap-2 text-white/90 text-sm font-medium drop-shadow-lg bg-white/10 px-3 py-1.5 rounded-full backdrop-blur-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span id="current-image">1</span> / <span id="total-images">{{ count($post->images) }}</span>
                        </span>
                    </div>
                    
                    <!-- Botón de cerrar derecha -->
                    <button id="lightbox-close" class="group relative text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 rounded-lg transition-all duration-200 ease-in-out p-2.5 hover:bg-red-500/20 active:scale-95" aria-label="Cerrar lightbox">
                        <svg class="h-6 w-6 sm:h-7 sm:w-7 drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                        <span class="absolute right-full mr-3 px-3 py-1.5 bg-black/90 text-white text-xs rounded-md opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none backdrop-blur-sm">
                            Cerrar (Esc)
                        </span>
                    </button>
                </div>
                
                <!-- Imagen principal -->
                <figure class="w-full h-full flex flex-col items-center justify-center transition-all duration-300 ease-in-out">
                    <div id="lightbox-preloader" class="hidden"></div>
                    <div class="relative max-h-[calc(100vh-200px)] w-full flex items-center justify-center">
                        <img 
                            id="lightbox-image" 
                            src="" 
                            alt="Imagen ampliada del servicio {{ $post->title ?? '' }}" 
                            class="w-auto h-auto max-w-full max-h-[calc(100vh-200px)] rounded-lg shadow-2xl object-contain transition-all duration-300 ease-in-out"
                            width="1200" 
                            height="800"
                        >
                    </div>
                    <figcaption id="lightbox-title" class="sr-only">Imagen ampliada</figcaption>
                </figure>
                
                <!-- Navegación y miniaturas -->
                <nav class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent p-4 sm:p-6 flex items-center justify-center gap-3 sm:gap-4 z-30 transition-opacity duration-300">
                    <!-- Botón anterior -->
                    <button id="lightbox-prev" class="group flex-shrink-0 text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#4b8b97] rounded-full bg-black/40 backdrop-blur-sm p-2.5 sm:p-3 transition-all duration-200 hover:scale-110 hover:bg-black/60 active:scale-95" aria-label="Imagen anterior">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <!-- Miniaturas -->
                    <div class="flex-1 overflow-x-auto scrollbar-hide">
                        <div id="lightbox-thumbs" class="flex gap-3 justify-center px-2 transition-all duration-300 ease-in-out"></div>
                    </div>
                    
                    <!-- Botón siguiente -->
                    <button id="lightbox-next" class="group flex-shrink-0 text-white/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-[#4b8b97] rounded-full bg-black/40 backdrop-blur-sm p-2.5 sm:p-3 transition-all duration-200 hover:scale-110 hover:bg-black/60 active:scale-95" aria-label="Imagen siguiente">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </nav>
            </div>
        </dialog>
    </div>
</section>

@push('styles')
    <style>
        /* Ocultar scrollbar pero mantener funcionalidad */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Animaciones suaves para el modal */
        #lightbox-modal[open] {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = @json($post->images->pluck('image_path'));
            const modal = document.getElementById('lightbox-modal');
            const modalContent = modal.querySelector('div');
            const modalImg = document.getElementById('lightbox-image');
            const closeBtn = document.getElementById('lightbox-close');
            const prevBtn = document.getElementById('lightbox-prev');
            const nextBtn = document.getElementById('lightbox-next');
            const playPauseBtn = document.getElementById('lightbox-play-pause');
            const playIcon = document.getElementById('play-icon');
            const pauseIcon = document.getElementById('pause-icon');
            const thumbs = document.getElementById('lightbox-thumbs');
            const preloader = document.getElementById('lightbox-preloader');
            const currentImageSpan = document.getElementById('current-image');
            const totalImagesSpan = document.getElementById('total-images');
            
            let currentIndex = 0;
            let isPlaying = false;
            let slideInterval = null;
            const slideDelay = 1500;

            // Precargar imágenes
            function preloadImages() {
                images.forEach(img => {
                    const preloadImg = new Image();
                    preloadImg.src = '{{ asset('') }}' + img.replace(/^\/+/, '');
                    preloadImg.style.display = 'none';
                    preloader.appendChild(preloadImg);
                });
            }
            
            preloadImages();

            // Iniciar reproducción automática
            function startSlideshow() {
                if (slideInterval) clearInterval(slideInterval);
                
                slideInterval = setInterval(() => {
                    showImage(currentIndex + 1);
                }, slideDelay);
                
                isPlaying = true;
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
                playPauseBtn.setAttribute('aria-label', 'Pausar presentación');
            }

            // Detener reproducción automática
            function stopSlideshow() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                    slideInterval = null;
                }
                
                isPlaying = false;
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
                playPauseBtn.setAttribute('aria-label', 'Reproducir presentación');
            }

            // Toggle play/pause
            function togglePlayPause() {
                if (isPlaying) {
                    stopSlideshow();
                } else {
                    startSlideshow();
                }
            }

            // Actualizar contador
            function updateCounter() {
                currentImageSpan.textContent = currentIndex + 1;
            }

            // Abrir modal
            function openModal(index) {
                currentIndex = index;
                const imgPath = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
                modalImg.src = imgPath;
                
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalImg.style.opacity = '0';
                
                modal.classList.remove('pointer-events-none');
                modal.setAttribute('open', '');
                
                requestAnimationFrame(() => {
                    modal.style.opacity = '1';
                    setTimeout(() => {
                        modalContent.style.opacity = '1';
                        modalContent.style.transform = 'scale(1)';
                        modalImg.style.opacity = '1';
                    }, 50);
                });
                
                renderThumbs();
                updateCounter();
                document.body.style.overflow = 'hidden';
                stopSlideshow();
            }

            // Cerrar modal
            function closeModal() {
                stopSlideshow();
                
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalContent.style.transform = 'scale(0.95)';
                modalImg.style.opacity = '0';
                
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    modal.removeAttribute('open');
                    document.body.style.overflow = '';
                }, 300);
            }

            // Mostrar imagen
            function showImage(index) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                currentIndex = index;
                
                const nextImg = new Image();
                nextImg.src = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
                
                modalImg.style.opacity = '0';
                modalImg.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    modalImg.src = nextImg.src;
                    modalImg.style.opacity = '1';
                    modalImg.style.transform = 'scale(1)';
                }, 200);
                
                renderThumbs();
                updateCounter();
                
                // Scroll automático a la miniatura activa
                const activeThumb = thumbs.querySelector(`[data-index="${currentIndex}"]`);
                if (activeThumb) {
                    activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }
            }

            // Renderizar miniaturas
            function renderThumbs() {
                thumbs.innerHTML = '';
                
                // Si hay pocas imágenes, centrarlas; si hay muchas, permitir scroll
                const thumbsContainer = thumbs.parentElement;
                if (images.length <= 6) {
                    thumbsContainer.style.justifyContent = 'center';
                } else {
                    thumbsContainer.style.justifyContent = 'flex-start';
                }
                
                images.forEach((img, idx) => {
                    const thumbWrapper = document.createElement('div');
                    thumbWrapper.className = 'flex-shrink-0 relative';
                    
                    // Contenedor con borde y fondo
                    const thumbContainer = document.createElement('div');
                    thumbContainer.className = 'relative rounded-lg overflow-hidden transition-all duration-300 cursor-pointer ' + 
                                               (idx === currentIndex 
                                                 ? 'p-0.5 bg-gradient-to-br from-[#4b8b97] to-[#5fa3b0] shadow-lg shadow-[#4b8b97]/30 scale-105' 
                                                 : 'p-0.5 bg-white/5 hover:bg-white/15 hover:scale-105');
                    
                    const thumb = document.createElement('img');
                    thumb.src = '{{ asset('') }}' + img.replace(/^\/+/, '');
                    thumb.alt = 'Miniatura ' + (idx + 1);
                    thumb.setAttribute('data-index', idx);
                    thumb.className = 'w-14 h-14 sm:w-16 sm:h-16 object-cover rounded-md transition-all duration-300 ' + 
                                      (idx === currentIndex 
                                        ? 'opacity-100' 
                                        : 'opacity-40 hover:opacity-100');
                    thumb.onclick = () => {
                        stopSlideshow();
                        showImage(idx);
                    };
                    
                    thumbContainer.appendChild(thumb);
                    thumbWrapper.appendChild(thumbContainer);
                    thumbs.appendChild(thumbWrapper);
                });
            }

            // Event Listeners
            document.querySelectorAll('.open-lightbox-btn').forEach((btn, idx) => {
                btn.addEventListener('click', () => openModal(idx));
            });

            closeBtn.addEventListener('click', closeModal);
            
            prevBtn.addEventListener('click', () => {
                stopSlideshow();
                showImage(currentIndex - 1);
            });
            
            nextBtn.addEventListener('click', () => {
                stopSlideshow();
                showImage(currentIndex + 1);
            });

            playPauseBtn.addEventListener('click', togglePlayPause);

            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });

            // Navegación por teclado
            document.addEventListener('keydown', function (e) {
                if (modal.hasAttribute('open')) {
                    switch(e.key) {
                        case 'Escape':
                            closeModal();
                            break;
                        case 'ArrowLeft':
                            stopSlideshow();
                            showImage(currentIndex - 1);
                            break;
                        case 'ArrowRight':
                            stopSlideshow();
                            showImage(currentIndex + 1);
                            break;
                        case ' ':
                            e.preventDefault();
                            togglePlayPause();
                            break;
                    }
                }
            });

            // Soporte para gestos táctiles
            let touchStartX = 0;
            let touchEndX = 0;
            
            modal.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            });
            
            modal.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            });
            
            function handleSwipe() {
                const swipeThreshold = 50;
                if (touchEndX < touchStartX - swipeThreshold) {
                    stopSlideshow();
                    showImage(currentIndex + 1);
                }
                if (touchEndX > touchStartX + swipeThreshold) {
                    stopSlideshow();
                    showImage(currentIndex - 1);
                }
            }
        });
    </script>
@endpush