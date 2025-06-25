    <!-- Quill Editor CDN -->
    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" 
        rel="stylesheet" 
    />      
    @endpush

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
            Descripción Detallada
        </label>
        <div id="quill-editor" style="min-height: 780px;">{!! old('content') !!}</div>
        <input type="hidden" name="content" id="content" value="{{ old('content', isset($event) ? $event->content : '') }}">    @error('content')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
             // Quill Editor
            let quill;
            document.addEventListener('DOMContentLoaded', function() {
                quill = new Quill('#quill-editor', {
                    theme: 'snow',
                    placeholder: 'Describe el evento con detalle...',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike', 'blockquote', 'code-block'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'indent': '-1'}, { 'indent': '+1' }],
                            ['link', 'image', 'video', 'formula'],
                            ['clean'],
                            ['direction', { 'direction': 'rtl' }], // Dirección de texto
                            [{ 'script': 'sub'}, { 'script': 'super' }], // Subíndice/Superíndice
                            [{ 'size': ['small', false, 'large', 'huge'] }], // Tamaño de fuente
                            [{ 'header': 1 }, { 'header': 2 }], // Encabezados rápidos
                            [{ 'background': [] }], // Color de fondo
                            [{ 'font': [] }], // Tipos de fuente
                            [{ 'align': [] }], // Alineación
                        ]
                    },
                    bounds: '#quill-editor',
                    readOnly: false,
                    scrollingContainer: null,
                    formats: [
                        'header', 'font', 'size', 'bold', 'italic', 'underline', 'strike', 'blockquote',
                        'list', 'bullet', 'indent', 'link', 'image', 'video', 'code-block', 'color',
                        'background', 'align', 'direction', 'script', 'formula'
                    ]
                });    // Si hay contenido previo (old) o estamos editando, cargarlo
                @if(old('content'))
                quill.root.innerHTML = `{!! old('content') !!}`;
                @elseif(isset($event) && $event->content)
                quill.root.innerHTML = `{!! $event->content !!}`;
                @endif

                // Actualizar el campo oculto con el contenido del editor
                quill.on('text-change', function() {
                    document.getElementById('content').value = quill.root.innerHTML;
                });
            });
        </script>
    @endpush
