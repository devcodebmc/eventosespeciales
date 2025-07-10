<div class="flex justify-center items-center py-24 px-4 bg-white relative overflow-hidden">
    <!-- Flor izquierda (más cerca del círculo) -->
    <img src="{{ asset('images/contact-left-leaf.png') }}" alt="Flor izquierda"
        class="hidden md:block absolute left-40 top-1/2 -translate-y-1/2 max-w-[140px] z-0 pointer-events-none">

    <!-- Flor derecha (más cerca del círculo) -->
    <img src="{{ asset('images/contact-right-leaf.png') }}" alt="Flor derecha"
        class="hidden md:block absolute right-40 top-1/2 -translate-y-1/2 max-w-[140px] z-0 pointer-events-none">

    <!-- Círculo decorativo con bordes irregulares -->
    <div class="relative w-[90vw] max-w-xl aspect-square flex items-center justify-center z-10">
        <!-- Círculo con ondas intercaladas 1 -->
        <div class="absolute inset-0 rounded-[55%_45%_50%_50%_/_45%_55%_50%_50%] border border-cyan-300 scale-[1.1] rotate-1 shadow-md shadow-cyan-300/30"></div>

        <!-- Círculo con ondas intercaladas 2 -->
        <div class="absolute inset-0 rounded-[50%_50%_55%_45%_/_50%_50%_45%_55%] border border-cyan-200 scale-[1.15] -rotate-2 shadow-lg shadow-cyan-200/40"></div>

        <!-- Círculo principal -->
        <div class="relative bg-white border border-cyan-600 rounded-[50%] w-full h-full flex items-center justify-center p-8 md:p-10">
            <form action="#" method="POST" class="w-full max-w-md space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm text-cyan-900 font-medium">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full border-b border-cyan-600 bg-transparent focus:outline-none focus:ring-0 text-gray-700 text-sm"
                            required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm text-cyan-900 font-medium">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border-b border-cyan-600 bg-transparent focus:outline-none focus:ring-0 text-gray-700 text-sm"
                            required>
                    </div>
                    <div>
                        <label for="phone" class="block text-sm text-cyan-900 font-medium">Phone</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full border-b border-cyan-600 bg-transparent focus:outline-none focus:ring-0 text-gray-700 text-sm">
                    </div>
                    <div>
                        <label for="subject" class="block text-sm text-cyan-900 font-medium">Subject</label>
                        <input type="text" name="subject" id="subject"
                            class="w-full border-b border-cyan-600 bg-transparent focus:outline-none focus:ring-0 text-gray-700 text-sm">
                    </div>
                </div>

                <div>
                    <label for="message" class="block text-sm text-cyan-900 font-medium">Message</label>
                    <textarea name="message" id="message" rows="3"
                        class="w-full border-b border-cyan-600 bg-transparent focus:outline-none focus:ring-0 text-gray-700 text-sm resize-none"></textarea>
                </div>

                <div class="flex justify-center pt-2">
                    <button type="submit"
                        class="btn-action  px-10 py-5">
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
