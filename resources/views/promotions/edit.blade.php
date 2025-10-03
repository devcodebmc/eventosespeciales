<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Promoción') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('promotions.update', $promotion->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Título --}}
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Título <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       value="{{ old('title', $promotion->title) }}"
                                       required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('title') border-red-500 @enderror"
                                       placeholder="Título de la promoción">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Descripción --}}
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Descripción
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="4"
                                          class="block w-full border-gray-300 pl-3 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-500 @enderror"
                                          placeholder="Descripción de la promoción">{{ old('description', $promotion->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tipo --}}
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipo <span class="text-red-500">*</span>
                                </label>
                                <select name="type" 
                                        id="type"
                                        required
                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out @error('type') border-red-500 @enderror">
                                    <option value="">Seleccionar tipo</option>
                                    <option value="discount" {{ old('type', $promotion->type) == 'discount' ? 'selected' : '' }}>Descuento</option>
                                    <option value="banner" {{ old('type', $promotion->type) == 'banner' ? 'selected' : '' }}>Banner</option>
                                    <option value="offer" {{ old('type', $promotion->type) == 'offer' ? 'selected' : '' }}>Oferta</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Orden --}}
                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                                    Orden
                                </label>
                                <input type="number" 
                                       name="order" 
                                       id="order" 
                                       value="{{ old('order', $promotion->order) }}"
                                       min="1"
                                       max="{{ $orderLimit }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('order') border-red-500 @enderror"
                                       placeholder="0">
                                @error('order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Fecha de inicio --}}
                            <div>
                                <label for="starts_at" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de inicio
                                </label>
                                <input type="datetime-local" 
                                       name="starts_at" 
                                       id="starts_at" 
                                       value="{{ old('starts_at', $promotion->starts_at ? \Carbon\Carbon::parse($promotion->starts_at)->format('Y-m-d\TH:i') : '') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('starts_at') border-red-500 @enderror">
                                @error('starts_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Fecha de fin --}}
                            <div>
                                <label for="ends_at" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fecha de fin
                                </label>
                                <input type="datetime-local" 
                                       name="ends_at" 
                                       id="ends_at" 
                                       value="{{ old('ends_at', $promotion->ends_at ? \Carbon\Carbon::parse($promotion->ends_at)->format('Y-m-d\TH:i') : '') }}"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('ends_at') border-red-500 @enderror">
                                @error('ends_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Imagen actual y nueva --}}
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Imagen
                                </label>
                                
                                {{-- Imagen actual --}}
                                @if ($promotion->image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                                    <div class="relative inline-block">
                                        <img src="{{ asset('storage/' . $promotion->image) }}" 
                                             alt="{{ $promotion->title }}" 
                                             id="currentImage"
                                             class="w-48 h-48 object-cover rounded-md border border-gray-300">
                                        <button type="button" 
                                                onclick="removeCurrentImage()"
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                title="Eliminar imagen actual">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                                </div>
                                @endif

                                {{-- Nueva imagen --}}
                                <div class="mt-1 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img id="imagePreview" 
                                             src="#" 
                                             alt="Preview" 
                                             class="hidden w-32 h-32 object-cover rounded-md border border-gray-300">
                                    </div>
                                    <div class="flex-grow">
                                        <input type="file" 
                                               name="image" 
                                               id="image" 
                                               accept="image/*"
                                               onchange="previewImage(event)"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image') border-red-500 @enderror">
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG hasta 2MB</p>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Estado activo --}}
                            <div class="md:col-span-2">
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="is_active" 
                                           id="is_active" 
                                           value="1"
                                           {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                        Promoción activa
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="mt-6 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500">
                                    Creado: {{ $promotion->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Actualizado: {{ $promotion->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('promotions.index') }}" 
                                   class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Actualizar Promoción
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview de imagen
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        // Remover imagen actual
        function removeCurrentImage() {
            if (confirm('¿Estás seguro de que deseas eliminar la imagen actual?')) {
                document.getElementById('currentImage').parentElement.style.display = 'none';
                document.getElementById('removeImageInput').value = '1';
            }
        }

        // Generar slug automáticamente desde el título
        document.getElementById('title').addEventListener('input', function(e) {
            const title = e.target.value;
            const slug = title
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('slug').value = slug;
        });
    </script>
</x-app-layout>