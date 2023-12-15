@extends('layouts.app')

@section('css')
    <style>
        img {
            width: 200px;
        }
    </style>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('report.index') }}">
                                <i class="fa-solid fa-circle-chevron-left"></i>
                            </a> Data Aset</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="visible-print d-blok text-center">
                                    <img src="{{ asset('storage/qrcodes/' . $data->kode_sn . '.png') }}" alt="QR Code"
                                        class="img-fluid" style="width: 150px; height:150px;">
                                    <br>
                                    <a href="{{ route('asset-fixed.downloadQrCode', $data->id) }}"
                                        class="btn btn-primary text-white mt-2 btn-xs">Download Qr Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kode BMN</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->kode_bmn }}
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
                                                {{ $data->subcategory->category->nama_kategori }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Sub Kategori</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->subcategory->nama_sub_kategori }}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jumlah Barang</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                1 {{ $data->unit->nama }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Lokasi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->specificlocation->location->lokasi_umum }}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Sub Lokasi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->specificlocation->lokasi_khusus }}

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
                                                <strong>Mitra</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->procurement->mitra }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jenis Pengadaan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->procurement->jenis_pengadaan }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tahun Pengadaan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ \Carbon\Carbon::parse($data->procurement->tahun_pengadaan)->format('Y') }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Penanggung Jawab / Divisi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->user->nama }} / {{ $data->user->division->nama_divisi }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Kondisi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->kondisi }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Tahun Perolehan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ \Carbon\Carbon::parse($data->tahun_perolehan)->format('Y') }}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
