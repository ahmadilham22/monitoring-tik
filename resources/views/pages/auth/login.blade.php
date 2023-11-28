@extends('layouts.login')

@section('css')
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

        input[type="email"] {
            border: none;
            border-bottom: 2px solid #1f91ff;
        }

        input[type="email"]:focus {
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
@endsection


@section('content')
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
                            <form id="formAuthentication" class="align-items-center px-sm-5" action="{{ route('signin') }}"
                                method="POST">
                                @csrf
                                <div class="row d-block">
                                    <div class="col-sm-6 col-12 mb-4 mx-auto">
                                        {{-- <label for="email" class="form-label">Email</label> --}}
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email" autofocus />
                                    </div>
                                    <div class="col-sm-6 col-12 mb-4 form-password-toggle mx-auto">
                                        {{-- <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div> --}}
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control"
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
    </div>
@endsection

@section('js')
@endsection
