<a class="btn btn-success" href="{{ route('especie.show', $id) }}" >
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
<a class="btn btn-warning" href="{{ route('especie.edit', $id) }}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</a>
<form method="POST" action="{{ route('especie.destroy', $id) }}" style="display: inline">
    @csrf
    @method('DELETE')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>

