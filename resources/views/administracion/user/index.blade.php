@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    <div class="container p-4 rounded">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Gestionar usuario
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr class="bg-primary">
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Email Verificado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if($user->email_verified_at == null)
                                    <td><span class="badge badge-danger">No verificado</span></td>
                                    @else
                                    <td><span class="badge badge-success">Verificado</span></td>
                                @endif
                                <td>
                                    @include('administracion.user.action', [ 'data' => $user])
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            {{ $usuarios->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
