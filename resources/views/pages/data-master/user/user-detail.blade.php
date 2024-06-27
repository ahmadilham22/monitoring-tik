@extends('layouts.app')


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        @if ($data->photo)
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="visible-print d-blok text-center">
                                    <img src="{{ asset('storage/userImage/' . $data->photo) }}" alt="QR Code"
                                        class="img-fluid" style="height: 150px; object-fit:cover">
                                </div>
                            </div>
                        @else
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="visible-print d-blok text-center">
                                    <img src="{{ asset('/assets/img/avatars/avatar.jpeg') }}" alt="QR Code"
                                        class="img-fluid" style="height: 150px; object-fit:cover">
                                    {{-- <strong>
                                        Belum ada foto
                                    </strong> --}}
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" action="{{ route('user.update-porfile', Auth::user()->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="nama" name="nama"
                                        value="{{ $data->nama }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        placeholder="Email" value="{{ $data->email }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="division" class="form-label">Divisi</label>
                                    <select id="penanggungJawabSelect" name="division_id"
                                        class="form-select form-select mb-3" aria-label="Large select example">
                                        <option value="">Pilih Divisi</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                                {{ $data->division_id == $division->id ? 'selected' : '' }}>
                                                {{ $division->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Jabatan</label>
                                    <input class="form-control" type="text" id="jabatan" name="jabatan"
                                        placeholder="Jabatan" value="{{ $data->jabatan }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input class="form-control" type="file" id="photo" name="photo"
                                        placeholder="Photo" />
                                </div>
                            </div>
                            <div class="mt-2">
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

@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: "top-end",
                timer: 2000,
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
            });
        </script>
    @endif
@endsection
