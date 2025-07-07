<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-8 bg-gray-100" data-animate>
    <header class="flex flex-col sm:flex-row items-center justify-center my-8 w-full">
        <div class="flex items-center w-full justify-center mt-12">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                Elige tu mejor paquete
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
       Precio y Plan Cómodos para Todos
    </h3>
</section>

<section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @php
                $plans = [
                    [
                        'title' => 'Basic Plan',
                        'price' => '$150',
                        'text' => 'Our services begin with an initial consultation in which we learn about your individual needs, preferences, and budget.',
                        'image' => 'https://assets-global.website-files.com/648044f76e52ed7cac83946c/6486a20da369abe71170996e_pricing-image-01-p-500.jpg'
                    ],
                    [
                        'title' => 'Standard',
                        'price' => '$250',
                        'text' => 'We are devoted to making your dream wedding a reality, and we have expertise and a love for creating amazing moments.',
                        'image' => 'https://assets-global.website-files.com/648044f76e52ed7cac83946c/6486b1b448d5ac597d18964a_pricing-image-02-p-500.jpg'
                    ],
                    [
                        'title' => 'Luxury',
                        'price' => '$300',
                        'text' => 'We think that your wedding should be as unique as your love story, and we are dedicated to exceeding your expectations.',
                        'image' => 'https://assets-global.website-files.com/648044f76e52ed7cac83946c/6486bd4384706dc064c1e2a5_pricing-image-03-p-500.jpg'
                    ],
                ];
            @endphp

            @foreach ($plans as $plan)
                <div class="relative w-full max-w-sm mx-auto">
                    <!-- Fondo grande -->
                    <div class="relative h-96 w-full">
                        <img src="{{ asset($plan['image']) }}"
                            alt="Fondo"
                            class="absolute inset-0 w-full h-full object-cover rounded-xl" />
                        <!-- Card centrado -->
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/3 transition-all duration-500 hover:translate-y-2 z-10">
                        <div class="bg-white rounded-xl shadow-xl p-6 w-64 text-center">
                            <h2 class="text-xl font-secondary text-[#F6BBA9] mb-2">{{ $plan['title'] }}</h2>
                            <p class="text-gray-700 mb-4">{{ $plan['text'] }}</p>
                            <a href="#" class="btn-action inline-block px-4 py-2 transition">Ver más</a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
