<div class="d-flex gap-2">
    {{-- <a href="{{ route('goods.main.edit') }}" class="btn btn-warning btn-xs"><i class="bx bx-edit-alt"></i></a> --}}
    <a href="javascript:void(0)" data-toggle="tooltip" onClick="editFunc({{ $id }})" data-original-title="Edit"
        class="edit btn btn-warning btn-xs edit">
        <i class="bx bx-edit-alt"></i>
    </a>
    <a href="javascript:void(0);" id="delete-compnay" onClick="deleteFunc({{ $id }})" data-toggle="tooltip"
        data-original-title="Delete" class="delete btn btn-danger btn-xs">
        <i class="bx bx-trash"></i>
    </a>
</div>
