<div class="d-flex gap-2">
    <a href="{{ route('asset-moved.show') }}" class="btn btn-primary btn-xs"><i class="bx bx-show"></i></a>
    <a href="{{ route('asset-moved.edit') }}" class="btn btn-warning btn-xs"><i class="bx bx-edit-alt"></i></a>
    <form action="" class="" method="POST">
        @csrf
        @method('DELETE')
        <button href="" class="btn btn-danger btn-xs"><i class="bx bx-trash"></i></button>
    </form>
</div>
