@can('permiso', 'editar-denuncia')
    <a class="btn btn-warning" href="{{ route('denuncia.edit', $denuncia->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-denuncia')
    <form method="POST" action="{{ route('denuncia.destroy', $denuncia->id) }}"
          style="display: inline">
        @csrf
        @method('DELETE')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger elevation-2">
            <i class="fa fa-recycle" aria-hidden="true"></i>
        </button>
    </form>
@endcan
