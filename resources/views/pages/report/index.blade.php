@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 mt-3 w-100">
        <div class="row">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Aset Tetap</h4>
                        {{-- Filter --}}
                        <div class="row">
                            <div class="col-12">
                                <p class="d-inline-flex gap-2">
                                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <i class="fa-solid fa-filter me-2"></i> Filter Data
                                    </button>
                                    <button id="resetFilter" class="btn btn-warning"><i
                                            class="fa-solid fa-arrows-rotate me-2"></i>
                                        Reset
                                        Filter</button>
                                </p>
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="fa-solid fa-file-export me-2"></i>
                                    Export Data
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a id="sheet1" class="dropdown-item" href="{{ route('report.export') }}">Sheet
                                            1</a></li>
                                    {{-- <li><a id="sheet2" class="dropdown-item" href="#">Sheet 2</a></li> --}}
                                </ul>
                                <button type="button" class="btn btn-info" id="downloadReport" disabled><i
                                        class="fa-solid fa-download me-2"></i>
                                    Download
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-10">
                                <div class="collapse" id="collapseExample">
                                    <div class="row mt-3 mb-4 d-flex">
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
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Kategori : </label>
                                                <select id="kategoriFilter" class="form-select form-select-sm filter"
                                                    aria-label="Large select example">
                                                    <option value="">Tampilkan Semua</option>
                                                    @foreach ($subcategories as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama_kategori }}
                                                        </option>
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
                                                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap mt-2">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>
                                            <input name="maincheckboxreport[]" class="form-check-input checkboxreport p-2"
                                                type="checkbox" value="" id="maincheckboxreport">
                                        </th>
                                        <th>No</th>
                                        <th>Kode SN</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Lokasi</th>
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

@section('js')
    <script>
        let kondisi = $('#kondisiFilter').val();
        let kategori = $('#kategoriFilter').val();
        let pj = $('#pjFilter').val();

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
                    url: '{{ route('report.index') }}',
                    data: function(d) {
                        d.kondisi = kondisi;
                        d.kategori = kategori;
                        d.pj = pj;
                        // d.reset = reset;
                    }
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
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

                ],
            });

            // Fungsi untuk mengatur ulang status checkbox header
            function resetHeaderCheckbox() {
                $('input[name="maincheckboxreport[]"]').prop('checked', false);
            }

            // Fungsi untuk mengatur button delete all menjadi disable
            function buttonDownload() {
                if ($('input[name="checkboxreport[]"]:checked').length > 0) {
                    $('button#downloadReport').removeAttr('disabled');
                } else {
                    $('button#downloadReport').attr('disabled', true);
                }
            }

            // Event handler untuk filter
            $('.filter').on('change', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                pj = $('#pjFilter').val();
                let sheet2 = $('#sheet2').val();
                let sheet1 = $("#sheet1").attr("href", "{{ route('report.export') }}?kondisi=" + kondisi +
                    "&kategori=" + kategori + "&pj=" + pj);

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

            // Event handler untuk seleksi checkbox utama
            $(document).on('click', 'input[name="maincheckboxreport[]"]', function() {
                if (this.checked) {
                    $('input[name="checkboxreport[]"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="checkboxreport[]"]').each(function() {
                        this.checked = false;

                    });
                }
            });

            // Event handler untuk mengatur checkbox utama berdasarkan seleksi checkbox individual
            $(document).on('change', 'input[name="checkboxreport[]"]', function() {
                if ($('input[name="checkboxreport[]"]').length == $(
                        'input[name="checkboxreport[]"]:checked').length) {
                    $('input[name="maincheckboxreport[]"]').prop('checked', true);
                } else {
                    $('input[name="maincheckboxreport[]"]').prop('checked', false);

                }
                buttonDownload()
            });

            // Event handler untuk seleksi checkbox utama
            $('#maincheckboxreport').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#downloadReport').prop('disabled', false);
                } else {
                    $('#downloadReport').prop('disabled', true);
                }
            });

            // Event handler untuk aksi mendwonload data qrcode terpilih
            $('#downloadReport').click(function() {
                let selectedIds = $('input[name="checkboxreport[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                // console.log(selectedIds);

                if (selectedIds.length > 0) {
                    $.ajax({
                        url: '{{ route('download-selected-qrcodes') }}',
                        type: 'POST',
                        data: {
                            selectedIds: selectedIds
                        },
                        success: function(response) {
                            // Lakukan sesuatu jika unduhan berhasil
                            window.location.href =
                                '{{ route('download-selected-qrcodes-zip') }}';
                        },
                        error: function(xhr, status, error) {
                            // Tampilkan pesan atau lakukan sesuatu jika terjadi kesalahan
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
    @include('pages.data-asset.fixed-assets._function.function')
@endsection

@push('addon-script')
@endpush
