@extends('layouts.app')
@section('title', 'Reporte')
@section('content')
    @once
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
    @endpush
    @endonce
    <form action="{{ route('reporteMascota.report') }}" method="post">
        @csrf
        @method('POST')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card elevation-4">
                    <div class="card-header bg-secondary">
                        Reporte de mascotas
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mascota</label> <br>
                            <select class="js-example-basic-single" name="mascota">
                                @foreach($mascotas as $mascota)
                                <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mostrar Encargado de dar en adopcion</label> <br>
                            <select  name="user">
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mostrar nuevo encargado de adopcion (SI tiene)</label> <br>
                            <select  name="adoptador">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mostrar publicaciones</label> <br>
                            <select  name="publicacion">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mostrar Denuncias de las publicaciones</label> <br>
                            <select  name="denuncia">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mostrar Solicitudes de Publicacion</label> <br>
                            <select  name="solicitud">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                        <button class="btn btn-secondary m-2">
                            Preparar
                        </button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script type="application/javascript">
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>
    @endpush
@endsection
