@extends('layouts.app')
@section('title', 'Publicacion de adopcion')
@section('content')
   <div class="container">
       <div class="row">
           <div class="col-9">
               <div class="my-3 p-3 bg-white rounded box-shadow elevation-4">
                   <h6 class="border-gray mb-0">{{ ucfirst($publicacion->titulo) }}</h6>
                   <h6 class="border-bottom border-gray pb-2 mb-0 text-muted">{{ $publicacion->created_at }}</h6>
                   <div class="mt-4">
                       {!! $publicacion->descripcion_corta !!}
                   </div>
               </div>
           </div>
           <div class="col-3">
               <div class="my-3 p-3 bg-white rounded box-shadow elevation-4">
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
                           <strong class="d-block text-gray-dark">Nombre</strong>
                            {{ $publicacion->mascota->nombre }}
                       </p>
                   </div>
                   <div class="media text-muted pt-1">
                       <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                           <strong class="d-block text-gray-dark">Tamaño</strong>
                           {{ $publicacion->mascota->tamagno }}
                       </p>
                   </div>
                   <div class="media text-muted pt-1">
                       <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                           <strong class="d-block text-gray-dark">Salud</strong>
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
           </div>
       </div>
   </div>
@endsection
