@extends('layouts.app')
@section('title', 'Permisos')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card elevation-4">
                    <div class="card-header">
                        Bitacora
                        @can('permiso', 'buscar-bitacora')
                            <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                    data-target="#searchModal">
                                Busqueda
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                            <a
                                href="{{ route('bitacora.index') }}"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Limpiar busqueda
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                        @endcan
                        @include('administracion.bitacora.search')
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr class="bg-primary">
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge badge-info p-1">{{ $user->rol->nombre }}</span>
                                    </td>
                                    <td>
                                        @include('administracion.bitacora.action', [ 'data' => $user])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
