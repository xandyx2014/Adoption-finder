@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container elevation-4 rounded p-4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-text-width"></i>
                            Solicitud de adopcion de mascota
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Motivo</dt>
                            <dd class="col-sm-8">{{ ucfirst($solicitud->motivo) }}</dd>
                            <dt class="col-sm-4">Descripcion</dt>
                            <dd class="col-sm-8">{{ ucfirst($solicitud->descripcion) }}</dd>
                            <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                @if($solicitud->estado)
                                    <span class="badge badge-success">Aceptado</span>
                                    @else
                                    <span class="badge badge-danger">No aceptado</span>
                                @endif
                            </dd>
                            <dt class="col-sm-4">Usuario</dt>
                            <dd class="col-sm-8">
                                <a  href="#" class="badge badge-success">User</a>
                            </dd>
                            <dt class="col-sm-4">Publicacion adopcion</dt>
                            <dd class="col-sm-8">
                                <a  target="_blank" href="{{ route('finder.show', $solicitud->publicacion_adopcion_id) }}" class="badge badge-primary">Publicacion de adopcion</a>
                            </dd>

                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
