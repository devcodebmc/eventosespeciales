<!-- Alertas -->
@if(session('success'))
    <div id="success-alert" class="fixed top-6 right-6 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100">
        <div class="bg-white border border-green-200 shadow-lg rounded-lg px-6 py-4 flex items-center max-w-md w-full">
            <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-gray-800 flex-grow">{{ session('success') }}</span>
            <button onclick="closeAlert(this.closest('[id$=-alert]'))" 
                    class="text-gray-400 hover:text-gray-500">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if(alert) closeAlert(alert);
        }, 5000);
    </script>
@endif

@if($errors->any())
    <div id="error-alert" class="fixed top-6 right-6 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100">
        <div class="bg-white border border-red-200 shadow-lg rounded-lg px-6 py-4 max-w-md w-full">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-red-500 mr-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-grow">
                    <h3 class="text-gray-800 font-medium mb-1">Error</h3>
                    <ul class="text-gray-600 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="closeAlert(this.closest('[id$=-alert]'))" 
                        class="text-gray-400 hover:text-gray-500 ml-4">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if(alert) closeAlert(alert);
            }, 8000); // Más tiempo para errores
        </script>
    @endpush
@endif

@push('js')
    <script>
        function closeAlert(alertElement) {
            if(!alertElement) return;
            
            // Animación de salida
            alertElement.classList.remove('translate-x-0', 'opacity-100');
            alertElement.classList.add('translate-x-full', 'opacity-0');
            
            // Eliminar después de la animación
            setTimeout(() => {
                alertElement.remove();
            }, 1000);
        }
    </script>
@endpush
