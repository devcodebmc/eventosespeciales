<section class="bg-white relative px-4 sm:px-6 lg:px-0 overflow-hidden" aria-labelledby="galeria-imagenes">
    <div class="w-full max-w-4xl mx-auto mt-10 relative">
        <!-- Galería de imágenes -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($post->images->take(6) as $index => $image)
            <figure class="aspect-square rounded-xl overflow-hidden shadow-md border border-gray-200 bg-white group">
                <button 
                    type="button"
                    class="w-full h-full open-lightbox-btn focus:outline-none"
                    data-index="{{ $index }}"
                    aria-label="Ver imagen ampliada"
                >
                    <img src="{{ asset($image->image_path) }}" alt="Imagen relacionada al servicio" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" decoding="async" loading="lazy">
                </button>
                <figcaption class="sr-only">Imagen relacionada al servicio</figcaption>
            </figure>
            @endforeach
        </div>
        <!-- Lightbox Modal -->
        <dialog id="lightbox-modal" class="fixed inset-0 z-90 bg-black/90 flex items-center justify-center w-full h-full p-0 m-0 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out" aria-modal="true" aria-labelledby="lightbox-title">
            <div class="relative max-w-4xl w-full mx-4 bg-transparent flex flex-col items-center transition-opacity duration-300 ease-in-out">
                <!-- Botón de cerrar -->
                <button id="lightbox-close" class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none transition-colors duration-200 ease-in-out" aria-label="Cerrar lightbox" style="z-index:2;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
                <figure class="w-full flex flex-col items-center transition-opacity duration-300 ease-in-out">
                    <img id="lightbox-image" src="" alt="Imagen ampliada" class="w-full h-auto rounded-lg shadow-lg object-contain max-h-[80vh] mx-auto transition-opacity duration-300 ease-in-out">
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
            const modalContent = modal.querySelector('div'); // Contenedor del contenido
            const modalImg = document.getElementById('lightbox-image');
            const closeBtn = document.getElementById('lightbox-close');
            const prevBtn = document.getElementById('lightbox-prev');
            const nextBtn = document.getElementById('lightbox-next');
            const thumbs = document.getElementById('lightbox-thumbs');
            let currentIndex = 0;

            function openModal(index) {
                currentIndex = index;
                modalImg.src = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
                
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
                // Ocultar todo simultáneamente
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalImg.style.opacity = '0';
                
                // Esperar a que termine la transición antes de ocultar completamente
                setTimeout(() => {
                    modal.classList.add('pointer-events-none');
                    modal.removeAttribute('open');
                    modalImg.src = '';
                    document.body.style.overflow = '';
                }, 300); // Debe coincidir con la duración de la transición (300ms)
            }

            function showImage(index) {
                if (index < 0) index = images.length - 1;
                if (index >= images.length) index = 0;
                currentIndex = index;
                
                // Transición suave al cambiar imágenes
                modalImg.style.opacity = '0';
                setTimeout(() => {
                    modalImg.src = images[index] ? '{{ asset('') }}' + images[index].replace(/^\/+/, '') : '';
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