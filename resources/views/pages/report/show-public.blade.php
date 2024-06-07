@extends('layouts.app-public')


@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="visible-print d-blok text-center">
                                    <img src="{{ asset('storage/qrcodes/' . $data->qrcode) }}" alt="QR Code"
                                        class="img-fluid" style="height: 150px; object-fit:cover">
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
                                        <hr>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="col-sm-4">
                                                <strong>Penanggung Jawab / Divisi</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->user->nama }} / {{ $data->user->division->nama_divisi }}
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
                                                <strong>Kondisi Saat Ini</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $latestHistory->kondisi }}
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
                                                <strong>Harga</strong>
                                            </div>
                                            <div class="col-sm-8">
                                                {{ $data->harga }}
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
                            {{-- <div class="col-sm-12 mt-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="col-12 d-block justify-content-center align-items-center">
                                            <div class="visible-print d-blok text-center">
                                                <h4>Gambar Aset</h4>
                                                <br>
                                                <img src="{{ asset('storage/assetImage/' . $data->image) }}"
                                                    alt="Gambar Aset" class="img-fluid w-75">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row mt-3">
                            {{-- <div class="col-sm-6">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h4 class="text-center">Gambar Aset</h4>
                                        <div class="d-flex justify-content-center gap-3">
                                            <div class="visible-print d-blok text-center mt-3">
                                                <img src="{{ asset('storage/assetImage/' . $data->image) }}"
                                                    alt="Gambar Aset" class="img-fluid w-75">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-sm-12">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <h4 class="text-center">Kondisi dan Gambar Aset</h4>
                                        <div class="d-flex justify-content-between gap-3">
                                            {{-- <div class="col-sm-4">
                                                    <strong>Kondisi</strong>
                                                </div>
                                                <div class="col-sm-8">
                                                    {{ $history->kondisi }} / {{ $history->created_at }}
                                                    <hr />
                                                </div> --}}
                                            <table id="myTable" class="table table-bordered table-sm w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Kondisi</th>
                                                        <th class="d-flex justify-content-center">Gambar</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($data->histories as $history)
                                                    <tbody class="table-border-bottom-0">
                                                        <td>{{ $history->kondisi }}</td>
                                                        <td class="d-flex justify-content-center"> <img
                                                                src="{{ asset('storage/assetImage/' . $history->image) }}"
                                                                alt="QR Code" class="img-fluid"
                                                                style="height: 300px; object-fit:cover"></td>
                                                        <td>{{ $history->created_at }}</td>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12 mt-3">
                                <div class="card bg-light h-100">
                                    <div class="card-body">
                                        <div class="col-12 d-block justify-content-center align-items-center">
                                            <div class="visible-print d-blok text-center">
                                                <h4>Gambar Aset</h4>
                                                <br>
                                                <img src="{{ asset('storage/assetImage/' . $data->image) }}"
                                                    alt="Gambar Aset" class="img-fluid w-75">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
