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
                        <a href="javascript:void(0)" class="btn btn-primary" onclick="add()">Tambah
                            Kategori
                        </a>
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

    @include('pages.data-master.category._partial.model')
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
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
    @include('pages.data-master.category._function.function')
@endpush
