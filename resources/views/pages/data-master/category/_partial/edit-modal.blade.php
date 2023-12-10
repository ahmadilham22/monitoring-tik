<div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="edit_categoryForm" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="edit_category_id">
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label mt-2">Kode
                                Kategori</label>
                            <input type="text" class="form-control" name="edit_kode_kategori" id="edit_kode_kategori"
                                placeholder="Masukan Nama Barang.." />
                        </div>
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label mt-2">Nama
                                Kategori</label>
                            <input type="text" class="form-control" name="edit_nama_kategori" id="edit_nama_kategori"
                                placeholder="Masukan Merek.." />
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" id="update_category" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
