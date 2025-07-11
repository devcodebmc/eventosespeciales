<section class="flex justify-center items-center py-12 md:py-24 px-4 bg-white relative overflow-hidden">
    <!-- Decoración superior para móvil -->
    <img src="{{ asset('images/contact-left-leaf.png') }}" alt="Flor decorativa"
        class="sm:hidden absolute top-0 left-1/2 -translate-x-1/2 max-w-[120px] rotate-90 z-20 pointer-events-none">

    <!-- Decoración inferior para móvil -->
    <img src="{{ asset('images/contact-right-leaf.png') }}" alt="Flor decorativa"
        class="sm:hidden absolute -bottom-3 left-1/3 -translate-x-1/2 max-w-[120px] -rotate-90 z-10 pointer-events-none">

    <!-- Decoración izquierda para desktop -->
    <img src="{{ asset('images/contact-left-leaf.png') }}" alt="Flor izquierda"
        class="hidden sm:block absolute left-0 sm:left-40 top-1/2 -translate-y-1/2 max-w-[100px] sm:max-w-[220px] z-0 pointer-events-none">

    <!-- Decoración derecha para desktop -->
    <img src="{{ asset('images/contact-right-leaf.png') }}" alt="Flor derecha"
        class="hidden sm:block absolute right-0 sm:right-40 top-1/2 -translate-y-1/2 max-w-[100px] sm:max-w-[220px] z-0 pointer-events-none">

    <!-- Contenedor ovalado -->
    <div class="relative w-[90vw] max-w-xl aspect-[4/5] sm:aspect-square flex items-center justify-center z-10 mt-10 sm:mt-0 mb-10 sm:mb-0">
        <!-- Contorno 1 -->
        <div class="hidden sm:block absolute inset-0 rounded-[40%_40%_50%_50%_/_40%_50%_50%_50%] sm:rounded-[55%_45%_50%_50%_/_45%_55%_50%_50%]
            border border-rose-300 scale-[1.05] sm:scale-[1.1] rotate-1 shadow-md bg-white shadow-rose-200/40">
        </div>

        <!-- Contorno 2 -->
        <div class="hidden sm:block absolute inset-0 rounded-[50%_50%_40%_40%_/_50%_50%_40%_50%] sm:rounded-[50%_50%_55%_45%_/_50%_50%_45%_55%]
            border border-teal-600 scale-[1.08] sm:scale-[1.15] -rotate-1 sm:-rotate-2 shadow-lg shadow-cyan-200/40">
        </div>

        <!-- Formulario principal -->
        <div class="relative bg-white sm:border border-cyan-600 rounded-[40%] sm:rounded-[50%] w-full h-full flex items-center justify-center px-4 sm:px-10 py-6 sm:py-10">
            <form method="POST" action="#" class="w-full max-w-md space-y-4 sm:space-y-6" aria-label="Formulario de contacto">
                @csrf
                <fieldset class="space-y-3 sm:space-y-4">
                    <legend class="sr-only">Información de contacto</legend>

                    <!-- Inputs -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-cyan-900">Nombre</label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-2 py-1 sm:px-0 sm:py-0 border-b border-cyan-600 bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-cyan-900">Correo electrónico</label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-2 py-1 sm:px-0 sm:py-0 border-b border-cyan-600 bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-cyan-900">Teléfono</label>
                            <input type="text" name="phone" id="phone"
                                class="w-full px-2 py-1 sm:px-0 sm:py-0 border-b border-cyan-600 bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-cyan-900">Asunto</label>
                            <input type="text" name="subject" id="subject"
                                class="w-full px-2 py-1 sm:px-0 sm:py-0 border-b border-cyan-600 bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-cyan-900">Mensaje</label>
                        <textarea name="message" id="message" rows="3" sm:rows="4"
                            class="w-full px-2 py-1 sm:px-0 sm:py-0 border-b border-cyan-600 bg-transparent focus:outline-none text-sm text-gray-700 resize-none placeholder-gray-400"
                            required></textarea>
                    </div>

                    <!-- Botón -->
                    <div class="flex justify-center pt-2 sm:pt-0">
                        <button type="submit"
                            class="btn-action px-8 py-4 sm:px-10 sm:py-5 border text-sm transition rounded-md">
                            Enviar Mensaje
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>