@extends('layouts.app')

@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Data Aset Tetap</h5>
                        <div class="row">
                            <form action="{{ route('asset-fixed.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kode SN</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="kode_sn" type="text" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Kode SN.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="category_id" class="form-label mt-2">Kategori</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="categorySelect" name="category_id"
                                                class="form-select form-select mb-3">
                                                <option selected>Pilih...</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="sub_category_id" class="form-label mt-2">Sub Kategori</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select id="subcategorySelect" name="sub_category_id"
                                                class="form-select form-select mb-3">
                                                <option selected>Pilih...</option>
                                                @foreach ($subCategory as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-category-id="{{ $item->categories_id }}">
                                                        {{ $item->nama_sub_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Lokasi Umum</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select name="location_id" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                @foreach ($location as $item)
                                                    <option value="{{ $item->id }}">{{ $item->lokasi_umum }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Lokasi Khusus</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select name="specific_location_id" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                @foreach ($specificLocation as $item)
                                                    <option value="{{ $item->id }}">{{ $item->lokasi_khusus }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Mitra</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select name="procurement_id" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                @foreach ($procurement as $item)
                                                    <option value="{{ $item->id }}">{{ $item->mitra }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Penanggung
                                                Jawab</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="penanggung_jawab" type="text" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Penanggung Jawab.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Divisi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select name="division_id" class="form-select form-select mb-3"
                                                aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                @foreach ($division as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_divisi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Jabatan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="jabatan" type="text" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Penanggung Jawab.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Jumlah Barang</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="jumlah_barang" type="text" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Penanggung Jawab.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kondisi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select name="kondisi" class="form-select form-select mb-3 required"
                                                aria-label="Large select example">
                                                <option value="">Pilih...</option>
                                                <option value="Baik">Baik</option>
                                                <option value="Buruk">Buruk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Tahun
                                                Perolehan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input name="tahun_perolehan" type="date" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukan Penanggung Jawab.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Keterangan</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                        </div>
                                    </div>
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    {{-- <script>
        $(document).ready(function() {
            $('#categorySelect').select2({
                placeholder: 'Pilih Kategori',
            });
        })
    </script> --}}
    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            var selectedCategoryId = this.value;
            // console.log(selectedCategoryId);

            // Sembunyikan semua opsi Subkategori
            var subcategories = document.querySelectorAll('#subcategorySelect option');
            subcategories.forEach(function(subcategory) {
                subcategory.style.display = 'none';
            });
            // console.log(subcategories);

            // Tampilkan hanya Subkategori yang sesuai dengan Kategori yang dipilih
            var matchingSubcategories = document.querySelectorAll('#subcategorySelect option[data-category-id="' +
                selectedCategoryId + '"]');
            // console.log(matchingSubcategories);
            matchingSubcategories.forEach(function(subcategory) {
                subcategory.style.display = 'block';
            });
        });
    </script>
@endpush
