<section class="flex flex-col items-center sm:items-start opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-8 mt-8" data-animate>
    <header class="flex flex-col sm:flex-row items-center sm:items-start justify-start my-6 w-full">
        <div class="flex items-center w-full justify-center sm:justify-start gap-3">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center sm:text-left">
                Único y perfecto
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center sm:text-left px-2 ml-0">
        Momentos Memorables en Cada Celebración
    </h3>
</section>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 md:gap-6 lg:gap-4 mt-12 justify-center items-stretch w-full px-8 md:px-6 lg:px-4 place-items-center">
    @foreach ($moments as $moment)
        <div class="flex flex-col flex-1 max-w-md w-full py-4" data-animate-scale>
            <div class="grid grid-cols-2 sm:grid-cols-3 grid-rows-2 gap-2">
                @if (count($moment->images) > 0)
                    @foreach ($moment->images as $index => $image)
                        @if ($index == 0)
                            <div class="col-span-2 sm:col-span-2 row-span-2 rounded-xl overflow-hidden">
                                <img src="{{ asset($image->image_path) }}" alt="Ilustración 1 del momento - {{ $moment->title }}" class="w-full h-full object-cover" loading="lazy" decoding="async" fetchpriority="low"/>
                            </div>
                        @elseif ($index == 1)
                            <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                                <img src="{{ asset($image->image_path) }}" alt="Ilustración 2 del momento - {{ $moment->title }}" class="w-full h-full object-cover" loading="lazy" decoding="async" fetchpriority="low"/>
                            </div>
                        @elseif ($index == 2)
                            <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                                <img src="{{ asset($image->image_path) }}" alt="Ilustración 3 del momento - {{ $moment->title }}" class="w-full h-full object-cover" loading="lazy" decoding="async" fetchpriority="low"/>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="col-span-2 sm:col-span-2 row-span-2 rounded-xl overflow-hidden">
                        <img src="{{ asset($moment->image) }}" alt="Imagen principal del momento - {{ $moment->title }}" class="w-full h-full object-cover" loading="lazy" decoding="async" fetchpriority="low"/>
                    </div>
                @endif
            </div>
            <div class="mt-6">
                <h4 class="text-xl sm:text-2xl font-secondary text-[#2A4044]">
                    {{ $moment->category->name }}
                </h4>
                <a href="{{ route('events.showEvent', $moment->slug) }}" 
                    class="text-[#2A4044] mt-1 text-sm sm:text-base font-medium hover:text-[#4b8b97] transition-colors duration-300">
                    {{ $moment->title }}
                    {{-- open link in new tab icon  --}}
                    <svg class="inline-block ml-1 " xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach ($moment->tags->take(3) as $tag)
                        <span class="bg-[#fbeee6] text-[#2A4044] px-3 py-1 rounded-md text-sm sm:text-base">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
