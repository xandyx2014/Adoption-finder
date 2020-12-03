@can('permiso', 'consultar-seguimiento-mascota')
    <a class="btn btn-success elevation-2" href="{{ route('seguimiento.show', $data->id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-seguimiento-mascota')
    <a class="btn btn-warning elevation-2" href="{{ route('seguimiento.edit', $data->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-seguimiento-mascota')
    <form method="POST" action="{{ route('seguimiento.destroy', $data->id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan
