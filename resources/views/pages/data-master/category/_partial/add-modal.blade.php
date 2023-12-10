<div class="modal fade" id="AddCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="add_categoryForm" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label mt-2">Kode
                                Kategori</label>
                            <input type="text" class="form-control" name="kode_kategori" id="kode_kategori"
                                placeholder="Masukan Kode Kategori.." />
                        </div>
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label mt-2">Nama
                                Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                                placeholder="Masukan Nama Kategori.." />
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="submit" id="add_category" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
