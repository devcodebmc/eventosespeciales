<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700" data-animate>
    <header class="flex items-center justify-center my-6">
        <span class="w-10 border-t border-[#4b8b97] mx-2"></span>
        <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
        </svg>
        <h2 class="text-lg text-gray-500 tracking-widest uppercase mx-4">
            SERVICES
        </h2>
        <svg class="mx-0" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
        </svg>
        <span class="w-10 border-t border-[#4b8b97] mx-2"></span>
    </header>
    <h3 class="text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center">
        Planificación de Principio a Fin
    </h3>
</section>

<section aria-labelledby="services-heading" class="w-full mt-10">
    <div class="grid grid-cols-1 md:grid-cols-3 items-stretch gap-8">
        @foreach($services as $service)
            <article class="flex-1 p-8 flex flex-col items-center text-center" aria-label="{{ $service->name }}">
                <figure>
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-40 h-40 object-cover mb-4">
                </figure>
                <header>
                    <h3 class="text-2xl font-secondary text-[#2A4044] mb-3">{{ $service->name }}</h3>
                </header>
                <p class="text-gray-500 mb-6">{{ $service->description }}</p>
                <a href="{{ route('services.show', $service->id) }}" class="relative inline-block text-gray-400  transition-colors duration-200 hover:text-gray-600 group">
                    Ver Más
                    <span class="block mx-auto w-6 h-0.5 bg-[#4b8b97] opacity-0 group-hover:opacity-100 transition-opacity duration-700 mt-1"></span>
                </a>
            </article>
        @endforeach
    </div>
</section>


