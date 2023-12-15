@extends('layouts.app')

@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Form Data Aset Tetap</h5>
                        <div class="row">
                            <form action="">
                                <div class="row">
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kode Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Kode Aset.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Nama Aset</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Nama Aset.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Nama Barang</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select class="form-select form-select mb-3" aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                <option value="1">Buku</option>
                                                <option value="2">Televisi</option>
                                                <option value="3">laptop</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kategori</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select class="form-select form-select mb-3" aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                <option value="1">Buku</option>
                                                <option value="2">Televisi</option>
                                                <option value="3">laptop</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kategori</label>
                                        </div>
                                        <div class="col-md-5 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Jumlah Barang.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Sub Kategori</label>
                                        </div>
                                        <div class="col-md-5 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Jumlah Barang.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Merek</label>
                                        </div>
                                        <div class="col-md-5 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Jumlah Barang.." />
                                        </div>
                                    </div> --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Lokasi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select class="form-select form-select mb-3" aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                <option value="1">Buku</option>
                                                <option value="2">Televisi</option>
                                                <option value="3">laptop</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Lokasi Terinci</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <select class="form-select form-select mb-3" aria-label="Large select example">
                                                <option selected>Pilih...</option>
                                                <option value="1">Buku</option>
                                                <option value="2">Televisi</option>
                                                <option value="3">laptop</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Jumlah Barang</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Jumlah Barang.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Penanggung
                                                Jawab</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="Masukan Penanggung Jawab.." />
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="col-md-3 mt-2 col-4">
                                            <label for="exampleInputEmail1" class="form-label mt-2">Kondisi</label>
                                        </div>
                                        <div class="col-md-7 col-8">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
