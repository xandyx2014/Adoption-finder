@extends('layouts.app')
@section('title', 'Mascota')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
        <style>
            .select2-selection__choice {
                background-color: #007bff !important;
            }
        </style>
    @endpush
    <form class="needs-validation" novalidate="" action="{{ route('mascota.update', $mascota->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container elevation-4 p-4">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    {{--<h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">3</span>
                    </h4>--}}
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Etiquetas</h6>
                                <select style="width: 100%" id="etiqueta" name="etiquetas[]" multiple="multiple">
                                    @foreach($etiquetas as $etiqueta)
                                    <option
                                        {{ collect(old('etiquetas', $mascota->etiquetas->pluck('id')))->contains($etiqueta->id) ? 'selected': '' }}
                                        value="{{$etiqueta->id}}">{{ $etiqueta->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Raza</h6>
                                <select style="width: 100%" id="raza"  name="raza">

                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}"
                                                @if($mascota->raza_id == $raza->id)
                                                selected
                                                @endif
                                        >{{ $raza->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Especies</h6>
                                <select style="width: 100%" id="especie" name="especie">
                                    @foreach($especies as $especie)

                                        <option value="{{ $especie->id }}"
                                                @if($mascota->especie_id == $especie->id)
                                                selected
                                            @endif

                                        >{{ $especie->nombre }}</option>



                                    @endforeach
                                </select>
                            </div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div class="w-100">
                                <h6 class="my-0">Genero</h6>
                                <select style="width: 100%" name="genero">
                                    <option
                                        @if($mascota->genero == 'MACHO')
                                        selected
                                        @endif
                                        value="MACHO">
                                        Macho
                                    </option>
                                    <option
                                        @if($mascota->genero == 'HEMBRA')
                                        selected
                                        @endif
                                        value="HEMBRA">
                                        Hembra
                                    </option>
                                </select>
                            </div>
                        </li>
                        @if($mascota->propetario != null)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Propetario</h6>
                                <p class="media-body pb-1 mb-0 lh-125">
                                    <strong class="d-block text-gray-dark">Nombre</strong>
                                    {{ $mascota->propetario->name }}
                                </p>
                                <p class="media-body pb-1 mb-0 lh-125">
                                    <strong class="d-block text-gray-dark">Email</strong>
                                    {{ $mascota->propetario->email }}
                                </p>
                                <p class="media-body pb-1 mb-0 lh-125">
                                    <strong class="d-block text-gray-dark">Usuario</strong>
                                    <a href="#" class="badge badge-primary">User</a
                                </p>
                                <strong class="d-block text-gray-dark">Propetario</strong>
                                <select name="propetario" class="custom-select w-100">
                                    <option value="1">Aprobado</option>
                                    <option value="0">Deshaprobado</option>
                                </select>
                            </div>
                        </li>
                        @endif

                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div >
                                <h6 class="my-0">Adicionar Imagenes</h6>
                                <input type="file" name="file[]" accept="image/x-png,image/gif,image/jpeg" multiple />
                                @error('file.*')
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5>
                                        <i class="icon fa fa-ban"></i>
                                        {{ $message }}
                                    </h5>
                                </div>
                                @enderror
                            </div>
                        </li>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                            Actualizar mascota
                        </button>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Agregar una mascota</h4>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre de la mascota</label>
                            <input
                                type="text"
                                name="nombre"
                                placeholder="Nombre de la mascota"
                                value="{{ old('nombre', $mascota->nombre) }}"
                                class="form-control @error('nombre') is-invalid @enderror">
                            @error('nombre')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Color</label>
                            <input
                                type="text"
                                name="color"
                                placeholder="Color de la mascota"
                                value="{{ old('color', $mascota->color) }}"
                                class="form-control @error('color') is-invalid @enderror">
                            @error('color')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Descripcion</label>
                            <input
                                type="text"
                                name="descripcion"
                                placeholder="Descripcion"
                                value="{{ old('descripcion', $mascota->descripcion) }}"
                                class="form-control @error('descripcion') is-invalid @enderror">
                            @error('descripcion')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tamaño</label>
                            <input
                                type="text"
                                name="tamagno"
                                placeholder="Tamaño de la mascota"
                                value="{{ old('tamagno', $mascota->tamagno) }}"
                                class="form-control @error('tamagno') is-invalid @enderror">
                            @error('tamagno')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Salud</label>
                            <input
                                type="text"
                                name="salud"
                                placeholder="Salud de la mascota"
                                value="{{ old('salud', $mascota->salud) }}"
                                class="form-control @error('salud') is-invalid @enderror">
                            @error('salud')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Acerca de la masctoa</label>
                            <textarea
                                name="about"
                                id="about"
                                class="form-control @error('about') is-invalid @enderror"
                                cols="30"
                                value="{{ old('about', $mascota->about) }}"
                                rows="5"></textarea>
                            @error('about')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <hr class="mb-4">

                </div>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($mascota->imagens as $photo)
            <div class="col-md-4">
                <form action="{{ route('mascota.photo.delete', $photo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="position: absolute;"><i
                            class="fa fa-remove"></i></button>
                </form>
                @if(Illuminate\Support\Str::contains($photo->url, 'https'))
                    <img src='{{ asset( $photo->url ) }}' class="img-fluid" alt="" srcset="">
                @else
                    <img src='{{ asset( "storage/" . $photo->url ) }}' class="img-fluid" alt="" srcset="">
                @endif

            </div>
        @endforeach
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                document.getElementById("about").defaultValue = "{{ old('about', $mascota->about) }}"
                $('#etiqueta').select2({
                    placeholder: 'Elije una etiqueta'
                });
                $('#raza').select2({
                    placeholder: 'Elije una raza'
                });
                $('#especie').select2({
                    placeholder: 'Elije una especie'
                });

            });
        </script>
    @endpush
@endsection
