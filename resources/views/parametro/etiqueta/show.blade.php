@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2  border-bottom m-2">

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Creado {{ $especie->created_at }}
                            </button>
                            <button class="btn btn-sm btn-outline-secondary ml-1" disabled>
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                Actualizado {{ $especie->updated_at }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <h1 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i> ID: {{ $especie->id }}</h1>
                        <h1 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i> Nombre: {{ $especie->nombre }}</h1>

                        {{--<h3 class="h6"> <i class="fa fa-address-book" aria-hidden="true"></i>  Descripcion: </h3>
                        <p>{{ $especie->descripcion }}</p>--}}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
