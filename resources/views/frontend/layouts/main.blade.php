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
    
        @stack('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const animatedElements = document.querySelectorAll('[data-animate]');
                
                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('opacity-100', 'translate-y-0');
                                entry.target.classList.remove('opacity-0', 'translate-y-4');
                                observer.unobserve(entry.target); // Deja de observar después de animar
                            }
                        });
                    },
                    {
                        threshold: 0.1, // Activa cuando el 10% del elemento es visible
                    }
                );

                animatedElements.forEach((element) => observer.observe(element));
            });
        </script>
    </body>    
</html>
