<a class="btn btn-success" href="{{ route('especie.show', $id) }}">
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
<form method="POST" action="{{ route('especie.update', $id) }}?restore=true" style="display: inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>
<form method="POST" action="{{ route('especie.destroy', $id) }}?bin=true" style="display: inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
</form>
