<div class="px-6 sm:px-12 py-12 lg:py-16 opacity-0 transition-all duration-700" data-animate>
    <section class="relative bg-[#263238] text-white rounded-2xl md:rounded-3xl lg:rounded-full py-12 sm:py-16 lg:py-20 max-w-7xl mx-auto overflow-hidden shadow-lg">
        <!-- Decoraciones de esquina -->
        <div class="absolute bottom-0 left-0 w-48 sm:w-64 opacity-40 pointer-events-none">
            <img src="{{ asset('images/flower-pattern.png') }}" alt="Detalles florales decorativos" class="w-full">
        </div>
        <div class="absolute bottom-0 right-0 w-48 sm:w-64 opacity-40 pointer-events-none">
            <img src="{{ asset('images/pointers-pattern.png') }}" alt="Elementos decorativos geométricos" class="w-full">
        </div>

        <!-- Contenido principal -->
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center">
                <!-- Sección de texto -->
                <div class="lg:w-1/2 lg:pr-12 mb-10 lg:mb-0 mx-4 sm:mx-12">
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-secondary mb-6">Únete a Nosotros</h2>
                    <p class="text-base sm:text-xl lg:text-lg leading-relaxed opacity-90">
                        Acompáñanos en este viaje y te mantendremos actualizado con las mejores promociones, descuentos e historias de nuestros clientes.
                    </p>
                </div>

                <!-- Formulario de suscripción -->
                <div class="lg:w-1/2 lg:pl-12 w-full">
                    <form action="{{ route('subscribe') }}" method="POST" class="p-4 sm:p-8" aria-label="Formulario de suscripción">
                        @csrf
                        <div class="mb-8">
                            <label for="email-suscripcion" class="sr-only">Correo electrónico</label>
                            <input 
                                id="email-suscripcion"
                                name="email"
                                type="email" 
                                placeholder="Ingresa tu correo electrónico" 
                                class="w-full bg-transparent border-0 border-b-2 border-[#F6BBA9] text-white placeholder-gray-400 focus:border-white focus:outline-none focus:ring-0 px-0 py-3 transition-colors duration-300"
                                required
                                aria-required="true"
                                oninput="this.value = this.value.toLowerCase()"
                                value="{{ old('email') }}"
                                autocomplete="email"
                            >
                        </div>
                        <button 
                            type="submit" 
                            class="btn-action-dark w-full lg:w-auto px-10 py-3.5 text-base font-medium rounded-lg hover:scale-[1.02] transition-all"
                            aria-label="Suscribirse al boletín"
                        >
                            Suscribirse
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>