@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
            integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
            crossorigin="anonymous"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" />
    @endpush
    <div class="container-fluid">
        <form role="form" class="p-2 pr-0" action="{{ route('publicacion.update', $especie->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-left">
                <div class="col-8">
                    <div class="card elevation-2">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Contenido de la post</h3>
                                </div>
                                <textarea id="summernote" name="cuerpo"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-primary elevation-2">
                                <div class="card-header">
                                    <h3 class="card-title">Propiedades</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="titulo">Titulo</label>
                                        <input
                                            type="text"
                                            name="titulo"
                                            value="{{ old('titulo', $especie->titulo) }}"
                                            class="form-control @error('titulo') is-invalid @enderror" id="titulo"
                                            placeholder="Introducce titulo">
                                        @error('titulo')
                                        <div class="error invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitulo">Subtitulo</label>
                                        <input
                                            type="text"
                                            name="subtitulo"
                                            value="{{ old('subtitulo', $especie->subtitulo) }}"
                                            class="form-control @error('subtitulo') is-invalid @enderror"
                                            id="subtitulo" placeholder="Introducce Subtitulo">
                                        @error('subtitulo')
                                        <div class="error invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Imagen destacada</label>
                                        @if(empty($especie['imagens'][0]['url']))
                                            <img id="blah" style="max-width: 159px" class="img-thumbnail"
                                                 src='{{ asset('storage/default.jpg') }}' alt="" srcset="">
                                        @else
                                            @if(Illuminate\Support\Str::contains($especie['imagens'][0]['url'], 'http'))
                                                <img  id="blah" class="img-thumbnail" src='{{ asset( $especie['imagens'][0]['url'] ) }}'>
                                            @else
                                                <img id="blah"  style="width: 50%" class="img-thumbnail" src='{{ asset( "storage/" . $especie['imagens'][0]['url'] ) }}'>
                                            @endif
                                        @endif
                                        {{--<img id="blah" style="max-width: 159px" class="img-thumbnail"
                                             src='{{ asset('storage/default.jpg') }}' alt="" srcset="">--}}
                                    </div>
                                    <div class="form-group">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                       accept="image/x-png,image/gif,image/jpeg"
                                                       name="image"
                                                       class="custom-file-input @error('image') is-invalid @enderror"
                                                       id="exampleInputFile">
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Seleciona Imagen</span>
                                            </div>
                                            @error('image')
                                            <div class="error invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> Tipo de publicacion</label>
                                        <select
                                            style="width: 100%;"
                                            id="js-example-basic-single"
                                            class="form-control select2-selection select2-selection--single"
                                            name="tipo_publicacion_id"
                                            value="{{ old('tipo_publicacion_id', $especie->tipo_publicacion_id) }}"
                                        >
                                            @foreach($tipos as $tipo)
                                                <option
                                                    style="padding: 5px;"
                                                    @if($especie->tipo_publicacion_id == $tipo->id)
                                                        selected
                                                    @endif
                                                    value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <div class="row">
            @foreach($especie->imagens as $photo)
                <div class="col-md-4">
                    <form action="{{ route('publicacion.photo.delete', $photo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="position: absolute;"><i
                                class="fa fa-remove"></i></button>
                    </form>
                    @if(Illuminate\Support\Str::contains($photo->url, 'https'))
                        <img src='{{ asset( $photo->url ) }}' class="img-fluid" alt="" srcset="">
                    @else
                        <img src='{{ asset( "storage/" . $photo->url ) }}' class="img-fluid" alt="" srcset="">
                    @endif

                </div>
            @endforeach
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#exampleInputFile").change(function () {

                readURL(this);
            });
            (function($) {

                $.extend($.summernote.lang, {
                    'es-ES': {
                        font: {
                            bold: 'Negrita',
                            italic: 'Cursiva',
                            underline: 'Subrayado',
                            clear: 'Eliminar estilo de letra',
                            height: 'Altura de línea',
                            name: 'Tipo de letra',
                            strikethrough: 'Tachado',
                            subscript: 'Subíndice',
                            superscript: 'Superíndice',
                            size: 'Tamaño de la fuente',
                            sizeunit: 'Unidad del tamaño de letra',
                        },
                        image: {
                            image: 'Imagen',
                            insert: 'Insertar imagen',
                            resizeFull: 'Redimensionar a tamaño completo',
                            resizeHalf: 'Redimensionar a la mitad',
                            resizeQuarter: 'Redimensionar a un cuarto',
                            resizeNone: 'Tamaño original',
                            floatLeft: 'Flotar a la izquierda',
                            floatRight: 'Flotar a la derecha',
                            floatNone: 'No flotar',
                            shapeRounded: 'Forma: Redondeado',
                            shapeCircle: 'Forma: Círculo',
                            shapeThumbnail: 'Forma: Miniatura',
                            shapeNone: 'Forma: Ninguna',
                            dragImageHere: 'Arrastre una imagen o texto aquí',
                            dropImage: 'Suelte una imagen o texto',
                            selectFromFiles: 'Seleccione un fichero',
                            maximumFileSize: 'Tamaño máximo del fichero',
                            maximumFileSizeError: 'Superado el tamaño máximo de fichero.',
                            url: 'URL de la imagen',
                            remove: 'Eliminar la imagen',
                            original: 'Original',
                        },
                        video: {
                            video: 'Vídeo',
                            videoLink: 'Enlace del vídeo',
                            insert: 'Insertar un vídeo',
                            url: 'URL del vídeo',
                            providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion o Youku)',
                        },
                        link: {
                            link: 'Enlace',
                            insert: 'Insertar un enlace',
                            unlink: 'Quitar el enlace',
                            edit: 'Editar',
                            textToDisplay: 'Texto a mostrar',
                            url: '¿A qué URL lleva este enlace?',
                            openInNewWindow: 'Abrir en una nueva ventana',
                            useProtocol: 'Usar el protocolo predefinido',
                        },
                        table: {
                            table: 'Tabla',
                            addRowAbove: 'Añadir una fila encima',
                            addRowBelow: 'Añadir una fila debajo',
                            addColLeft: 'Añadir una columna a la izquierda',
                            addColRight: 'Añadir una columna a la derecha',
                            delRow: 'Borrar la fila',
                            delCol: 'Borrar la columna',
                            delTable: 'Borrar la tabla',
                        },
                        hr: {
                            insert: 'Insertar una línea horizontal',
                        },
                        style: {
                            style: 'Estilo',
                            p: 'Normal',
                            blockquote: 'Cita',
                            pre: 'Código',
                            h1: 'Título 1',
                            h2: 'Título 2',
                            h3: 'Título 3',
                            h4: 'Título 4',
                            h5: 'Título 5',
                            h6: 'Título 6',
                        },
                        lists: {
                            unordered: 'Lista',
                            ordered: 'Lista numerada',
                        },
                        options: {
                            help: 'Ayuda',
                            fullscreen: 'Pantalla completa',
                            codeview: 'Ver el código fuente',
                        },
                        paragraph: {
                            paragraph: 'Párrafo',
                            outdent: 'Reducir la sangría',
                            indent: 'Aumentar la sangría',
                            left: 'Alinear a la izquierda',
                            center: 'Centrar',
                            right: 'Alinear a la derecha',
                            justify: 'Justificar',
                        },
                        color: {
                            recent: 'Último color',
                            more: 'Más colores',
                            background: 'Color de fondo',
                            foreground: 'Color del texto',
                            transparent: 'Transparente',
                            setTransparent: 'Establecer transparente',
                            reset: 'Restablecer',
                            resetToDefault: 'Restablecer a los valores predefinidos',
                            cpSelect: 'Seleccionar',
                        },
                        shortcut: {
                            shortcuts: 'Atajos de teclado',
                            close: 'Cerrar',
                            textFormatting: 'Formato de texto',
                            action: 'Acción',
                            paragraphFormatting: 'Formato de párrafo',
                            documentStyle: 'Estilo de documento',
                            extraKeys: 'Teclas adicionales',
                        },
                        help: {
                            insertParagraph: 'Insertar un párrafo',
                            undo: 'Deshacer la última acción',
                            redo: 'Rehacer la última acción',
                            tab: 'Tabular',
                            untab: 'Eliminar tabulación',
                            bold: 'Establecer estilo negrita',
                            italic: 'Establecer estilo cursiva',
                            underline: 'Establecer estilo subrayado',
                            strikethrough: 'Establecer estilo tachado',
                            removeFormat: 'Limpiar estilo',
                            justifyLeft: 'Alinear a la izquierda',
                            justifyCenter: 'Alinear al centro',
                            justifyRight: 'Alinear a la derecha',
                            justifyFull: 'Justificar',
                            insertUnorderedList: 'Insertar lista',
                            insertOrderedList: 'Insertar lista numerada',
                            outdent: 'Reducir sangría del párrafo',
                            indent: 'Aumentar sangría del párrafo',
                            formatPara: 'Cambiar el formato del bloque actual a párrafo (etiqueta P)',
                            formatH1: 'Cambiar el formato del bloque actual a H1',
                            formatH2: 'Cambiar el formato del bloque actual a H2',
                            formatH3: 'Cambiar el formato del bloque actual a H3',
                            formatH4: 'Cambiar el formato del bloque actual a H4',
                            formatH5: 'Cambiar el formato del bloque actual a H5',
                            formatH6: 'Cambiar el formato del bloque actual a H6',
                            insertHorizontalRule: 'Insertar una línea horizontal',
                            'linkDialog.show': 'Mostrar el panel de enlaces',
                        },
                        history: {
                            undo: 'Deshacer',
                            redo: 'Rehacer',
                        },
                        specialChar: {
                            specialChar: 'CARACTERES ESPECIALES',
                            select: 'Seleccionar caracteres especiales',
                        },
                        output: {
                            noSelection: '¡No ha seleccionado nada!',
                        },
                    },
                });
            })(jQuery);
            $(document).ready(function() {

                /*let myDropzone = new Dropzone('#dropzone', {
                    url: '/admin/posts/5/photos',
                    acceptedFiles: 'image/!*',
                    maxFilesize: 2,
                    paramName: 'photo',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dictDefaultMessage: 'Agrega tu imagen'
                });*/


                $('#js-example-basic-single').select2();
                const sum = $('#summernote').summernote({
                    height: 280,
                    lang: 'es-ES',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['codeview', 'help']]
                    ]
                });
                sum.summernote('code', `{!! old('cuerpo', $especie->cuerpo) !!}`);

            });
        </script>
    @endpush
@endsection
