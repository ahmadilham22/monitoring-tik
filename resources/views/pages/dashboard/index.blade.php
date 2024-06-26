@extends('layouts.app')

@section('css')
    <style>
        .swal2-container {
            z-index: 1000;
        }

        .chartMenu {
            width: 100vw;
            height: 40px;
            background: #1A1A1A;
            color: rgba(54, 162, 235, 1);
        }

        .chartMenu p {
            padding: 10px;
            font-size: 20px;
        }

        .chartCard {
            width: 100vw;
            height: calc(100vh - 40px);
            background: rgba(54, 162, 235, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chartBox {
            width: 580px;
            /* padding: 20px; */
            border-radius: 20px;
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
                                <h4 class="card-title text-primary mb-5">
                                    Selamat Datang, {{ Auth::user()->nama }}! 🎉
                                </h4>
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
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-5 col-sm-12">
                                <span class="text-center">
                                    <h4>Kondisi Baik</h4>
                                </span>
                                @if (array_sum($dataset['datasetBaik']) == 0)
                                    <p class="text-center mt-5">No data found
                                    </p>
                                @else
                                    <canvas id="myChart"></canvas>
                                @endif
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <span class="text-center">
                                    <h4>Kondisi Rusak</h4>
                                </span>
                                @if (array_sum($dataset['datasetRusak']) == 0)
                                    <p class="text-center mt-5">No data found
                                    </p>
                                @else
                                    <canvas id="myChart1"></canvas>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="row data-kategori" id="data-wrapper">
                            @include('pages.dashboard.data')
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success load-more-data">View More</button>
                            <button class="btn btn-danger load-less-data" style="display:none;">View Less</button>
                        </div> --}}
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
                        <div class="row data-user" id="data-wrapper-users">
                            @include('pages.dashboard.data-users')
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary load-more-data-users">View More</button>
                            <button class="btn btn-danger load-less-data-users" style="display:none;">View Less</button>
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
        $(document).ready(function() {
            // Categories
            var pageCategories = 1;

            // Saat halaman dimuat, simpan data asli sebelum "View More" ditekan
            var originalDataCategories = $("#data-wrapper").html();

            $('.load-more-data').on('click', function() {
                pageCategories++; // Increment nomor halaman saat tombol ditekan

                // Lakukan AJAX request untuk memuat data berikutnya
                $.ajax({
                    url: "{{ route('home') }}", // Ganti dengan route yang sesuai di Laravel Anda
                    method: "GET",
                    data: {
                        page: pageCategories
                    },
                    success: function(response) {
                        // Memasukkan data baru ke dalam container data yang sudah ada
                        $("#data-wrapper").append(response.htmlCategories);

                        // Jika tidak ada data lagi atau jumlah total data sudah melebihi perPageCategories, ubah tombol menjadi "View Less"
                        if (response.nextPageCategories == null) {
                            $('.load-more-data').hide(); // Sembunyikan tombol "View More"
                            $('.load-less-data').show(); // Tampilkan tombol "View Less"
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', errorThrown);
                    }
                });
            });

            // Event handler untuk tombol "View Less"
            $('.load-less-data').on('click', function() {
                // Kembali ke halaman awal (misalnya, halaman pertama)
                pageCategories = 1;

                // Sembunyikan tombol "View Less"
                $('.load-less-data').hide();
                // Tampilkan tombol "View More"
                $('.load-more-data').show();

                // Menampilkan kembali data asli yang disimpan sebelumnya
                $("#data-wrapper").empty(); // Menghapus semua data yang sudah dimuat
                $("#data-wrapper").append(originalDataCategories);
            });
            // Categories



            // Users
            var pageUsers = 1;

            // Saat halaman dimuat, simpan data asli sebelum "View More" ditekan
            var originalDataUsers = $("#data-wrapper-users").html();

            $('.load-more-data-users').on('click', function() {
                pageUsers++; // Increment nomor halaman saat tombol ditekan

                // Lakukan AJAX request untuk memuat data berikutnya
                $.ajax({
                    url: "{{ route('home.users') }}", // Ganti dengan route yang sesuai di Laravel Anda
                    method: "GET",
                    data: {
                        page: pageUsers
                    },
                    success: function(response) {

                        // Memasukkan data baru ke dalam container data yang sudah ada
                        $("#data-wrapper-users").append(
                            response
                            .htmlUsers);

                        // Jika tidak ada data lagi atau jumlah total data sudah kembali ke jumlah awal, ubah tombol menjadi "View Less"
                        if (response.nextPageUsers == null) {
                            $('.load-more-data-users').hide(); // Sembunyikan tombol "View More"
                            $('.load-less-data-users').show(); // Tampilkan tombol "View Less"
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', errorThrown);
                    }
                });
            });
            // Event handler untuk tombol "View Less"
            $('.load-less-data-users').on('click', function() {
                // Kembali ke halaman awal (misalnya, halaman pertama)
                pageUsers = 1;

                // Sembunyikan tombol "View Less"
                $('.load-less-data-users').hide();
                // Tampilkan tombol "View More"
                $('.load-more-data-users').show();

                // Menampilkan kembali data asli yang disimpan sebelumnya
                $("#data-wrapper-users").empty(); // Menghapus semua data yang sudah dimuat
                $("#data-wrapper-users").append(originalDataUsers);
            });
            // Users
        });
    </script>
    <script src="http://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="http://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>
    <script>
        const dataChart = {!! json_encode($dataset) !!};
        const data = {
            labels: dataChart.labels,
            datasets: [{
                data: dataChart.datasetBaik,
                borderWidth: 1
            }]
        };
        const data1 = {
            labels: dataChart.labels,
            datasets: [{
                data: dataChart.datasetRusak,
                borderWidth: 1
            }]
        };
        const goodCategory = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    labels: {
                        render: (args) => {
                            return `${args.value} ${args.label}`;
                        }
                    },
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        // text: 'Kondisi Baik',
                        padding: {
                            bottom: 30
                        },
                        font: {
                            size: 16,
                        }
                    }
                },
            },
        };

        const badCategory = {
            type: 'pie',
            data: data1,
            options: {
                responsive: true,
                plugins: {
                    labels: {
                        render: (args) => {
                            return `${args.value} ${args.label}`;
                        }
                    },
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        // text: 'Kondisi Rusak',
                        padding: {
                            bottom: 30
                        },
                        font: {
                            size: 16,
                        }
                    }
                },
            },
        };


        // render init block
        const myChart = new Chart(
            document.getElementById('myChart'),
            goodCategory
        );
        const myChart1 = new Chart(
            document.getElementById('myChart1'),
            badCategory
        );

        // Instantly assign Chart.js version
        const chartVersion = document.getElementById('chartVersion');
        chartVersion.innerText = Chart.version;
    </script>
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
