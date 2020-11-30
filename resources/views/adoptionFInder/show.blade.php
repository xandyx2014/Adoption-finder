@extends('layouts.finder')
@section('content-body')
    @error('motivo')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    @error('descripcion')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror
    <div class="card gedf-card elevation-2">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    {{--<div class="mr-2">
                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                    </div>--}}
                    <div class="ml-2">
                        <div class="h5 m-0"># {{ $publicacion->titulo  }}</div>
                        <div class="h7 text-muted">{{ $publicacion->user->name  }}</div>
                    </div>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <div class="h6 dropdown-header">
                                <a href="#">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    Denunciar
                                </a>
                            </div>
                            {{--<a class="dropdown-item" href="#">Denunciar esta publicacion</a>--}}

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i> {{ $publicacion->created_at }}
            </div>
            {{-- <a class="card-link" href="#">
                 <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
             </a>--}}
            <p class="card-text">
                {!!  $publicacion->descripcion_corta !!}
            </p>
        </div>
        <div class="card-footer">
            <br>
            <button href="#" class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-paw"
                                                                      aria-hidden="true"></i>
                Solicitar</button>
            @include('adoptionFInder.store', [ 'data' => $publicacion])
        </div>
    </div>
@endsection
@section('info')
    @parent
    <div class="mb-1 p-3 bg-white rounded box-shadow elevation-2">
        <h6 class="border-bottom border-gray pb-2 mb-0">Mascotas</h6>
        @forelse($publicacion->mascota->imagens as $imagen)
            @if($loop->first)
                @if(Illuminate\Support\Str::contains( $imagen->url, 'http'))
                    <img class="img-thumbnail rounded-circle" src='{{ asset(  $imagen->url ) }}' alt="" srcset="">
                @else
                    <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/" .  $imagen->url ) }}' alt=""
                         srcset="">
                @endif
            @endif
        @empty
            <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/default.jpg" ) }}' alt=""
                 srcset="">
        @endforelse
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Nombre 🔍</strong>
                {{ $publicacion->mascota->nombre }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Descripcion 📜</strong>
                {{ $publicacion->mascota->descripcion }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Acerca de mi ❤</strong>
                {{ $publicacion->mascota->about }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Tamaño  📋</strong>
                {{ $publicacion->mascota->tamagno }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Salud 💕</strong>
                {{ $publicacion->mascota->salud }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Adoptado</strong>
                @if($publicacion->mascota->adoptado == 1)
                    <span class="badge badge-success p-2">Adoptado</span>
                @else
                    <span class="badge badge-danger p-2">No adoptado</span>
                @endif
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Raza</strong>
                {{ $publicacion->mascota->raza->nombre }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Especie</strong>
                {{ $publicacion->mascota->especie->nombre }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Total solicitudes</strong>
                {{ count($publicacion->solicitudAdopcions ?? []) }}
            </p>
        </div>
        <div class="media text-muted pt-1">
            <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                <strong class="d-block text-gray-dark">Etiquetas</strong>
                @forelse($publicacion->mascota->etiquetas as $item)
                    <span class="badge badge-primary p-1">{{ $item->nombre }}</span>
                @empty
                    <span class="badge badge-secondary p-1">No etiquetas</span>
                @endforelse
            </p>
        </div>
    </div>
@endsection
