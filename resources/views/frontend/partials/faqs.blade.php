<!-- partials/faqs.blade.php -->
<section class="py-16 sm:py-24 bg-white opacity-0" data-animate aria-labelledby="preguntas-frecuentes">
    <div class="container mx-auto px-6 sm:px-8 max-w-7xl">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            <!-- Left Column - Title and Image -->
            <div class="lg:w-2/5">
                <div class="mb-8">
                    <h2 id="preguntas-frecuentes" class="text-3xl sm:text-4xl lg:text-5xl font-secondary text-[#2a2a2a] mb-4">
                        Preguntas Frecuentes
                    </h2>
                    <p class="text-gray-600 mt-2">Encuentra respuestas a las preguntas más comunes sobre nuestros servicios de eventos.</p>
                </div>
                
                <!-- Image -->
                <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden">
                    <img src="{{ asset('images/accordion-leaf.png') }}" alt="Event planning illustration" 
                         class="object-cover w-full h-full transition-all duration-500 hover:scale-105">
                </div>
            </div>

            <!-- Right Column - FAQ Accordion -->
            <div class="lg:w-3/5">
                <div class="divide-y divide-gray-200/50" id="faq-accordion">
                    <!-- Question 1 -->
                    <div class="faq-item group py-6 first:pt-0 transition-all duration-200 hover:bg-gray-50/50 px-4 rounded-lg">
                        <button class="faq-toggle flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-300">
                                ¿Qué tipos de eventos pueden organizar?
                            </h3>
                            <svg class="faq-icon w-6 h-6 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-300" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)] max-h-0 opacity-0">
                            <div class="pb-4">
                                Organizamos todo tipo de eventos sociales y corporativos, incluyendo bodas, fiestas de cumpleaños, aniversarios, reuniones familiares, conferencias, lanzamientos de producto y eventos corporativos. Cada evento se diseña según tus necesidades específicas.
                            </div>
                        </div>
                    </div>

                    <!-- Question 2 -->
                    <div class="faq-item group py-6 transition-all duration-200 hover:bg-gray-50/50 px-4 rounded-lg">
                        <button class="faq-toggle flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-300">
                                ¿Cómo es el proceso de planificación de un evento?
                            </h3>
                            <svg class="faq-icon w-6 h-6 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-300" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)] max-h-0 opacity-0">
                            <div class="pb-4">
                                Nuestro proceso consta de 5 etapas: 1) Consulta inicial para entender tu visión, 2) Diseño conceptual y propuesta, 3) Selección de proveedores y logística, 4) Coordinación previa al evento, y 5) Ejecución impecable el día del evento.
                            </div>
                        </div>
                    </div>

                    <!-- Question 3 -->
                    <div class="faq-item group py-6 transition-all duration-200 hover:bg-gray-50/50 px-4 rounded-lg">
                        <button class="faq-toggle flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-300">
                                ¿Con cuánta anticipación debo contratar sus servicios?
                            </h3>
                            <svg class="faq-icon w-6 h-6 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-300" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)] max-h-0 opacity-0">
                            <div class="pb-4">
                                Recomendamos contactarnos con al menos 3-6 meses de anticipación para eventos medianos y 6-12 meses para bodas o eventos grandes. Sin embargo, podemos organizar eventos con menos tiempo dependiendo de la disponibilidad.
                            </div>
                        </div>
                    </div>

                    <!-- Question 4 -->
                    <div class="faq-item group py-6 transition-all duration-200 hover:bg-gray-50/50 px-4 rounded-lg">
                        <button class="faq-toggle flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-300">
                                ¿Pueden gestionar eventos en todo México?
                            </h3>
                            <svg class="faq-icon w-6 h-6 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-300" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)] max-h-0 opacity-0">
                            <div class="pb-4">
                                En Eventos Especiales Lerma, nos dedicamos a organizar eventos en toda la región, incluyendo todo el territorio nacional.
                            </div>
                        </div>
                    </div>

                    <!-- Question 5 -->
                    <div class="faq-item group py-6 last:pb-0 transition-all duration-200 hover:bg-gray-50/50 px-4 rounded-lg">
                        <button class="faq-toggle flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="text-lg sm:text-xl font-medium text-gray-900 group-hover:text-[#4b8b97] transition-colors duration-300">
                                ¿Qué incluyen sus paquetes de servicios?
                            </h3>
                            <svg class="faq-icon w-6 h-6 text-gray-500 group-hover:text-[#4b8b97] transition-all duration-300" 
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="faq-content mt-3 text-gray-600 overflow-hidden transition-all duration-500 ease-[cubic-bezier(0.25,0.1,0.25,1)] max-h-0 opacity-0">
                            <div class="pb-4">
                                Nuestros paquetes varían según el tipo de evento, pero generalmente incluyen: planificación integral, diseño de concepto, gestión de proveedores, coordinación logística, diseño de invitaciones, gestión de presupuesto y supervisión el día del evento.
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
                // Si este item ya está abierto, ciérralo
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                    content.style.maxHeight = '0';
                    content.style.opacity = '0';
                    icon.classList.remove('rotate-90', 'text-[#4b8b97]');
                    return;
                }
                
                // Cerrar todos los demás items primero
                document.querySelectorAll('.faq-item.active').forEach(activeItem => {
                    if (activeItem !== item) {
                        const activeContent = activeItem.querySelector('.faq-content');
                        const activeIcon = activeItem.querySelector('.faq-icon');
                        
                        activeItem.classList.remove('active');
                        activeContent.style.maxHeight = '0';
                        activeContent.style.opacity = '0';
                        activeIcon.classList.remove('rotate-90', 'text-[#4b8b97]');
                    }
                });
                
                // Abrir el item actual
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + 'px';
                content.style.opacity = '1';
                icon.classList.add('rotate-90', 'text-[#4b8b97]');
            });
        });
    });
</script>
@endpush