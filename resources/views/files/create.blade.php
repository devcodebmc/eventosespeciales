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

                    {{-- Errores generales --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-red-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-red-800">Revisa los siguientes errores:</p>
                                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

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
                                       maxlength="255"
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                                       placeholder="Ej: Catálogo de productos 2026">
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
                                           accept=".jpg,.jpeg,.png,.gif,.webp,.bmp,.pdf,.doc,.docx,.xls,.xlsx,.csv,.txt"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('file') border-red-500 @enderror">
                                    <div id="fileInfo" class="mt-2 hidden">
                                        <p class="text-sm text-gray-600">
                                            <span id="fileName" class="font-medium"></span>
                                            (<span id="fileSize"></span>)
                                        </p>
                                        <p id="fileType" class="text-xs text-gray-500 mt-1"></p>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">
                                        Formatos permitidos: imágenes, PDF, documentos, Excel. Tamaño máximo: 10MB.
                                    </p>
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

                            {{-- Categoría con búsqueda --}}
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
                                       class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 ease-in-out @error('category_id') border-red-500 @enderror"
                                       placeholder="Escribe para buscar categorías...">

                                {{-- Campo oculto para el ID real --}}
                                <input type="hidden"
                                       name="category_id"
                                       id="category_id"
                                       value="{{ old('category_id') }}"
                                       required>

                                {{-- Botón para limpiar --}}
                                <button type="button"
                                        id="clear_category"
                                        class="absolute right-2 top-9 text-gray-400 hover:text-gray-600 hidden"
                                        title="Limpiar selección"
                                        onclick="clearCategorySelection()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                {{-- Contenedor para sugerencias --}}
                                <div id="category_suggestions"
                                     class="hidden absolute z-20 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 max-h-60 overflow-y-auto">
                                </div>

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
                                         class="w-48 h-48 object-contain rounded-md border border-gray-300 bg-gray-50">
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
                                    id="submitBtn"
                                    class="inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg id="submitSpinner" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span id="submitText">Subir Archivo</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JSON con las categorías --}}
    <script id="categories-data" type="application/json">
        {!! $categories->toJson() !!}
    </script>

    <script>
        // ============================================
        // Variables globales
        // ============================================
        let allCategories = [];
        let selectedCategoryId = null;

        // ============================================
        // Preview del archivo
        // ============================================
        function previewFileInfo(event) {
            const file = event.target.files[0];
            const fileInfo = document.getElementById('fileInfo');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            const typeSelect = document.getElementById('type');

            if (!file) {
                fileInfo.classList.add('hidden');
                imagePreviewContainer.classList.add('hidden');
                return;
            }

            // Mostrar información del archivo
            document.getElementById('fileName').textContent = file.name;
            document.getElementById('fileSize').textContent = formatFileSize(file.size);
            document.getElementById('fileType').textContent = `Tipo MIME: ${file.type || 'desconocido'}`;
            fileInfo.classList.remove('hidden');

            // Auto-completar el nombre si está vacío
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                const baseName = file.name.replace(/\.[^/.]+$/, '').replace(/[-_]/g, ' ');
                nameInput.value = baseName.charAt(0).toUpperCase() + baseName.slice(1);
            }

            // Detectar y sugerir tipo basado en la extensión
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

            if (detectedType) {
                typeSelect.value = detectedType;
            }

            // Preview para imágenes
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.classList.add('hidden');
            }
        }

        // Formatear tamaño legible
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // ============================================
        // Sistema de búsqueda de categorías
        // ============================================
        function initCategories() {
            try {
                allCategories = JSON.parse(document.getElementById('categories-data').textContent);
            } catch (e) {
                console.error('Error al cargar categorías:', e);
                allCategories = [];
            }

            // Restaurar selección previa si existe (old input)
            const categoryId = document.getElementById('category_id').value;
            const categorySearch = document.getElementById('category_search');
            const clearBtn = document.getElementById('clear_category');

            if (categoryId) {
                const selected = allCategories.find(cat => cat.id == categoryId);
                if (selected) {
                    categorySearch.value = selected.name;
                    selectedCategoryId = selected.id;
                    clearBtn.classList.remove('hidden');
                }
            } else if (categorySearch.value) {
                // Si hay texto pero no ID, buscar coincidencia exacta
                const found = allCategories.find(cat =>
                    cat.name.toLowerCase() === categorySearch.value.toLowerCase()
                );
                if (found) {
                    document.getElementById('category_id').value = found.id;
                    selectedCategoryId = found.id;
                    clearBtn.classList.remove('hidden');
                }
            }
        }

        function showCategorySuggestions(query) {
            const container = document.getElementById('category_suggestions');

            // Si no hay query, mostrar todas
            const filteredCategories = !query || query.trim() === ''
                ? allCategories
                : allCategories.filter(category =>
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
                item.dataset.id = category.id;
                item.dataset.name = category.name;

                // Resaltar texto coincidente
                if (query && query.trim()) {
                    const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
                    item.innerHTML = category.name.replace(regex, '<span class="font-semibold text-indigo-600">$1</span>');
                } else {
                    item.textContent = category.name;
                }

                item.addEventListener('click', function() {
                    selectCategory(category.id, category.name);
                });

                container.appendChild(item);
            });

            container.classList.remove('hidden');
        }

        function escapeRegex(str) {
            return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }

        function selectCategory(id, name) {
            selectedCategoryId = id;
            document.getElementById('category_id').value = id;
            document.getElementById('category_search').value = name;
            document.getElementById('category_suggestions').classList.add('hidden');
            document.getElementById('clear_category').classList.remove('hidden');
        }

        function clearCategorySelection() {
            selectedCategoryId = null;
            document.getElementById('category_id').value = '';
            document.getElementById('category_search').value = '';
            document.getElementById('category_suggestions').classList.add('hidden');
            document.getElementById('clear_category').classList.add('hidden');
            document.getElementById('category_search').focus();
        }

        // ============================================
        // Validación y envío
        // ============================================
        function setupFormValidation() {
            const form = document.querySelector('form[action="{{ route('files.store') }}"]');
            const submitBtn = document.getElementById('submitBtn');
            const submitSpinner = document.getElementById('submitSpinner');
            const submitText = document.getElementById('submitText');
            const categorySearch = document.getElementById('category_search');
            const categoryIdInput = document.getElementById('category_id');

            form.addEventListener('submit', function(e) {
                // Validar categoría seleccionada
                if (!categoryIdInput.value) {
                    // Intentar auto-seleccionar si el texto coincide exactamente con una categoría
                    const found = allCategories.find(cat =>
                        cat.name.toLowerCase() === categorySearch.value.trim().toLowerCase()
                    );

                    if (found) {
                        categoryIdInput.value = found.id;
                    } else {
                        e.preventDefault();
                        categorySearch.classList.add('border-red-500');
                        categorySearch.focus();
                        showToast('Debes seleccionar una categoría de la lista', 'error');
                        return false;
                    }
                }

                // Mostrar spinner
                submitBtn.disabled = true;
                submitSpinner.classList.remove('hidden');
                submitText.textContent = 'Subiendo...';
            });

            // Quitar borde rojo al escribir en categoría
            categorySearch.addEventListener('input', function() {
                this.classList.remove('border-red-500');
            });
        }

        // Toast simple para mensajes
        function showToast(message, type = 'info') {
            const colors = {
                error: 'bg-red-500',
                success: 'bg-emerald-500',
                info: 'bg-indigo-500',
            };
            const toast = document.createElement('div');
            toast.className = `fixed top-20 right-8 px-6 py-3 rounded-lg shadow-lg text-white text-sm font-medium z-50 ${colors[type] || colors.info}`;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.transition = 'opacity 0.3s';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ============================================
        // Event Listeners
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            initCategories();
            setupFormValidation();

            const categorySearch = document.getElementById('category_search');
            const suggestionsContainer = document.getElementById('category_suggestions');

            // Mostrar sugerencias al escribir
            categorySearch.addEventListener('input', function(e) {
                showCategorySuggestions(e.target.value);
            });

            // Mostrar todas al enfocar
            categorySearch.addEventListener('focus', function() {
                showCategorySuggestions(this.value);
            });

            // Cerrar al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!categorySearch.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.classList.add('hidden');
                }
            });

            // Teclas especiales
            categorySearch.addEventListener('keydown', function(e) {
                const items = suggestionsContainer.querySelectorAll('div[data-id]');

                if (e.key === 'Escape') {
                    suggestionsContainer.classList.add('hidden');
                    this.blur();
                } else if (e.key === 'ArrowDown' && items.length > 0) {
                    e.preventDefault();
                    items[0].classList.add('bg-indigo-50');
                    items[0].scrollIntoView({ block: 'nearest' });
                } else if (e.key === 'Enter' && items.length > 0 && !suggestionsContainer.classList.contains('hidden')) {
                    e.preventDefault();
                    items[0].click();
                }
            });

            // Limpiar si el input queda vacío al perder foco
            categorySearch.addEventListener('blur', function() {
                setTimeout(() => {
                    if (!this.value.trim()) {
                        clearCategorySelection();
                    }
                }, 200);
            });
        });
    </script>
</x-app-layout>