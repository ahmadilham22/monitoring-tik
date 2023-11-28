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
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Kondisi : </label>
                                    <select id="kondisiFilter" class="form-select form-select-sm filter"
                                        aria-label="Large select example">
                                        <option value="">Tampilkan Semua</option>
                                        @foreach ($conditions as $condition)
                                            <option value="{{ $condition }}">{{ $condition }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Kategori</label>
                                    <select id="kategoriFilter" class="form-select form-select-sm filter"
                                        aria-label="Large select example">
                                        <option value="">Tampilkan Semua</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-3 col-md-6 col-sm-12">
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
                                        <th>Lokasi</th>
                                        <th>Kondisi</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Aksi</th>
                                        <th></th>
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

@section('js')
    {{-- <script>
        $(function() {
            $(document).on('click', '#deleteFixedAsset', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            })
        });
    </script> --}}
@endsection

@push('addon-script')
    <script>
        let kondisi = $('#kondisiFilter').val();
        let kategori = $('#kategoriFilter').val();
        $(document).ready(function() {
            let table = $('#myTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: '{{ route('asset-fixed.index') }}',
                    data: function(d) {
                        d.kondisi = kondisi;
                        d.kategori = kategori;
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
                        data: 'subcategory.category.nama_kategori',
                        name: 'subcategory.category.nama_kategori',
                    },
                    {
                        data: 'subcategory.nama_sub_kategori',
                        name: 'subcategory.nama_sub_kategori',
                    },
                    {
                        data: 'specificlocation.location.lokasi_umum',
                        name: 'specificlocation.location.lokasi_umum'
                    },
                    {
                        data: 'kondisi',
                        name: 'kondisi'
                    },
                    {
                        data: 'user.nama',
                        name: 'user.nama'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('.filter').on('change', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                table.ajax.reload(null, false);
            })
        });
    </script>
    @include('pages.data-asset.fixed-assets._function.function')
@endpush
