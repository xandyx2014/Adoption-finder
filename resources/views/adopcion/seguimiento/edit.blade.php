@extends('layouts.app')
@section('title', 'Seguimiento mascota')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    @endpush
    <form action="{{ route('seguimiento.update', $seguimiento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container elevation-4 rounder p-4">
            <div class="row">
                <div class="col-9">
                    <h4 class="mb-3">Seguimiento de mascota</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="customRange1">Puntuacion <span class="badge badge-primary"
                                                                           id="slider_value"> </span></label>
                                <input name="puntuacion" type="range" min="0" max="100" value="{{ old('puntuacion', $seguimiento->puntuacion) }}"
                                       step="1" class="custom-range @error('puntuacion') is-invalid @enderror"
                                       id="slider">
                                @error('puntuacion')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Descripcion</label>
                            <input type="text" required value="{{ old('descripcion', $seguimiento->descripcion) }}" name="descripcion"
                                   class="form-control  @error('descripcion') is-invalid @enderror">
                            @error('descripcion')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Calidad (Buena, Mala....)</label>
                            <input type="text" required value="{{ old('calidad', $seguimiento->calidad) }}" name="calidad" min="0" max="15"
                                   class="form-control  @error('calidad') is-invalid @enderror">
                            @error('calidad')
                            <div class="error invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Mascota</span>
                        </h4>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div class="w-100">
                                    <h6 class="my-0">Mascota</h6>
                                    <select class="js-example-basic-single w-100" name="mascota_id" value="{{ old('mascota_id') }}" id="js-example-basic-single">
                                        @foreach($mascotas as $mascota)
                                            <option
                                                value="{{ $mascota->id }}"
                                                @if($mascota->id == $seguimiento->mascota_id)
                                                selected
                                                @endif
                                            >{{ $mascota->nombre }}</option>
                                        @endforeach
                                    </select>
                                   {{-- <select class="js-example-basic-single" name="state">
                                        <option value="AL">Alabama</option>
                                        ...
                                        <option value="WY">Wyoming</option>
                                    </select>--}}
                                </div>
                            </li>
                        </ul>

                        <form class="card p-2">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary w-100">Actualizar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script type="application/javascript">


            $(document).ready(function() {
                $('#slider_value').html($('#slider').val());
                $('#js-example-basic-single').select2();
                $(document).on('input', '#slider', function () {
                    const value = $(this).val();
                    $('#slider_value').html(value);
                });
            });

        </script>
    @endpush
@endsection

