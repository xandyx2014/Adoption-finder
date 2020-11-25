@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    <div class="container p-4">
        <div class="row b-flex justify-content-center">
            <div class="col-4 elevation-4 p-4">
                <div class="row">
                    <div class="col">
                        <label for="customRange1">Puntuacion <span class="badge badge-primary"
                                                                   id="slider_value"> </span></label>
                        <input name="puntuacion" disabled type="range" min="0" max="100" value="{{ $seguimiento->puntuacion }}"
                               step="1" class="custom-range"
                               id="slider">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="customRange1">Calidad</label>
                        <div class="text-muted">
                            {{ $seguimiento->calidad }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="customRange1">Descripcion</label>
                        <div class="text-muted">
                            {{ $seguimiento->descripcion }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class=" p-4 bg-white rounded box-shadow elevation-4">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Mascotas</h6>
                    @forelse($seguimiento->mascota->imagens as $imagen)
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
                            {{ $seguimiento->mascota->nombre }}
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Tamaño</strong>
                            {{ $seguimiento->mascota->tamagno }}
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Salud</strong>
                            {{ $seguimiento->mascota->salud }}
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Adoptado</strong>
                            @if($seguimiento->mascota->adoptado == 1)
                                <span class="badge badge-success p-2">Adoptado</span>
                            @else
                                <span class="badge badge-danger p-2">No adoptado</span>
                            @endif
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Raza</strong>
                            {{ $seguimiento->mascota->raza->nombre }}
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Especie</strong>
                            {{ $seguimiento->mascota->especie->nombre }}
                        </p>
                    </div>
                    <div class="media text-muted pt-1">
                        <p class="media-body pb-1 mb-0 small lh-125 border-bottom">
                            <strong class="d-block text-gray-dark">Etiquetas</strong>
                            @forelse($seguimiento->mascota->etiquetas as $item)
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
    @push('js')
        <script type="application/javascript">
            $('#slider_value').html($('#slider').val());
        </script>
    @endpush
@endsection
