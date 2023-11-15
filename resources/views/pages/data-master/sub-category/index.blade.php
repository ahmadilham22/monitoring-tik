@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Sub Kategori Barang</h4>
                    </div>
                    <div class="card-body">
                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Data
                        </button> --}}
                        <button type="button" class="btn btn-primary" onclick="create()">Tambah Data
                        </button>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sub Kategori</th>
                                        <th>Nama Sub Kategori</th>
                                        <th>Terakhir Update</th>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Tambah Data
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page">

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
                {{-- <form action="{{ route('sub-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                </form> --}}
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
                ajax: "{{ route('sub-category.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    }, {
                        data: 'kode_sub_kategori',
                        name: 'kode_sub_kategori'
                    },
                    {
                        data: 'nama_sub_kategori',
                        name: 'nama_sub_kategori'
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
    <script>
        $(document).ready(function() {

        });

        function create() {
            $.get("{{ route() }}")
            $('#exampleModal').modal('show');
        }
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#cat_id').select2({
                tags: "true",
                placeholder: "Select an option",
                allowClear: true
            });
        })
    </script> --}}
@endpush
