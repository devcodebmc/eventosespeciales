@props(['image' => null, 'videoUrl' => null])
<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 py-4 px-4 sm:px-6 lg:px-0 mt-0 bg-white" data-animate>
    <header class="flex flex-col sm:flex-row items-center justify-center my-8 w-full">
        <div class="flex items-center w-full justify-center mt-12">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                Momentos Especiales
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
        {{ $post->title }}
    </h3>
    @if($videoUrl)
    <article class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-8" data-animate>
        <figure class="relative max-w-xs mx-auto my-10 group cursor-pointer transition-all duration-500 ease-in-out hover:-rotate-3 hover:scale-105"
            onclick="openEmbedLightbox('{{ $videoUrl }}')">
            
            <!-- Marco de postal fotográfica con sombra y bordes -->
            <div class="overflow-hidden rounded-lg shadow-2xl border-8 border-white bg-white p-1 transform rotate-1 group-hover:rotate-0 transition-transform duration-500">
                @if($image)
                    <div class="relative">
                        <img src="{{ $image }}" 
                            alt="Miniatura del video"
                            class="w-full h-72 sm:h-80 md:h-96 object-cover transition-all duration-500 ease-in-out blur-sm group-hover:blur-none" 
                            loading="lazy" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-70 group-hover:opacity-30 transition-opacity duration-300"></div>
                    </div>
                @else
                    <div class="w-full h-72 sm:h-80 md:h-96 bg-gradient-to-r from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Ícono de play con efecto de iluminación -->
            <figcaption class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border-2 border-white/80 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:bg-black/50 group-hover:border-white group-hover:backdrop-blur-md">
                    <svg class="w-6 h-6 text-white/90 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 4l10 6-10 6V4z" />
                    </svg>
                </div>
            </figcaption>
        </figure>
    </article>
</section>


<!-- Lightbox rediseñado para móviles -->
<aside id="embedLightbox" class="fixed inset-0 bg-black/95 z-[9999] hidden items-center justify-center p-0 sm:p-4 backdrop-blur-sm opacity-0 transition-opacity duration-300" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="lightboxTitle">
    <div class="relative w-full h-full flex flex-col items-center justify-center">
        <!-- Botón de cerrar mejor posicionado -->
        <button onclick="closeEmbedLightbox()" 
                class="absolute top-2 left-2 sm:top-4 sm:left-4 text-white hover:text-gray-300 p-2 z-50 focus:outline-none focus:ring-2 focus:ring-white/50 rounded-full hover:scale-110 transform transition-transform"
                aria-label="Cerrar reproductor de video">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <!-- Contenedor del video rediseñado -->
        <div class="w-full h-full sm:max-w-4xl sm:max-h-[90vh] sm:rounded-xl bg-black overflow-hidden relative">
            <div id="embedContent" class="w-full h-full flex items-center justify-center relative">
                <!-- Espacio reservado para controles móviles -->
                <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black/80 to-transparent pointer-events-none sm:hidden"></div>
            </div>
        </div>
    </div>
</aside>
@endif

@push('js')
<script>
    function openEmbedLightbox(videoUrl) {
        const lightbox = document.getElementById('embedLightbox');
        const contentDiv = document.getElementById('embedContent');
        
        // Mostrar loader
        contentDiv.innerHTML = `
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-white/50"></div>
                <p class="text-white/70 text-sm">Cargando video...</p>
            </div>
        `;
        
        // Mostrar lightbox (sin padding en móviles)
        lightbox.classList.remove('hidden');
        setTimeout(() => {
            lightbox.classList.add('opacity-100');
            document.body.classList.add('overflow-hidden');
            
            // Crear iframe optimizado para móviles
            setTimeout(() => {
                contentDiv.innerHTML = '';
                
                const iframe = document.createElement('iframe');
                iframe.className = 'w-full h-full absolute top-0 left-0';
                iframe.setAttribute('allow', 'autoplay; fullscreen; accelerometer; gyroscope; picture-in-picture');
                iframe.setAttribute('frameborder', '0');
                iframe.setAttribute('allowfullscreen', '');
                
                // Atributos críticos para controles en móviles
                iframe.setAttribute('playsinline', 'true');
                iframe.setAttribute('webkit-playsinline', 'true');
                iframe.setAttribute('controlsList', 'nodownload');
                
                // Ajustar el viewport para móviles
                const metaViewport = document.createElement('meta');
                metaViewport.name = 'viewport';
                metaViewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no';
                document.head.appendChild(metaViewport);
                
                // Procesar URL con parámetros para controles móviles
                if (videoUrl.includes('youtube.com/watch') || videoUrl.includes('youtu.be/')) {
                    const videoId = videoUrl.includes('youtube.com/watch') ? 
                        videoUrl.split('v=')[1].split('&')[0] : 
                        videoUrl.split('youtu.be/')[1];
                    iframe.src = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&mute=0&rel=0&modestbranding=1&playsinline=1&controls=1&showinfo=0`;
                } else if (videoUrl.includes('vimeo.com')) {
                    const videoId = videoUrl.split('vimeo.com/')[1];
                    iframe.src = `https://player.vimeo.com/video/${videoId}?autoplay=1&title=0&byline=0&portrait=0&playsinline=1&controls=1`;
                } else {
                    iframe.src = videoUrl;
                }
                
                // Asegurar espacio para controles en móviles
                if (window.innerWidth < 640) {
                    iframe.style.height = 'calc(100% - 60px)'; // Espacio para controles
                }
                
                contentDiv.appendChild(iframe);
                
                // Forzar redimensionamiento en iOS
                setTimeout(() => {
                    iframe.style.height = iframe.offsetHeight + 'px';
                }, 500);
            }, 300);
        }, 10);
    }

    function closeEmbedLightbox() {
        const lightbox = document.getElementById('embedLightbox');
        lightbox.classList.remove('opacity-100');
        
        // Restaurar el viewport
        const metaViewport = document.querySelector('meta[name="viewport"]');
        if (metaViewport) {
            metaViewport.content = 'width=device-width, initial-scale=1.0';
        }
        
        setTimeout(() => {
            lightbox.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.getElementById('embedContent').innerHTML = '';
        }, 300);
    }

    // Event listeners (mantén los existentes)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('embedLightbox').classList.contains('hidden')) {
            closeEmbedLightbox();
        }
    });
    
    document.getElementById('embedLightbox')?.addEventListener('click', function(e) {
        if (e.target === e.currentTarget) {
            closeEmbedLightbox();
        }
    });
    
    // Ajustar el iframe al cambiar orientación
    window.addEventListener('resize', function() {
        const iframe = document.querySelector('#embedContent iframe');
        if (iframe && window.innerWidth < 640) {
            iframe.style.height = 'calc(100% - 60px)';
        } else if (iframe) {
            iframe.style.height = '100%';
        }
    });
</script>
@endpush