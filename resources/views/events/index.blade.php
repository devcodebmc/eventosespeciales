<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
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
        }, 4000); // Ocultar después de 4 segundos
    </script>
    @endif

    {{-- Tabla con el listado de etiquetas --}}
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col sm:flex-row justify-between items-center py-6 px-4 sm:px-6 space-y-4 sm:space-y-0">
                    <form method="GET" action="{{ route('events.index') }}" class="flex flex-col sm:flex-row items-stretch w-full sm:w-auto">
                        <div class="flex flex-col sm:flex-row flex-grow space-y-4 sm:space-y-0 sm:space-x-4">
                            <div class="flex-grow relative">
                                <input id="search" type="text" name="search" value="{{ request('search') }}" placeholder="Buscar eventos" 
                                       class="w-full h-full border border-gray-300 rounded-md pl-3 pr-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500" required/>
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                <button type="submit" class="inline-flex justify-center items-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 h-full">
                                    Buscar
                                </button>
                                @if (request('search'))
                                <a href="{{ route('events.index') }}" class="inline-flex justify-center items-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-full">
                                    Limpiar
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                   
                    <div class="flex space-x-1">
                        <button id="list-view" class="p-2 rounded hover:bg-indigo-100" title="Vista de lista">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </button>
                        <button id="grid-view" class="p-2 rounded hover:bg-indigo-100" title="Vista de cuadrícula">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                        </button>
                        <a href="{{ route('events.create') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 flex items-center w-full sm:w-auto justify-center sm:justify-start order-3" title="Nuevo evento">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Vista de lista -->
                <div id="list-view-container" class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Portada
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Titulo
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipo 
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
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
                            @foreach ($events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($event->image)
                                            <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="w-10 h-10 rounded-full border-2 border-emerald-500">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div id="tag-view-{{ $event->id }}">
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                {{ Str::limit($event->title, 30) }}
                                            </span>
                                        </div>
                                        <button 
                                            type="button" 
                                            onclick="openContentModal({{ $event->id }})"
                                            class="mt-2 text-xs text-emerald-600 hover:underline focus:outline-none"
                                            title="Ver contenido completo"
                                        >
                                            Vista previa
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            {{ $event->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($event->status == 'draft')
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-yellow-200 text-yellow-800">
                                                Borrador
                                            </span>
                                            @else
                                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-200 text-green-800">
                                                Publicado
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $event->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $event->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <!-- Icono para cambiar estado (solo para admin/editor) -->
                                            @if(auth()->user())
                                                <form action="{{ route('events.update-status', $event->id) }}" method="POST" class="inline mr-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="new_status" value="{{ $event->status == 'draft' ? 'published' : 'draft' }}">
                                                    <button type="submit" class="text-gray-500 {{ $event->status == 'draft' ? 'hover:text-green-600' : 'hover:text-yellow-500'}}" title="{{ $event->status == 'draft' ? 'Publicar' : 'Marcar como borrador' }}">
                                                        @if($event->status == 'draft')
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-h h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                                            </svg>  
                                                        @endif
                                                    </button>
                                                </form>
                                            @endif
                                            <!-- Icono de editar -->
                                            <a href="{{ route('events.edit', $event->id) }}" class="text-gray-500 hover:text-indigo-600 mb-2" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                            
                                            <!-- Icono de mover a la papelera -->
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-600" title="Mover a la papelera">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                     
                    </table>
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
                
                <!-- Vista de cuadrícula -->
                <div id="grid-view-container" class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 hidden">
                    @foreach ($events as $event)
                        <div class="relative bg-cover bg-center rounded-lg shadow-md h-48 group" 
                             @if ($event->image)
                                 style="background-image: url('{{ asset($event->image) }}');"
                             @else
                                 style="background-color: #566573 ; display: flex; align-items: center; justify-content: center;"
                             @endif
                        >
                            @unless($event->image)
                                <div class="flex items-center justify-center h-full w-full">
                                    <svg class="w-28 h-28 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </div>
                            @endunless
                            <!-- Badge de estado en la esquina superior izquierda -->
                            <div class="absolute top-2 left-2 z-10">
                                @if ($event->status == 'draft')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-400 text-yellow-800">
                                        Borrador
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-400 text-green-800">
                                        Publicado
                                    </span>
                                @endif
                            </div>
                            
                            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg p-4 flex flex-col justify-end transition-all duration-300 hover:bg-opacity-65 group">
                                <!-- Título con mejor contraste -->
                                <div class="text-sm font-semibold text-white group-hover:text-yellow-300 transition-colors duration-300">
                                    {{ $event->title }}
                                </div>
                                <!-- Texto secundario con mejor contraste -->
                                <div class="text-sm text-gray-300 mt-2 group-hover:text-gray-100 transition-colors duration-300">
                                    {{ $event->updated_at->format('d/m/Y h:i a') }}
                                </div>
                                
                                <!-- Botón de vista previa -->
                                <button 
                                    onclick="openContentModal({{ $event->id }})"
                                    class="mt-2 text-xs text-emerald-300 hover:text-emerald-100 focus:outline-none text-left"
                                    title="Ver contenido completo"
                                >
                                    Vista previa
                                </button>
                            </div>
                                                                    
                            <!-- Menú de tres puntos y dropdown de acciones -->
                            <div class="absolute top-2 right-2">
                                <!-- Botón de tres puntos -->
                                <button onclick="toggleDropdown('dropdown-{{ $event->id }}', event)" class="dropdown-button text-white bg-gray-700 bg-opacity-50 rounded-full p-1 focus:outline-none hover:bg-gray-600">
                                    &#x22EE; <!-- Icono de tres puntos -->
                                </button>

                                <!-- Dropdown de acciones -->
                                <div id="dropdown-{{ $event->id }}" class="dropdown-content hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        @if(auth()->user())
                                            <form action="{{ route('events.update-status', $event->id) }}" method="POST" class="block w-full text-left px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="new_status" value="{{ $event->status == 'draft' ? 'published' : 'draft' }}">
                                                <button type="submit" class="w-full flex items-center gap-2 text-left">
                                                    @if($event->status == 'draft')
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Publicar
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        Marcar como borrador
                                                    @endif
                                                </button>
                                            </form>
                                        @endif
                                        <div class="block w-full text-left px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <a href="{{ route('events.edit', $event->id) }}" class="w-full flex items-center gap-2 text-left" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                Editar
                                            </a>
                                        </div>
                                        
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="block w-full text-left px-2 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex items-center gap-2 text-left">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Mover a la papelera
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para vista previa del contenido (compartido por ambas vistas) -->
    @foreach ($events as $event)
    <div 
        id="content-modal-{{ $event->id }}" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden"
        aria-modal="true" role="dialog"
    >
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-4 sm:mx-6 p-4 sm:p-6 relative flex flex-col max-h-[90vh]">
            <button 
                onclick="closeContentModal({{ $event->id }})"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700"
                title="Cerrar"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <h3 class="text-lg font-semibold mb-4 text-gray-800 pr-8">{{ $event->title }}</h3>
            <div class="prose max-w-full overflow-y-auto" style="max-height:60vh;">
                {!! $event->content !!}
            </div>
        </div>
    </div>
    @endforeach

    @push('js')
    <script>
        // Función para alternar la visibilidad del dropdown
        function toggleDropdown(dropdownId, event) {
            event.stopPropagation(); // Evita que el clic se propague y cierre el dropdown inmediatamente
            const dropdown = document.getElementById(dropdownId);
            const allDropdowns = document.querySelectorAll('.dropdown-content');

            // Cerrar todos los dropdowns excepto el actual
            allDropdowns.forEach(function(d) {
                if (d.id !== dropdownId) {
                    d.classList.add('hidden');
                }
            });

            // Alternar la visibilidad del dropdown actual
            dropdown.classList.toggle('hidden');
        }
        
        // Cerrar el dropdown al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            const isClickInsideDropdown = Array.from(dropdowns).some(dropdown => dropdown.contains(event.target));
            const isClickOnButton = event.target.matches('.dropdown-button') || event.target.closest('.dropdown-button');

            if (!isClickInsideDropdown && !isClickOnButton) {
                dropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
        
        // Funciones para el modal de contenido
        function openContentModal(id) {
            document.getElementById('content-modal-' + id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        
        function closeContentModal(id) {
            document.getElementById('content-modal-' + id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
        
        // Funciones para alternar entre vistas
        function toggleView(activeButton, inactiveButton, activeContainer, inactiveContainer) {
            document.getElementById(activeContainer).classList.remove('hidden');
            document.getElementById(inactiveContainer).classList.add('hidden');
            document.getElementById(activeButton).classList.add('bg-indigo-200');
            document.getElementById(inactiveButton).classList.remove('bg-indigo-200');
        }

        // Agregar eventos a los botones de vista
        document.getElementById('list-view').addEventListener('click', function() {
            toggleView('list-view', 'grid-view', 'list-view-container', 'grid-view-container');
        });

        document.getElementById('grid-view').addEventListener('click', function() {
            toggleView('grid-view', 'list-view', 'grid-view-container', 'list-view-container');
        });
        
        // Inicializar con la vista de lista activa
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('list-view').classList.add('bg-indigo-200');
        });
    </script>
    @endpush
</x-app-layout>