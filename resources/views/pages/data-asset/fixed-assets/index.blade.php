@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 mt-3 w-100">
        <div class="row">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Aset Tetap</h4>
                        <a href="{{ route('asset-fixed.create') }}" class="btn btn-primary">Tambah
                            Data
                        </a>
                        <div class="row mt-4 mb-4 d-flex">
                            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Kondisi</label>
                                    <select id="kondisiFilter" class="form-select form-select-sm"
                                        aria-label="Large select example">
                                        <option value="">Tampilkan Semua</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Buruk">Buruk</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Jenis Aset</label>
                                    <select class="form-select form-select-sm" aria-label="Large select example">
                                        <option selected>Pilih...</option>
                                        <option value="1">Buku</option>
                                        <option value="2">Televisi</option>
                                        <option value="3">laptop</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Jenis Aset</label>
                                    <select class="form-select form-select-sm" aria-label="Large select example">
                                        <option selected>Pilih...</option>
                                        <option value="1">Buku</option>
                                        <option value="2">Televisi</option>
                                        <option value="3">laptop</option>
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="col-sm-3 col-12 d-flex gap-2 mt-4 mx-auto">
                                <button class="btn btn-success btn-sm"><i class="bx bx-export me-2 mb-1"></i>Export
                                    Excel</button>
                                <button class="btn btn-danger btn-sm"><i class="bx bx-export me-2 mb-1"></i>Export
                                    PDF</button>
                            </div> --}}
                        </div>
                        <div class="table-responsive text-nowrap mt-2">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode SN</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Lokasi Umum</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
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
        $('#kondisiFilter').on('change', function() {
            var kondisi = $(this).val();

            $('#myTable').DataTable().ajax.url('{{ route('asset-fixed.index') }}?kondisi=' + kondisi).load();
        });
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('asset-fixed.index') }}",
                    data: function(d) {
                        d.kondisi = $('#kondisiFilter').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_sn',
                        name: 'kode_sn',
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'sub_category_name',
                        name: 'sub_category_name',
                    },
                    {
                        data: 'lokasi_umum',
                        name: 'lokasi_umum'
                    },
                    {
                        data: 'jumlah_barang',
                        name: 'jumlah_barang'
                    },
                    {
                        data: 'kondisi',
                        name: 'kondisi'
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
            // $('#kondisiFilter').on('change', function() {
            //     table.draw();
            // });
        });
    </script>
    @include('pages.data-asset.fixed-assets._function.function')
@endpush
