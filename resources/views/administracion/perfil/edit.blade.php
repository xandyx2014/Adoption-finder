@extends('layouts.app')
@section('title', 'Usuario')
@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-5">

                <div class="card elevation-4">
                    <div class="card-header">
                        <h4>Tu cuenta</h4>
                    </div>
                    @if(session()->has('user'))
                        <div class="card bg-success">
                            <!-- /.card-header -->
                            <div class="card-body">
                                Se ha actualizado tu perfil
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('perfil.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email', $user->email) }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">Nueva {{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-secondary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card elevation-4 rounded ">
                    @if(session()->has('success'))
                        <div class="card bg-success">
                            <!-- /.card-header -->
                            <div class="card-body">
                                Se ha actualizado tu perfil
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif
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
