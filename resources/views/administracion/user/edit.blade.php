@extends('layouts.app')
@section('title', 'Usuario')
@section('content')
    @once
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    @endpush
    @endonce
    <form action="{{ route('user.update', $user->id) }} @if(request()->has('edit')) ?edit=admin @endif " method="POST">
        @csrf
        @method('PUT')
        <div class="container elevation-1 p-4 rounded">
            <div class="row">
                @if(request()->has('edit'))
                    <div class="col">

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
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Enter ...">
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
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter ...">
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
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   autocomplete="new-password">

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
                                                   name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>

                    </div>
                @endif
                @unless(request()->has('edit'))
                    <div class="col-6">
                        <div class="card elevation-4 p-4">
                            <div class="card-header bg-primary">
                                Informacion del usuario
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><b>Nombre</b>: {{ $user->name }}</li>
                                    <li><b>Email</b>: {{ $user->email }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card elevation-4 rounded p-4">
                            <div class="card-header bg-primary">
                                Roles
                            </div>
                            <div class="card-body">
                                <select class="js-example-basic-single w-100" name="rol">
                                    @foreach($roles as $rol)
                                    <option
                                        value="{{ $rol->id }}"
                                        @if($rol->id == $user->rol_id) selected @endif
                                    >{{ $rol->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
            <button type="submit" class="btn btn-primary w-100">
                Actualizar
            </button>
        </div>
    </form>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
        <script type="application/javascript">
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endpush
@endsection
