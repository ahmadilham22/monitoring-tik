@extends('layouts.app')

@section('css')
    <link href="http://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
                    <div class="card-body">
                        <div class="col-lg-12 d-flex">
                            <h5 class="card-title fw-semibold mb-4">Form Data Aset Tetap</h5>
                            <button id="resetData" class="btn btn-warning btn-xs ms-auto" type="submit"><i
                                    class="fa-solid fa-rotate me-2"></i>
                                Reset Data
                            </button>
                        </div>
                        <div class="row mt-3">
                            <form action="#" method="POST" enctype="multipart/form-data" id="FixedAssetForm">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    {{-- Kode BMN --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="kode_bmn" class="form-label mt-2">Kode BMN</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="kode_bmn" type="text" class="form-control" id="kode_bmn"
                                                placeholder="Masukan Kode BMN.." />
                                        </div>
                                    </div>
                                    {{-- Kode BMN --}}

                                    {{-- Kode SN --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="kode_sn" class="form-label mt-2">Kode SN</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="kode_sn" type="text" class="form-control" id="kode_sn"
                                                placeholder="Masukan Kode SN.." />
                                        </div>
                                    </div>
                                    {{-- Kode SN --}}

                                    {{-- Kategori --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="sub_category_id" class="form-label mt-2">Kategori</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="subcategorySelect" name="sub_category_id" class="form-select mb-3 ">
                                                <option></option>
                                                @foreach ($subCategories as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->category->nama_kategori }} /
                                                        {{ $item->nama_sub_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Kategori --}}

                                    {{-- Lokasi --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="specific_location" class="form-label mt-2">Lokasi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="specifiLocationSelect" name="specific_location_id"
                                                class="form-select form-select mb-3" aria-label="Large select example">
                                                <option></option>
                                                @foreach ($specificLocation as $item)
                                                    <option value="{{ $item->id }}">{{ $item->location->lokasi_umum }} /
                                                        {{ $item->lokasi_khusus }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Lokasi --}}

                                    {{-- Pengadaan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="procurement" class="form-label mt-2">Mitra</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="procurementSelect" name="procurement_id"
                                                class="form-select form-select mb-3" aria-label="Large select example">
                                                <option></option>
                                                @foreach ($procurement as $item)
                                                    <option value="{{ $item->id }}">{{ $item->mitra }} /
                                                        {{ $item->jenis_pengadaan }} / {{ $item->tahun_pengadaan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Pengadaan --}}

                                    {{-- Penanggung Jawab --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="user" class="form-label mt-2">Penanggung
                                                Jawab</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="penanggungJawabSelect" name="user_id"
                                                class="form-select form-select mb-3" aria-label="Large select example">
                                                <option></option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }} /
                                                        {{ $item->division->nama_divisi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Penanggung Jawab --}}

                                    {{-- Unit --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="unit" class="form-label mt-2">Satuan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="unitSelect" name="unit_id" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                                <option></option>
                                                @foreach ($unit as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Unit --}}

                                    {{-- Kondisi --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="kondisi" class="form-label mt-2">Kondisi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="kondisi" name="kondisi"
                                                class="form-select form-select mb-3 required"
                                                aria-label="Large select example">
                                                <option value="">Pilih...</option>
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak">Rusak</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- Kondisi --}}

                                    {{-- Tahun Perolehan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="tahun_perolehan" class="form-label mt-2">Tahun
                                                Perolehan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="tahun_perolehan" type="text" class="form-control"
                                                id="tahun_perolehan" placeholder="Masukan Tahun Perolehan.." />
                                        </div>
                                    </div>
                                    {{-- Tahun Perolehan --}}

                                    {{-- Gambar Aset --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="image" class="form-label mt-2">Gambar Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="file" name="image" class="form-control" />
                                        </div>
                                    </div>
                                    {{-- Gambar Aset --}}

                                    {{-- Harga Aset --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="harga" class="form-label mt-2">Harga Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" name="harga" class="form-control" />
                                        </div>
                                    </div>
                                    {{-- Harga Aset --}}

                                    {{-- Keterangan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="keterangan" class="form-label mt-2">Keterangan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <textarea name="keterangan" class="form-control" id="keterangan" rows="5"></textarea>
                                        </div>
                                    </div>
                                    {{-- Keterangan --}}

                                    {{-- Button --}}
                                    <div class="mb-3 mt-4 d-flex text-right gap-2">
                                        <a href="{{ route('asset-fixed.index') }}" class="btn btn-danger px-5"
                                            type="submit">
                                            Kembali
                                        </a>
                                        <button class="btn btn-primary px-5" type="submit">
                                            Save
                                        </button>
                                        <div class="auto-load text-center" style="display: none; z-index: 100;">
                                            <div class="d-flex justify-content-center">
                                                <div class="spinner-border" role="status">
                                                    {{-- <span>Loading...</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-2 col-4"></div>
                                        <div class="col-md-2 col-8"></div> --}}
                                    </div>
                                    {{-- Button --}}

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="http://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#resetData').on('click', function(e) {
            $('#FixedAssetForm :input').val('');
            $('#FixedAssetForm select').val('').trigger('change');
        })
        $('#FixedAssetForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                type: 'POST',
                beforeSend: function() {
                    $('.auto-load').show();
                },
                url: "{{ route('asset-fixed.store.ajax') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('.auto-load').hide();
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false
                    });

                    $('#kode_bmn').val('');
                    $('#kode_sn').val('');
                    $('#keterangan').val('');
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

                        $('.auto-load').hide();
                    }
                }
            });
        });
    </script>
@endsection

@push('addon-script')
    @include('pages.data-asset.fixed-assets._function.function')
@endpush
