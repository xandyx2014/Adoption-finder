@extends('layouts.app')
@section('title', 'Usuario')
@section('content')
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @method('POST')
    <div class="container elevation-1 p-4 rounded">
        <div class="row">
            <div class="col-6">
                <div class="card elevation-4">
                    <div class="card-header">
                        <div class="text-muted">
                            Usuario
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter ...">
                                    @error('name')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter ...">
                                    @error('email')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Confirmacion de Contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="card elevation-4 rounded p-4">
                    <div class="card-header"></div>
                    <div class="card-body"></div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            Crear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
