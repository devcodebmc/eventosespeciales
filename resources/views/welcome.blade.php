@extends('frontend.layouts.main')

@section('content')
<section class="bg-white">
    <div class="container mx-auto py-4">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#4b8b97] mb-4">Eventos Especiales Lerma</h1>
            <div class="flex items-center justify-center my-6">
                <span class="w-36 border-t border-[#4b8b97] mx-2"></span>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <p class="text-md text-gray-500 tracking-widest uppercase mx-4">
                Tu planificador de confianza para eventos inolvidables
                </p>
                <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
                </svg>
                <span class="w-36 border-t border-[#4b8b97] mx-2"></span>
            </div>
            <h2 class="text-2xl md:text-4xl lg:text-8xl text-[#2A4044] font-secondary text-center mt-8">
                Creando una Celebración Inolvidable
            </h2>
            <div class="flex items-center justify-center mt-8">
                <a href="#" class="btn-action text-lg py-5 px-10">
                    Nuestro Trabajo
                </a>
            </div>
        </div>
    </div>
    @include('frontend.partials.services')
    @include('frontend.partials.shortHistory')
    @include('frontend.partials.moments')
    @include('frontend.partials.packages')
    @include('frontend.partials.shortDescription')
</section> 
@endsection
