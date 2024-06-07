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
                        {{-- @if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin') --}}
                        <div class="row">
                            <div class="col-12">
                                {{-- <p class="d-inline-flex gap-2">
                                    <a href="{{ route('asset-fixed.create') }}" class="btn btn-primary mt-2"><i
                                            class="fa-solid fa-plus me-2"></i> Tambah
                                        Data
                                    </a>
                                </p> --}}
                                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa-solid fa-filter me-2"></i> Filter Data
                                </button>
                                <button id="resetFilter" class="btn btn-warning"><i
                                        class="fa-solid fa-arrows-rotate me-2"></i>
                                    Reset
                                    Filter</button>
                                {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#ImportData">
                                        <i class="fa-solid fa-file-import me-2"></i>
                                        Import Data
                                    </button> --}}
                                {{-- @if (Auth::user()->role == 'super_admin')
                                        <button id="deleteAsset" class="btn btn-danger" disabled><i
                                                class="fa-solid fa-trash me-2"></i>
                                            Delete Data</button>
                                    @endif --}}
                            </div>
                        </div>
                        {{-- @endif --}}
                        <div class="collapse" id="collapseExample">
                            <div class="row d-flex">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Kondisi : </label>
                                        <select id="kondisiFilter" class="form-select form-select-sm filter"
                                            aria-label="Large select example">
                                            <option value="">Tampilkan Semua</option>
                                            @foreach ($conditions as $condition)
                                                <option value="{{ $condition }}" id="condition_{{ $condition }}">
                                                    {{ $condition }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-3
                                                    col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Kategori : </label>
                                        <select id="kategoriFilter" class="form-select form-select-sm filter"
                                            aria-label="Large select example">
                                            <option value="">Tampilkan Semua</option>
                                            @foreach ($subcategories as $item)
                                                <option value="{{ $item->id }}" id="id_category_{{ $item->id }}">
                                                    {{ $item->nama_kategori }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Penanggung Jawab : </label>
                                        <select id="pjFilter" class="form-select form-select-sm filter"
                                            aria-label="Large select example">
                                            <option value="">Tampilkan Semua</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" id="id_user_{{ $user->id }}">
                                                    {{ $user->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

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
        let kondisi = $('#kondisiFilter').val();
        let kategori = $('#kategoriFilter').val();
        let pj = $('#pjFilter').val();
        {{-- let kode_lokasi = $('#pjFilter').val(); --}}

        $(document).ready(function() {

            var category_id = (new URL(location.href)).searchParams.get('id_category');
            var user_id = (new URL(location.href)).searchParams.get('id_user');
            var params = new URLSearchParams(window.location.search);
            var condition = params.get('kondisi');
            let kode_lokasi = params.get('kode_lokasi');

            if (category_id !== null || category_id !== undefined) {
                kategori = category_id;
                $('#id_category_' + kategori).attr('selected', true);
            }
            if (user_id !== null || user_id !== undefined) {
                pj = user_id;
                $('#id_user_' + pj).attr('selected', true);
            }
            if (condition !== null || condition !== undefined) {
                kondisi = condition;
                $('#condition_' + kondisi).attr('selected', true);
            }


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Fungsi untuk mengatur button delete all menjadi disable
            function buttonDeleteAll() {
                if ($('input[name="fixedassetcheckbox"]:checked').length > 0) {
                    $('button#deleteAsset').removeAttr('disabled');
                } else {
                    $('button#deleteAsset').attr('disabled', true);
                }
            }

            // Fungsi untuk mengatur ulang status checkbox header
            function resetHeaderCheckbox() {
                $('input[name="main_checkbox"]').prop('checked', false);
            }

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
                        d.kondisi = kondisi;
                        d.kategori = kategori;
                        d.pj = pj;
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

            $.fn.editable.defaults.mode = 'inline';

            table.on('draw.dt', function() {
                $('.editablesn').each(function() {
                    var pk = $(this).data('pk');

                    $(this).editable({
                        url: "{{ route('asset-fixed.update.sn') }}",
                        type: "text",
                        name: "kode_sn",
                        title: "Masukan data",
                        emptytext: '<input type="text"" placeholder="Masukan Kode SN"/>',
                        success: function(response) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                timer: 2000,
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false
                            });
                        },
                        error: function(error) {
                            if (error.responseJSON) {
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    timer: 2000,
                                    icon: 'error',
                                    title: 'Error',
                                    text: error.responseJSON[0],
                                    showConfirmButton: false
                                });
                            }
                        }
                    });
                });
            });

            table.on('draw.dt', function() {
                $('.editablebmn').each(function() {
                    var pk = $(this).data('pk');
                    {{-- console.log('PK:', pk);  --}}

                    $(this).editable({
                        url: "{{ route('asset-fixed.update.bmn') }}",
                        type: "text",
                        name: "kode_sn",
                        title: "Masukan data",
                        emptytext: '<input type="text"" placeholder="Masukan Kode BMN"/>',
                        success: function(response) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                timer: 2000,
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false
                            });
                        },
                        error: function(error) {
                            if (error.responseJSON) {
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    timer: 2000,
                                    icon: 'error',
                                    title: 'Error',
                                    text: error.responseJSON[0],
                                    showConfirmButton: false
                                });
                            }
                        }
                    });
                });
            });

            // Event handler untuk filter
            $('.filter').on('change', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                pj = $('#pjFilter').val();
                table.ajax.reload(null, false);
            })

            // Event handler untuk mereset filter
            $('#resetFilter').on('click', function() {
                $('#kondisiFilter').val('');
                $('#kategoriFilter').val('');
                $('#pjFilter').val('');

                kondisi = '';
                kategori = '';
                pj = '';

                table.search('').draw();
                table.ajax.reload();
            });

            // Event handler untuk penggambaran ulang tabel
            table.on('draw', function() {
                resetHeaderCheckbox();
            });

            // Event handler untuk hapus data individual
            $(document).on('click', '#delete_asset', function(e) {
                e.preventDefault();

                let userId = $(this).val();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            data: {
                                id: userId
                            },
                            url: "fixed/delete/" + userId,
                            dataType: 'json',
                            success: function(res) {
                                var oTable = $('#myTable').dataTable();
                                oTable.fnDraw(false);
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    timer: 2000,
                                    icon: 'success',
                                    title: 'Success',
                                    text: res.message,
                                    showConfirmButton: false
                                })
                            }
                        });
                    }
                });
            });

            // Event handler untuk seleksi checkbox utama
            $(document).on('click', 'input[name="main_checkbox"]', function() {
                if (this.checked) {
                    $('input[name="fixedassetcheckbox"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="fixedassetcheckbox"]').each(function() {
                        this.checked = false;

                    });
                }
            });

            // Event handler untuk mengatur checkbox utama berdasarkan seleksi checkbox individual
            $(document).on('change', 'input[name="fixedassetcheckbox"]', function() {
                if ($('input[name="fixedassetcheckbox"]').length == $(
                        'input[name="fixedassetcheckbox"]:checked').length) {
                    $('input[name="main_checkbox"]').prop('checked', true);
                } else {
                    $('input[name="main_checkbox"]').prop('checked', false);

                }
                buttonDeleteAll();
            });

            // Event handler untuk seleksi checkbox utama
            $('#main_checkbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#deleteAsset').prop('disabled', false);
                } else {
                    $('#deleteAsset').prop('disabled', true);
                }
            });

            // Event handler untuk aksi menghapus data terpilih
            $(document).on('click', 'button#deleteAsset', function() {
                let checkedAsset = [];
                $('input[name="fixedassetcheckbox"]:checked').each(function() {
                    checkedAsset.push($(this).data('id'));
                })


                let url = "{{ route('asset-fixed.destroy.selected') }}"
                if (checkedAsset.length > 0) {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then(function(result) {
                        if (result.value) {
                            $.post(url, {
                                fixedasset_id: checkedAsset
                            }, function(data) {
                                if (data.success) {
                                    var oTable = $('#myTable').dataTable();
                                    oTable.fnDraw(false);
                                    $('button#deleteAsset').attr('disabled', true);
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        timer: 2000,
                                        icon: 'success',
                                        title: 'Success',
                                        text: data.message,
                                        showConfirmButton: false
                                    })
                                }
                            }, 'json');
                        }
                    })
                }
            });

        })
    </script>
    <script></script>
    @if (session('success'))
        <script>
            // Menampilkan SweetAlert jika session flash success ada
            Swal.fire({
                toast: true,
                position: "top-end",
                timer: 2000,
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            // Menampilkan SweetAlert jika session flash success ada
            Swal.fire({
                toast: true,
                position: "top-end",
                timer: 20000,
                icon: 'success',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @endif
    @include('pages.data-asset.fixed-assets._function.function')
@endsection
