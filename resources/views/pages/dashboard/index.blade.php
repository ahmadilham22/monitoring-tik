@extends('layouts.app')

@section('css')
    <style>
        .swal2-container {
            z-index: 1000;
        }
    </style>
@endsection

@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 mb-3 order-0">
                <div class="card">
                    <div class="d-flex align-items-end">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary mb-5">
                                    Selamat Datang, {{ Auth::user()->nama }}! 🎉
                                </h3>
                                <p class="mb-4">
                                    {{-- You have done <span class="fw-bold">72%</span> more
                                    sales today. Check your new badge in your profile. --}}
                                </p>
                                {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                    Badges</a> --}}
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            {{-- Data Aset --}}
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Aset Tetap</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($data as $item)
                                <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                            <div class="card-title mb-0">
                                                <h5 class="m-0 me-2 mb-3">{{ $item->subcategory->category->nama_kategori }}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <h2 class="mb-2">{{ $item->total_count }}</h2>
                                                </div>
                                            </div>
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1 me-2">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-info"><i
                                                                class="bx bx-check"></i></span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Baik</h6>
                                                        </div>
                                                        <div class="user-progress">
                                                            <small class="fw-semibold">190</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="d-flex mb-4 pb-1 me-2">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <span class="avatar-initial rounded bg-label-danger"><i
                                                                class="bx bx-x"></i></span>
                                                    </div>
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Rusak</h6>
                                                            {{-- <small class="text-muted">Football, Cricket Kit</small> --}}
                                                        </div>
                                                        <div class="user-progress">
                                                            <small class="fw-semibold">10</small>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="col-lg-12 d-flex">
                                                <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="">
                                <div class="collapse" id="dataAsetTetap">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div
                                                    class="card-header d-flex align-items-center justify-content-between pb-0">
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-0 me-2 mb-3">Laptop</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex flex-column align-items-center gap-1">
                                                            <h2 class="mb-2">200</h2>
                                                            <!-- <span>Total Orders</span> -->
                                                        </div>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-info"><i
                                                                        class="bx bx-check"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Baik</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">190</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-danger"><i
                                                                        class="bx bx-x"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Rusak</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">10</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="demo-inline-spacing d-flex justify-content-end">
                                    <a data-bs-toggle="collapse" href="#dataAsetTetap" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Aset Tetap Lainnya <i class="bx bx-chevron-right"></i>
                                    </a>
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data Aset --}}
            {{-- Data Aset --}}
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Aset Tetap</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <h5 class="m-0 me-2 mb-3">Laptop</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <h2 class="mb-2">200</h2>
                                                <!-- <span>Total Orders</span> -->
                                            </div>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Baik</h6>
                                                        {{-- <small class="text-muted">Fine Art, Dining</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Rusak</h6>
                                                        {{-- <small class="text-muted">Football, Cricket Kit</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <h5 class="m-0 me-2 mb-3">Laptop</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <h2 class="mb-2">200</h2>
                                                <!-- <span>Total Orders</span> -->
                                            </div>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Baik</h6>
                                                        {{-- <small class="text-muted">Fine Art, Dining</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Rusak</h6>
                                                        {{-- <small class="text-muted">Football, Cricket Kit</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <h5 class="m-0 me-2 mb-3">Laptop</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <h2 class="mb-2">200</h2>
                                                <!-- <span>Total Orders</span> -->
                                            </div>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Baik</h6>
                                                        {{-- <small class="text-muted">Fine Art, Dining</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Rusak</h6>
                                                        {{-- <small class="text-muted">Football, Cricket Kit</small> --}}
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="collapse" id="dataAsetBerjalan">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div
                                                    class="card-header d-flex align-items-center justify-content-between pb-0">
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-0 me-2 mb-3">Total Aset</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex flex-column align-items-center gap-1">
                                                            <h2 class="mb-2">200</h2>
                                                            <!-- <span>Total Orders</span> -->
                                                        </div>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-info"><i
                                                                        class="bx bx-home-alt"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Decor</h6>
                                                                    <small class="text-muted">Fine Art, Dining</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">849k</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-secondary"><i
                                                                        class="bx bx-football"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Sports</h6>
                                                                    <small class="text-muted">Football, Cricket Kit</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">99</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div
                                                    class="card-header d-flex align-items-center justify-content-between pb-0">
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-0 me-2 mb-3">Total Aset</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex flex-column align-items-center gap-1">
                                                            <h2 class="mb-2">200</h2>
                                                            <!-- <span>Total Orders</span> -->
                                                        </div>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-info"><i
                                                                        class="bx bx-home-alt"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Decor</h6>
                                                                    <small class="text-muted">Fine Art, Dining</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">849k</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-secondary"><i
                                                                        class="bx bx-football"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Sports</h6>
                                                                    <small class="text-muted">Football, Cricket Kit</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">99</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div
                                                    class="card-header d-flex align-items-center justify-content-between pb-0">
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-0 me-2 mb-3">Total Aset</h5>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex flex-column align-items-center gap-1">
                                                            <h2 class="mb-2">200</h2>
                                                            <!-- <span>Total Orders</span> -->
                                                        </div>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-info"><i
                                                                        class="bx bx-home-alt"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Decor</h6>
                                                                    <small class="text-muted">Fine Art, Dining</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">849k</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded bg-label-secondary"><i
                                                                        class="bx bx-football"></i></span>
                                                            </div>
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Sports</h6>
                                                                    <small class="text-muted">Football, Cricket Kit</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">99</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="demo-inline-spacing d-flex justify-content-end">
                                    <a data-bs-toggle="collapse" href="#dataAsetBerjalan" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        Aset Berjalan Lainnya <i class="bx bx-chevron-right"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Data Aset --}}
            {{-- User --}}
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>User</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-1 mb-3">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                    class="img-fluid rounded me-3" height="50" width="50"
                                                    alt="">
                                                <h4 class="mb-2">John Doe </h4>
                                            </div>
                                        </div>
                                        <div class="">
                                            <h5><strong>Penanggung Jawab Aset</strong></h5>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-1 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Laptop</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ac</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-1 mb-3">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                    class="img-fluid rounded me-3" height="50" width="50"
                                                    alt="">
                                                <h4 class="mb-2">John Doe </h4>
                                            </div>
                                        </div>
                                        <div class="">
                                            <h5><strong>Penanggung Jawab Aset</strong></h5>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-1 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Laptop</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ac</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-1 mb-3">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                    class="img-fluid rounded me-3" height="50" width="50"
                                                    alt="">
                                                <h4 class="mb-2">John Doe </h4>
                                            </div>
                                        </div>
                                        <div class="">
                                            <h5><strong>Penanggung Jawab Aset</strong></h5>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex mb-1 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Laptop</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">190</small>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-4 pb-1 me-2">
                                                {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ac</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <small class="fw-semibold">10</small>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="col-lg-12 d-flex">
                                            <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="collapse" id="dataUser">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex align-items-center gap-1 mb-3">
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                                class="img-fluid rounded me-3" height="50"
                                                                width="50" alt="">
                                                            <h4 class="mb-2">John Doe </h4>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h5><strong>Penanggung Jawab Aset</strong></h5>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-1 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Laptop</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">190</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Ac</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">10</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex align-items-center gap-1 mb-3">
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                                class="img-fluid rounded me-3" height="50"
                                                                width="50" alt="">
                                                            <h4 class="mb-2">John Doe </h4>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h5><strong>Penanggung Jawab Aset</strong></h5>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-1 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Laptop</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">190</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Ac</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">10</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div class="d-flex align-items-center gap-1 mb-3">
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                                class="img-fluid rounded me-3" height="50"
                                                                width="50" alt="">
                                                            <h4 class="mb-2">John Doe </h4>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <h5><strong>Penanggung Jawab Aset</strong></h5>
                                                    </div>
                                                    <ul class="p-0 m-0">
                                                        <li class="d-flex mb-1 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class="bx bx-home-alt"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Laptop</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">190</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex mb-4 pb-1 me-2">
                                                            {{-- <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class="bx bx-football"></i></span>
                                                </div> --}}
                                                            <div
                                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0">Ac</h6>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">10</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="col-lg-12 d-flex">
                                                        <a class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="demo-inline-spacing d-flex justify-content-end">
                                    <a data-bs-toggle="collapse" href="#dataUser" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Users Lainnya <i class="bx bx-chevron-right"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- User --}}
        </div>
        {{-- <a href="https://themeselection.com/">ThemeSelection</a> --}}
    </div>
@endsection

@section('js')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Selamat Datang',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000,
            })
        @endif
    </script>
@endsection
