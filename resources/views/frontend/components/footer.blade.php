<footer class="bg-gray-100 text-[#2A4044] py-16 px-4 sm:px-8">
    <div class="text-center mb-8">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-script text-[#4b8b97] mb-2">
            Eventos Especiales Lerma
        </h2>
        <h3 class="text-md text-gray-800 tracking-[.8em] uppercase mx-4">
            Agencia de Eventos
        </h3>
        <p class="max-w-4xl mx-auto mt-4 text-sm sm:text-base md:text-lg text-gray-600 text-center px-2">
           Somos mas que una agencia de eventos, somos tu agencia de eventos; Estamos comprometidos en la creación de un dia que capture la esencia de tu evento y lo haga inolvidable.
        </p>
    </div>
    @include('frontend.partials.divider')
    <div class="max-w-7xl mx-auto">
        <!-- Sección superior del footer -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-16">
            <!-- Columna 1 - Logo y descripción -->
            <div class="md:col-span-2">
                
            </div>

            <!-- Columna 2 - Enlaces rápidos -->
            <div>
                <h3 class="text-lg font-secondary tracking-wider text-[#2A4044]  mb-4">
                    Enlaces Rápidos
                </h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors">Home</a></li>
                    <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors">About Us</a></li>
                    <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors">Services</a></li>
                    <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors">Portfolio</a></li>
                    <li><a href="#" class="text-md hover:text-[#4b8b97] transition-colors">Blog</a></li>
                </ul>
            </div>

            <!-- Columna 3 - Contacto -->
            <div>
                <h3 class="text-lg font-secondary tracking-wider text-[#2A4044] mb-4">Contacto</h3>
                <address class="not-italic text-md space-y-2">
                    <p>123 Wedding Street</p>
                    <p>New York, NY 10001</p>
                    <p>
                        <a href="mailto:hello@dreamweds.com" class="hover:text-[#4b8b97] transition-colors">hello@dreamweds.com</a>
                    </p>
                    <p>
                        <a href="tel:+11234567890" class="hover:text-[#4b8b97] transition-colors">+1 (123) 456-7890</a>
                    </p>
                </address>
            </div>
        </div>

        <!-- Línea divisoria -->
        <div class="border-t border-[#e0dcd5] mb-8"></div>

        <!-- Sección inferior del footer -->
        <div class="flex flex-col md:flex-row justify-between items-center text-sm">
            <p>&copy; 2023 Dreamweds. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-[#333] transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-[#333] transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-[#333] transition-colors">Cookies Settings</a>
            </div>
        </div>
    </div>
</footer>