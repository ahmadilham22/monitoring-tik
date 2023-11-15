@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Kategori Barang</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Kategori
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Tambah Jenis Barang
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('category.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-3 col-4">
                                                        <label for="kode_kategori" class="form-label mt-2">Kode
                                                            Kategori</label>
                                                    </div>
                                                    <div class="col-md-9 col-8">
                                                        <input type="text" class="form-control" name="kode_kategori"
                                                            id="kode_kategori" placeholder="Masukan Nama Barang.."
                                                            value="{{ old('name') }}" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <div class="col-md-3 col-4">
                                                        <label for="kode_kategori" class="form-label mt-2">Nama
                                                            Kategori</label>
                                                    </div>
                                                    <div class="col-md-9 col-8">
                                                        <input type="text" class="form-control" name="nama_kategori"
                                                            id="kode_kategori" placeholder="Masukan Merek.." />
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
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered w-100 table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Terakhir update</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'kode_kategori',
                        name: 'kode_kategori'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'updated_at',
                        name: 'terakhir_update',
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
