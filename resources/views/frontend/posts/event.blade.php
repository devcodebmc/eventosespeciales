@extends('frontend.layouts.main')

@section('title', $post->title . ' - ' . config('app.name'))
@section('description', $post->summary)
@section('keywords', implode(', ', $post->tags->pluck('name')->toArray()))
@section('canonical', url()->current())

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
        <article class="flex flex-col lg:flex-row bg-white overflow-hidden p-6 md:p-10">
            <!-- Imagen principal -->
            <figure class="w-full lg:w-1/2">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover rounded-lg">
            </figure>

            <!-- Contenido -->
            <section class="w-full lg:w-1/2 flex flex-col justify-between mt-8 lg:mt-0 lg:pl-10">
                <header class="mb-6">
                    <h2 class="text-4xl font-script text-[#2A4044] mb-1">
                        {{ $post->title }}
                    </h2>
                    <p class="text-lg tracking-widest uppercase text-[#4b8b97]">
                        {{ strtoupper($post->location) }} - {{ mb_strtoupper(\Carbon\Carbon::parse($post->event_date)->translatedFormat('F Y'), 'UTF-8') }}
                    </p>
                </header>

                <!-- Descripción -->
                <section class="mb-10 text-gray-700 text-[15px] leading-relaxed">
                    <p class="text-base italic text-gray-800 mb-4">
                        {{ $post->summary }}
                    </p>
                </section>

                <!-- Caja de detalles -->
                <footer class="relative flex flex-col items-center bg-gray-100 rounded-sm lg:rounded-sm xl:rounded-full px-8 py-8 overflow-hidden">
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
                                <dd class="text-gray-900 flex-1">{{ $post->client ?? 'Pendiente' }}</dd>
                            </div>
                            <div class="flex items-center gap-2">
                                <dt class="font-secondary text-[#2A4044] w-20 text-start">Lugar</dt>
                                <span class="text-[#2A4044] font-semibold">:</span>
                                <dd class="text-gray-900 flex-1">{{ $post->location }}</dd>
                            </div>
                            <div class="flex items-center gap-2">
                                <dt class="font-secondary text-[#2A4044] w-20 text-start">Fecha</dt>
                                <span class="text-[#2A4044] font-semibold">:</span>
                            <dd class="text-gray-900 flex-1">
                                    {{ \Carbon\Carbon::parse($post->event_date)->translatedFormat('d \d\e F, Y') }}
                                </dd>
                            </div>
                            <div class="flex items-center gap-2">
                                <dt class="font-secondary text-[#2A4044] w-20 text-start">Etiquetas</dt>
                                <span class="text-[#2A4044] font-semibold">:</span>
                                <dd class="text-gray-900 flex-1">{{ $post->tags->pluck('name')->implode(', ') }}</dd>
                            </div>
                        </dl>
                    </div>
                </footer>
            </section>
        </article>
        <article class="prose prose-lg prose-gray bg-white overflow-hidden transition-all duration-300 ease-in-out px-4 py-6 sm:px-6 md:px-10 lg:px-16 max-w-7xl mx-auto rich-content">
            {!! $post->content !!}
        </article>
       <!-- Grid de imágenes responsive con lightbox -->
       @include('frontend.partials.specialLightbox')
        <!-- video del evento $post->video_url -->
        @include('frontend.partials.videoLightbox', [
            'image' => $post->image,
            'videoUrl' => $post->video_url
        ])
        <section class="py-8">
            @include('frontend.partials.divider')
        </section>
        <section>
            @include('frontend.partials.blockquote')
            @include('frontend.partials.packages')
            @include('frontend.partials.contactForm')
            @include('frontend.partials.eventCards', ['excludeId' => $post->id])
        </section>
    </section>
</main>
@endsection
