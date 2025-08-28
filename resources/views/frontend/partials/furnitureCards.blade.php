<section aria-labelledby="mobiliario-destacado" class="py-4 px-1 max-w-full mx-auto">
    <h2 id="mobiliario-destacado" class="sr-only">Mobiliario destacado</h2>

    @if($furnitures->count() > 0)
        @foreach($furnitures as $serviceName => $serviceFurnitures)
            <!-- Header del servicio -->
            <header class="flex flex-col sm:flex-row items-center justify-center my-10 w-full">
                <div class="flex items-center w-full justify-center">
                    <span class="sm:block w-16 border-t border-[#4b8b97] mx-2"></span>
                    <svg class="mx-0 sm:block" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2L22 12L12 22L2 12L12 2Z" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <h2 class="text-base sm:text-lg md:text-xl text-gray-600 tracking-widest uppercase mx-0 sm:mx-6 text-center font-light">
                        {{ $serviceName ?? 'Servicio' }}
                    </h2>
                    <svg class="mx-0 sm:block" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2L22 12L12 22L2 12L12 2Z" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="sm:block w-16 border-t border-[#4b8b97] mx-2"></span>
                </div>
            </header>

            <!-- Grid de mobiliario del servicio actual -->
            <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-1 mb-16 px-2">
                @foreach($serviceFurnitures as $index => $card)
                    <article class="relative aspect-[3/4] group overflow-hidden shadow-lg hover:shadow-xl transition-all duration-500 cursor-pointer transform hover:-translate-y-1">
                        <button
                            type="button"
                            class="absolute inset-0 z-10 focus:outline-none w-full h-full"
                            aria-label="Leer más sobre {{ $card->name }}"
                            data-modal-trigger="furniture-modal"
                            data-card="{{ json_encode([
                                'image' => asset('storage/' . $card->image),
                                'name' => $card->name,
                                'service' => $card->service->name ?? 'Servicio',
                                'description' => $card->description,
                            ]) }}"
                        >
                        </button>

                        <!-- Fondo oscuro por defecto -->
                        <div class="absolute inset-0 bg-[#263238] z-0"></div>

                        <!-- Imagen revelada con scroll -->
                        <div
                            class="absolute inset-0 bg-cover bg-center opacity-0 transition-all duration-700 ease-out z-0 group-hover:scale-105"
                            data-bg-reveal
                            style="background-image: url('{{ 'storage/' . $card->image }}'); transition-delay: {{ $index * 100 }}ms;"
                            aria-hidden="true">
                        </div>

                        <!-- Capa de gradiente para mejor legibilidad -->
                        <div class="absolute inset-0 bg-black/50 z-[1]"></div>

                        <!-- Indicador de "ver más" -->
                        <div class="absolute top-3 right-3 z-[3] bg-white/90 rounded-full p-1.5 shadow-md transform translate-y-1 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <circle cx="11" cy="11" r="7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="16.5" y1="16.5" x2="21" y2="21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <!-- Efecto de brillo al pasar el ratón -->
                        <div class="absolute inset-0 z-[1] opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        </div>

                        <!-- Contenido -->
                        <div class="absolute inset-0 z-[2] flex flex-col justify-end p-5">
                            <span class="text-xs text-white/80 mb-1 font-medium tracking-wide">
                                {{ $card->service->name ?? 'Servicio' }}
                            </span>
                            <h3 class="text-lg font-script tracking-widest text-white mb-2 leading-tight">
                                {{ $card->name }}
                            </h3>
                            <div class="w-8 h-0.5 bg-rose-400 mb-3 group-hover:w-12 transition-all duration-500" aria-hidden="true"></div>
                            <p class="text-xs text-white/90 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500 delay-100">
                                {{ substr($card->description, 0, 100) . '...' ?? $card->description }}
                            </p>
                            
                            <!-- Texto indicador de acción -->
                            <div class="mt-2 text-xs text-white/70 font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center">
                                <span>Click para detalles</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endforeach
    @else
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="text-gray-500 text-lg">No hay mobiliario disponible para mostrar</p>
        </div>
    @endif

    <!-- Modal mejorado -->
    <div
        id="furniture-modal"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 transition-all duration-300 opacity-0 pointer-events-none p-4"
        aria-modal="true"
        role="dialog"
        tabindex="-1"
    >
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-auto animate-fade-in overflow-hidden">
            <button
                type="button"
                class="absolute top-4 right-4 z-20 bg-white/90 hover:bg-white rounded-full p-2 shadow-md text-gray-600 hover:text-gray-900 focus:outline-none transition-all duration-300 transform hover:scale-110"
                aria-label="Cerrar"
                id="modal-close-btn"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            
            <div class="flex flex-col md:flex-row">
                <!-- Imagen -->
                <div class="md:w-1/2 relative overflow-hidden">
                    <img id="modal-image" src="" alt="" class="w-full h-72 md:h-full object-cover transition-transform duration-700" />
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/30 opacity-0 transition-opacity duration-500" id="modal-gradient"></div>
                </div>
                
                <!-- Contenido -->
                <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center">
                    <span id="modal-service" class="text-xs text-rose-400 uppercase tracking-widest font-secondary mb-2"></span>
                    <h3 id="modal-name" class="text-2xl md:text-3xl font-script text-[#4b8b97] mt-1 mb-3 leading-tight"></h3>
                    <div class="w-12 h-0.5 bg-rose-400 mb-4"></div>
                    <p id="modal-description" class="text-gray-600 text-sm md:text-base leading-relaxed mb-6"></p>
                    
                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        <svg class="h-6 w-6 mr-1 text-rose-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Disponible en nuestro almacen</span>
                    </div>
                    <!-- Botones de acción (opcionales) -->
                    <div class="pt-4">
                        <div class="flex gap-3">
                            <button id="modal-availability-btn" class="flex-1 btn-action rounded-lg px-4 py-2 transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Consultar disponibilidad
                            </button>
                            {{-- <button class="px-4 py-2 border border-gray-300 hover:border-gray-400 text-gray-700 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .animate-fade-in { 
            animation: fadeInModal 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; 
        }
        
        @keyframes fadeInModal {
            0% { 
                transform: translateY(40px) scale(0.96); 
                opacity: 0; 
            }
            100% { 
                transform: translateY(0) scale(1); 
                opacity: 1; 
            }
        }
        
        /* Efecto de scroll revelador para imágenes */
        [data-bg-reveal] {
            transform: scale(1.1);
            transition: opacity 1.2s ease, transform 1.2s ease;
        }
        
        [data-bg-reveal].opacity-100 {
            transform: scale(1);
        }
    </style>
</section>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Imagen reveal
        const images = document.querySelectorAll('[data-bg-reveal]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100');
                    entry.target.classList.remove('opacity-0');
                } else {
                    entry.target.classList.remove('opacity-100');
                    entry.target.classList.add('opacity-0');
                }
            });
        }, { threshold: 0.15 });
        
        images.forEach(img => observer.observe(img));

        // Modal logic
        const modal = document.getElementById('furniture-modal');
        const modalImage = document.getElementById('modal-image');
        const modalName = document.getElementById('modal-name');
        const modalService = document.getElementById('modal-service');
        const modalDescription = document.getElementById('modal-description');
        const modalGradient = document.getElementById('modal-gradient');
        const closeBtn = document.getElementById('modal-close-btn');

        function openModal(card) {
            modalImage.src = card.image;
            modalImage.alt = card.name;
            modalName.textContent = card.name;
            modalService.textContent = card.service;
            modalDescription.textContent = card.description;
            
            // Resetear animaciones
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            
            // Pequeño delay para activar la transición del gradiente
            setTimeout(() => {
                modalGradient.classList.add('opacity-100');
                modalImage.classList.add('scale-105');
            }, 50);
            
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modalGradient.classList.remove('opacity-100');
            modalImage.classList.remove('scale-105');
            document.body.style.overflow = '';
        }

        document.getElementById('modal-availability-btn').addEventListener('click', function() {
            const phoneNumber = '527293353878';
            const message = encodeURIComponent(`Hola, estoy interesado en el mobiliario "${modalName.textContent}" que vi en su sitio web. ¿Podrían proporcionarme más información?`);
            const url = `https://wa.me/${phoneNumber}?text=${message}`;
            window.open(url, '_blank');
        });

        document.querySelectorAll('[data-modal-trigger]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const card = JSON.parse(btn.getAttribute('data-card'));
                openModal(card);
            });
            
            // Efecto de feedback táctil
            btn.addEventListener('mousedown', (e) => {
                e.currentTarget.style.transform = 'scale(0.98)';
            });
            
            btn.addEventListener('mouseup', (e) => {
                e.currentTarget.style.transform = '';
            });
            
            btn.addEventListener('mouseleave', (e) => {
                e.currentTarget.style.transform = '';
            });
        });

        closeBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (modal.classList.contains('opacity-100') && e.key === 'Escape') closeModal();
        });
    });
</script>
@endpush