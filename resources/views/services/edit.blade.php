<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Servicio') }}
        </h2>
    </x-slot>

    {{-- Formulario para la creación de Servicios --}}
    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Nombre del Servicio -->
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Nombre
                                    <span class="text-red-500">*</span>
                                </label>
                                <input id="name" type="text" name="name" value="{{ old('name', $service->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 text-sm" oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)"/>
                            </div>
                            {{-- Descripción del Servicio --}}
                            <div class="col-span-1">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Descripción
                                </label>
                                <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md pl-3 text-sm resize-none h-32" rows="4" oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)">{{ old('description', $service->description) }}</textarea>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white  bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-full">
                                Actualizar Servicio
                            </button>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="{{ route('services.index') }}" class="text-blue-500 hover:underline">
                                Volver a Servicios
                            </a>
                        </div>
                        @error('name')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
