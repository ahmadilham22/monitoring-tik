<div class="modal fade" id="EditSubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Sub Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="edit_subcategoryForm" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_subcategory_id">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select id="edit_categories_id" class="form-select" name="edit_categories_id" required>
                                <option value="" selected></option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode_kategori }} /
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_sub_kategori" class="form-label">Kode Sub
                                Kategori</label>
                            <input type="text" name="edit_kode_sub_kategori" id="edit_kode_sub_kategori"
                                class="form-control" placeholder="Masukan Kode..." required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_sub_kategori" class="form-label">Nama Sub
                                Kategori</label>
                            <input type="text" name="edit_nama_sub_kategori" id="edit_nama_sub_kategori"
                                class="form-control" placeholder="Masukan Nama..." required>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" id="update_subcategory" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
