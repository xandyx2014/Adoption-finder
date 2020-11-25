<a class="btn btn-success elevation-2" href="{{ route('publicacionAdopcion.show', $data->id) }}" >
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
<a class="btn btn-warning elevation-2" href="{{ route('publicacionAdopcion.edit', $data->id) }}">
    <i class="fa fa-pencil" aria-hidden="true"></i>
</a>
<form method="POST" action="{{ route('publicacionAdopcion.destroy', $data->id) }}" style="display: inline">
    @csrf
    @method('DELETE')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <button type="submit" class="btn btn-danger elevation-2">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>
