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
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                                       placeholder="Nombre del archivo">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Archivo --}}
                            <div class="md:col-span-2">
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                    Archivo <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <input type="file" 
                                           name="file" 
                                           id="file" 
                                           required
                                           onchange="previewFileInfo(event)"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('file') border-red-500 @enderror">
                                    <div id="fileInfo" class="mt-2 hidden">
                                        <p class="text-sm text-gray-600">
                                            <span id="fileName" class="font-medium"></span> 
                                            (<span id="fileSize"></span>)
                                        </p>
                                        <p id="fileType" class="text-xs text-gray-500 mt-1"></p>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Formatos permitidos: imágenes, PDF, documentos, Excel</p>
                                    @error('file')
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
                            <div class="relative">
                                <label for="category_search" class="block text-sm font-medium text-gray-700 mb-2">
                                    Categoría <span class="text-red-500">*</span>
                                </label>
                                
                                {{-- Input para búsqueda --}}
                                <input type="text" 
                                    id="category_search" 
                                    name="category_search"
                                    autocomplete="off"
                                    value="{{ old('category_search') }}"
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out"
                                    placeholder="Escribe para buscar categorías...">
                                
                                {{-- Campo oculto para el ID real --}}
                                <input type="hidden" 
                                    name="category_id" 
                                    id="category_id"
                                    value="{{ old('category_id') }}"
                                    required>
                                
                                {{-- Contenedor para sugerencias --}}
                                <div id="category_suggestions" 
                                    class="hidden absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 max-h-60 overflow-y-auto">
                                </div>
                                
                                {{-- Select original (lo mantendremos oculto para tener los datos) --}}
                                <select id="original_categories" class="hidden">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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

        // Variables globales
        let allCategories = [];

        // Función para inicializar las categorías
        function initCategories() {
            allCategories = [];
            document.querySelectorAll('#original_categories option').forEach(option => {
                allCategories.push({
                    id: option.value,
                    name: option.dataset.name || option.textContent
                });
            });
            
            // Si hay un valor anterior, establecerlo en el input de búsqueda
            const categoryId = document.getElementById('category_id').value;
            if (categoryId) {
                const selectedCategory = allCategories.find(cat => cat.id == categoryId);
                if (selectedCategory) {
                    document.getElementById('category_search').value = selectedCategory.name;
                }
            }
        }

        // Función para filtrar y mostrar sugerencias
        function showCategorySuggestions(query) {
            const container = document.getElementById('category_suggestions');
            const searchInput = document.getElementById('category_search');
            
            // Ocultar si no hay query
            if (!query || query.trim() === '') {
                container.classList.add('hidden');
                return;
            }
            
            const filteredCategories = allCategories.filter(category => 
                category.name.toLowerCase().includes(query.toLowerCase())
            );
            
            if (filteredCategories.length === 0) {
                container.innerHTML = '<div class="p-3 text-gray-500 text-sm text-center">No se encontraron categorías</div>';
                container.classList.remove('hidden');
                return;
            }
            
            container.innerHTML = '';
            filteredCategories.forEach(category => {
                const item = document.createElement('div');
                item.className = 'p-3 hover:bg-indigo-50 cursor-pointer text-sm border-b border-gray-100 last:border-b-0 transition duration-150 ease-in-out';
                item.textContent = category.name;
                item.dataset.id = category.id;
                item.dataset.name = category.name;
                
                // Resaltar texto coincidente
                const regex = new RegExp(`(${query})`, 'gi');
                item.innerHTML = category.name.replace(regex, '<span class="font-semibold text-indigo-600">$1</span>');
                
                // Evento para seleccionar una categoría
                item.addEventListener('click', function() {
                    selectCategory(category.id, category.name);
                });
                
                item.addEventListener('mouseenter', function() {
                    this.classList.add('bg-indigo-50');
                });
                
                item.addEventListener('mouseleave', function() {
                    this.classList.remove('bg-indigo-50');
                });
                
                container.appendChild(item);
            });
            
            container.classList.remove('hidden');
        }

        // Función para seleccionar una categoría
        function selectCategory(id, name) {
            document.getElementById('category_id').value = id;
            document.getElementById('category_search').value = name;
            document.getElementById('category_suggestions').classList.add('hidden');
            
            // Validar que se seleccionó una categoría
            const hiddenInput = document.getElementById('category_id');
            if (hiddenInput.value) {
                hiddenInput.classList.remove('border-red-500');
            }
        }

        // Función para limpiar la selección
        function clearCategorySelection() {
            document.getElementById('category_id').value = '';
            document.getElementById('category_search').value = '';
            document.getElementById('category_suggestions').classList.add('hidden');
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar categorías
            initCategories();
            
            // Input de búsqueda de categorías
            const categorySearch = document.getElementById('category_search');
            const suggestionsContainer = document.getElementById('category_suggestions');
            
            // Evento para mostrar sugerencias al escribir
            categorySearch.addEventListener('input', function(e) {
                showCategorySuggestions(e.target.value);
            });
            
            // Evento para enfocar el input de búsqueda
            categorySearch.addEventListener('focus', function() {
                if (this.value) {
                    showCategorySuggestions(this.value);
                } else {
                    // Mostrar todas las categorías si no hay texto
                    showCategorySuggestions('');
                }
            });
            
            // Evento para cerrar sugerencias al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!categorySearch.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.classList.add('hidden');
                }
            });
            
            // Evento para teclas especiales en el input de búsqueda
            categorySearch.addEventListener('keydown', function(e) {
                const suggestions = suggestionsContainer.querySelectorAll('div');
                
                if (e.key === 'Escape') {
                    suggestionsContainer.classList.add('hidden');
                    this.blur();
                } else if (e.key === 'ArrowDown' && suggestions.length > 0) {
                    e.preventDefault();
                    suggestions[0].focus();
                    suggestions[0].classList.add('bg-indigo-50');
                }
            });
            
            // Evento para limpiar selección si el input se vacía
            categorySearch.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    clearCategorySelection();
                }
            });
        });
    </script>
</x-app-layout>