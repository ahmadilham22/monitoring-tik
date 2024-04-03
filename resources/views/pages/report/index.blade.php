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
                                    <li><a id="sheet1" href="{{ route('report.export') }}" class="dropdown-item">Sheet
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
                                                        <option value="{{ $condition }}"
                                                            id="condition_{{ $condition }}">{{ $condition }}</option>
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
                                                        <option value="{{ $item->id }}"
                                                            id="id_category_{{ $item->id }}">
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
                                                        <option value="{{ $user->id }}"
                                                            id="id_user_{{ $user->id }}">{{ $user->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Periode : </label>
                                                <select id="periodeFilter" class="form-select form-select-sm filter"
                                                    aria-label="Large select example">
                                                    <option value="">Tampilkan Semua</option>
                                                    @foreach ($periods as $period)
                                                        <option value="{{ $period }}"
                                                            id="period_{{ $period }}">{{ $period }}
                                                        </option>
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
        let periode = $('#periodeFilter').val();
        console.log(periode);
        let sn = [];
        $(document).ready(function() {
            var category_id = (new URL(location.href)).searchParams.get('id_category');
            var user_id = (new URL(location.href)).searchParams.get('id_user');
            var params = new URLSearchParams(window.location.search);
            var condition = params.get('kondisi');
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
                        d.periode = periode;
                        console.log(d);
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

            // Event handler untuk filter
            $('.filter').on('change', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                pj = $('#pjFilter').val();
                periode = $('#periodeFilter').val();
                console.log(periode);
                let sheet1 = $("#sheet1").attr("href", "{{ route('report.export') }}?kondisi=" + kondisi +
                    "&kategori=" + kategori + "&pj=" + pj + "&periode=" + periode);

                table.ajax.reload(null, false);
            })

            $(document).on('change', 'input[name="checkboxreport[]"]', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                pj = $('#pjFilter').val();
                if ($(this).is(":checked")) {
                    sn = $('input[name="checkboxreport[]"]:checked').map(function() {
                        return $(this).val();
                    }).get();
                    // console.log(sn);
                    let sheet1 = $("#sheet1").attr("href", "{{ route('report.export') }}?kondisi=" +
                        kondisi +
                        "&kategori=" + kategori + "&pj=" + pj + "&periode" + periode + "&sn=" + sn);
                } else {
                    console.log("Checkbox is not checked!");
                }
            });

            $(document).on('change', 'input[name="maincheckboxreport[]"]', function() {
                kondisi = $('#kondisiFilter').val();
                kategori = $('#kategoriFilter').val();
                pj = $('#pjFilter').val();
                periode = $('#periodeFilter').val();
                if ($(this).is(":checked")) {
                    sn = $('input[name="checkboxreport[]"]:checked').map(function() {
                        return $(this).val();
                    }).get();
                    console.log(sn);
                    let sheet1 = $("#sheet1").attr("href", "{{ route('report.export') }}?kondisi=" +
                        kondisi +
                        "&kategori=" + kategori + "&pj=" + pj + "&periode" + periode + "&sn=" + sn);
                } else {
                    console.log("Checkbox is not checked!");
                }
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

            // Event handler untuk mereset filter
            $('#resetFilter').on('click', function() {
                $('#kondisiFilter').val('');
                $('#kategoriFilter').val('');
                $('#pjFilter').val('');
                $('#periodeFilter').val('');

                kondisi = '';
                kategori = '';
                pj = '';
                periode = '';

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

            // $('#sheet1').click(function() {

            //     kondisi = $('#kondisiFilter').val();
            //     kategori = $('#kategoriFilter').val();
            //     pj = $('#pjFilter').val();
            //     let data = [

            //     ]
            //     console.log(sn);

            //     $.ajax({
            //         url: '{{ route('report.export') }}',
            //         type: 'GET',
            //         data: {
            //             sn: sn
            //         },
            //         success: function(response) {
            //             console.log('success');
            //             // console.log(response);
            //         },
            //         error: function(error) {
            //             console.error(error);
            //         }
            //     })
            // })
        });
    </script>
    @include('pages.data-asset.fixed-assets._function.function')
@endsection

@push('addon-script')
@endpush
