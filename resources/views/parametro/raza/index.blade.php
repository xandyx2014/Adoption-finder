@extends('layouts.app')
@section('title', 'Raza')
@section('content')
    @push('css')

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    @endpush
    <div class="container elevation-4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Raza
                        @unless($bin)
                            <button
                                data-toggle="modal" data-target="#reportModal"
                               class="btn btn-sm btn-outline-secondary elevation-2">
                                Reporte <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('raza.index', [ 'bin' => true]) }}"
                               class="btn btn-sm btn-outline-danger elevation-2">
                                Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            @include('parametro.raza.select')
                        @endunless
                        @if($bin)
                            <a href="{{ route('raza.index') }}" class="btn btn-sm btn-outline-success elevation-2">
                                Lista <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        @endif

                    </div>
                    @error('errorDependencia')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Mensaje</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    <div class="row">
                        @unless($bin)
                            <div class="col-3">
                                @include('parametro.raza.create')
                            </div>
                        @endunless
                        <div class="@if($bin) col @else col-9 @endif">
                            <div class="card-body pt-2">
                                <table id="especie-data-table" class="table table-striped table-bordered table-sm"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Creado en</th>
                                        <th>Actualizado en</th>
                                        @if($bin)
                                            <th>Eliminado en</th>
                                        @endif
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function () {
                const url = '{{ $bin }}' == '1' ? '{{ url('api/raza') }}' + '?bin=1' : '{{ url('api/raza') }}';
                const columns = '{{ $bin }}' != '1' ? [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'btn'},
                ] : [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'deleted_at'},
                    {data: 'btn'}
                ];
                $('#especie-data-table').DataTable({
                    "serverSide": true,
                    "order": [[0, "desc"]],
                    "columnDefs": [
                        {
                            "targets": 4,
                            "orderable": false
                        }
                    ],
                    "ajax": url,
                    "lengthMenu": [4, 5, 10, 30, 100],
                    "columns": columns,
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar...",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select >' +
                            '<option value="4">4</option>' +
                            '<option value="5">5</option>' +
                            '<option value="10">10</option>' +
                            '<option value="30">30</option>' +
                            '<option value="100">100</option>' +
                            '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias",
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }
                });
            });
        </script>
    @endpush
@endsection

