@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">Formulacion de edicion</div>

                    <div class="card-body">
                        <form class="p-2 pr-0" action="{{ route('raza.update', $raza->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            {{--@if (session('success'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Exito</strong> se ha creado exitosamente
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif--}}
                            <div class="form-group">
                                <label for="inputAddress">Nombre</label>
                                <input id="nombre"
                                       value="{{ old('nombre', $raza->nombre) }}"
                                       name="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror"
                                       placeholder="nombre de la raza">
                                @error('nombre')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small id="nombre" class="form-text text-muted">
                                    Este nombre sera para identificar el Raza.
                                </small>

                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Descripcion</label>
                                <input
                                    type="text"
                                    value="{{ old('descripcion', $raza->descripcion) }}"
                                          name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                          id="descripcion" placeholder="Descripcion de la raza"/>
                                @error('descripcion')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <small id="descripcion" class="form-text text-muted">
                                    Esto describira las caracteristicas y propiedades.
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
