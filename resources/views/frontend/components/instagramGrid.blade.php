<section class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        {{-- Encabezado con la misma línea de diseño del sitio --}}
        <div class="text-center mb-12">
            <a href="https://www.instagram.com/fincaisabelaeventos/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-[#2A4044] font-secondary text-lg mb-2">
                @fincaisabelaeventos
                <sup>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </sup>
            </a>
            <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-gray-800 font-light tracking-wide py-2">
                Descubre el <span class="text-[#4b8b97]  font-medium">Espacio</span> que nos define
            </h2>
            <div class="w-24 h-0.5 bg-[#4b8b97]  mx-auto mt-4 mb-4"></div>
            <p class="max-w-4xl mx-auto mt-4 text-sm sm:text-base md:text-lg text-gray-600 text-center px-2">
                Finca Isabela es un espacio único para vivir celebraciones memorables, con salones elegantes, jardines de eventos y ambientes diseñados para bodas, fiestas infantiles, XV años, reuniones empresariales y cada ocasión especial que puedas imaginar.
            </p>
        </div>

        {{-- Grid de Instagram --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
            @foreach ($instagramGallery as $item)
            <a href="{{ $item->video_url }}"
            class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col justify-center min-h-[200px]"
            target="_blank"
            rel="noopener noreferrer">

                {{-- Fondo degradado base --}}
                <div class="absolute inset-0 bg-gradient-to-br from-[#4b8b97]/40 via-[#2c6b75]/25 to-[#1a4a52]/50 z-0"></div>

                {{-- Imagen centrada, respeta su alto natural --}}
                <img
                    src="{{ $item->image }}"
                    alt="{{ $item->title }}"
                    class="relative z-10 w-full h-auto object-contain transition-transform duration-500 group-hover:scale-105"
                >

                {{-- Overlay hover --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-end p-4 z-20">
                
                    <span class="text-white/80 text-lg font-light flex items-center gap-1.5 text-center mb-2">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                        Ver en Instagram
                    </span>

                    @if($item->title)
                    <p class="text-white text-xs font-medium leading-snug line-clamp-2 tracking-wide text-center mb-2">
                        {{ $item->title }}
                    </p>
                    @endif

                </div>
            </a>
            @endforeach
        </div>

        {{-- Botón de llamado a la acción --}}
        <div class="text-center mt-10">
            <a href="https://www.instagram.com/fincaisabelaeventos/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 px-8 py-3 bg-gradient-to-r from-[#4b8b97] to-[#2A4044] text-white font-serif rounded-full shadow-md hover:shadow-lg hover:from-[#2A4044] hover:to-[#4b8b97] transition-all duration-300 text-sm md:text-base">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Síguenos en Instagram
            </a>
        </div>
    </div>
</section>