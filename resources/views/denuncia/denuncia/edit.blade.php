@extends('layouts.app')
@section('title', 'Denuncias')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
        <style type="text/css">
            textarea {
                max-height: 150px;
            }
        </style>
    @endpush
    <form action="{{ route('denuncia.update', $denuncia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container elevation-4 rounded p-4">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-text-width"></i>
                                Solicitud de adopcion de mascota

                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4">Descripcion</dt>
                                <dd class="col-sm-8">
                                    {{-- <input  value="{{ old('descripcion', ucfirst($solicitud->descripcion)) }}" class="form-control form-control-sm" type="text">--}}
                                    <textarea name="descripcion" id="descripcion"
                                              class="form-control  @error('descripcion') is-invalid @enderror" rows="3"
                                              placeholder="Descripcion ..."
                                              style="margin-top: 0px; margin-bottom: 0px; height: 108px;"></textarea>
                                    @error('descripcion')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </dd>

                            </dl>
                            <dl class="row">
                                <dt class="col-sm-4">Tipo de denuncia</dt>
                                <dd class="col-sm-8">
                                    {{-- <input  value="{{ old('descripcion', ucfirst($solicitud->descripcion)) }}" class="form-control form-control-sm" type="text">--}}
                                    <select class="js-example-basic-single w-100" name="tipo_denuncia_id">
                                        @foreach($tipo as $i)
                                            <option
                                                value="{{ $i->id }}"
                                            @if($denuncia->tipo_denuncia_id == $i->id) selected @endif
                                            >{{ $i->tipo }}</option>
                                        @endforeach
                                    </select>
                                    @error('descripcion')
                                    <div class="error invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </dd>
                            </dl>
                        </div>
                        <div class="card-footer">
                            <div class="pull-right">
                                <button class="btn btn-primary" type="submit">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
            });
            document.getElementById("descripcion").defaultValue = "{{ old('descripcion', $denuncia->descripcion) }}";
        </script>
    @endpush
@endsection
