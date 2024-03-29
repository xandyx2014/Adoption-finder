@can('permiso', 'consultar-mascota')
    <a class="btn btn-success elevation-2" href="{{ route('mascota.show', $data->id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-mascota')
    <a class="btn btn-warning elevation-2" href="{{ route('mascota.edit', $data->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-mascota')
    <form method="POST" action="{{ route('mascota.destroy', $data->id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan
