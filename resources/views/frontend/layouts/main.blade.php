<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eventos Especiales Lerma</title>
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <!-- Navbar -->
        @include('frontend.components.navbar')

        <!-- Content -->
        @yield('content')
        
        <!-- Footer -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Animación principal (slide-up)
                const slideUpElements = document.querySelectorAll('[data-animate]');
                
                const slideUpObserver = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('opacity-100', 'translate-y-0');
                                entry.target.classList.remove('opacity-0', 'translate-y-4');
                                slideUpObserver.unobserve(entry.target);
                            }
                        });
                    },
                    { threshold: 0.1 }
                );

                slideUpElements.forEach((element) => {
                    element.classList.add('opacity-0', 'translate-y-4');
                    element.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                    slideUpObserver.observe(element);
                });
            });
        </script>
        @stack('js')
    </body>    
</html>
