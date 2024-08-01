@extends('layouts.app-public')

@section('css')
    {{-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js">
    </script> --}}
@endsection


@section('content')
    <div class="container flex-grow-1 mt-3 w-100">
        <div class="row">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <a href="{{ route('asset-fixed.index') }}">
                                <i class="fa-solid fa-circle-chevron-left"></i>
                            </a> Data Aset
                        </h4>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">Aset Tetap</h4>
                        <div class="table-responsive text-nowrap mt-2">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode BMN</th>
                                        <th>Kode SN</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Kondisi</th>
                                        <th>Penanggung Jawab</th>
                                        {{-- <th>Aksi</th> --}}
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
    @include('pages.data-asset.fixed-assets.action.modal-import')
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            var kode_lokasi = (new URL(location.href)).searchParams.get('kode_lokasi');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Setting up DataTable
            let table = $('#myTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: '{{ route('report.list-public') }}',
                    data: function(d) {
                        d.kode_lokasi = kode_lokasi;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_bmn',
                        name: 'kode_bmn',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'kode_sn',
                        name: 'kode_sn',
                        orderable: false,
                        searchable: false,
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
                    {{-- {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }, --}}

                ],
            });
        })
    </script>
    @include('pages.data-asset.fixed-assets._function.function')
@endsection
