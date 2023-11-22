<div class="modal fade" id="subCategory-model" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Lokasi Umum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="subCategoryForm" name="subCategoryForm" class="form-horizontal"
                method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            {{-- <div class="col-12"> --}}
                            <label class="form-label">Kategori</label>
                            {{-- </div> --}}
                            {{-- <div class="col-12"> --}}
                            <select id="cat_id" class="form-select" name="categories_id" id="categories_id"
                                aria-label="Large select example">
                                <option value=""></option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode_kategori }} /
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- </div> --}}
                        </div>
                        <div class="mb-3">
                            <label for="kode_sub_kategori" class="form-label">Kode Sub
                                Kategori</label>
                            <input type="text" name="kode_sub_kategori" id="kode_sub_kategori" class="form-control"
                                placeholder="Masukan Kode...">
                        </div>
                        <div class="mb-3">
                            <label for="nama_sub_kategori" class="form-label">Nama Sub
                                Kategori</label>
                            <input type="text" name="nama_sub_kategori" id="nama_sub_kategori" class="form-control"
                                placeholder="Masukan Nama...">
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
        </div>
    </div>
</div>
