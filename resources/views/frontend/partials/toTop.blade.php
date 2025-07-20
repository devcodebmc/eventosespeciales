<!-- Botón "Volver arriba" con semántica mejorada -->
<button 
    id="backToTop"
    aria-label="Volver al inicio de la página"
    title="Volver al inicio"
    class="fixed bottom-8 right-8 p-3 bg-gray-800 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 z-50"
>
    <!-- Icono como imagen SVG externa -->
    <img 
        src="{{ asset('images/leaf-organic.svg') }}" 
        alt="" 
        aria-hidden="true" 
        class="w-6 h-6"
        width="24" 
        height="24"
        loading="lazy"
    >
    <!-- Texto accesible oculto visualmente -->
    <span class="sr-only">Volver al inicio de la página</span>
</button>
