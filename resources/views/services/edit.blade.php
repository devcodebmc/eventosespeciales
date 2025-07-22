<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Servicio') }}
        </h2>
    </x-slot>

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
                            
                            {{-- Estado del Servicio --}}
                            <div class="col-span-1">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado
                                </label>
                                <select 
                                    id="status" 
                                    name="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm px-3 py-2 bg-white"
                                >
                                    <option value="draft" {{ old('status', $service->status) == 'draft' ? 'selected' : '' }}>Borrador</option>
                                    <option value="published" {{ old('status', $service->status) == 'published' ? 'selected' : '' }}>Publicado</option>
                                </select>
                            </div>
                            
                            {{-- Orden del Servicio --}}
                            <div class="col-span-1">
                                <label for="order" class="block text-sm font-medium text-gray-700">
                                    Orden de visualización
                                </label>
                                <input 
                                    type="number" 
                                    id="order" 
                                    name="order" 
                                    value="{{ old('order', $service->order) }}"
                                    min="1"
                                    max="{{ $orderLimit }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 text-sm"
                                >
                                <p class="mt-1 text-sm text-gray-500">
                                    Número que determina el orden de visualización (1 = primero)
                                </p>
                            </div>
                            
                            <div class="col-span-1">
                                <label for="image" class="block text-sm font-medium text-gray-700">
                                    Imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="image" 
                                    name="image" 
                                    accept="image/*"
                                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    onchange="previewImage(event)"
                                >
                                <div class="mt-2">
                                    <div class="flex justify-center">
                                        @if($service->image)
                                            <img id="image-preview" src="{{ asset('storage/' . $service->image) }}" alt="Imagen actual" class="w-24 h-24 object-cover rounded-md border border-gray-200"/>
                                        @else
                                            <img id="image-preview" src="#" alt="Vista previa" class="hidden w-24 h-24 object-cover rounded-md border border-gray-200"/>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-full">
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
                        @error('order')
                        <div class="text-red-500 mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('image-preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
</x-app-layout>