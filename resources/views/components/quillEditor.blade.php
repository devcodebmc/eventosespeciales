    <!-- Quill Editor CDN -->
    @push('css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">        
    @endpush

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
            Descripción Detallada
        </label>
        <div id="quill-editor" style="min-height: 180px;">{!! old('content') !!}</div>
        <input type="hidden" name="content" id="content">
        @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    @push('js')
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script>
             // Quill Editor
            let quill;
            document.addEventListener('DOMContentLoaded', function() {
                quill = new Quill('#quill-editor', {
                theme: 'snow',
                placeholder: 'Describe el evento con detalle...',
                modules: {
                    toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                    ]
                }
                });

                // Si hay contenido previo (old) o estamos editando, cargarlo
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
