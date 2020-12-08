@extends('layouts.app')
@section('title', 'Especie')
@section('content')

    <div class="container elevation-4 p-4">
        @error('igual')
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-exclamation-triangle"></i> Mensaje</h5>
            {{ $message }}
        </div>
        @enderror
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Solicitud de adopcion</div>
                    <div class="card-body">
                        <div>
                            <h6 class="my-0">Motivo</h6>
                            <small class="text-muted">{{ $solicitud->motivo }}</small>
                        </div>
                        <div>
                            <h6 class="my-0">Descripcion</h6>
                            <small class="text-muted">{{ $solicitud->descripcion }}</small>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Persona interesada</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Nombre</h6>
                            <small class="text-muted">{{ $solicitud->user->name }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Email</h6>
                            <small class="text-muted">{{ $solicitud->user->email }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Solicitudes realizadas </h6>
                            <small
                                class="badge badge-secondary">{{ count($solicitud->user->solicitudAdopcions) }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Email Verificado</h6>
                            @if($solicitud->user->email_verified_at)
                                <small class="badge badge-success">SI</small>
                            @else
                                <small class="badge badge-success">NO</small>
                            @endif

                        </div>
                    </li>
                    @if($solicitud->user->profile)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">apellidos</h6>
                                <small class="text-muted">{{ $solicitud->user->profile->apellido }}</small>
                            </div>
                        </li>
                    @else
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Perfil</h6>
                                <small class="badge badge-danger">NO</small>
                            </div>
                        </li>
                    @endif
                </ul>

            </div>
            <div class="col">
                @unless($solicitud->publicacion_adopcion->mascota == null)
                    <div class="my-3 p-3 bg-white rounded box-shadow elevation-4">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Mascotas</h6>
                        @forelse($solicitud->publicacion_adopcion->mascota->imagens as $imagen)
                            @if($loop->first)
                                @if(Illuminate\Support\Str::contains( $imagen->url, 'http'))
                                    <img class="img-thumbnail rounded-circle" src='{{ asset(  $imagen->url ) }}' alt=""
                                         srcset="">
                                @else
                                    <img class="img-thumbnail rounded-circle"
                                         src='{{ asset( "storage/" .  $imagen->url ) }}' alt=""
                                         srcset="">
                                @endif
                            @endif
                        @empty
                            <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/default.jpg" ) }}' alt=""
                                 srcset="">
                        @endforelse
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Nombre</strong>
                                {{ $solicitud->publicacion_adopcion->mascota->nombre}}
                            </p>
                        </div>
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Tamaño</strong>
                                {{ $solicitud->publicacion_adopcion->mascota->tamagno }}
                            </p>
                        </div>
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Salud</strong>
                                {{ $solicitud->publicacion_adopcion->mascota->salud }}
                            </p>
                        </div>
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Adoptado</strong>
                                @if($solicitud->publicacion_adopcion->mascota->adoptado == 1)
                                    <span class="badge badge-success p-2">Adoptado</span>
                                @else
                                    <span class="badge badge-danger p-2">No adoptado</span>
                                @endif
                            </p>
                        </div>
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Raza</strong>
                                {{ $solicitud->publicacion_adopcion->mascota->raza->nombre }}
                            </p>
                        </div>
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Especie</strong>
                                {{ $solicitud->publicacion_adopcion->mascota->especie->nombre }}
                            </p>
                        </div>
                        {{--<div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Total solicitudes</strong>
                                {{ count($publicacion->solicitudAdopcions ?? []) }}
                            </p>
                        </div>--}}
                        <div class="media text-muted pt-1">
                            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                                <strong class="d-block text-gray-dark">Etiquetas</strong>
                                @forelse($solicitud->publicacion_adopcion->mascota->etiquetas as $item)
                                    <span class="badge badge-primary p-1">{{ $item->nombre }}</span>
                                @empty
                                    <span class="badge badge-secondary p-1">No etiquetas</span>
                                @endforelse
                            </p>
                        </div>
                    </div>
                @endunless
            </div>

        </div>
        <div class="row">
            <div class="col">
                @can('permiso', 'aprobar-rechazar-solicitud')
                    <form action="{{ route('aprobarSolicitud.update', $solicitud->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  type="submit" class="btn btn-danger bt-lg w-100">
                    <span class="text-light">
                        RECHAZAR
                    </span>
                        </button>
                    </form>
                @endcan
            </div>
            <div class="col">
                @can('permiso', 'aprobar-rechazar-solicitud')
                    <form action="{{ route('aprobarSolicitud.update', $solicitud->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" hidden name="adoptar" value="1">
                        <button
                            type="submit"
                            @if($solicitud->publicacion_adopcion->mascota->adoptado == 1)
                            disabled
                            @endif
                            class="btn btn-primary bt-lg w-100">
                            APROBAR
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
