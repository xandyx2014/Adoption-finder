@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    @once
        @push('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css"
                  integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w=="
                  crossorigin="anonymous"/>
        @endpush
    @endonce
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                @if(session('status'))
                <div class="alert alert-warning" role="alert">
                    Mensaje de confirmacion enviado <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </div>
                @endif

                @unless(auth()->user()->email_verified_at)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fa fa-ban"></i> Alerta!</h5>
                        Porfa vor verifica tu correo electronico no podras realizar ninguna accion sin antes poder verificar tu correo electronico
                        si no te ha llegado en tu buzon puedes intentar con este
                        <form action="{{ route('resendEmailVerification') }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-sm btn-primary">Renviar <i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                        </form>

                    </div>
                @endunless
                <div class="card">
                    <div class="card-header border border-primary text-primary">General</div>
                    <div class="card-body bg-light d-flex flex-wrap">
                        @can('permiso', 'listar-mascota')
                            <div style="width: 250px" class="small-box bg-info mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Mascotas</h5>

                                    <p>Ver mascotas</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-paw" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('mascota.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-publicacion-adopcion')
                            <div style="width: 250px" class="small-box bg-primary mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Publicacion adopcion</h5>

                                    <p>Ver publicaciones adopcion</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('publicacionAdopcion.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-seguimiento-mascota')
                            <div style="width: 250px" class="small-box bg-secondary mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Seguimiento</h5>

                                    <p>Ver seguimientos</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-history" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('seguimiento.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-solicitud-adopcion')
                            <div style="width: 250px" class="small-box bg-warning mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Solicitud de adopcion</h5>

                                    <p>Ver solicitud</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-question" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('solicitud.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-aprobar-rechazar-solicitud')
                            <div style="width: 250px" class="small-box bg-success mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Aprobar rechazar</h5>

                                    <p>Solicitud de mascota</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('aprobarSolicitud.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-galeria-mascota')
                            <div style="width: 250px" class="small-box bg-dark mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Galeria de mascota</h5>

                                    <p>fotos de la mascota</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('imagenMascota.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-tipo-publicacion')
                            <div style="width: 250px" class="small-box bg-gradient-dark mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Tipo de publicacion</h5>

                                    <p>ver los tipos</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('tipopublicacion.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-publicacion-informativa')
                            <div style="width: 250px" class="small-box bg-gradient-info mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Publicaciones informativas</h5>

                                    <p>ver los publicaciones</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-rss" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('publicacion.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-solicitud-publicacion')
                            <div style="width: 250px" class="small-box bg-gradient-warning mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Aprobar o rechazar</h5>

                                    <p>Solicitud de publicacion</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('aprobar.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-galeria-publicacion-informativa')
                            <div style="width: 250px" class="small-box bg-gradient-danger mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Galeria de foto</h5>

                                    <p>publicacion informativas</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('imagenPublicacion.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-tipo-denuncia')
                            <div style="width: 250px" class="small-box bg-gradient-success mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Tipo de denuncia</h5>

                                    <p>Ver tipo de denuncia</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('tipodenuncia.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-denuncia')
                            <div style="width: 250px" class="small-box bg-gradient-secondary mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Denuncia</h5>

                                    <p>De las publicaciones</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('denuncia.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-especie')
                            <div style="width: 250px" class="small-box bg-primary mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Especie</h5>

                                    <p>De las mascotas</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-paw" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('especie.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-raza')
                            <div style="width: 250px" class="small-box bg-light mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Raza</h5>

                                    <p>De las mascotas</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-paw" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('raza.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                        @can('permiso', 'listar-etiqueta')
                            <div style="width: 250px" class="small-box bg-dark mr-3 elevation-4">
                                <div class="inner">
                                    <h5>Etiquetas</h5>

                                    <p>De las mascotas</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                </div>
                                <a href="{{ route('etiqueta.index') }}" class="small-box-footer">Ver<i
                                        class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card bg-light elevation-1">
                    <div class="card-header border border-primary text-primary">
                        Mascotas en general
                    </div>
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    @once
        @push('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"
                    integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw=="
                    crossorigin="anonymous"></script>
            <script type="application/javascript">
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Mascotas no adoptadas', 'Mascota adoptadas',],
                        datasets: [{
                            data: [
                                {{ count( App\Models\Mascota::where('adoptado', 0)->get() ) }},
                                {{ count( App\Models\Mascota::where('adoptado', 1)->get() ) }},
                            ],
                            backgroundColor: [
                                'rgba(220, 53, 69, 1)',
                                'rgba(0, 123, 255, 1)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                });
            </script>
        @endpush
    @endonce
@endsection
