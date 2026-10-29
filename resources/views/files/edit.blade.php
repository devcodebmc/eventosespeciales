<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Archivo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('files.update', $file) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nombre <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $file->name) }}" required
                                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                    Archivo (opcional, dejar vacío para conservar el actual)
                                </label>
                                <input type="file" name="file" id="file" onchange="previewFileInfo(event)"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                @if ($file->file)
                                    <p class="mt-2 text-sm text-gray-600">
                                        Actual:
                                        <a href="{{ $file->url }}" target="_blank" class="text-indigo-600 hover:underline">
                                            {{ $file->original_name ?? basename($file->file) }}
                                        </a>
                                        ({{ $file->human_size }})
                                    </p>
                                @endif
                                @error('file')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipo <span class="text-red-500">*</span></label>
                                <select name="type" id="type" required
                                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 @error('type') border-red-500 @enderror">
                                    <option value="">Seleccionar tipo</option>
                                    @foreach (['image' => 'Imagen', 'pdf' => 'PDF', 'doc' => 'Documento', 'excel' => 'Excel'] as $value => $label)
                                        <option value="{{ $value }}" {{ old('type', $file->type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría <span class="text-red-500">*</span></label>
                                <select name="category_id" id="category_id" required
                                        class="block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 @error('category_id') border-red-500 @enderror">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $file->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('files.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Actualizar Archivo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFileInfo(event) {
            const file = event.target.files[0];
            const typeSelect = document.getElementById('type');
            if (!file) return;
            const ext = file.name.split('.').pop().toLowerCase();
            let detected = '';
            if (['jpg','jpeg','png','gif','bmp','webp'].includes(ext)) detected = 'image';
            else if (ext === 'pdf') detected = 'pdf';
            else if (['doc','docx','txt','rtf'].includes(ext)) detected = 'doc';
            else if (['xls','xlsx','csv'].includes(ext)) detected = 'excel';
            if (detected) typeSelect.value = detected;
        }
    </script>
</x-app-layout>