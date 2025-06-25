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
    </body>    
</html>
