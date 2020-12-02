@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container-fluid" xmlns="http://www.w3.org/1999/html">
        <div class="row">

            <div class="col-8 p-0" >
                <div class="card elevation-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2  border-bottom m-2">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <a href="{{ route('publicacion.index') }}" class="btn btn-sm btn-primary mr-1 elevation-2">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-secondary elevation-2" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Creado {{ $especie->created_at }}
                            </button>
                            <button class="btn btn-sm btn-outline-secondary ml-1 elevation-2" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Actualizado {{ $especie->updated_at }}
                            </button>
                            <a href="{{ route('tipopublicacion.show', $especie->tipoPublicacion->id) }}" class="btn btn-sm btn-outline-primary ml-1 elevation-2" disabled>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                Tipo publicacion: <b>{{ $especie->tipoPublicacion->tipo }}</b>
                            </a>

                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <dl class="row">
                            <dt class="col-sm-4">Id</dt>
                            <dd class="col-sm-8">{{ $especie->id }}</dd>
                            <dt class="col-sm-4">Titulo</dt>
                            <dd class="col-sm-8">{{ $especie->titulo }}.</dd>
                            <dt class="col-sm-4">Subtitulo</dt>
                            <dd class="col-sm-8">{{ $especie->titulo }}.</dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                @if($especie->estado == 1)
                                    <span class="badge badge-success">Aprobado</span>
                                    @else
                                    <span class="badge badge-danger">No Aprobado</span>
                                @endif
                            </dd>
                            <dt class="col-sm-4">Denuncias</dt>
                            <dd class="col-sm-8">
                                <a href="{{ route('publicacion.denuncia',  $especie->id) }}" class="btn btn-sm btn-warning mt-1 elevation-2" disabled>
                                    <i class="fa fa-exclamation" aria-hidden="true"></i>
                                    Denuncias: <b><span class="badge badge-dark">{{ $especie->denuncias->count()}} </span> </b>
                                </a >
                            </dd>
                        </dl>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa fa-book"></i>
                                    Contenido
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                @foreach($especie->imagens as $imagen)
                                    @if(Illuminate\Support\Str::contains($imagen['url'], 'https'))
                                        <div class="col">
                                        <img src='{{ asset( $imagen['url'] ) }}' alt="" srcset="">
                                        </div>
                                    @else
                                        <div class="col">
                                        <img style="max-width: 250px" src='{{ asset( "storage/" . $imagen['url'] ) }}' alt="" srcset="">
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>{!! $especie->cuerpo  !!}</div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        {{--<h3 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i>  Descripcion: </h3>
                        <p>{{ $especie->descripcion }}</p>--}}

                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="row">
                    <div class="card elevation-2" style="width: 18rem;">

                        <div class="card-body">
                            <h5 class="card-title p-0">Creador :</h5> <br>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-0"><b>Nombre: </b> {{ $especie->user->name }}</li>
                                <li class="list-group-item p-0"><b>Email: </b> {{ $especie->user->email }}</li>
                                <li class="list-group-item p-0"><b>Rol: </b><span class="badge badge-primary">ROL USER</span> </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
            integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g=="
            crossorigin="anonymous"></script>
        <script>
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        </script>
    @endpush
@endsection
