@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 mt-3 w-100">
        <div class="row">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>User</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah
                            User
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Tambah User
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-12 col-4">
                                                        <label for="exampleInputEmail1" class="form-label mt-2">Nama
                                                            User</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Masukan Nama Barang.." />
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-12 col-4">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label mt-2">Username</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Masukan Nama Barang.." />
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex gap-1">
                                                    <div class="col-md-6 col-6">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label mt-2">Password</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Masukan Nama Barang.." />
                                                    </div>
                                                    <div class="col-md-6 col-6 d-block ms-auto">
                                                        <label for="exampleInputEmail1" class="form-label mt-2">Ulangi
                                                            Password</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Masukan Nama Barang.." />
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-12 col-4">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label mt-2">Jabatan</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Masukan Nama Barang.." />
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-12 col-4">
                                                        <label class="form-label">Role</label>
                                                        <select class="form-select form-select mb-3"
                                                            aria-label="Large select example">
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
                        <div class="table-responsive text-nowrap mt-2">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'username',
                        name: 'username',
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        });
    </script>
@endpush
