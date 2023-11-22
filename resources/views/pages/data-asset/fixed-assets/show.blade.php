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
                        <h4>Data Aset</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img class="img-fluid" src="{{ asset('assets/img/illustrations/qr-code.webp') }}"
                                    alt="">
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
                                                1
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Sub Lokasi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->specificlocation->lokasi_khusus }}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Penanggung Jawab</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->user->nama }}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Jabatan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->user->division->nama_divisi }}
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
                                        {{-- <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Periode Pengadaan</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                2019
                                            </div>
                                        </div> --}}
                                        {{-- <hr> --}}

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
