<nav class="bg-white shadow-sm overflow-hidden">
    <div class="max-w-7xl mx-auto py-4 px-2 sm:py-6 sm:px-4 lg:px-8">
        <div class="flex justify-between h-16 sm:h-20 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex flex-col items-start">
                <span class="font-script text-lg sm:text-2xl text-gray-800">
                    Eventos Especiales Lerma
                </span>
                <span class="text-[10px] sm:text-xs tracking-widest text-gray-500 mt-1">
                    AGENCIAS DE EVENTOS
                </span>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex md:items-center md:space-x-6 lg:space-x-12">
                <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-[#65ABB7] font-medium transition duration-300 flex flex-col items-center">
                    Inicio
                    <span class="{{ request()->is('/') ? 'w-6 h-0.5 bg-[#65ABB7] mt-1' : 'w-0 h-0.5 bg-transparent mt-1' }} transition-all duration-300"></span>
                </a>
                <a href="/sobre-nosotros" class="text-gray-700 hover:text-[#65ABB7] font-medium transition duration-300 flex flex-col items-center">
                    Sobre Nosotros
                    <span class="{{ request()->is('sobre-nosotros') ? 'w-6 h-0.5 bg-[#65ABB7] mt-1' : 'w-0 h-0.5 bg-transparent mt-1' }} transition-all duration-300"></span>
                </a>
                <a href="/servicios" class="text-gray-700 hover:text-[#65ABB7] font-medium transition duration-300 flex flex-col items-center">
                    Servicios
                    <span class="{{ request()->is('servicios') ? 'w-6 h-0.5 bg-[#65ABB7] mt-1' : 'w-0 h-0.5 bg-transparent mt-1' }} transition-all duration-300"></span>
                </a>
                <a href="/portafolio" class="text-gray-700 hover:text-[#65ABB7] font-medium transition duration-300 flex flex-col items-center">
                    Portafolio
                    <span class="{{ request()->is('portafolio') ? 'w-6 h-0.5 bg-[#65ABB7] mt-1' : 'w-0 h-0.5 bg-transparent mt-1' }} transition-all duration-300"></span>
                </a>
                <div class="relative group flex flex-col items-center">
                    <button class="flex items-center text-gray-700 hover:text-[#65ABB7] font-medium focus:outline-none transition duration-300">
                        Paginas
                        <svg class="ml-1 w-4 h-4 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <span class="{{ request()->is('team', 'faq', 'testimonials') ? 'w-6 h-0.5 bg-[#65ABB7] mt-1' : 'w-0 h-0.5 bg-transparent mt-1' }} transition-all duration-300"></span>
                    <!-- Dropdown -->
                    <div class="absolute left-0 mt-2 w-40 sm:w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform -translate-y-1 group-hover:translate-y-0">
                        <a href="/contacto" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition {{ request()->is('contacto') ? 'bg-blue-50 text-[#65ABB7]' : '' }}">Contacto</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition {{ request()->is('faq') ? 'bg-blue-50 text-[#65ABB7]' : '' }}">FAQ</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition {{ request()->is('testimonials') ? 'bg-blue-50 text-[#65ABB7]' : '' }}">Testimonials</a>
                    </div>
                </div>
                <a href="mailto:info@eventosespecialeslerma.com" class="flex items-center text-gray-700 hover:text-[#65ABB7] transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-[#65ABB7]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <span class="hidden lg:inline">info@eventosespecialeslerma.com</span>
                </a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="navbar-toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50 focus:outline-none transition duration-300">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger icon -->
                    <svg id="hamburger-icon" class="block h-8 w-8 text-[#65ABB7]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Close icon (hidden by default) -->
                    <svg id="close-icon" class="hidden h-8 w-8 text-[#65ABB7]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg rounded-b-lg">
        <div class="px-2 sm:px-4 pt-2 pb-6 space-y-1 sm:space-y-2">
            <a href="{{ route('welcome') }}" class="block px-3 py-2 sm:py-3 rounded-md text-base font-medium {{ request()->is('/') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Inicio</a>
            <a href="/sobre-nosotros" class="block px-3 py-2 sm:py-3 rounded-md text-base font-medium {{ request()->is('sobre-nosotros') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Sobre Nosotros</a>
            <a href="/servicios" class="block px-3 py-2 sm:py-3 rounded-md text-base font-medium {{ request()->is('servicios') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Servicios</a>
            <a href="/portafolio" class="block px-3 py-2 sm:py-3 rounded-md text-base font-medium {{ request()->is('portafolio') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Portafolio</a>
            <div class="block">
                <button id="mobile-dropdown-toggle" class="w-full flex justify-between items-center px-3 py-2 sm:py-3 rounded-md text-base font-medium {{ request()->is('team', 'faq', 'testimonials') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50' }} focus:outline-none transition">
                    <span>Paginas</span>
                    <svg id="mobile-dropdown-arrow" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="mobile-dropdown" class="hidden pl-6 mt-1 space-y-1">
                    <a href="/contacto" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('contacto') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-600 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Contacto</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('faq') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-600 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">FAQ</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('testimonials') ? 'text-[#65ABB7] bg-blue-50' : 'text-gray-600 hover:text-[#65ABB7] hover:bg-blue-50' }} transition">Testimonials</a>
                </div>
            </div>
            <a href="mailto:info@eventosespecialeslerma.com" class="flex items-center px-3 py-2 sm:py-3 rounded-md text-base font-medium text-gray-700 hover:text-[#65ABB7] hover:bg-blue-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 text-[#65ABB7]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="sm:inline">Contact Us</span>
            </a>
        </div>
    </div>
</nav>

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('navbar-toggle');
    const menu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const dropdownToggle = document.getElementById('mobile-dropdown-toggle');
    const dropdown = document.getElementById('mobile-dropdown');
    const dropdownArrow = document.getElementById('mobile-dropdown-arrow');

    // Toggle mobile menu
    toggle.addEventListener('click', function () {
        menu.classList.toggle('hidden');
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });

    // Toggle mobile dropdown
    dropdownToggle.addEventListener('click', function () {
        dropdown.classList.toggle('hidden');
        dropdownArrow.classList.toggle('rotate-180');
    });

    // Close mobile menu when clicking on any link (including dropdown links)
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            menu.classList.add('hidden');
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        });
    });
});
</script>
@endpush