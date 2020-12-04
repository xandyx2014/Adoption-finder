@can('permiso', 'consultar-publicacion-informativa')
    <a class="btn btn-success elevation-2" href="{{ route('publicacion.show', $data->id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-publicacion-informativa')
    <a class="btn btn-warning elevation-2" href="{{ route('publicacion.edit', $data->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-publicacion-informativa')
    <form method="POST" action="{{ route('publicacion.destroy', $data->id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan

