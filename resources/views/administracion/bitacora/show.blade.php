@extends('layouts.app')
@section('title', 'Permisos')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="card-footer p-0 ">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Nombre <span class="float-right badge bg-secondary p-1">{{ $user->name }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Correo <span class="float-right badge bg-secondary p-1"> {{ $user->email }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card elevation-4">
                    <div class="card-header">
                        <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                data-target="#searchModal">
                            Busqueda
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <a
                            href="{{ route('bitacora.show', $user->id) }}"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Limpiar busqueda
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                        <button
                            data-toggle="modal" data-target="#reportModal"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Reporte <i class="fa fa-file" aria-hidden="true"></i>
                        </button>
                        @include('administracion.bitacora.select', [ 'id' => $user->id])
                        @include('administracion.bitacora.searchUser', [ 'id' => $user->id])
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Accion</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bitacoras as $bitacora)
                                <tr>
                                    <th scope="row">{{ $bitacora->id }}</th>
                                    <td>{{ $bitacora->accion }}</td>
                                    <td>{{ $bitacora->entidad }}</td>
                                    <td>{{ $bitacora->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $bitacoras->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
