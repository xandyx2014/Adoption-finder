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
                        <div class="callout callout-danger">
                            @if(Illuminate\Support\Str::contains($publicacion['imagens'][0]['url'], 'http'))
                                <img class="img-thumbnail" src='{{ asset( $publicacion['imagens'][0]['url'] ) }}' alt=""
                                     srcset="">
                            @else
                                <img style="width: 50%" class="img-thumbnail"
                                     src='{{ asset( "storage/" . $publicacion['imagens'][0]['url'] ) }}' alt=""
                                     srcset="">
                            @endif
                            Imagen Actual
                        </div>

                    </div>
                    <div class="col">
                        <div class="callout callout-success">
                            <div class="text-dark">
                                Nueva imagen

                            </div>
                            <img id="blah" style="width: 180px"
                                 src='{{ asset('storage/default.jpg') }}' alt="" srcset="">
                            <form action="{{ route('imagenPublicacion.update', $publicacion->imagens[0]->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <input
                                    type='file'
                                    accept="image/x-png,image/gif,image/jpeg"
                                    name="file" id="imgInp"/> <br>
                                <button type="submit" class="btn mt-4 btn-primary">Actualizar</button>
                            </div>
                            </form>
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
