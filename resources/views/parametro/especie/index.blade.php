@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    @push('css')

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Especie
                        @unless($bin)
                        <a href="{{ route('especie.index', [ 'bin' => true]) }}" class="btn btn-sm btn-outline-danger">
                            Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                        </a>
                        @endunless
                        @if($bin)
                            <a href="{{ route('especie.index') }}" class="btn btn-sm btn-outline-success">
                                Lista <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        @endif

                    </div>
                    <div class="row">
                        @unless($bin)
                        <div class="col-3">
                            <form class="p-2 pr-0" action="{{ route('especie.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                {{--@if (session('success'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Exito</strong> se ha creado exitosamente
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif--}}
                                <div class="form-group">
                                    <label for="inputAddress">Nombre</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror"
                                           placeholder="nombre de la especie">
                                    @error('nombre')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small id="nombre" class="form-text text-muted">
                                        Este nombre sera para identificar el Especie.
                                    </small>

                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Descripcion</label>
                                    <input type="text" name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                                           id="descripcion" placeholder="Descripcion de la especie">
                                    @error('descripcion')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small id="descripcion" class="form-text text-muted">
                                        Esto describira las caracteristicas y propiedades.
                                    </small>

                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Crear</button>
                                    </div>
                                </div>
                            </form>
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
                const url = '{{ $bin }}' == '1' ? '{{ url('api/especie') }}' + '?bin=1': '{{ url('api/especie') }}';
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
                    "order": [[ 0, "desc" ]],
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

