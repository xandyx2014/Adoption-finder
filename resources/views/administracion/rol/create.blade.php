@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card card-primary elevation-4">
                    <div class="card-header">
                        <h3 class="card-title">Rol</h3>
                    </div>
                    <form action="{{ route('rol.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="rol" value="{{ old('rol') }}" class="form-control @error('rol') is-invalid @enderror" placeholder="Enter ...">
                                @error('rol')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
