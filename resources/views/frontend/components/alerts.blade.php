@if(session('success'))
<div id="success-alert" class="fixed top-10 right-6 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100 z-50">
    <div class="bg-white border-l-4 border-teal-500 shadow-xl rounded-lg px-5 py-4 flex items-center max-w-md w-full">
        <div class="flex-shrink-0 flex items-center justify-center h-8 w-8">
            <svg class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-gray-800 font-medium">{{ session('success') }}</p>
        </div>
        <button onclick="closeAlert(this.closest('[id$=-alert]'))" 
                class="text-gray-400 hover:text-gray-500 focus:outline-none flex items-center justify-center h-6 w-6">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

@push('js')
<script>
    setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if(alert) closeAlert(alert);
    }, 5000);
</script>   
@endpush

@endif

@if($errors->any())
<div id="error-alert" class="fixed top-6 right-6 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100 z-50">
    <div class="bg-white border-l-4 border-rose-500 shadow-xl rounded-lg px-5 py-4 w-full max-w-md">
        <div class="flex">
            <div class="flex-shrink-0 flex items-center h-8 w-8">
                <svg class="h-6 w-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <h3 class="text-lg font-medium text-gray-800 mb-1">Ocurrió un error</h3>
                <ul class="text-gray-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-rose-500 mr-1.5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button onclick="closeAlert(this.closest('[id$=-alert]'))" 
                    class="text-gray-400 hover:text-gray-500 focus:outline-none flex items-center justify-center h-6 w-6 ml-2">
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
        
        // Animación de salida mejorada
        alertElement.style.transform = 'translateX(100%)';
        alertElement.style.opacity = '0';
        
        // Eliminar después de la animación
        setTimeout(() => {
            alertElement.remove();
        }, 500);
    }
</script>
@endpush
