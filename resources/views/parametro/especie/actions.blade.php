@can('permiso', 'consultar-especie')
    <a class="btn btn-success elevation-2" href="{{ route('especie.show', $id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso','editar-especie')
    <a class="btn btn-warning elevation-2" href="{{ route('especie.edit', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-especie')
    <form method="POST" action="{{ route('especie.destroy', $id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan
