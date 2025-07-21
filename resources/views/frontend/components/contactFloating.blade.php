<div id="contactFloating" class="fixed right-0 top-1/2 transform -translate-y-1/2 z-50 transition-all duration-500 ease-in-out opacity-0">
    <div class="flex items-center">
        <!-- Opciones desplegables -->
        <div id="contactOptions" class="hidden flex-col space-y-2 mr-2">
            <!-- WhatsApp -->
            <a href="https://wa.me/527293353878?text=Hola,%20quiero%20más%20información%20sobre%20eventos%20especiales" target="_blank" rel="noopener noreferrer"
               class="bg-white hover:bg-gray-50 text-gray-800 rounded-l-lg py-2 px-3 shadow-sm flex items-center transition-all duration-200 hover:translate-x-1 border border-gray-200"
               title="Contactar por WhatsApp">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
                    <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                </svg>
                <span class="ml-2 text-sm">WhatsApp</span>
            </a>

            <!-- Messenger -->
            <a href="https://www.facebook.com/eventosespecialeslerma1/" target="_blank" rel="noopener noreferrer"
               class="bg-white hover:bg-gray-50 text-gray-800 rounded-l-lg py-2 px-3 shadow-sm flex items-center transition-all duration-200 hover:translate-x-1 border border-gray-200"
               title="Contactar por Messenger">
                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.5 2 2 6.1 2 11c0 2.8 1.4 5.3 3.7 7-.1.9-.6 2.7-.7 3.1 0 .2.1.3.3.3.2 0 2.1-.3 3.6-1.2.9.2 1.8.3 2.7.3 5.5 0 10-4.1 10-9.1C22 6.1 17.5 2 12 2zm.1 13.2l-2.5-2.7-5.2 2.7 5.5-5.9 2.4 2.8 5.2-2.8-5.4 5.9z"/>
                </svg>
                <span class="ml-2 text-sm">Messenger</span>
            </a>

            <!-- Teléfono -->
            <a href="tel:+527293353878"
               class="bg-white hover:bg-gray-50 text-gray-800 rounded-l-lg py-2 px-3 shadow-sm flex items-center transition-all duration-200 hover:translate-x-1 border border-gray-200"
               title="Llamar por teléfono">
                <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6.6 10.8c1.2 2.4 3.2 4.4 5.6 5.6l1.9-1.9c.3-.3.8-.4 1.1-.2 1.2.5 2.6.8 4 .8.6 0 1 .5 1 1V20c0 .6-.4 1-1 1C11.3 21 3 12.7 3 3c0-.6.4-1 1-1h3.8c.6 0 1 .4 1 1 0 1.4.3 2.8.8 4 .1.4 0 .9-.3 1.1l-1.7 1.7z"/>
                </svg>
                <span class="ml-2 text-sm">Llamar</span>
            </a>
        </div>

        <!-- Badge vertical compacto -->
        <button id="contactMainButton"
                class="bg-gray-800 hover:bg-gray-700 text-white text-xs font-medium py-2 px-1 rounded-l-lg shadow-md flex flex-col items-center transition-all duration-300 focus:outline-none"
                title="Opciones de contacto">
            <span class="[writing-mode:vertical-rl] rotate-180 py-1 tracking-widest">Contacto</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </button>
    </div>
</div>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const contactFloating = document.getElementById('contactFloating');
    const contactMainButton = document.getElementById('contactMainButton');
    const contactOptions = document.getElementById('contactOptions');
    let isOpen = false;
    let hasScrolled = false;

    function showFloatingButtonWithPulse() {
        contactFloating.classList.remove('opacity-0', 'translate-x-full');
        contactFloating.classList.add('opacity-100', 'translate-x-0', 'animate-pulse-soft');

        // Quitar animación después de terminar (solo visual)
        setTimeout(() => {
            contactFloating.classList.remove('animate-pulse-soft');
        }, 1500);

        // Ocultarlo después de 5 segundos si no está abierto
        setTimeout(() => {
            if (!isOpen) {
                contactFloating.classList.remove('opacity-100', 'translate-x-0');
                contactFloating.classList.add('opacity-0', 'translate-x-full');
            }
        }, 5000);
    }

    // Mostrar solo 1 vez al hacer scroll
    window.addEventListener('scroll', () => {
        if (!hasScrolled) {
            hasScrolled = true;
            showFloatingButtonWithPulse();
        }
    });

    // Repetir cada 15 segundos después del scroll inicial
    setTimeout(() => {
        setInterval(() => {
            if (!isOpen) {
                showFloatingButtonWithPulse();
            }
        }, 15000);
    }, 1000); // Pequeño delay para no competir con el scroll inicial

    // Mostrar opciones al hacer clic
    contactMainButton.addEventListener('click', () => {
        isOpen = !isOpen;
        contactOptions.classList.toggle('hidden');
        contactOptions.classList.toggle('flex');
        contactMainButton.classList.toggle('bg-gray-700');
    });

    // Cerrar si haces clic fuera
    document.addEventListener('click', function (e) {
        if (isOpen && !contactFloating.contains(e.target)) {
            isOpen = false;
            contactOptions.classList.remove('flex');
            contactOptions.classList.add('hidden');
            contactMainButton.classList.remove('bg-gray-700');
        }
    });

    // Inicialmente oculto
    contactFloating.classList.add('opacity-0', 'translate-x-full');
});
</script> 
@endpush
