<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    th,
    td {
        font-size: 0.80em;
        padding: 2px 2px;
        text-align: left;
        border-bottom: 1px solid #E1E1E1;
    }

    th:first-child,
    td:first-child {
        padding-left: 0;
    }

    th:last-child,
    td:last-child {
        padding-right: 0;
    }

    table {
        width: 100%;

    }

    .titulo {
        text-align: center;
    }
    label {
        font-weight: bold;
    }
</style>
<body>
<div>
    <div class="titulo">
        <h4>Mascota</h4>
    </div>
</div>


<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Color</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Tamaño</th>
        <th scope="col">Salud</th>
        <th scope="col" style="width: 20%">Acerca de</th>
        <th scope="col">Adoptado</th>
        <th scope="col">Creado</th>
        <th scope="col">Actualizado</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $mascota->id }}</td>
        <td>{{ $mascota->nombre }}</td>
        <td>{{ $mascota->color }}</td>
        <td>{{ $mascota->descripcion }}</td>
        <td>{{ $mascota->tamagno }}</td>
        <td>{{ $mascota->salud }}</td>
        <td>{{ $mascota->about }}</td>
        @if($mascota->adoptado == 1)
            <td>Si</td>
        @else
            <td>No</td>
        @endif
        <td>{{ $mascota->created_at }}</td>
        <td>{{ $mascota->updated_at }}</td>
    </tr>
    </tbody>
</table>
<br>
<label> Raza</label>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col" style="width: 20%">Descripcion</th>
        <th scope="col">Creado</th>
        <th scope="col">Actualizado</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $mascota->raza->id }}</td>
        <td>{{ $mascota->raza->nombre }}</td>
        <td>{{ $mascota->raza->descripcion }}</td>
        <td>{{ $mascota->raza->created_at }}</td>
        <td>{{ $mascota->raza->updated_at }}</td>
    </tr>
    </tbody>
</table>
<br>
<label> Especie</label>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col" style="width: 20%">Descripcion</th>
        <th scope="col">Creado</th>
        <th scope="col">Actualizado</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $mascota->especie->id }}</td>
        <td>{{ $mascota->especie->nombre }}</td>
        <td>{{ $mascota->especie->descripcion }}</td>
        <td>{{ $mascota->especie->created_at }}</td>
        <td>{{ $mascota->especie->updated_at }}</td>
    </tr>
    </tbody>
</table>
<br>
<label> Etiquetas Total : {{ count($mascota->etiquetas ?? []) }}</label>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Creado</th>
        <th scope="col">Actualizado</th>
    </tr>
    </thead>
    <tbody>
    @forelse($mascota->etiquetas as $etiqueta)
        <tr>

            <td>{{ $etiqueta->id }}</td>
            <td>{{ $etiqueta->nombre }}</td>
            <td>{{ $etiqueta->created_at }}</td>
            <td>{{ $etiqueta->updated_at }}</td>

        </tr>
    @empty
        <tr>
            <td>No tiene etiquetas</td>
        </tr>
    @endforelse
    </tbody>
</table>
<br>
@if($user == 1)
    <label> Usuario creador de la mascota</label>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col" style="width: 20%">Email</th>
            <th scope="col">Creado</th>
            <th scope="col">Actualizado</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $mascota->user->id }}</td>
            <td>{{ $mascota->user->name }}</td>
            <td>{{ $mascota->user->email }}</td>
            <td>{{ $mascota->user->created_at }}</td>
            <td>{{ $mascota->user->updated_at }}</td>
        </tr>
        </tbody>
    </table>
@endif
<br>
@if($adoptador == 1)
    <label> Usuario adoptador de la mascota</label>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col" style="width: 20%">Email</th>
            <th scope="col">Creado</th>
            <th scope="col">Actualizado</th>
        </tr>
        </thead>
        <tbody>
        @if($mascota->propetario != null)
            <tr>
                <td>{{ $mascota->user->id }}</td>
                <td>{{ $mascota->user->name }}</td>
                <td>{{ $mascota->user->email }}</td>
                <td>{{ $mascota->user->created_at }}</td>
                <td>{{ $mascota->user->updated_at }}</td>
            </tr>
        @else
            <tr>
                <td>No hay adoptado</td>
            </tr>
        @endif
        </tbody>
    </table>
@endif
<br>
@if($publicacion == 1)
    <label> Publicaciones creada de la para la mascota</label>
    <table class="table table-sm">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titulo</th>
            @if($denuncia == 1)
                <th scope="col">Total denuncias</th>
            @endif()
            @if($solicitud == 1)
                <th scope="col">Total Solicitudes</th>
            @endif
            <th scope="col">Creado</th>
            <th scope="col">Actualizado</th>
        </tr>
        </thead>
        <tbody>

        @if(count($mascota->publicacionAdopcions()->withTrashed()->get()) > 0)
            @foreach($mascota->publicacionAdopcions()->withTrashed()->get() as $publicacion)
                <tr>
                    <td>{{ $publicacion->id }}</td>
                    <td>{{ $publicacion->titulo }}</td>
                    @if($denuncia == 1)
                        <td>{{ count($publicacion->denuncias) }}</td>
                    @endif
                    @if($solicitud == 1)
                        <td>{{ count($publicacion->solicitudAdopcions) }}</td>
                    @endif
                    <td>{{ $publicacion->created_at }}</td>
                    <td>{{ $publicacion->updated_at }}</td>

                </tr>
            @endforeach
        @else
            <tr>
                <td>Sin Publicaciones</td>
            </tr>
        @endif
        </tbody>
    </table>
@endif
</body>
<script type="text/php">

    if ($PAGE_COUNT > 1) {

        if ($PAGE_COUNT > 1) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 10;
            $pageText = "Pagina " . $PAGE_NUM . " de " . $PAGE_COUNT;
            $y = 800;
            $x = 280;
            $pdf->text($x, $y, $pageText, $font, $size);
            $pdf->text(470, 800, auth()->user()->name , $font, $size);
            $pdf->text(470, 15, "{{ \Carbon\Carbon::now()->format('d-M-Y')  }}" , $font, $size);
           ');
        }

    }


</script>
</html>

