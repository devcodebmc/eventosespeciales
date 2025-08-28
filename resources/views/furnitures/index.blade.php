<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mobiliario') }}
        </h2>
    </x-slot>

    {{-- Mostrar mensaje flash --}}
    @if (session('success'))
    <div id="flash-message" class="fixed top-20 right-8 flex items-center justify-between p-8 text-sm rounded-lg shadow-md bg-white border border-gray-200">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>  
            <p class="font-semibold text-gray-900">{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('flash-message').style.display='none';" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('flash-message').style.display = 'none';
        }, 4000); // Ocultar después de 6 segundos
    </script>
    @endif

    {{-- Tabla con el listado de mobiliario --}}
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col sm:flex-row justify-between items-center py-6 px-4 sm:px-6 space-y-4 sm:space-y-0">
                    {{-- <form method="POST" action="{{ route('furnitures.store') }}" class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                        @csrf
                        <div class="flex items-center space-x-2 w-full sm:w-auto">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nueva Mobiliario" required class="block w-full border border-gray-300 rounded-md pl-3 text-sm" oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)"/>
                        </div>
                        <div class="flex items-center space-x-2 w-full sm:w-auto">
                            <input id="description" type="text" name="description" value="{{ old('description') }}" placeholder="Descripción (opcional)" class="block w-full border border-gray-300 rounded-md pl-3 text-sm" oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)"/>
                        </div>
                        <div class="flex items-center space-x-2 w-full sm:w-auto">
                            <select id="service_id" name="service_id" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out">
                                <option value="">Seleccione un Servicio</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="inline-flex justify-center items-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-full">
                            Crear Mobiliario
                        </button>
                        @error('name')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </form> --}}
                    <form method="GET" action="{{ route('furnitures.index') }}" class="flex flex-col sm:flex-row items-stretch w-full sm:w-auto">
                        <div class="flex flex-col sm:flex-row flex-grow space-y-4 sm:space-y-0 sm:space-x-4">
                            <div class="flex-grow relative">
                                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Buscar mobiliario" 
                                       class="w-full h-full border border-gray-300 rounded-md pl-3 pr-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500" required/>
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                <button type="submit" class="inline-flex justify-center items-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 h-full">
                                    Buscar
                                </button>
                                @if (request('search'))
                                <a href="{{ route('furnitures.index') }}" class="inline-flex justify-center items-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-full">
                                    Limpiar
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('furnitures.create') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        Nuevo Mobiliario
                    </a>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción
                                </th> --}}
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Orden
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Servicio
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha de creación
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha de actualización
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($furnitures as $furniture)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $furniture->name }}
                                    </td>
                                    {{-- <td class="px-6 py-4 whitespace-nowrap">
                                        {{ (strlen($furniture->description) > 50) ? substr($furniture->description, 0, 20) . '...' : (string)$furniture->description }}
                                    </td> --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($furniture->image)
                                            <img src="{{ asset('storage/' . $furniture->image) }}" alt="Imagen actual" class="w-12 h-12 object-cover rounded-md border border-gray-200">
                                        @else
                                            Sin imagen
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $furniture->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $furniture->status == 'published' ? 'Publicado' : 'Borrador' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $furniture->order }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        {{ $furniture->service->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $furniture->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $furniture->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('furnitures.edit', $furniture->id) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>                                              
                                            </a>
                                            <!-- Botón que abre el modal -->
                                            <button type="button" class="text-sm font-medium text-gray-500 hover:text-gray-700" title="Eliminar" onclick="openModal({{ $furniture->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div id="confirmationModal{{ $furniture->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 transition-opacity duration-300 hidden">
                                            <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full" id="modalContent">
                                                <div class="p-6">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-900">Confirmar eliminación</h3>
                                                        <button onclick="closeModal({{ $furniture->id }})" class="text-gray-400 hover:text-gray-600">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <p class="text-gray-600 mb-6 text-center">¿Estás seguro de que deseas eliminar la categoría <strong class="ml-1">{{ $furniture->name }}</strong>? 
                                                        <br>
                                                        <b class="text-red-400">Esta acción no se puede deshacer.</b>
                                                    </p>
                                                    <div class="flex justify-end space-x-3">
                                                        <button onclick="closeModal({{ $furniture->id }})" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Cancelar
                                                        </button>
                                                        <form action="{{ route('furnitures.destroy', $furniture->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                Eliminar definitivamente
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                     
                    </table>
                    <div class="mt-4">
                        {{ $furnitures->links() }}
                    </div>
                </div>
            </div>
            <!-- Table -->
        </div>
    </div>
<!-- Main Content -->
<script>
    // Función para mostrar el modal con animación
    function openModal(id) {
        const modal = document.getElementById('confirmationModal' + id);
        const modalContent = modal.querySelector('#modalContent');

        // Mostrar modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    // Función para cerrar el modal con animación
    function closeModal(id) {
        const modal = document.getElementById('confirmationModal' + id);
        const modalContent = modal.querySelector('#modalContent');

        // Animación de salida
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        modal.classList.remove('opacity-100');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Cerrar modal al hacer clic fuera del contenido
    document.querySelectorAll('[id^="confirmationModal"]').forEach((modal) => {
        modal.addEventListener('click', function (e) {
            if (e.target === this) {
                closeModal(this.id.replace('confirmationModal', ''));
            }
        });
    });
</script>
</x-app-layout>
