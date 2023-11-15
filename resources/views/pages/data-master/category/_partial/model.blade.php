<div class="modal fade" id="category-model" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <div class="modal-body"> --}}
            <form action="javascript:void(0)" id="categoryForm" name="categoryForm" class="form-horizontal"
                method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 d-flex">
                            <div class="col-md-3 col-4">
                                <label for="kode_kategori" class="form-label mt-2">Kode
                                    Kategori</label>
                            </div>
                            <div class="col-md-9 col-8">
                                <input type="text" class="form-control" name="kode_kategori" id="kode_kategori"
                                    placeholder="Masukan Nama Barang.." value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="col-md-3 col-4">
                                <label for="kode_kategori" class="form-label mt-2">Nama
                                    Kategori</label>
                            </div>
                            <div class="col-md-9 col-8">
                                <input type="text" class="form-control" name="nama_kategori" id="nama_kategori"
                                    placeholder="Masukan Merek.." />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
            {{-- </div> --}}
        </div>
    </div>
</div>
