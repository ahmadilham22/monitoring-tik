@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Pengadaan</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Data
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Tambah Data
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('procurement.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="mitra" class="form-label">Mitra</label>
                                                    <input type="text" name="mitra" class="form-control"
                                                        placeholder="Masukan Kode...">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_pengadaan" class="form-label">Jenis Pengadaan</label>
                                                    <input type="text" name="jenis_pengadaan" class="form-control"
                                                        placeholder="Masukan Kode...">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                                                    <input type="date" name="tahun_pengadaan" class="form-control"
                                                        placeholder="Masukan Kode...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Save changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mitra</th>
                                        <th>Jenis Pengadaan</th>
                                        <th>Tahun Pengadaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="employee-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="EmployeeForm" name="EmployeeForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group mb-3">
                            <label for="mitra" class="col-sm-2 control-label">Mitra</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="mitra" name="mitra"
                                    placeholder="Enter Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_pengadaan" class="col-sm-2 control-label">Jenis Pengadaan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="jenis_pengadaan" name="jenis_pengadaan"
                                    placeholder="Enter Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tahun_pengadaan" class="col-sm-2 control-label">Tahun Pengadaan</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan"
                                    placeholder="Enter Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10"><br />
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="location_id" id="location_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Lokasi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Enter Location" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('procurement.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'mitra',
                        name: 'mitra'
                    },
                    {
                        data: 'jenis_pengadaan',
                        name: 'jenis_pengadaan'
                    },
                    {
                        data: 'tahun_pengadaan',
                        name: 'tahun_pengadaan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });
        });

        function add() {
            $('#EmployeeForm').trigger("reset");
            $('#EmployeeModal').html("Add Employee");
            $('#employee-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('procurement.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    $('#EmployeeModal').html("Edit Employee");
                    $('#employee-modal').modal('show');
                    $('#id').val(res.id);
                    $('#mitra').val(res.mitra);
                    $('#jenis_pengadaan').val(res.jenis_pengadaan);
                    $('#tahun_pengadaan').val(res.tahun_pengadaan);
                }
            });
        }

        function deleteFunc(id) {
            // if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ route('procurement.destroy') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    var oTable = $('#myTable').dataTable();
                    oTable.fnDraw(false);
                }
            });
            // }
        }

        $('#EmployeeForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('procurement.update') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#employee-modal").modal('hide');
                    var oTable = $('#myTable').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
