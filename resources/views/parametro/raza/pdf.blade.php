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

</style>
<body>
<div>
    <div class="titulo">
        <h4>Raza</h4>
    </div>

</div>

<table class="rtable" style="margin-top: 1em">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th style="width: 25%">Descripcion
        </td>
        <th style="width: 18%">Creado en</th>
        <th>Actualizado</th>
    </tr>
    </thead>
    <tbody>

    @forelse ($especies as $especie)
        <tr>
            <td>{{ $especie->id }}</td>
            <td>{{ $especie->nombre }}</td>
            <td>{{ $especie->descripcion }}</td>
            <td>{{ $especie->created_at }}</td>
            <td>{{ $especie->updated_at }}</td>
        </tr>
    @empty
        <tr style="text-align: center">
            <p>No hay datos</p>
        </tr>
    @endforelse
    </tbody>
</table>

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

