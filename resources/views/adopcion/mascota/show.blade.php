@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    <div class="container elevation-4 p-4">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Propiedades</span>
                    {{--<span class="badge badge-secondary badge-pill">3</span>--}}
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Nombre</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->nombre }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Color</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->color }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tamaño</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->tamagno }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Raza</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->raza->nombre }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Especie</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->especie->nombre }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Genero</h6>
                        </div>
                        <span class="text-muted">{{ $mascota->genero }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-primary">
                            <h6 class="my-0">Dueño</h6>
                        </div>
                        <span class="text-primary">{{ $mascota->user->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="@if($mascota->adoptado) text-success @else text-danger  @endif">
                            <h6 class="my-0">Adoptado</h6>
                        </div>
                        <span class="@if($mascota->adoptado) text-success @else text-danger  @endif">
                            @if($mascota->adoptado) Si @else No  @endif
                        </span>
                    </li>

                </ul>
                @if($mascota->propetario_id != null)
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Propetario</span>
                        {{--<span class="badge badge-secondary badge-pill">3</span>--}}
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Nombre</h6>
                            </div>
                            <span class="text-muted">{{ $mascota->propetario->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Email</h6>
                            </div>
                            <span class="text-muted">{{ $mascota->propetario->email }}</span>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Nombre: {{ $mascota->nombre }}</h4>
                <div class="row">
                    <div class="col-4">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

                                @forelse($mascota->imagens as $item)
                                    <img class="carousel-item @if ($loop->first) active @endif"
                                         src='{{ asset( "storage/" . $item->url ) }}' alt="" srcset="">
                                @empty
                                    <img class="carousel-item active"
                                         src='{{ asset("storage/default.jpg") }}' alt=""
                                         srcset="">
                                @endforelse

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Sgte</span>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <p class="font-weight-bold mb-0">Descripcion :</p>
                        {{ $mascota->descripcion }}
                        <p class="font-weight-bold mb-0">Acerca de mi :</p>
                        {{ $mascota->about }}
                        <p class="font-weight-bold mb-0">Total imagenes :</p>
                        {{ $mascota->imagens->count() }}
                        <p class="font-weight-bold mb-0">Etiquetas :</p>
                        @foreach($mascota->etiquetas as $etiqueta)
                            <span class="badge badge-primary">{{ $etiqueta->nombre }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $('#carouselExampleControls').carousel()
        </script>
    @endpush
@endsection
