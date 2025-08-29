@push('css')
    <style>
        .tox .tox-edit-area {
            min-height: 500px !important;
        }
        .tinymce-container {
            border-radius: 0.375rem;
            overflow: hidden;
        }
        .tinymce-container:focus-within {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .tox-tinymce {
            border-color: #d1d5db !important;
        }
        .tox-tinymce:hover {
            border-color: #6366f1 !important;
        }
    </style>
@endpush

<div>
    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
        Descripción Detallada
    </label>
    
    <div class="tinymce-container">
        <textarea
            id="content"
            name="content"
            class="w-full"
        >{{ old('content', isset($event) ? $event->content : '') }}</textarea>
    </div>
    
    @error('content')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

@push('js')
    <!-- TinyMCE Editor JS -->
    <script src="https://cdn.tiny.cloud/1/9gtcoq7rvjq7qmy3ogfrpyo7w30a44jmyfgd8u0n63rg4dvu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#content',
                
                // Configuración básica
                height: 900,
                menubar: true,
                branding: false,
                resize: 'both',
                
                // Plugins gratuitos
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 
                    'preview', 'anchor', 'searchreplace', 'visualblocks', 
                    'code', 'fullscreen', 'insertdatetime', 'media', 'table',
                    'wordcount', 'emoticons', 'codesample', 'quickbars'
                ],
                
                // Barra de herramientas
                toolbar: [
                    'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough',
                    'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist',
                    'forecolor backcolor removeformat | link image media table | emoticons charmap',
                    'searchreplace visualblocks code fullscreen | insertdatetime | help'
                ],
                
                // Configuración adicional
                placeholder: 'Describe el evento con detalle...',
                content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 16px; }',
                
                // Configuración de imagen
                image_title: true,
                image_description: false,
                
                // Configuración de enlaces
                link_title: false,
                target_list: false,
                
                // Formato de bloques
                block_formats: 'Párrafo=p; Encabezado 1=h1; Encabezado 2=h2; Encabezado 3=h3; Encabezado 4=h4; Encabezado 5=h5; Encabezado 6=h6; Cita=blockquote; Preformateado=pre',
                
                // Configuración de tabla
                table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                
                // Configuración de código
                codesample_languages: [
                    {text: 'HTML/XML', value: 'markup'},
                    {text: 'JavaScript', value: 'javascript'},
                    {text: 'CSS', value: 'css'},
                    {text: 'PHP', value: 'php'},
                    {text: 'Python', value: 'python'},
                    {text: 'SQL', value: 'sql'},
                    {text: 'JSON', value: 'json'}
                ],
                
                // Configuración de fuentes
                font_family_formats: 'Arial=arial,helvetica,sans-serif; Georgia=georgia,palatino; Helvetica=helvetica; Times New Roman=times new roman,times; Courier New=courier new,courier',
                
                font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
                
                // Limpieza de contenido
                paste_as_text: false,
                paste_auto_cleanup_on_paste: true,
                
                // Configuración de quickbars (barras contextuales)
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
                quickbars_insert_toolbar: 'quickimage quicktable',
                
                // Validación y eventos
                setup: function(editor) {
                    editor.on('init', function() {
                        // El editor está listo
                        console.log('TinyMCE inicializado correctamente');
                    });
                    
                    editor.on('change keyup', function() {
                        // Sincronizar contenido
                        editor.save();
                    });
                },
                
                // Configuración de idioma (opcional)
                language: 'es',
                language_url: 'https://cdn.tiny.cloud/1/9gtcoq7rvjq7qmy3ogfrpyo7w30a44jmyfgd8u0n63rg4dvu/tinymce/6/langs/es.js'
            });
            
            // Validación del formulario
            var form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function() {
                    tinymce.triggerSave();
                });
            }
        });
    </script>
@endpush