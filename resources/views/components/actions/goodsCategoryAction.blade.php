<div class="d-flex gap-2">
    {{-- <a href="{{ route('goods.main.edit') }}" class="btn btn-warning btn-xs"><i class="bx bx-edit-alt"></i></a> --}}
    <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#goodsCategoryEdit"><i
            class="bx bx-edit-alt"></i>
    </button>
    <div class="modal fade" id="goodsCategoryEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="goodsCategoryEdit">
                        Edit Kategori Barang
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 d-flex">
                                <div class="col-md-3 col-4">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Kode
                                        Kategori</label>
                                </div>
                                <div class="col-md-9 col-8">
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-md-3 col-4">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Nama
                                        Kategori</label>
                                </div>
                                <div class="col-md-9 col-8">
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Merek.." />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="" class="" method="POST">
        @csrf
        @method('DELETE')
        <button href="" class="btn btn-danger btn-xs"><i class="bx bx-trash"></i></button>
    </form>
</div>
