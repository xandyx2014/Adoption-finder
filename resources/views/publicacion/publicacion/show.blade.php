@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 p-0" >
                <div class="card">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2  border-bottom m-2">
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Creado {{ $especie->created_at }}
                            </button>
                            <button class="btn btn-sm btn-outline-secondary ml-1" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Actualizado {{ $especie->updated_at }}
                            </button>
                            <a href="{{ route('tipopublicacion.show', $especie->tipoPublicacion->id) }}" class="btn btn-sm btn-outline-primary ml-1" disabled>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                Tipo publicacion: <b>{{ $especie->tipoPublicacion->tipo }}</b>
                            </a>
                            <button class="btn btn-sm btn-warning mt-1" disabled>
                                <i class="fa fa-exclamation" aria-hidden="true"></i>
                                Denuncias: <b><span class="badge badge-dark">{{ $especie->denuncias->count()}} </span> </b>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <h1 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i> <b>ID: </b> <br> {{ $especie->id }}</h1>
                        <h1 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i>  <b>Titulo:</b> <br> {{ $especie->titulo }}</h1>
                        <h1 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i>  <b>Subtitulo:</b> <br> {{ $especie->subtitulo }}</h1>
                        <p>
                            <b>Contendio : </b> <br> {{ $especie->cuerpo }}
                        </p>
                        {{--<h3 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i>  Descripcion: </h3>
                        <p>{{ $especie->descripcion }}</p>--}}

                    </div>
                </div>

            </div>
            <div class="col-4 p-0">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Usuario</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nombre: </b> {{ $especie->user->name }}</li>
                            <li class="list-group-item"><b>Email: </b> {{ $especie->user->email }}</li>
                            <li class="list-group-item"><b>Rol: </b><span class="badge badge-primary">Etc</span> </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
