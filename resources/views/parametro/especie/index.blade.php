@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    @push('css')

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="#">Parametros</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Especie</li>
                        </ol>
                    </nav>
                    <div class="card-body pt-0">

                        <table id="especie-data-table" class="table table-striped table-bordered table-sm" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Creado en</th>
                                <th>Actualizado en</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#especie-data-table').DataTable({
                    "serverSide": true,
                    "ajax": "{{ url('api/especie') }}",
                    "lengthMenu": [ 4, 5, 10, 30, 100 ],
                    "columns": [
                        {data: 'id'},
                        {data: 'nombre'},
                        {data: 'created_at'},
                        {data: 'updated_at'},
                        {data: 'btn'},
                    ],
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar...",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select >'+
                            '<option value="4">4</option>'+
                            '<option value="5">5</option>'+
                            '<option value="10">10</option>'+
                            '<option value="30">30</option>'+
                            '<option value="100">100</option>'+
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

