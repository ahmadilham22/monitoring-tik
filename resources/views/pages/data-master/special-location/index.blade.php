@extends('layouts.app')


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
                                        <th>Kode Lokasi</th>
                                        <th>Lokasi Umum</th>
                                        <th>Lokasi Khusus</th>
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
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('special-location.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_lokasi',
                        name: 'kode_lokasi'
                    },
                    {
                        data: 'location.lokasi_umum',
                        name: 'lokasi_umum'
                    },
                    {
                        data: 'lokasi_khusus',
                        name: 'lokasi_khusus'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            });
        });
    </script>
    @include('pages.data-master.special-location._function.function')
@endpush
