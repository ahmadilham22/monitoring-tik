@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Aset</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        {{-- <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tampilkan Gambar</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#gambar">Tampilkan
                                                </button>
                                                <div class="modal fade" id="gambar" tabindex="-1"
                                                    aria-labelledby="gambarLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="gambarLabel">
                                                                    Gambar Laptop Acer Nitro 5
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row justify-content-center">
                                                                    <img class="img-fluid w-75 h-100"
                                                                        src="{{ asset('assets/img/illustrations/acer-nitro-5.jpg') }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="button" class="btn btn-primary">
                                                                    Save changes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr> --}}
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tampilkan Qr Code</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#qrCode">Tampilkan
                                                </button>
                                                <div class="modal fade" id="qrCode" tabindex="-1"
                                                    aria-labelledby="qrCodeLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="qrCodeLabel">
                                                                    Qr Code Laptop Acer Nitro 5
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row justify-content-center">
                                                                    <img class="img-fluid w-75 h-100"
                                                                        src="{{ asset('assets/img/illustrations/qr-code.webp') }}"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="button" class="btn btn-primary">
                                                                    Save changes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kode SN</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                ALDASDUAD120912
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kategori</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Laptop
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Sub Kategori</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Laptop Acer Nitro 5
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jumlah Barang</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                200
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Lokasi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Gedung TIK Universitas Lampung
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Lokasi Terinci</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Ruang H-18
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Penanggung Jawab</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                John Doe
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jabatan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Staff
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kondisi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim molestiae
                                                sapiente ipsam in cupiditate, fugiat voluptatem nisi laudantium ratione?
                                                Sapiente!
                                            </div>
                                        </div>
                                        <hr> --}}
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Periode Pengadaan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                2019
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tahun Perolehan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                2019
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
