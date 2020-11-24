@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card elevation-2">
                    <div class="card-header">Formulacion de edicion</div>

                    <div class="card-body">
                        <form class="p-2 pr-0" action="{{ route('tipopublicacion.update', $especie) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="inputAddress">Nombre</label>
                                <input id="nombre"
                                       value="{{ old('tipo', $especie->tipo) }}"
                                       name="tipo" type="text" class="form-control form-control-sm @error('tipo') is-invalid @enderror"
                                       placeholder="tipo de la publicacion">
                                @error('tipo')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small id="nombre" class="form-text text-muted">
                                    Este nombre sera para identificar tipo de publicacion.
                                </small>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-sm btn-outline-primary">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
