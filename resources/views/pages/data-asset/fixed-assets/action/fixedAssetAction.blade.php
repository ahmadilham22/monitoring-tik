    <div class="d-flex gap-2">
        <a href="{{ route('asset-fixed.show', $data->id) }}" class="btn btn-primary btn-xs"><i class="bx bx-show"></i></a>
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin')
            <a href="{{ route('asset-fixed.edit', $data->id) }}" class="btn btn-warning btn-xs"><i
                    class="bx bx-edit-alt"></i></a>
            {{-- <form action="{{ route('asset-fixed.destroy', $data->id) }}" class="" id="assetDeleteForm"
                method="POST">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" id="deleteFixedAsset" class="btn btn-danger btn-xs pt-1"
                    data-confirm-delete="true" data-toggle="tooltip" title='Delete'><i
                        class="bx bx-trash mb-1"></i></button>
            </form> --}}
            <button value="{{ $data->id }}" id="delete_asset" data-toggle="tooltip" data-original-title="Delete"
                class="delete btn btn-danger btn-xs">
                <i class="bx bx-trash"></i>
            </button>
        @endif
    </div>
