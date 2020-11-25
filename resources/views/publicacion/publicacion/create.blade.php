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
        <form role="form" class="p-2 pr-0" action="{{ route('publicacion.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-left">
                <div class="col-8">
                    <div class="card elevation-4">
                        <div class="card-body">
                           <div class="card card-primary">
                               <div class="card-header">
                                   <h3 class="card-title">Contenido de la post</h3>
                               </div>
                               <textarea id="summernote" value="{{ old('cuerpo') }}" rows=10 name="cuerpo"></textarea>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card elevation-4">
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
                                            value="{{ old('titulo') }}"
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
                                            value="{{ old('subtitulo') }}"
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
                                        <img id="blah" style="max-width: 159px" class="img-thumbnail"
                                             src='{{ asset('storage/default.jpg') }}' alt="" srcset="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Seleciona una imagen</label>
                                        <div class="input-group input-group-sm">
                                            <div class="custom-file">
                                                <input type="file"
                                                       accept="image/x-png,image/gif,image/jpeg"
                                                       name="image"
                                                       class="custom-file-input @error('image') is-invalid @enderror"
                                                       id="exampleInputFile">

                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Selecionar Imagen Destacada <i class="fa ml-2 fa-picture-o" aria-hidden="true"></i></span>
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
                                        <select style="width: 100%;" id="js-example-basic-single" class="form-control select2-selection select2-selection--single" name="tipoPublicacion">
                                            @foreach($tipos as $tipo)
                                                <option style="padding: 5px;" value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
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
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-es-ES.min.js" integrity="sha512-L2aDRReu0LLrPXjoBozyyZeoPDr4l2xI5+H6cpAyU+bOlnQWEht8rbLn2SAVBTq/x9iPfoKOyuPDC0rdPQuymg==" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
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
                    height: 220,
                    lang: 'es-ES',
                    maximumImageFileSize: 1024*1024,
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear', 'fontsize', 'fontsizeunit']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph', 'height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']],
                        ['view', ['help']],
                    ],
                    callbacks:{
                        onImageUploadError: function(msg){
                            console.log(msg + ' (1 MB)');
                            Swal.fire(
                                'Error al subir imagen',
                                msg,
                                'error'
                            )
                        }
                    }
                });
                sum.summernote('code', "{!! old('cuerpo') !!}");

            });
        </script>
    @endpush
@endsection
