@extends('layouts.app')
@section('title', 'Publicacion de adopcion')
@section('content')
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
            integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
            crossorigin="anonymous"
        />
    @endpush
    <div class="container elevation-4">
        <form action="{{ route('publicacionAdopcion.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-9 p-2">
                    <div class="mb-3">
                        <label for="email">Titulo de la publicacion</label>
                        <input name="titulo" value="{{ old('titulo') }}" type="text" class="form-control @error('titulo') is-invalid @enderror"  placeholder="Mi titulo de mi publicacion">
                        @error('titulo')
                        <div class="error invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <textarea id="summernote" rows=10
                                  name="descripcion_corta"></textarea>
                        @error('descripcion_corta')
                        <div class="color-palette-set">
                            <div class="bg-danger color-palette p-1"><span><i class="fa fa-ban" aria-hidden="true"></i></span></div>
                            <div class="bg-danger disabled color-palette p-1"><span>{{ $message }}</span></div>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-3 p-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Animal</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Mascota de publicacion</h6>
                                <select name="mascota" value="{{ old('mascota') }}" class="js-example-basic-single w-100">
                                    @foreach($mascotas as $mascota)
                                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <button type="submit" class="btn  w-100 btn-primary">
                                Crear
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-es-ES.min.js" integrity="sha512-L2aDRReu0LLrPXjoBozyyZeoPDr4l2xI5+H6cpAyU+bOlnQWEht8rbLn2SAVBTq/x9iPfoKOyuPDC0rdPQuymg==" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $('.js-example-basic-single').select2();
            const sum = $('#summernote').summernote({
                height: 350,
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
            sum.summernote('code', `{!! old('descripcion_corta') !!}`);
        </script>
    @endpush
@endsection
