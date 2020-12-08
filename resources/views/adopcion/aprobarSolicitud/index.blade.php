@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
    @endpush
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Solicitud rechazada</h5>
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('rechazado'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Exelente</h5>
            {{ session()->get('rechazado') }}
        </div>
    @endif
    <div class="container elevation-4 p-4">
        <div class="card">
            <div class="card-header b-flex">
                <div class="text-muted">
                    Solicitudes de mascotas
                    @can('permiso', 'buscar-aprobar-rechazar-solicitud')
                        <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                data-target="#searchModal">
                            Busqueda
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <a
                            href="{{ route('aprobarSolicitud.index') }}"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Limpiar busqueda
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                    @endcan
                </div>
            </div>
            @include('adopcion.aprobarSolicitud.search')
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr class="bg-primary">
                        <th scope="col">ID</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <th scope="row" class="text-muted">{{ $solicitud->id }}</th>
                            <td>{{ Illuminate\Support\Str::substr( $solicitud->motivo, 0 ,30) }}...</td>
                            <td>{{ $solicitud->user->name }}</td>
                            <td>
                                    <span class="badge badge-info">{{ $solicitud->estado }}</span>
                            </td>
                            <td>
                                @include('adopcion.aprobarSolicitud.action', [ 'data' => $solicitud])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="pull-right">
                    {{ $solicitudes->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                $('#estado').select2();
            });
        </script>
    @endpush
@endsection
