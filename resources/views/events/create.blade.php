<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Evento') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
            @csrf
            @method('POST')
            <!-- Icono para retornar al listado de eventos -->
            <div class="flex justify-end items-center">
                <a href="{{ route('events.index') }}" class="text-indigo-500 hover:text-indigo-600 transition duration-200 flex items-center font-semibold" title="Volver al listado de eventos">
                   <small>Regresar al listado de eventos</small> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>
                </a>
            </div>
            <!-- Título del Evento -->
            <div class="mb-8">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Título del Evento
                </label>
                <input type="text" name="title" id="title" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" placeholder="Ej: Fiesta de Aniversario" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Columna Izquierda -->
                <div class="space-y-6">
                    <!-- Resumen -->
                    <div>
                        <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">
                            Resumen
                        </label>
                        <input type="text" name="summary" id="summary" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" placeholder="Breve descripción del evento" value="{{ old('summary') }}">
                        @error('summary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Contenido con Quill -->
                    @include('components.quillEditor')

                </div>
                <!-- Columna Derecha -->
                <div class="space-y-6">
                     <!-- Categoría -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Tags -->
                    @include('components.tagList')
                    <!-- Fecha y hora -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora</label>
                            <input type="datetime-local" name="event_date" id="event_date" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" value="{{ old('event_date') }}">
                            @error('event_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lugar</label>
                            <input type="text" name="location" id="location" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" placeholder="Ej: Salón Principal" value="{{ old('location') }}">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Organizador -->
                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-700 mb-2">Organizador</label>
                        <input type="text" name="organizer" id="organizer" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" placeholder="Nombre del organizador" value="{{ old('organizer') }}">
                        @error('organizer')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Imagen principal -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Imagen Principal
                        </label>
                        <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="space-y-1 text-center" id="upload-container">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex flex-col text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500">
                                        <span>Subir una imagen</span>
                                        <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                            </div>
                            <div id="image-preview" class="hidden text-center">
                                <img id="preview" class="max-w-full h-48 rounded-lg" src="#" alt="Previsualización de la imagen" />
                                <button type="button" id="remove-image" class="mt-2 text-sm text-red-600 hover:text-red-500">Reemplazar imagen</button>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- URL del Video -->
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">URL del Video</label>
                        <input type="url" name="video_url" id="video_url" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200" placeholder="Ej: https://youtube.com/..." value="{{ old('video_url') }}">
                        @error('video_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Imágenes Secundarias -->
                    <div>
                        <label for="event_images" class="block text-sm font-medium text-gray-700 mb-2">Imágenes Secundarias</label>
                        <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 hover:bg-gray-100 transition duration-200">
                            <div class="space-y-1 text-center" id="upload-container-secondary">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex flex-col text-sm text-gray-600">
                                    <label for="event_images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500">
                                        <span>Subir imágenes</span>
                                        <input type="file" name="event_images[]" id="event_images" class="sr-only" accept="image/*" multiple>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB cada una</p>
                            </div>
                            <div id="images-preview" class="flex flex-wrap gap-4 mt-4"></div>
                        </div>
                        @error('event_images')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Estado y Tipo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Borrador</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Publicado</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                            <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition duration-200">
                                <option value="Event" {{ old('type') == 'Event' ? 'selected' : '' }}>Evento</option>
                                <option value="Service" {{ old('type') == 'Service' ? 'selected' : '' }}>Servicio</option>
                                <option value="Gallery" {{ old('type') == 'Gallery' ? 'selected' : '' }}>Galería</option>
                                <option value="Video" {{ old('type') == 'Video' ? 'selected' : '' }}>Video</option>
                                <option value="Banner" {{ old('type') == 'Banner' ? 'selected' : '' }}>Banner</option>
                                <option value="Promotion" {{ old('type') == 'Promotion' ? 'selected' : '' }}>Promoción</option>
                                <option value="Package" {{ old('type') == 'Promotion' ? 'selected' : '' }}>Paquete</option>
                                <option value="Article" {{ old('type') == 'Article' ? 'selected' : '' }}>Artículo</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Botón de Envío -->
                    <div class="mt-8">
                        <button type="submit" class="w-full text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 py-3 px-4 transition duration-200">
                            Guardar Evento
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Quill Editor CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Previsualización de la imagen principal
            const imageInput = document.getElementById('image');
            const uploadContainer = document.getElementById('upload-container');
            const imagePreview = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview');
            const removeImageButton = document.getElementById('remove-image');

            imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                previewImage.src = e.target.result;
                uploadContainer.classList.add('hidden');
                imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
            });

            removeImageButton.addEventListener('click', function() {
            imageInput.value = '';
            previewImage.src = '#';
            imagePreview.classList.add('hidden');
            uploadContainer.classList.remove('hidden');
            });

            // Previsualización de las imagenes secundarias
            const imagesInput = document.getElementById('event_images');
            const uploadContainerSecondary = document.getElementById('upload-container-secondary');
            const imagesPreview = document.getElementById('images-preview');

            imagesInput.addEventListener('change', function(event) {
            const files = event.target.files;
            if (files.length > 0) {
                imagesPreview.innerHTML = '';
                Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageContainer = document.createElement('div');
                    imageContainer.className = 'relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-24 h-24 object-cover rounded-lg';

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className = 'absolute top-0 right-0 px-1 py-1 bg-red-500 text-white rounded-full hover:bg-red-600 transition duration-200';
                    removeButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    `;
                    removeButton.onclick = function() {
                    imageContainer.remove();
                    updateFileInput(files, file);
                    if (imagesPreview.children.length === 0) {
                        imagesPreview.classList.add('hidden');
                        uploadContainerSecondary.classList.remove('hidden');
                    }
                    };

                    imageContainer.appendChild(img);
                    imageContainer.appendChild(removeButton);
                    imagesPreview.appendChild(imageContainer);
                };
                reader.readAsDataURL(file);
                });
                uploadContainerSecondary.classList.add('hidden');
                imagesPreview.classList.remove('hidden');
            }
            });

            function updateFileInput(allFiles, fileToRemove) {
            const dataTransfer = new DataTransfer();
            Array.from(allFiles).forEach(file => {
                if (file !== fileToRemove) {
                dataTransfer.items.add(file);
                }
            });
            imagesInput.files = dataTransfer.files;
            }


        });
    </script>
</x-app-layout>
