@extends('layouts.app')
@section('title', 'Imagen Publicacion')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
    @endpush
    <div class="container elevation-4">
        <div class="card">
            <div class="card-header b-flex">
                Denuncias | Total :
                <span class="badge badge-secondary">
                    {{ $denuncias->total() }}
                </span>
                @unless(request()->has('bin'))
                    |@can('permiso', 'buscar-denuncia')
                        <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                data-target="#searchModal">
                            Busqueda
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <a
                            href="{{ route('denuncia.index') }}"
                            class="btn btn-sm btn-secondary elevation-2">
                            Limpiar busqueda
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                    @endcan
                    <button
                        data-toggle="modal" data-target="#reportModal"
                        class="btn btn-sm btn-outline-secondary elevation-2">
                        Reporte <i class="fa fa-file" aria-hidden="true"></i>
                    </button>
                    @include('denuncia.denuncia.select')
                    @include('denuncia.denuncia.search')

                    |
                    @can('permiso', 'estado-denuncia')
                        <a href="{{ route('denuncia.index', [ 'bin' => true]) }}"
                           class="btn btn-sm btn-outline-danger elevation-2">
                            Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                        </a>
                    @endcan
                @endunless
                |
                @can('permiso', 'registrar-denuncia')
                    @if(request()->has('bin'))
                        <a href="{{ route('denuncia.index') }}?tipo=1"
                           class="btn btn-sm btn-outline-success elevation-2">
                            Lista <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                    @endif
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-sm  table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 35%">Descripcion</th>
                        <th scope="col" style="width: 10%">Tipo</th>
                        <th scope="col">Pertenece</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($denuncias as $denuncia)
                        <tr>
                            <td>{{ $denuncia->id }}</td>
                            <th class="text-muted">{{ $denuncia->descripcion }}</th>
                            <th> {{ collect($denuncia)['tipo_denuncia']['tipo'] }}</th>
                            <th>
                                @if($denuncia->denunciable_type == App\Models\PublicacionInformativa::class)
                                    Publicacion Informativa
                                @else
                                    Publicacion Adopcion
                                @endif
                            </th>
                            <td>{{ $denuncia->created_at }}</td>
                            <td>
                                @can('permiso', 'consultar-denuncia')
                                    <a class="btn btn-success elevation-2"
                                       href="{{ route('denuncia.show', $denuncia->id) }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                @endcan

                                @unless(request()->has('bin'))
                                    @include('denuncia.denuncia.actions', [ 'denuncia' => $denuncia])
                                @endunless
                                @if(request()->has('bin'))
                                    @include('denuncia.denuncia.actionsBin', [ 'data' => $denuncia])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $denuncias->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#js-example-basic-single').select2();
            });
        </script>
    @endpush
@endsection
