<!-- partials/faqs.blade.php -->
<section class="py-16 sm:py-24 bg-white" aria-labelledby="faq-heading">
    <div class="container mx-auto px-6 sm:px-8 max-w-7xl">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            <!-- Left Column - Title and Image -->
            <div class="lg:w-2/5">
                <div class="mb-8">
                    <h2 id="faq-heading" class="text-3xl sm:text-4xl lg:text-5xl font-secondary text-[#2a2a2a] mb-4">
                        Preguntas Frecuentes
                    </h2>
                </div>
                
                <!-- Image -->
                <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/accordion-leaf.png') }}" alt="Wedding planning illustration" 
                         class="object-cover w-full h-full transition-opacity duration-300 hover:opacity-90">
                </div>
            </div>

            <!-- Right Column - FAQ Accordion -->
            <div class="lg:w-3/5">
                <div class="divide-y divide-gray-200" id="faq-accordion">
                    <!-- Question 1 -->
                    <div class="faq-item group py-6 first:pt-0">
                        <button class="faq-toggle flex justify-between items-center w-full text-left">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-200">
                                ¿Qué tipos de servicios para bodas ofrecen?
                            </h3>
                            <svg class="faq-icon w-5 h-5 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-200" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden max-h-0 opacity-0">
                            <div class="pb-2 transform origin-top scale-y-0 group-[.active]:scale-y-100 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                Ofrecemos una gama completa de servicios para bodas incluyendo planificación completa, coordinación del día del evento, diseño floral, fotografía profesional, catering y más. Cada paquete se personaliza según tus necesidades.
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="faq-item group py-6">
                        <button class="faq-toggle flex justify-between items-center w-full text-left">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-200">
                                ¿Cómo reservo sus servicios para bodas?
                            </h3>
                            <svg class="faq-icon w-5 h-5 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-200" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden max-h-0 opacity-0">
                            <div class="pb-2 transform origin-top scale-y-0 group-[.active]:scale-y-100 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                Puedes contactarnos a través de nuestro formulario web, por teléfono o email. Recomendamos reservar con al menos 6-12 meses de anticipación para asegurar disponibilidad, especialmente en temporada alta.
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="faq-item group py-6">
                        <button class="faq-toggle flex justify-between items-center w-full text-left">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-200">
                                ¿Pueden ayudar con bodas en destino?
                            </h3>
                            <svg class="faq-icon w-5 h-5 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-200" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden max-h-0 opacity-0">
                            <div class="pb-2 transform origin-top scale-y-0 group-[.active]:scale-y-100 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                ¡Absolutamente! Tenemos experiencia organizando bodas en destinos nacionales e internacionales. Nos encargamos de todos los detalles logísticos, permisos legales y coordinación con proveedores locales.
                            </div>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="faq-item group py-6">
                        <button class="faq-toggle flex justify-between items-center w-full text-left">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-200">
                                ¿Cuál es el costo promedio de sus servicios?
                            </h3>
                            <svg class="faq-icon w-5 h-5 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-200" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden max-h-0 opacity-0">
                            <div class="pb-2 transform origin-top scale-y-0 group-[.active]:scale-y-100 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                Los costos varían según el alcance del evento. Nuestros paquetes básicos comienzan desde $2,500, con opciones personalizadas disponibles. Ofrecemos consultas gratuitas para proporcionarte un presupuesto detallado.
                            </div>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="faq-item group py-6 last:pb-0">
                        <button class="faq-toggle flex justify-between items-center w-full text-left">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-200">
                                ¿Ofrecen servicios de coordinación solo para el día del evento?
                            </h3>
                            <svg class="faq-icon w-5 h-5 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-200" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-hidden max-h-0 opacity-0">
                            <div class="pb-2 transform origin-top scale-y-0 group-[.active]:scale-y-100 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]">
                                Sí, ofrecemos un servicio de coordinación exclusiva para el día de tu boda. Incluye gestión de proveedores, cronograma detallado y supervisión de todos los detalles para que tú y tu familia puedan disfrutar sin preocupaciones.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const toggle = item.querySelector('.faq-toggle');
            const content = item.querySelector('.faq-content');
            const icon = item.querySelector('.faq-icon');
            
            toggle.addEventListener('click', () => {
                // Cerrar todos los demás items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        const otherContent = otherItem.querySelector('.faq-content');
                        const otherIcon = otherItem.querySelector('.faq-icon');
                        
                        otherItem.classList.remove('active');
                        otherContent.classList.remove('max-h-[500px]', 'opacity-100');
                        otherContent.classList.add('max-h-0', 'opacity-0');
                        otherIcon.classList.remove('rotate-90', 'text-[#4b8b97]');
                    }
                });
                
                // Alternar el item actual
                const isOpen = item.classList.contains('active');
                
                if (isOpen) {
                    item.classList.remove('active');
                    content.classList.remove('max-h-[500px]', 'opacity-100');
                    content.classList.add('max-h-0', 'opacity-0');
                    icon.classList.remove('rotate-90', 'text-[#4b8b97]');
                } else {
                    item.classList.add('active');
                    content.classList.remove('max-h-0', 'opacity-0');
                    content.classList.add('max-h-[500px]', 'opacity-100');
                    icon.classList.add('rotate-90', 'text-[#4b8b97]');
                }
            });
        });
    });
</script>
@endpush