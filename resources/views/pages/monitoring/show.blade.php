@extends('layouts.app')


@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Monitoring Data Aset</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
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
                                                {{ $data->kode_sn }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kategori</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->category->nama_kategori }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Sub Kategori</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{-- {{ $data->subcategory->nama_sub_kategori }} --}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jumlah Barang</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->jumlah_barang }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Lokasi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->location->lokasi_umum }}
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
                                                {{ $data->specificLocation->lokasi_khusus }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Penanggung Jawab</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->penanggung_jawab }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jabatan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->jabatan }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tahun Perolehan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->tahun_perolehan }}
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Keterangan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->keterangan }}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
