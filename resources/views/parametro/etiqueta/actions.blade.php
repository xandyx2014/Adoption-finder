@can('permiso', 'consultar-etiqueta')
    <a class="btn btn-success" href="{{ route('etiqueta.show', $id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-etiqueta')
    <a class="btn btn-warning" href="{{ route('etiqueta.edit', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-etiqueta')
    <form method="POST" action="{{ route('etiqueta.destroy', $id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan

