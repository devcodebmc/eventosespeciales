@extends('frontend.layouts.main')

@section('title', $post->title . ' - ' . config('app.name'))
@section('description', $post->summary)
@section('keywords', implode(', ', $post->tags->pluck('name')->toArray()))
@section('canonical', url()->current())
@section('alternate', url()->current())

@section('ogtitle', $post->title . ' - ' . config('app.name'))
@section('ogdescription', $post->summary)
@section('ogurl', url()->current())
@section('ogimage', asset('storage/' . $serviceImage->image))
@section('ogimage:secure_url', asset('storage/' . $serviceImage->image))

@section('twittertitle', $post->title . ' - ' . config('app.name'))
@section('twitterdescription', $post->summary)
@section('twitterimage', asset('storage/' . $serviceImage->image))

@section('content')
<main>
    <section class="bg-white relative overflow-hidden" aria-labelledby="acerca-de-nosotros">
        <!-- Flores decorativas - Visibles en todas las resoluciones -->
        <div role="presentation" class="pointer-events-none select-none absolute -left-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-56 lg:h-56 xl:w-72 xl:h-72 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-izquierda.png') }}" alt="Imagen decorativa de flor izquierda" 
                 class="w-full h-full object-contain object-left-top"
                 style="clip-path: inset(0 0 20% 0);" 
                 aria-hidden="true" decoding="async" loading="lazy">
        </div>
        
        <div role="presentation" class="pointer-events-none select-none absolute -right-2 top-10 w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-64 lg:h-64 xl:w-80 xl:h-80 2xl:w-96 2xl:h-96 opacity-0 transition-all duration-700 z-0" data-animate>
            <img src="{{ asset('images/flor-derecha.png') }}" alt="Imagen decorativa de flor derecha" 
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
                        Servicios
                    </p>
                    <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" focusable="false">
                        <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                    </svg>
                    <span class="w-24 sm:w-36 border-t border-[#4b8b97] mx-2"></span>
                </div>
                <h1 id="acerca-de-nosotros" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-[#2A4044] font-secondary text-center mt-8 px-4">
                    {{ $post->title }}
                </h1>
            </article>
        </div>
        @include('frontend.partials.divider')
        <section class="bg-white relative overflow-hidden flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0" data-animate>
            <!-- Imagen decorativa del servicio -->
            <figure 
                class="w-16 h-16 md:w-24 md:h-24 lg:w-32 lg:h-32 rounded-full border-2 border-gray-300 flex items-center justify-center overflow-hidden bg-white shadow-md"
            >
                <img 
                    src="{{ asset('storage/' . $serviceImage->image) }}" 
                    alt="Imagen decorativa del servicio" 
                    width="80" height="80" 
                    class="w-10 h-10 md:w-16 md:h-16 lg:w-20 lg:h-20 object-contain" 
                    aria-hidden="true" 
                    decoding="async" 
                    loading="lazy"
                >
                <figcaption class="sr-only">Imagen decorativa del servicio</figcaption>
            </figure>

            <!-- Imagen principal del post -->
            <figure class="w-full max-w-6xl mt-4 mb-8">
                <img 
                    src="{{ asset($post->image) }}" 
                    alt="{{ $post->title }}" 
                    width="1200" height="675" 
                    class="w-full h-auto object-cover rounded-lg" 
                    decoding="async" 
                    loading="eager"
                >
                <figcaption class="sr-only">{{ $post->title }}</figcaption>
            </figure>
            <header class="w-full max-w-4xl mx-auto px-2 flex flex-col items-start">
                <h2 class="text-base sm:text-lg md:text-xl lg:text-4xl text-[#2A4044] font-secondary text-left">
                    {{ $post->title }}
                </h2>
                <p class="mt-4 text-sm sm:text-base md:text-lg text-gray-500 text-left w-full">
                    {{ $post->summary }}
                </p>
            </header>
        </section>
        @include('frontend.partials.lightbox')
        <section class="bg-white w-full mx-auto px-2 my-8 prose prose-lg prose-blue text-center">
            <div class="w-full max-w-4xl mx-auto px-2 text-left">
            {!! $post->content !!}
            </div>
        </section>
        @include('frontend.components.cardContact')
        @include('frontend.partials.subscriptionBanner')
        @include('frontend.partials.faqs')
    </section>
</main>
@endsection
