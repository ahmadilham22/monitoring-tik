@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 mt-3 w-100">
        <div class="row">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Laporan</h4>
                        <a href="{{ route('report.create') }}" class="btn btn-primary">Tambah
                            Data
                        </a>
                        {{-- <div class="row mt-4 mb-4">
                            <div class="col-md-12 d-flex">
                                <div class="col-8 d-flex gap-4">
                                    <div class="col-sm-3">
                                        <label class="form-label">Jenis Aset</label>
                                        <select class="form-select form-select-sm" aria-label="Large select example">
                                            <option selected>Pilih...</option>
                                            <option value="1">Buku</option>
                                            <option value="2">Televisi</option>
                                            <option value="3">laptop</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-select form-select-sm" aria-label="Large select example">
                                            <option selected>Pilih...</option>
                                            <option value="1">Buku</option>
                                            <option value="2">Televisi</option>
                                            <option value="3">laptop</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">SUb Kategori</label>
                                        <select class="form-select form-select-sm" aria-label="Large select example">
                                            <option selected>Pilih...</option>
                                            <option value="1">Buku</option>
                                            <option value="2">Televisi</option>
                                            <option value="3">laptop</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-4 col-4 justify-content-end me-5">
                                    <button class="btn btn-success btn-sm"><i class="bx bx-export me-2 mb-1"></i>Export
                                        Excel</button>
                                    <button class="btn btn-danger btn-sm"><i class="bx bx-export me-2 mb-1"></i>Export
                                        PDF</button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="table-responsive text-nowrap mt-2">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Lokasi Umum</th>
                                        <th>Jumlah</th>
                                        <th>Penanggung Jawab</th>
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
                ajax: "{{ route('report.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'sub_kategori',
                        name: 'sub_kategori',
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'penanggung_jawab',
                        name: 'penanggung_jawab'
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
