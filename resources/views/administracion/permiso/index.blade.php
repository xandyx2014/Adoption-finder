@extends('layouts.app')
@section('title', 'Permisos')
@section('content')
    <div class="container p-4 elevation-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Permisos
                            <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                    data-target="#searchModal">
                                Busqueda
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                            <a
                                href="{{ route('permiso.index') }}"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Limpiar busqueda
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                            @include('administracion.permiso.search')
                            <button
                                data-toggle="modal" data-target="#reportModal"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Reporte <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                            @include('administracion.permiso.select')
                    </div>
                    @can('permiso', 'Ver usuario')
                        tengo el permiso de ver usuario
                    @endcan
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr class=" bg-primary">
                                <th scope="col" style="text-align: center">ID</th>
                                <th scope="col" style="text-align: center">Rol</th>
                                <th scope="col" style="text-align: center">Creado</th>
                                <th scope="col" style="text-align: center">Actualizado</th>
                                <th scope="col" style="text-align: center">Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permisos as $permiso)
                            <tr>
                                <th scope="row" style="text-align: center">{{ $permiso->id }}</th>
                                <td style="text-align: center" class="font-weight-bold">
                                    {{ $permiso->nombre }}
                                </td>
                                <td style="text-align: center">{{ $permiso->created_at }}</td>
                                <td style="text-align: center">{{ $permiso->updated_at }}</td>
                                <td>
                                    <a class="btn btn-info elevation-2" href="{{ route('permiso.show', $permiso->id) }}">
                                        <i class="fa fa-shield" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            {{ $permisos->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
