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
                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Ubah Data Aset Tetap</h5>
                        <div class="row">
                            <form action="{{ route('asset-fixed.update', $aset->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- Kode BMN --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kode BMN</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="kode_bmn" type="text"
                                                class="form-control @error('kode_bmn') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Kode BMN.."
                                                value="{{ old('kode_bmn', $aset->kode_bmn) }}" />

                                            @error('kode_bmn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Kode BMN --}}

                                    {{-- Kode SN --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kode SN</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="kode_sn" type="text"
                                                class="form-control @error('kode_sn') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukkan Kode SN.."
                                                value="{{ old('kode_sn', $aset->kode_sn) }}" />

                                            @error('kode_sn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Kode SN --}}

                                    {{-- Kategori --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="sub_category_id" class="form-label mt-2">Kategori</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="subcategorySelect" name="sub_category_id"
                                                class="form-select mb-3 @error('sub_category_id') is-invalid @enderror">
                                                <option></option>
                                                @foreach ($subCategories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('sub_category_id', $aset->sub_category_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->category->nama_kategori }} /
                                                        {{ $item->nama_sub_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('sub_category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Kategori --}}

                                    {{-- Lokasi --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Lokasi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="specifiLocationSelect" name="specific_location_id"
                                                class="form-select form-select mb-3 @error('specific_location_id') is-invalid @enderror"
                                                aria-label="Large select example">
                                                <option></option>
                                                @foreach ($specificLocation as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('specific_location_id', $aset->specific_location_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->location->lokasi_umum }} /
                                                        {{ $item->lokasi_khusus }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('specific_location_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Lokasi --}}

                                    {{-- Pengadaan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Mitra</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="procurementSelect" name="procurement_id"
                                                class="form-select form-select mb-3 @error('procurement_id') is-invalid @enderror"
                                                aria-label="Large select example">
                                                <option></option>
                                                @foreach ($procurement as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('procurement_id', $aset->procurement_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->mitra }} /
                                                        {{ $item->jenis_pengadaan }} / {{ $item->tahun_pengadaan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procurement_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Pengadaan --}}

                                    {{-- Penanggung Jawab --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Penanggung
                                                Jawab</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="penanggungJawabSelect" name="user_id"
                                                class="form-select form-select mb-3 @error('user_id') is-invalid @enderror"
                                                aria-label="Large select example">
                                                <option></option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('user_id', $aset->user_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }} /
                                                        {{ $item->division->nama_divisi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Penanggung Jawab --}}

                                    {{-- Unit --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Satuan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="unitSelect" name="unit_id"
                                                class="form-select form-select mb-3 @error('unit_id') is-invalid @enderror"
                                                aria-label="Large select example">
                                                <option></option>
                                                @foreach ($unit as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('unit_id', $aset->unit_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Unit --}}

                                    {{-- Kondisi --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kondisi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="kondisi" name="kondisi"
                                                class="form-select form-select mb-3 required  @error('kondisi') is-invalid @enderror"
                                                aria-label="Large select example">
                                                <option value=""
                                                    {{ old('kondisi', $aset->kondisi) == '' ? 'selected' : '' }}>
                                                    Pilih...</option>
                                                <option value="Baik"
                                                    {{ old('kondisi', $aset->kondisi) === 'Baik' ? 'selected' : '' }}>
                                                    Baik</option>
                                                <option value="Rusak"
                                                    {{ old('kondisi', $aset->kondisi) === 'Rusak' ? 'selected' : '' }}>
                                                    Rusak</option>
                                                <option value="Perbaikan"
                                                    {{ old('kondisi', $aset->kondisi) === 'Perbaikan' ? 'selected' : '' }}>
                                                    Perbaikan</option>
                                            </select>
                                            @error('kondisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Kondisi --}}

                                    {{-- Tahun Perolehan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Tahun
                                                Perolehan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="tahun_perolehan" type="text"
                                                class="form-control @error('tahun_perolehan') is-invalid @enderror"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Penanggung Jawab.."
                                                value="{{ old('tahun_perolehan', $aset->tahun_perolehan) }}" />
                                            @error('tahun_perolehan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Tahun Perolehan --}}

                                    {{-- Gambar Aset --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="image" class="form-label mt-2">Gambar Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror" />
                                        </div>
                                    </div>
                                    {{-- Gambar Aset --}}

                                    {{-- Harga Aset --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="harga" class="form-label mt-2">Harga Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" name="harga"
                                                class="form-control @error('harga') is-invalid @enderror"
                                                value="{{ old('harga', $aset->harga) }}" />
                                        </div>
                                    </div>
                                    {{-- Harga Aset --}}

                                    {{-- Keterangan --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Keterangan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                                id="exampleFormControlTextarea1" rows="5">{{ old('keterangan', $aset->keterangan) }}</textarea>
                                            @error('keterangan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Keterangan --}}

                                    {{-- Button --}}
                                    <div class="mb-3 mt-4 d-flex text-right gap-2">
                                        <a href="{{ url()->previous() }}" class="btn btn-danger px-5" type="submit">
                                            Kembali
                                        </a>
                                        <button class="btn btn-primary px-5" type="submit">
                                            Save
                                        </button>
                                        <div class="col-md-2 col-4"></div>
                                        <div class="col-md-2 col-8"></div>
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
@endsection

@push('addon-script')
    @include('pages.data-asset.fixed-assets._function.function')
@endpush
