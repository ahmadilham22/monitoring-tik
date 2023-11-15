@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Lokasi Khusus</h4>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Tambah Lokasi Khusus
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Tambah Lokasi
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('special-location.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3">
                                                    <label for="kode_lokasi" class="form-label">Kode Lokasi</label>
                                                    <input type="text" name="kode_lokasi" class="form-control"
                                                        placeholder="Masukan Kode...">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Lokasi Umum</label>
                                                    <select class="form-select form-select mb-3" name="location_id"
                                                        aria-label="Large select example">
                                                        <option selected>Pilih...</option>
                                                        @foreach ($data as $item)
                                                            <option value="{{ $item->id }}">{{ $item->lokasi_umum }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lokasi" class="form-label">Lokasi Khusus</label>
                                                    <input type="text" name="lokasi_khusus" class="form-control"
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
                                        <th>Kode Lokasi</th>
                                        <th>Lokasi Umum</th>
                                        <th>Lokasi Khusus</th>
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
                            <label for="kode_lokasi" class="col-sm-2 control-label">Kode Lokasi</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="kode_lokasi" name="kode_lokasi"
                                    placeholder="Enter Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="lokasi_umum" class="col-sm-2 control-label">Lokasi Umum</label>
                            <div class="col-sm-12">
                                <select class="form-select form-select mb-3" name="location_id"
                                    aria-label="Large select example">
                                    {{-- <option selected>Pilih...</option> --}}
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->lokasi_umum }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="lokasi_khusus" class="col-sm-2 control-label">Lokasi Khusus</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="lokasi_khusus" name="lokasi_khusus"
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
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('special-location.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_lokasi',
                        name: 'kode_lokasi'
                    },
                    {
                        data: 'location.lokasi_umum',
                        name: 'lokasi_umum'
                    },
                    {
                        data: 'lokasi_khusus',
                        name: 'lokasi_khusus'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
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
                url: "{{ route('special-location.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    // console.log(res);
                    $('#EmployeeModal').html("Edit Employee");
                    $('#employee-modal').modal('show');
                    $('#id').val(res.id);
                    $('#kode_lokasi').val(res.kode_lokasi);
                    $('#location_id').val(res.location_id);
                    $('#lokasi_khusus').val(res.lokasi_khusus);
                }
            });
        }

        function deleteFunc(id) {
            // if (confirm("Delete Record?") == true) {
            var id = id;
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ route('special-location.destroy') }}",
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
                url: "{{ route('special-location.update') }}",
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
