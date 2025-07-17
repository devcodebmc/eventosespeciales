<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Cache Control -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('images/logo-white.png')}}" type="image/x-icon">
    
    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Eventos Especiales Lerma - Organización de Eventos en Lerma')</title>
    <meta name="description" content="@yield('description', 'Agencia profesional de organización de eventos en Lerma. Bodas, fiestas, eventos corporativos y más. Servicios completos para hacer tu evento memorable.')">
    <meta name="keywords" content="@yield('keywords', 'eventos Lerma, organización de eventos, bodas Lerma, fiestas Lerma, eventos corporativos, catering Lerma, decoración eventos, agencia eventos')">
    <meta name="author" content="Eventos Especiales Lerma">
    <meta name="copyright" content="Eventos Especiales Lerma">
    <meta name="robots" content="index,follow">
    
    <!-- Canonical & Alternate URLs -->
    <link rel="canonical" href="@yield('canonical', 'https://eventosespecialeslerma.com/')">
    <link rel="alternate" href="https://eventosespecialeslerma.com/" hreflang="es-mx"/>
    
    <!-- Theme Color -->
    <meta name="msapplication-TileColor" content="#4b8b97">
    <meta name="theme-color" content="#4b8b97">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:locale" content="es_MX">
    <meta property="og:type" content="website"> 
    <meta property="og:title" content="@yield('ogtitle', 'Eventos Especiales Lerma - Organización Profesional de Eventos')"> 
    <meta property="og:description" content="@yield('ogdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')"> 
    <meta property="og:url" content="@yield('ogurl','https://eventosespecialeslerma.com/')">
    <meta property="og:site_name" content="Eventos Especiales Lerma">  
    <meta property="article:publisher" content="https://www.facebook.com/eventosespecialeslerma1">
    <meta property="og:image" content="@yield('ogimage', asset('img/og-image.jpg'))">
    <meta property="og:image:secure_url" content="@yield('ogimage', asset('img/og-image.jpg'))">
    <meta property="og:image:alt" content="Eventos Especiales Lerma - Organización de Eventos">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@EventosLerma">
    <meta name="twitter:creator" content="@EventosLerma">
    <meta name="twitter:title" content="@yield('ogtitle', 'Eventos Especiales Lerma - Organización Profesional de Eventos')">
    <meta name="twitter:description" content="@yield('ogdescription', 'Agencia profesional de organización de eventos en Lerma. Creamos experiencias únicas para bodas, fiestas y eventos corporativos.')">
    <meta name="twitter:image" content="@yield('ogimage', asset('img/og-image.jpg'))">
    <meta name="twitter:image:alt" content="Eventos Especiales Lerma - Organización de Eventos">
    
    <!-- Schema.org markup for Google -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EventPlanningBusiness",
      "name": "Eventos Especiales Lerma",
      "image": "{{asset('img/logos/logorm.svg')}}",
      "@id": "https://eventosespecialeslerma.com/",
      "url": "https://eventosespecialeslerma.com/",
      "telephone": "+52 55 1234 5678",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Av. Principal 123",
        "addressLocality": "Lerma",
        "addressRegion": "Estado de México",
        "postalCode": "52000",
        "addressCountry": "MX"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "19.2859",
        "longitude": "-99.5162"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "09:00",
        "closes": "18:00"
      },
      "sameAs": [
        "https://www.facebook.com/eventosespecialeslerma1",
        "https://www.instagram.com/eventosespecialeslerma"
      ] 
    }
    </script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preload important resources -->
    <link rel="preload" href="{{ asset('css/index.css') }}" as="style">
    <link rel="preload" href="{{asset('img/logos/logorm.svg')}}" as="image">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    @include('frontend.components.navbar')

    <!-- Content -->
    @yield('content')
    
    <!-- Footer -->
    @include('frontend.components.footer')
    
    <!-- Animation Scripts -->
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
            
            // Animación scale-in (de dentro hacia afuera)
            const scaleInElements = document.querySelectorAll('[data-animate-scale]');
            
            const scaleInObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('opacity-100', 'scale-100');
                            entry.target.classList.remove('opacity-0', 'scale-90');
                            scaleInObserver.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.1 }
            );

            scaleInElements.forEach((element) => {
                element.classList.add('opacity-0', 'scale-90');
                element.style.transition = 'opacity 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
                scaleInObserver.observe(element);
            });
        });
    </script>
    
    @stack('js')
</body>    
</html>