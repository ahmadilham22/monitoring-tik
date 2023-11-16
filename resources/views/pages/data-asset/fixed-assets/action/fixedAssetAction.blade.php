    <div class="d-flex gap-2">
        <a href="{{ route('asset-fixed.show', $data->id) }}" class="btn btn-primary btn-xs"><i class="bx bx-show"></i></a>
        <a href="{{ route('asset-fixed.edit') }}" class="btn btn-warning btn-xs"><i class="bx bx-edit-alt"></i></a>
        <form action="{{ route('asset-fixed.destroy', $data->id) }}" class="" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-xs pt-1"><i class="bx bx-trash mb-1"></i></button>
        </form>
    </div>
