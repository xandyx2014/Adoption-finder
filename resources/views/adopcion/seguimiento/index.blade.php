@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
    @endpush
    <div class="container elevation-4">
        <div class="card">
            <div class="card-header">
                Mascotas Total : <span class="badge badge-secondary p-1">{{ $seguimientos->total() }}</span>
                @unless(request()->input('bin'))
                    @can('permiso', 'buscar-seguimiento-mascota')
                        <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                data-target="#searchModal">
                            Busqueda
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <a
                            href="{{ route('seguimiento.index') }}"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Limpiar busqueda
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                        @include('adopcion.seguimiento.search')
                    @endcan

                    @can('permiso', 'registrar-seguimiento-mascota')
                        <a
                            href="{{ route('seguimiento.create') }}"
                            class="btn btn-sm btn-secondary elevation-2">
                            Crear <i class="fa fa-book" aria-hidden="true"></i>
                        </a>
                    @endcan
                    @can('is-admin')
                        <button
                            data-toggle="modal" data-target="#reportModal"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Reporte <i class="fa fa-file" aria-hidden="true"></i>
                        </button>
                    @endcan
                    @can('permiso', 'estado-seguimiento-mascota')
                        <a href="{{ route('seguimiento.index', [ 'bin' => true]) }}"
                           class="btn btn-sm btn-outline-danger elevation-2">
                            Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                        </a>
                    @endcan
                    @include('adopcion.seguimiento.select')
                @endunless
                @can('permiso', 'estado-seguimiento-mascota')
                    @if(request()->input('bin'))
                        <a href="{{ route('seguimiento.index') }}" class="btn btn-sm btn-outline-success elevation-2">
                            Lista <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                    @endif
                @endcan
            </div>
            <div class="card-body">
                @can('permiso', 'buscar-seguimiento-mascota')
                    @unless(request()->input('bin'))
                        <form action="{{ route('seguimiento.index') }}" method="GET"
                              class="input-group input-group-sm m-2">
                            @csrf
                            @method('GET')
                            <input name="search" class="form-control form-control-navbar" type="search"
                                   placeholder="Buscar por nombre de mascota">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    @endunless
                @endcan
                <table class="table table-sm">
                    <thead>
                    <tr class="bg-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Calidad</th>
                        <th scope="col">Puntuacion</th>
                        <th scope="col">Nombre mascota</th>
                        <th scope="col">Adoptado</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Actualizado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($seguimientos as $mascota)
                        <tr>
                            <th scope="row">{{ $mascota->id }}</th>
                            <th scope="row">{{ $mascota->calidad }}</th>
                            <th scope="row">{{ $mascota->puntuacion }} / 100</th>
                            <th scope="row">{{ $mascota->mascota->nombre }}</th>
                            @if( $mascota->mascota->adoptado == 1)
                                <th scope="row"><span class="badge badge-success">Adoptado</span></th>
                            @else
                                <th scope="row"><span class="badge badge-danger">No adoptado</span></th>
                            @endif

                            <th scope="row">{{ $mascota->created_at }}</th>
                            <th scope="row">{{ $mascota->updated_at }}</th>
                            <th scope="row">

                                @if(request()->has('bin'))
                                    @include('adopcion.seguimiento.actionsBin', [ 'data' => $mascota])
                                @else
                                    @include('adopcion.seguimiento.action', [ 'data' => $mascota])
                                @endunless
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">

                </div>
                <div class="pull-right mt-3">
                    {{ $seguimientos->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
                $('#mascotas').select2();
                $('#mascotasSearch').select2();
            });
        </script>
    @endpush
@endsection
