<section class="bg-white py-4 md:py-8 lg:py-16" aria-labelledby="nuestra-historia">
  <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center relative">

    <!-- Imagen cuadrada grande -->
    <figure class="flex justify-start opacity-0" data-animate>
      <div class="w-full h-auto md:w-[28rem] md:h-[28rem] lg:w-[32rem] lg:h-[32rem] overflow-hidden shadow-lg rounded-xl">
        <img src="{{ asset('images/carpa-transparente.jpg') }}"
             alt="Equipo de Eventos Especiales Lerma trabajando en la organización de un evento"
             class="w-full h-full object-cover"
             loading="lazy"
             decoding="async">
      </div>
    </figure>

    <!-- Contenido de texto -->
    <article class="flex flex-col justify-center items-start px-4 sm:px-6 lg:px-0 relative text-left opacity-0" data-animate>
      
      <!-- Encabezado decorativo -->
      <header class="flex flex-col sm:flex-row items-center justify-center my-6 w-full">
        <div class="flex items-center justify-center w-full" aria-hidden="true">
          <span class="hidden sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
          <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" focusable="false">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
          </svg>
          <h2 id="nuestra-historia" class="text-base sm:text-lg md:text-xl text-gray-500 tracking-widest uppercase mx-0 sm:mx-4 text-center">
            Nuestra Historia
          </h2>
          <svg class="mx-0 sm:block" width="20" height="20" viewBox="0 0 20 20" focusable="false">
            <polygon points="10,3 17,10 10,17 3,10" stroke="#4b8b97" stroke-width="1.5" fill="none"/>
          </svg>
          <span class="hidden sm:block w-10 border-t border-[#4b8b97] mx-2"></span>
        </div>
      </header>

      <!-- Título principal -->
      <h3 class="max-w-5xl text-base sm:text-2xl md:text-3xl lg:text-4xl text-[#2A4044] font-secondary">
        Más de 15 Años Creando Momentos Inolvidables
      </h3>
      
      <!-- Contenido histórico -->
      <div class="prose max-w-none mt-4 text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed">
        <p>
          Fundada en 2008, Eventos Especiales Lerma nació de la pasión por transformar ocasiones ordinarias en experiencias extraordinarias. 
          Lo que comenzó como un pequeño equipo organizando bodas locales, hoy es una empresa líder en producción de eventos en toda la región.
        </p>
        
        <p class="mt-3">
          Nuestra filosofía se basa en tres pilares fundamentales: <strong>elegancia atemporal</strong>, 
          <strong>atención meticulosa al detalle</strong> y <strong>creación de experiencias emocionales</strong>. 
          Cada evento que diseñamos cuenta una historia única, reflejando la personalidad y sueños de nuestros clientes.
        </p>
        
        <p class="mt-3">
          A lo largo de estos años, hemos tenido el privilegio de organizar más de 1,200 eventos, desde íntimas celebraciones familiares 
          hasta grandes producciones corporativas, siempre manteniendo nuestro sello distintivo de excelencia y calidez humana.
        </p>
      </div>
      
      <!-- Logros destacados -->
      <aside class="mt-6 p-4 bg-gray-50 rounded-lg">
        <h4 class="font-secondary text-lg text-[#2A4044] mb-2">Algunos logros destacados:</h4>
        <ul class="list-disc pl-5 space-y-1">
          <li>Premio Nacional a la Excelencia en Organización de Eventos 2019</li>
          <li>Certificación Internacional en Protocolo y Etiqueta</li>
          <li>Más de 350 bodas de ensueño realizadas</li>
        </ul>
      </aside>
        <div class="flex items-center justify-center mt-8">
            <a href="#" class="btn-action text-lg py-5 px-10 rounded-md">
                Agendar Ahora
            </a>
        </div>
    </article>
  </div>
</section>