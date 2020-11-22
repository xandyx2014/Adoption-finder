@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">


                                <h3 class="card-title">
                                    <a href="{{ route('publicacion.show', $id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                    </a>
                                    Denuncias
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th style="width: 65%">Descripcion</th>
                                        <th>Tipo</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($denuncias as $denuncia)
                                    <tr>
                                        <td>{{ $denuncia->id }}</td>
                                        <td>{{ $denuncia->descripcion }}</td>
                                        <td>
                                                {{ $denuncia->tipoDenuncia->tipo }}
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <div class="pagination pagination-sm m-0 float-right">
                                    {{ $denuncias->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
