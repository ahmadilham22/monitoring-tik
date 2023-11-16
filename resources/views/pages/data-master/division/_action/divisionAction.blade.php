<div class="d-flex gap-2">
    <a href="#" data-toggle="tooltip" onClick="editFunc({{ $data->id }})" data-original-title="Edit"
        class="edit btn btn-warning btn-xs edit">
        <i class="bx bx-edit-alt"></i>
    </a>
    <a href="#" id="delete-compnay" onClick="deleteFunc({{ $data->id }})" data-toggle="tooltip"
        data-original-title="Delete" class="delete btn btn-danger btn-xs">
        <i class="bx bx-trash"></i>
    </a>
</div>
