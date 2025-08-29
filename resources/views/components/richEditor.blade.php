    @push('css')
        <!-- Froala Editor CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@4.1.4/css/froala_editor.pkgd.min.css">
        <style>
            .fr-wrapper {
                min-height: 500px;
                max-height: 800px;
            }
        </style>
    @endpush

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
            Descripción Detallada
        </label>
        <textarea
            id="content"
            name="content"
            class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        >{{ old('content', isset($event) ? $event->content : '') }}</textarea>
        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    @push('js')
        <!-- Froala Editor JS -->
        <script src="https://cdn.jsdelivr.net/npm/froala-editor@4.1.4/js/froala_editor.pkgd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new FroalaEditor('#content', 
                {
                    placeholderText: 'Describe el evento con detalle...',
                    heightMin: 500,
                    heightMax: 800,
                    theme: 'gray'
                });
            });
        </script>
    @endpush
