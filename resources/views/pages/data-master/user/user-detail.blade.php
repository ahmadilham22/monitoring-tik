@extends('layouts.app')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        {{-- <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div> --}}
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{ $data->nama }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="john.doe@example.com" placeholder="Email" value="{{ $data->email }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="division" class="form-label">Divisi</label>
                                    <input type="text" class="form-control" id="division" name="division"
                                        placeholder="Divisi"
                                        value="{{ isset($data->division->nama_divisi) ? $data->division->nama_divisi : '' }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input class="form-control" type="text" id="role" name="role"
                                        placeholder="Role" value={{ $data->role }} />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Jabatan</label>
                                    <input class="form-control" type="text" id="role" name="role"
                                        placeholder="Jabatan" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary px-5" type="submit">
                                    Kembali
                                </a>
                                <button class="btn btn-primary px-5" type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
