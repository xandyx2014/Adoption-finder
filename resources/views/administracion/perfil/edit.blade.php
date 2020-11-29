@extends('layouts.app')
@section('title', 'Usuario')
@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <div class="card elevation-4 rounded ">
                    {{--@if(session()->has('success'))
                        <div class="card bg-success">
                            <div class="card-header">
                                <h3 class="card-title">Exito</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                Se ha actualizado tu perfil
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif--}}
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Tu perfil</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col">
                                <form action="{{ route('perfil.update', auth()->user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-4 col-form-label">Apodo</label>
                                        <div class="col-8">
                                            <input
                                                name="apodo"
                                                placeholder="Apodo..."
                                                value="{{ old('apodo', optional($user->perfil)->apodo) }}"
                                                class="form-control here @error('apodo') is-invalid @enderror"
                                                type="text">
                                            @error('apodo')
                                            <div class="error invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input
                                            type="text"
                                            name="apellidos"
                                            value="{{ old('apellidos', optional($user->perfil)->apellidos) }}"
                                            class="form-control @error('apellido') is-invalid @enderror"
                                            placeholder="Apellidos ...">
                                        @error('apellido')
                                        <div class="error invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input
                                            type="text"
                                            name="telefono"
                                            value="{{ old('telefono', optional($user->perfil)->telefono) }}"
                                            class="form-control @error('telefono') is-invalid @enderror"
                                            placeholder="Telefono ...">
                                        @error('telefono')
                                        <div class="error invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Acerca de mi</label>
                                        <input
                                            type="text"
                                            name="about"
                                            value="{{ old('about', optional($user->perfil)->about) }}"
                                            class="form-control @error('about') is-invalid @enderror"
                                            placeholder="Acerca de mi ...">
                                        @error('about')
                                        <div class="error invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary">
                                                Actualizar mi Perfil
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
