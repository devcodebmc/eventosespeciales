@props(['image' => null, 'videoUrl' => null])

@if($videoUrl)
<article class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-8" data-animate>
    <figure class="relative max-w-xs mx-auto my-10 group cursor-pointer transition-all duration-500 ease-in-out hover:-rotate-3 hover:scale-110"
        onclick="openVideoLightbox('{{ $videoUrl }}')">
        
        <!-- Marco de postal fotográfica con sombra y bordes -->
        <div class="overflow-hidden rounded-lg shadow-2xl border-8 border-white bg-white p-1 transform rotate-1 group-hover:rotate-0 transition-transform duration-500">
            <img src="{{ $image ?? asset('images/example.jpg') }}"
                alt="Miniatura del video"
                class="w-full h-72 sm:h-80 md:h-96 object-cover transition-all duration-500 ease-in-out" 
                loading="lazy" />
        </div>

        <!-- Ícono de play minimalista blanco -->
        <figcaption class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-16 h-16 bg-transparent border-2 border-white rounded-full flex items-center justify-center backdrop-blur-sm transition-all duration-300 group-hover:scale-110">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M6 4l10 6-10 6V4z" />
                </svg>
            </div>
        </figcaption>
    </figure>
</article>

<!-- Lightbox mejorado -->
<aside id="videoLightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center p-4" aria-hidden="true" aria-labelledby="lightboxTitle">
    <div class="relative w-full max-w-6xl">
        <header class="flex justify-end mb-2">
            <button onclick="closeVideoLightbox()" 
                    class="text-white hover:text-gray-300 transition-colors"
                    aria-label="Cerrar reproductor de video">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>
        
        <main class="bg-black rounded-lg overflow-hidden shadow-2xl">
            <video id="lightboxVideo" class="w-full h-auto max-h-[80vh]" controls autoplay playsinline aria-labelledby="lightboxTitle">
                <source src="" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
        </main>
        
        <footer class="mt-2 text-center text-white text-sm opacity-75">
            Presiona ESC para salir
        </footer>
    </div>
</aside>
@endif

@push('js')
<script>
    function openVideoLightbox(videoUrl) {
        const lightbox = document.getElementById('videoLightbox');
        const video = document.getElementById('lightboxVideo');
        const source = video.querySelector('source');
        
        // Cargar el video
        source.src = videoUrl;
        video.load();
        source.type = getVideoType(videoUrl);
        
        // Mostrar lightbox
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        document.documentElement.style.paddingRight = window.innerWidth - document.documentElement.clientWidth + 'px';
        
        // Intentar reproducción automática (con mute para evitar bloqueos)
        video.muted = true;
        const playPromise = video.play();
        
        if (playPromise !== undefined) {
            playPromise.catch(e => {
                console.log("Autoplay bloqueado:", e);
                video.controls = true;
            }).then(() => {
                // Si se reproduce con éxito, quitar mute si el usuario interactúa
                video.addEventListener('click', () => video.muted = false, { once: true });
            });
        }
    }

    function closeVideoLightbox() {
        const lightbox = document.getElementById('videoLightbox');
        const video = document.getElementById('lightboxVideo');
        
        video.pause();
        video.currentTime = 0;
        lightbox.classList.remove('flex');
        lightbox.classList.add('hidden');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        document.documentElement.style.paddingRight = '';
    }

    function getVideoType(url) {
        const extension = url.split('.').pop().split(/#|\?/)[0].toLowerCase();
        return {
            'mp4': 'video/mp4',
            'webm': 'video/webm',
            'ogg': 'video/ogg',
            'mov': 'video/quicktime'
        }[extension] || 'video/mp4';
    }

    // Event listeners mejorados
    document.addEventListener('keydown', (e) => e.key === 'Escape' && closeVideoLightbox());
    
    document.getElementById('videoLightbox')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget || e.target.classList.contains('close-lightbox')) {
            closeVideoLightbox();
        }
    });
</script>
@endpush