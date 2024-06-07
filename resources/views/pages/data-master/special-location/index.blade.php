@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            /* Warna border yang mirip dengan Bootstrap */
            border-radius: .25rem;
            /* Sudut sudut yang sedikit membulat */
            height: calc(2.25rem + 2px);
            /* Tinggi kotak yang sama dengan input Bootstrap */
            line-height: 1.5;
            /* Spasi antara baris yang mirip dengan Bootstrap */
        }

        /* Gaya untuk tombol dropdown */
        .select2-container--default .select2-selection__arrow {
            height: calc(2.25rem + 2px);
            /* Tinggi tombol dropdown yang sama */
        }

        /* Gaya untuk dropdown item */
        .select2-container--default .select2-results__option--highlighted {
            background-color: #f8f9fa;
            /* Warna latar belakang yang mirip dengan Bootstrap */
            color: #495057;
            /* Warna teks yang mirip dengan Bootstrap */
        }
    </style>
@endsection

@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Sub Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary" onclick="add()">Tambah Sub Lokasi
                        </a>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi Umum</th>
                                        <th>Kode Lokasi</th>
                                        <th>Sub Lokasi</th>
                                        <th>Terakhir Update</th>
                                        <th>Kode Qr</th>
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
    @include('pages.data-master.special-location._partial.modal')
    @include('pages.data-master.special-location._partial.qrcode')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                serverSide: true,
                processing: true,
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: "{{ route('special-location.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'location.lokasi_umum',
                        name: 'location.lokasi_umum'
                    },
                    {
                        data: 'kode_lokasi',
                        name: 'kode_lokasi'
                    },
                    {
                        data: 'lokasi_khusus',
                        name: 'lokasi_khusus'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD/MM/YYYY');
                            }
                            return data;
                        }
                    },
                    {
                        data: 'qrcode',
                        name: 'qrcode',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
    @include('pages.data-master.special-location._function.function')
@endpush
