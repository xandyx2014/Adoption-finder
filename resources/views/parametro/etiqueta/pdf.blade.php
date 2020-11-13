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


    /* Typography
    –––––––––––––––––––––––––––––––––––––––––––––––––– */
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 2rem;
        font-weight: 300;
    }

    h1 {
        font-size: 4.0rem;
        line-height: 1.2;
        letter-spacing: -.1rem;
    }

    h2 {
        font-size: 3.6rem;
        line-height: 1.25;
        letter-spacing: -.1rem;
    }

    h3 {
        font-size: 3.0rem;
        line-height: 1.3;
        letter-spacing: -.1rem;
    }

    h4 {
        font-size: 2.4rem;
        line-height: 1.35;
        letter-spacing: -.08rem;
    }

    h5 {
        font-size: 1.8rem;
        line-height: 1.5;
        letter-spacing: -.05rem;
    }

    h6 {
        font-size: 1.5rem;
        line-height: 1.6;
        letter-spacing: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    /* Links
    –––––––––––––––––––––––––––––––––––––––––––––––––– */
    a {
        color: #1EAEDB;
    }

    a:hover {
        color: #0FA0CE;
    }

    /* Tables
    –––––––––––––––––––––––––––––––––––––––––––––––––– */
    th,
    td {
        font-size: 0.85em;
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

    /* .titulo {
         display: flex;
         justify-content: center;

     }*/
    .titulo {
        text-align: center;
    }

</style>
<body>
<div>
    <div class="titulo">
        <h4>{{ config('app.name', 'Laravel') }}</h4>
    </div>
    <div>
        <p>
            <b>Generado en:</b>{{  \Carbon\Carbon::now()->format('d-M-Y') }}
        </p>
        <p>
            <b>Modelo: </b>Etiqueta
        </p>
        <p>
            <b>Generado por:</b> {{ auth()->user()->name }}
        </p>
        <p>
            <b>Correo :</b> {{ auth()->user()->email }}
        </p>
        <p><b>Total filas:</b> {{ $especies->count() }}</p>
    </div>
</div>

<table class="rtable" style="margin-top: 1em">
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th style="width: 18%">Creado en</th>
        <th>Actualizado</th>
    </tr>
    </thead>
    <tbody>

    @forelse ($especies as $especie)
        <tr>
            <td>{{ $especie->id }}</td>
            <td>{{ $especie->nombre }}</td>
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
            $y = 15;
            $x = 528;
            $pdf->text($x, $y, $pageText, $font, $size);
           ');
        }

    }


</script>
</html>

