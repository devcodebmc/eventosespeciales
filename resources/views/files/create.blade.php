<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir Nuevo Archivo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nombre --}}
                            <div class="md:col-span-2">
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="nombre" 
                                       id="nombre" 
                                       value="{{ old('nombre') }}"
                                       required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nombre') border-red-500 @enderror"
                                       placeholder="Nombre del archivo">
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Archivo (path se generará automáticamente) --}}
                            <div class="md:col-span-2">
                                <label for="archivo" class="block text-sm font-medium text-gray-700 mb-2">
                                    Archivo <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <input type="file" 
                                           name="archivo" 
                                           id="archivo" 
                                           required
                                           onchange="previewFileInfo(event)"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('archivo') border-red-500 @enderror">
                                    <div id="fileInfo" class="mt-2 hidden">
                                        <p class="text-sm text-gray-600">
                                            <span id="fileName" class="font-medium"></span> 
                                            (<span id="fileSize"></span>)
                                        </p>
                                        <p id="fileType" class="text-xs text-gray-500 mt-1"></p>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Formatos permitidos: imágenes, PDF, documentos, Excel</p>
                                    @error('archivo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Imagen</option>
                                    <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                    <option value="doc" {{ old('type') == 'doc' ? 'selected' : '' }}>Documento</option>
                                    <option value="excel" {{ old('type') == 'excel' ? 'selected' : '' }}>Excel</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Categoría --}}
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Categoría <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" 
                                        id="category_id"
                                        required
                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out @error('category_id') border-red-500 @enderror">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Preview para imágenes --}}
                            <div class="md:col-span-2 hidden" id="imagePreviewContainer">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Vista previa
                                </label>
                                <div class="mt-1">
                                    <img id="imagePreview" 
                                         src="#" 
                                         alt="Preview" 
                                         class="w-48 h-48 object-contain rounded-md border border-gray-300">
                                </div>
                            </div>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('files.index') }}" 
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Subir Archivo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generar slug automáticamente desde el nombre
        document.getElementById('nombre').addEventListener('input', function(e) {
            const nombre = e.target.value;
            const slug = nombre
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Eliminar acentos
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('slug').value = slug;
        });

        // Detectar tipo de archivo y mostrar preview
        function previewFileInfo(event) {
            const file = event.target.files[0];
            const fileInfo = document.getElementById('fileInfo');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const typeSelect = document.getElementById('type');
            
            if (file) {
                // Mostrar información del archivo
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = formatFileSize(file.size);
                document.getElementById('fileType').textContent = `Tipo: ${file.type}`;
                fileInfo.classList.remove('hidden');
                
                // Detectar y sugerir tipo de archivo basado en extensión
                const extension = file.name.split('.').pop().toLowerCase();
                let detectedType = '';
                
                if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(extension)) {
                    detectedType = 'image';
                } else if (extension === 'pdf') {
                    detectedType = 'pdf';
                } else if (['doc', 'docx', 'txt', 'rtf'].includes(extension)) {
                    detectedType = 'doc';
                } else if (['xls', 'xlsx', 'csv'].includes(extension)) {
                    detectedType = 'excel';
                }
                
                // Si el tipo no está seleccionado, auto-seleccionar el detectado
                if (detectedType && !typeSelect.value) {
                    typeSelect.value = detectedType;
                }
                
                // Preview para imágenes
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreviewContainer.classList.add('hidden');
                }
            } else {
                fileInfo.classList.add('hidden');
                imagePreviewContainer.classList.add('hidden');
            }
        }

        // Formatear tamaño de archivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Auto-detect tipo cuando se cambia el archivo
        document.getElementById('archivo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const typeSelect = document.getElementById('type');
                const fileType = file.type;
                
                // Mapear tipos MIME a tus valores enum
                if (fileType.startsWith('image/')) {
                    typeSelect.value = 'image';
                } else if (fileType === 'application/pdf') {
                    typeSelect.value = 'pdf';
                } else if (fileType.includes('word') || fileType.includes('document')) {
                    typeSelect.value = 'doc';
                } else if (fileType.includes('excel') || fileType.includes('spreadsheet')) {
                    typeSelect.value = 'excel';
                }
            }
        });
    </script>
</x-app-layout>