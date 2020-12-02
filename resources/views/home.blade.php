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
                <div class="card">
                    <div class="card-header border border-primary text-primary">Gestion de adopcion</div>
                    <div class="card-body bg-light d-flex flex-wrap">
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
                        <div style="width: 250px" class="small-box bg-primary mr-3 elevation-4">
                            <div class="inner">
                                <h5>Publicacion</h5>

                                <p>Ver publicaciones</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                            </div>
                            <a href="{{ route('publicacion.index') }}" class="small-box-footer">Ver<i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
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
