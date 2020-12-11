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
                        <div class="h7 text-muted">{{ $publicacion->user->name  }} </div>
                    </div>
                </div>
                <div>

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
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('finder.show', $publicacion->id) }}&t='{{ $publicacion->titulo  }}'&display=popup">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
            </a>
            <a target="_blank" href="http://twitter.com/share?text={{ $publicacion->titulo  }}&url={{route('finder.show', $publicacion->id)}}">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a  target="_blank" href="https://wa.me/?text=Adopta a {{ $publicacion->mascota->nombre }} en {{route('finder.show', $publicacion->id)}} en Adoption Finder">
                <i class="fa fa-whatsapp" style="color: green;" aria-hidden="true"></i>
            </a>
            @can('permiso', 'registrar-solicitud-adopcion')
            <button href="#"
                    class="btn btn-info pull-right"
                    @if($publicacion->user_id == auth()->user()->id)
                    disabled
                    @endif
                    data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-paw"
                   aria-hidden="true"></i>
                Solicitar
            </button>
            @endcan
            @include('adoptionFInder.store', [ 'data' => $publicacion])
        </div>
    </div>
    @push('js-finder')
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function (event) {
                console.log('Hola');
            });


        </script>
    @endpush
@endsection
@section('info')
    @parent
    <div class="mb-1 p-3 bg-white rounded box-shadow elevation-2">
        <h6 class="border-bottom border-gray pb-2 mb-0">Mascotas</h6>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                @foreach($publicacion->mascota->imagens as $imagen)
                    <li data-target="#demo" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>

                @endforeach
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                @forelse($publicacion->mascota->imagens as $imagen)
                    {{--@if($loop->first)
                        @if(Illuminate\Support\Str::contains( $imagen->url, 'http'))

                               <img
                                   class="img-thumbnail rounded-circle"
                                   src='{{ asset(  $imagen->url ) }}'
                                   alt="" srcset="">

                        @else

                            <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/" .  $imagen->url ) }}' alt=""
                                 srcset="">
                        @endif
                    @endif--}}
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/" .  $imagen->url ) }}' alt=""
                             srcset="">
                    </div>
                @empty
                    <img class="img-thumbnail rounded-circle" src='{{ asset( "storage/default.jpg" ) }}' alt=""
                         srcset="">
                @endforelse
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>

        </div>

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
                <strong class="d-block text-gray-dark">Tamaño 📋</strong>
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
                <strong class="d-block text-gray-dark">Genero </strong>
                {{ $publicacion->mascota->genero }}
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
                    <span class="badge badge-info p-1">{{ $item->nombre }}</span>
                @empty
                    <span class="badge badge-secondary p-1">No etiquetas</span>
                @endforelse
            </p>
        </div>
    </div>
@endsection
