<a class="btn btn-success" href="{{ route('tipopublicacion.show', $id) }}" >
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
<a class="btn btn-warning" href="{{ route('tipopublicacion.edit', $id) }}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</a>
<form method="POST" action="{{ route('tipopublicacion.destroy', $id) }}" style="display: inline">
    @csrf
    @method('DELETE')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>
