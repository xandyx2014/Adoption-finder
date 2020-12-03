@can('permiso', 'consultar-solicitud-adopcion')
    <a class="btn btn-success" href="{{ route('solicitud.show', $id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-solicitud-adopcion')
    <a class="btn btn-warning" href="{{ route('solicitud.edit', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-solicitud-adopcion')
    <form method="POST" action="{{ route('solicitud.destroy', $id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan

