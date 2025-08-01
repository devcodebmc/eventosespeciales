<!-- LIGHTBOX -->
<div id="small-lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/0 transition-all duration-300 ease-in-out">
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-black/90 transition-opacity duration-300 ease-in-out"></div>

    <!-- Botón cerrar -->
    <button 
        class="absolute top-5 right-5 text-white text-3xl hover:text-gray-300 focus:outline-none z-50"
        onclick="closeLightbox()"
        aria-label="Cerrar lightbox"
    >
        &times;
    </button>

    <!-- Contenedor principal -->
    <div class="relative w-full h-full flex items-center justify-center">

        <!-- Botón anterior -->
        <button 
            class="absolute left-4 text-white bg-white/10 hover:bg-white/20 p-2 rounded-full transition transform hover:scale-110 focus:outline-none z-40"
            onclick="changeSlide(-1)"
            aria-label="Imagen anterior"
        >
            &#10094;
        </button>

        <!-- Imagen -->
        <div class="max-w-4xl w-full mx-auto px-4 relative z-30 scale-95 opacity-0 transition-all duration-300 ease-in-out">
            <img 
                id="small-lightbox-image"
                class="max-h-[80vh] mx-auto rounded-lg shadow-md transition-transform duration-300 ease-in-out"
                src=""
                alt=""
                loading="lazy"
            >
            <p id="small-lightbox-caption" class="text-white text-center mt-3 text-base opacity-0 transition-opacity duration-300 ease-in-out"></p>
        </div>

        <!-- Botón siguiente -->
        <button 
            class="absolute right-4 text-white bg-white/10 hover:bg-white/20 p-2 rounded-full transition transform hover:scale-110 focus:outline-none z-40"
            onclick="changeSlide(1)"
            aria-label="Imagen siguiente"
        >
            &#10095;
        </button>
    </div>
</div>

@push('js')
<script>
    let currentIndex = 0;
    let galleryImages = [];
    let isAnimating = false;

    document.addEventListener('DOMContentLoaded', function() {
        const thumbnails = document.querySelectorAll('.gallery-thumbnail');
        galleryImages = Array.from(thumbnails).map(thumb => ({
            src: thumb.querySelector('img').dataset.largeSrc || thumb.querySelector('img').src,
            alt: thumb.querySelector('img').alt,
            index: parseInt(thumb.dataset.index)
        })).sort((a, b) => a.index - b.index);
    });

    function openLightbox(index) {
        if (isAnimating) return;
        isAnimating = true;

        currentIndex = index;
        const lightbox = document.getElementById('small-lightbox');
        const content = lightbox.querySelector('div.max-w-4xl');
        const image = document.getElementById('small-lightbox-image');
        const caption = document.getElementById('small-lightbox-caption');

        const img = new Image();
        img.src = galleryImages[currentIndex].src;
        img.onload = function() {
            image.src = this.src;
            caption.textContent = galleryImages[currentIndex].alt;

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0)';

            setTimeout(() => {
                lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
            }, 10);

            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');

                setTimeout(() => {
                    caption.classList.remove('opacity-0');
                    caption.classList.add('opacity-100');
                    isAnimating = false;
                }, 200);
            }, 300);

            document.body.style.overflow = 'hidden';
        };
    }

    function closeLightbox() {
        if (isAnimating) return;
        isAnimating = true;

        const lightbox = document.getElementById('small-lightbox');
        const content = lightbox.querySelector('div.max-w-4xl');
        const caption = document.getElementById('small-lightbox-caption');

        caption.classList.remove('opacity-100');
        caption.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        lightbox.style.backgroundColor = 'rgba(0, 0, 0, 0)';

        setTimeout(() => {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            isAnimating = false;
            document.body.style.overflow = 'auto';
        }, 300);
    }

    function changeSlide(step) {
        if (isAnimating) return;
        isAnimating = true;

        const image = document.getElementById('small-lightbox-image');
        const caption = document.getElementById('small-lightbox-caption');
        const content = document.querySelector('#small-lightbox div.max-w-4xl');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        caption.classList.remove('opacity-100');
        caption.classList.add('opacity-0');

        setTimeout(() => {
            currentIndex += step;
            if (currentIndex >= galleryImages.length) currentIndex = 0;
            else if (currentIndex < 0) currentIndex = galleryImages.length - 1;

            const img = new Image();
            img.src = galleryImages[currentIndex].src;
            img.onload = function() {
                image.src = this.src;
                caption.textContent = galleryImages[currentIndex].alt;

                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                    setTimeout(() => {
                        caption.classList.remove('opacity-0');
                        caption.classList.add('opacity-100');
                        isAnimating = false;
                    }, 200);
                }, 10);
            };
        }, 300);
    }

    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('small-lightbox');
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            else if (e.key === 'ArrowLeft') changeSlide(-1);
            else if (e.key === 'ArrowRight') changeSlide(1);
        }
    });
</script>
@endpush
