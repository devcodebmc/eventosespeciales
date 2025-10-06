@extends('frontend.layouts.main')

@section('title', $post->title . ' - ' . config('app.name'))
@section('description', $post->summary)
@section('keywords', implode(', ', $post->tags->pluck('name')->toArray()))
@section('canonical', url()->current())
@section('alternate', url()->current())

@section('ogtitle', $post->title . ' - ' . config('app.name'))
@section('ogdescription', $post->summary)
@section('ogurl', url()->current())
@section('ogimage', asset($post->image))
@section('ogimage:secure_url', asset($post->image))

@section('twittertitle', $post->title . ' - ' . config('app.name'))
@section('twitterdescription', $post->summary)
@section('twitterimage', asset($post->image))


@section('content')
<main>
    <section class="bg-white relative overflow-hidden" aria-labelledby="titulo-del-evento">
        <!-- Flores decorativas - Visibles en todas las resoluciones -->
        <div role="presentation" class="pointer-events-none select-none absolute -left-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-72 xl:h-72 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-izquierda.png') }}" alt="" 
                 class="w-full h-full object-contain object-left-top"
                 style="clip-path: inset(0 0 20% 0);" 
                 aria-hidden="true" decoding="async" loading="lazy">
        </div>
        
        <div role="presentation" class="pointer-events-none select-none absolute -right-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-64 lg:h-64 xl:w-80 xl:h-80 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-derecha.png') }}" alt="" 
                 class="w-full h-full object-contain object-right-top"
                 style="clip-path: inset(0 0 20% 0);" 
                 aria-hidden="true" decoding="async" loading="lazy">
        </div>

        <div class="container mx-auto py-4 relative z-10 opacity-0 transition-all duration-700" data-animate>
            <article class="text-center mb-8 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center my-6" aria-hidden="true">
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <p class="text-lg text-gray-500 tracking-widest uppercase mx-2 sm:mx-4">
                        Eventos
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="titulo-del-evento" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    {{ $post->title }}
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        
        <!-- Contenido principal con altura automática para la imagen -->
        <article class="flex flex-col lg:flex-row bg-white overflow-hidden p-6 md:p-10">
            <!-- Imagen principal con iconos de compartir siempre visibles -->
            <figure class="w-full lg:w-1/2 relative">
                <div class="w-full h-64 md:h-80 lg:h-full overflow-hidden rounded-lg relative">
                <img src="{{ asset($post->image) }}" alt="Evento Privado en San Nicolás Peralta" class="w-full h-full object-cover rounded-lg">
                    
                    <!-- Iconos de compartir - Esquina superior derecha, siempre visibles -->
                    <div class="absolute top-4 right-4 z-20">
                        <div class="flex flex-col gap-2">
                            <!-- Facebook -->
                            <button 
                                onclick="shareOnFacebook()" 
                                class="w-8 h-8 bg-[#FFF0EC] hover:bg-[#ffdcd2] text-[#2A4044] rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition-all duration-200"
                                title="Compartir en Facebook"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </button>
                            
                            <!-- Twitter/X -->
                            <button 
                                onclick="shareOnTwitter()" 
                                class="w-8 h-8 bg-[#FFF0EC] hover:bg-[#ffdcd2] text-[#2A4044] rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition-all duration-200"
                                title="Compartir en X"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </button>
                            
                            <!-- Pinterest -->
                            <button 
                                onclick="shareOnPinterest()" 
                                class="w-8 h-8 bg-[#FFF0EC] hover:bg-[#ffdcd2] text-[#2A4044] rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition-all duration-200"
                                title="Compartir en Pinterest"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.221.085.343-.09.381-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                </svg>
                            </button>
                            
                            <!-- Copiar enlace -->
                            <button 
                                onclick="copyToClipboard()" 
                                data-share="copy"
                                class="w-8 h-8 bg-[#FFF0EC] hover:bg-[#ffdcd2] text-[#2A4044] rounded-full flex items-center justify-center shadow-sm hover:shadow-md transition-all duration-200"
                                title="Copiar enlace"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </figure>

            <!-- Contenido con altura ajustable -->
            <section class="w-full lg:w-1/2 flex flex-col justify-start mt-8 lg:mt-0 lg:pl-10">
                <div class="flex-1">
                    <header class="mb-6">
                        <h2 class="text-4xl font-script text-[#2A4044] mb-1">
                            {{ $post->title }}
                        </h2>
                        <p class="text-lg tracking-widest uppercase text-[#65ABB7]">
                            {{ strtoupper($post->location) }} - {{ mb_strtoupper(\Carbon\Carbon::parse($post->event_date)->translatedFormat('F Y'), 'UTF-8') }}
                        </p>
                    </header>

                    <!-- Descripción -->
                    <section class="mb-10 text-gray-700 text-[15px] leading-relaxed flex-1">
                        <p class="text-base italic text-[#5A6466] mb-4">
                            {{ $post->summary }}
                        </p>
                    </section>
                    <!-- Caja de detalles -->
                    <footer class="relative flex flex-col items-center bg-[#FFF0EC] rounded-sm lg:rounded-sm xl:rounded-full px-8 py-8 overflow-hidden mt-auto">
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 text-center sm:text-left">
                            <!-- Imagen decorativa más grande y centrada -->
                            <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 shrink-0 overflow-hidden">
                                <img src="{{ asset('images/flower-pattern.png') }}" alt="Detalles florales decorativos" class="w-full h-full object-cover">
                            </div>

                            <!-- Lista de datos centrada y distribuida -->
                            <dl class="flex flex-col gap-4 p-6 w-full max-w-md">
                                <div class="flex items-center gap-2">
                                    <dt class="font-secondary text-[#2A4044] w-20 text-start">Cliente</dt>
                                    <span class="text-[#2A4044] font-semibold">:</span>
                                    <dd class="text-[#5A6466] flex-1">{{ $post->client ?? 'General' }}</dd>
                                </div>
                                <div class="flex items-center gap-2">
                                    <dt class="font-secondary text-[#2A4044] w-20 text-start">Lugar</dt>
                                    <span class="text-[#2A4044] font-semibold">:</span>
                                    <dd class="text-[#5A6466] flex-1">{{ $post->location }}</dd>
                                </div>
                                <div class="flex items-center gap-2">
                                    <dt class="font-secondary text-[#2A4044] w-20 text-start">Fecha</dt>
                                    <span class="text-[#2A4044] font-semibold">:</span>
                                    <dd class="text-[#5A6466] flex-1">
                                        {{ \Carbon\Carbon::parse($post->event_date)->translatedFormat('d \d\e F, Y') }}
                                    </dd>
                                </div>
                                <div class="flex items-center gap-2">
                                    <dt class="font-secondary text-[#2A4044] w-20 text-start">Etiquetas</dt>
                                    <span class="text-[#2A4044] font-semibold">:</span>
                                    <dd class="text-[#5A6466] flex-1">{{ $post->tags->pluck('name')->implode(', ') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </footer>
                </div>  
            </section>
        </article>
        
        <article class="prose prose-lg prose-gray bg-white overflow-hidden transition-all duration-300 ease-in-out px-4 py-6 sm:px-6 md:px-10 lg:px-16 max-w-7xl mx-auto rich-content" data-animate>
            {!! $post->content !!}
        </article>
       <!-- Grid de imágenes responsive con lightbox -->
       @include('frontend.partials.specialLightbox')
        <!-- video del evento $post->video_url -->
        @include('frontend.partials.videoLightbox', [
            'image' => $post->image,
            'videoUrl' => $post->video_url
        ])
        @include('frontend.partials.generalTags', ['tags' => $post->tags->pluck('slug')])
        <section class="py-8">
            @include('frontend.partials.divider')
        </section>
        <section>
            @include('frontend.partials.blockquote')
            @include('frontend.partials.promotions')
            @include('frontend.components.cardContact')
            @include('frontend.partials.eventCards', ['excludeId' => $post->id])
        </section>
    </section>
</main>
@endsection

@push('js')
<script>
function shareOnFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent('{{ $post->title }}');
    const tags = encodeURIComponent('{{ $post->tags->pluck('slug')->implode(',') }}');
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}&hashtags=${tags}`, '_blank', 'width=600,height=400');
}

function shareOnPinterest() {
    const url = encodeURIComponent(window.location.href);
    const media = encodeURIComponent('{{ asset($post->image) }}');
    const description = encodeURIComponent('{{ $post->summary }}');
    window.open(`https://pinterest.com/pin/create/button/?url=${url}&media=${media}&description=${description}`, '_blank', 'width=600,height=400');
}

function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const button = document.querySelector('[data-share="copy"]');
        const originalSvg = button.innerHTML;
        button.innerHTML = `
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        `;
        button.classList.add('bg-[#65ABB7]', 'text-white');
        button.classList.remove('bg-[#FFF0EC]', 'hover:bg-[#ffdcd2]', 'text-[#2A4044]');
        
        setTimeout(() => {
            button.innerHTML = originalSvg;
            button.classList.remove('bg-[#65ABB7]', 'text-white');
            button.classList.add('bg-[#FFF0EC]', 'hover:bg-[#ffdcd2]', 'text-[#2A4044]');
        }, 1000);
    }).catch(() => {
        // Fallback para navegadores que no soportan clipboard API
        const textArea = document.createElement('textarea');
        textArea.value = window.location.href;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    });
}
</script>
@endpush