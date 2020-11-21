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
                <div class="col-7">
                    <div class="card">
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
                            <div class="card card-primary">
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
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Seleciona una imagen</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                       accept="image/x-png,image/gif,image/jpeg"
                                                       name="image"
                                                       class="custom-file-input @error('image') is-invalid @enderror"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Img</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Imagen</span>
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
                    <img class="img-fluid" src="{{ asset($photo->url) }}"
                         alt="First slide">

                </div>
            @endforeach
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
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
                    height: 250,
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
