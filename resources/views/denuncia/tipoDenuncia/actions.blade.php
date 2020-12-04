@can('permiso', 'consultar-tipo-denuncia')
    <a class="btn btn-success" href="{{ route('tipodenuncia.show', $id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'editar-tipo-denuncia')
    <a class="btn btn-warning" href="{{ route('tipodenuncia.edit', $id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-tipo-denuncia')
    <form method="POST" action="{{ route('tipodenuncia.destroy', $id) }}" style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan

