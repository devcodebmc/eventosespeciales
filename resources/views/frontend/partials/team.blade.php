<section class="flex flex-col items-center opacity-0 translate-y-4 transition-all duration-700 px-4 sm:px-6 lg:px-0 mt-0 bg-white" data-animate>
    <header class="flex flex-col sm:flex-row items-center justify-center my-8 w-full">
        <div class="flex items-center w-full justify-center mt-12">
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <h2 class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
                Conoce a Nuestro Equipo
            </h2>
            <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
            </svg>
            <span class="sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
    </header>
    <h3 class="max-w-5xl mx-auto text-base sm:text-lg md:text-xl lg:text-3xl text-[#2A4044] font-secondary text-center px-2">
       ¡Nos asociamos con Personas Fantásticas!
    </h3>
</section>

<section class="py-8 md:py-16 px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-16">
            @php
                $team = [
                    [
                        'name' => 'Harper Lee',
                        'role' => 'Manager',
                        'image' => 'images/1.jpg',
                        'socials' => ['x' => '#', 'facebook' => '#'],
                        'delay' => '100' // Retardo para la animación en escalera
                    ],
                    [
                        'name' => 'Lily Mae',
                        'role' => 'Designer',
                        'image' => 'images/2.jpg',
                        'socials' => ['instagram' => '#', 'x' => '#', 'facebook' => '#'],
                        'delay' => '400'
                    ],
                    [
                        'name' => 'John Michael',
                        'role' => 'Wedding Planner',
                        'image' => 'images/3.jpg',
                        'socials' => ['x' => '#', 'facebook' => '#'],
                        'delay' => '600'
                    ]
                ];
            @endphp

            @foreach ($team as $member)
                <article 
                    class="relative group flex animate-stair"
                    data-animate-stair
                    data-delay="{{ $member['delay'] }}"
                >
                    <!-- Contenedor de la imagen y contenido -->
                    <div class="flex-1 relative">
                        <!-- Imagen con borde redondeado -->
                        <figure class="overflow-hidden rounded-lg h-full">
                            <img 
                                src="{{ asset($member['image']) }}" 
                                alt="{{ $member['name'] }}" 
                                class="w-full h-[300px] md:h-[400px] lg:h-[500px] object-cover" 
                                loading="lazy"
                            />
                        </figure>
                        
                        <!-- Role - Responsive -->
                        <span class="absolute top-6 md:top-12 -left-3 md:-left-6 bg-white px-2 md:px-3 py-2 md:py-3 text-xs md:text-sm font-medium tracking-wide">
                            {{ $member['role'] }}
                        </span>
                        
                        <!-- Redes sociales - Responsive -->
                        <div class="absolute bottom-2 md:bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 md:gap-4">
                            @foreach ($member['socials'] as $icon => $link)
                                <a 
                                    href="{{ $link }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    aria-label="{{ $icon }} profile"
                                    class="w-8 h-8 md:w-10 md:h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-100 transition"
                                >
                                    @switch($icon)
                                        @case('facebook')
                                            <svg class="w-4 h-4 md:w-6 md:h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                                            </svg>
                                            @break
                                        @case('x')
                                            <svg class="w-4 h-4 md:w-6 md:h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                                            </svg>
                                            @break
                                        @case('instagram')
                                            <svg class="w-4 h-4 md:w-6 md:h-6 text-gray-800" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                                            </svg>
                                            @break
                                    @endswitch
                                </a>
                            @endforeach
                        </div>
                        
                        <!-- Nombre vertical alineado - Responsive -->
                        <div class="absolute bottom-0 -left-2 md:-left-4 transform origin-left -rotate-90 flex items-center h-8 md:h-12">
                            <h3 class="text-sm md:text-lg font-medium text-gray-800 whitespace-nowrap ml-8 md:ml-12">
                                {{ $member['name'] }}
                            </h3>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animación en escalera
            const stairObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const delay = entry.target.getAttribute('data-delay') || 0;
                            
                            setTimeout(() => {
                                entry.target.classList.add('opacity-100', 'translate-y-0');
                                entry.target.classList.remove('opacity-0', 'translate-y-16');
                            }, delay);
                            
                            stairObserver.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.1 }
            );

            // Configuración inicial para los elementos de la escalera
            document.querySelectorAll('[data-animate-stair]').forEach((element) => {
                element.classList.add(
                    'opacity-0',
                    'translate-y-16',
                    'transition-all',
                    'duration-500',
                    'ease-out'
                );
                element.style.transitionDelay = '0ms'; // Se sobrescribirá con el delay individual
                stairObserver.observe(element);
            });
        });
    </script>
@endpush
