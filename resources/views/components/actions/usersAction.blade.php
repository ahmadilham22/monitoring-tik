<div class="d-flex gap-2">
    {{-- <a href="{{ route('goods.main.edit') }}" class="btn btn-warning btn-xs"><i class="bx bx-edit-alt"></i></a> --}}
    <button type="button" class="btn btn-warning btn-xs" data-bs-toggle="modal" data-bs-target="#userEdit"><i
            class="bx bx-edit-alt"></i>
    </button>
    <div class="modal fade" id="userEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userEdit">
                        Edit User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 d-flex">
                                <div class="col-md-12 col-4">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Nama
                                        User</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-md-12 col-4">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Username</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                            </div>
                            <div class="mb-3 d-flex gap-1">
                                <div class="col-md-6 col-6">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Password</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                                <div class="col-md-6 col-6 d-block ms-auto">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Ulangi
                                        Password</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-md-12 col-4">
                                    <label for="exampleInputEmail1" class="form-label mt-2">Jabatan</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Masukan Nama Barang.." />
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="col-md-12 col-4">
                                    <label class="form-label">Role</label>
                                    <select class="form-select form-select mb-3" aria-label="Large select example">
                                        <option selected>Pilih...</option>
                                        <option value="1">Buku</option>
                                        <option value="2">Televisi</option>
                                        <option value="3">laptop</option>
                                    </select>
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
