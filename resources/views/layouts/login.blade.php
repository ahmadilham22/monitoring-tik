<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/avatars/unila.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css-own.css') }}">
    <style>
        .form-control {
            border-radius: 0px;
        }


        input:focus {
            outline: none !important;
        }

        input[type="text"] {
            border: none;
            border-bottom: 2px solid #1f91ff;
        }

        input[type="text"]:focus {
            border: none;
            border-bottom: 2px solid #1f91ff;
            box-shadow: none;
        }


        input[type="password"] {
            border: none;
            border-bottom: 2px solid #1f91ff;
            /* box-shadow: none; */
        }

        input[type="password"]:focus {
            border: none;
            border-bottom: 2px solid #1f91ff;
            box-shadow: none !important;
            outline: none !important;
        }

        .password-look {
            border: none;
            border-bottom: 2px solid #1f91ff;
            border-radius: 0px;
        }
    </style>
</head>

<body>
    <!-- Content -->
    <div class="container-fluid content-body">
        <div class="authentication-wrapper authentication-basic">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card border-image">
                    <div class="card-body">
                        {{-- <div class="content tes"> --}}
                        {{-- <div class="row d-flex left-content"> --}}
                        {{-- <div class="col-sm-6 col-12 fill-content">
                                <img src="{{ asset('assets/img/illustrations/unila-rektorat.jpeg') }}" alt=""
                                    class="img-fluid img-responsive w-100 h-100">
                            </div> --}}
                        <div class="col-sm-12 col-12">
                            <!-- Logo -->
                            <div class="text-center mt-4 mb-5">
                                <h2>Inventory TIK <br> Universitas Lampung</h2>
                            </div>
                            <form id="formAuthentication" class="align-items-center px-sm-5" action="index.html"
                                method="POST">
                                <div class="row d-block">
                                    <div class="col-sm-6 col-12 mb-4 mx-auto">
                                        {{-- <label for="email" class="form-label">Email</label> --}}
                                        <input type="text" class="form-control" id="email" name="email-username"
                                            placeholder="Enter your email" autofocus />
                                    </div>
                                    <div class="col-sm-6 col-12 mb-4 form-password-toggle mx-auto">
                                        {{-- <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div> --}}
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control"
                                                placeholder="Enter your password" aria-describedby="password1" />
                                            <span class="input-group-text cursor-pointer password-look"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6 col-12 mb-3 mx-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-me" />
                                            <label class="form-check-label" for="remember-me"> Remember Me </label>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6 col-12 mb-3 mx-auto">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- </div> --}}
                        {{-- </div> --}}

                        {{-- </div> --}}
                    </div>
                    <!-- /Register -->
                </div>
            </div>
        </div>

        <!-- / Content -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

        <script src="../assets/vendor/js/menu.js"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
