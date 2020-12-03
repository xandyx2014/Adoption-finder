@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        @error('file')
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-exclamation-triangle"></i> Archivo</h5>
            {{ $message }}
        </div>
        @enderror
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        @foreach($publicacion->imagens as $imagen)
                            <div class="callout callout-danger">
                                @if(Illuminate\Support\Str::contains($imagen->url, 'http'))
                                    <img class="img-thumbnail" src='{{ asset( $imagen->url ) }}' alt=""
                                         srcset="">
                                @else
                                    <img style="width: 50%" class="img-thumbnail"
                                         src='{{ asset( "storage/" . $imagen->url ) }}' alt=""
                                         srcset="">
                                @endif
                                @can('permiso', 'eliminar-galeria-mascota')
                                    <form action="{{ route('imagenMascota.destroy', $imagen->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Eliminar <i class="fa fa-ban"
                                                                                   aria-hidden="true"></i></button>
                                    </form>
                                @endcan

                            </div>
                        @endforeach
                    </div>
                    <div class="col">
                        <div class="callout callout-success">
                            <div class="text-dark">
                                Nueva imagen

                            </div>
                            <img id="blah" style="width: 180px"
                                 src='{{ asset('storage/default.jpg') }}' alt="" srcset="">
                            @can('permiso', 'registrar-galeria-mascota')
                                <form action="{{ route('imagenMascota.update', $publicacion->id) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input
                                            type='file'
                                            accept="image/x-png,image/gif,image/jpeg"
                                            name="file" id="imgInp"/> <br>
                                        <button type="submit" class="btn mt-4 btn-primary">Adicionar</button>
                                    </div>
                                </form>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
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

            $("#imgInp").change(function () {
                readURL(this);
            });
        </script>
    @endpush
@endsection
