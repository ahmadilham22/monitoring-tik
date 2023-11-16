@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengadaan</h4>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary" onclick="add()">Tambah Data
                        </a>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mitra</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Tahun Pengadaan</th>
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

    @include('pages.data-master.procurement._partial.modal')
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
                serverSide: true,
                ajax: "{{ route('procurement.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'mitra',
                        name: 'mitra'
                    },
                    {
                        data: 'jenis_pengadaan',
                        name: 'jenis_pengadaan'
                    },
                    {
                        data: 'tahun_pengadaan',
                        name: 'tahun_pengadaan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });
        });
    </script>
    @include('pages.data-master.procurement._function.function')
@endpush
