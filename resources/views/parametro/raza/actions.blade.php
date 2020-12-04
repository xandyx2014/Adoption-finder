@can('permiso', 'consultar-raza')
    <a class="btn btn-success elevation-2" href="{{ route('raza.show', $id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-raza')
    <a class="btn btn-warning elevation-2" href="{{ route('raza.edit', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-raza')
    <form method="POST" action="{{ route('raza.destroy', $id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan

