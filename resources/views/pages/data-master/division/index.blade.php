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
                        <h4>Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Divisi
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Tambah Divisi
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('division.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="nama_divisi" class="form-label">Nama Divisi</label>
                                                    <input type="text" name="nama_divisi" class="form-control"
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
                                        <th>Divisi</th>
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
                    <h5 class="modal-title">Edit Divisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="EmployeeForm" name="EmployeeForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nama_divisi" class="col-sm-2 control-label">Divisi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama_divisi" name="nama_divisi"
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
                ajax: "{{ route('division.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_divisi',
                        name: 'nama_divisi'
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
                url: "{{ route('division.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    $('#EmployeeModal').html("Edit Employee");
                    $('#employee-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama_divisi').val(res.nama_divisi);
                }
            });
        }

        function deleteFunc(id) {
            // if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ route('division.destroy') }}",
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
                url: "{{ route('division.update') }}",
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
