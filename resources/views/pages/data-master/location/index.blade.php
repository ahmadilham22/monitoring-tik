@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Lokasi</h4>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" onclick="add()" href="javascript:void()">Tambah
                            Lokasi
                        </a>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered table-sm w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lokasi</th>
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
    <div class="modal fade" id="location-model" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeader">Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="LocationForm" name="LocationForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="lokasi_umum" class="col-sm-2 control-label">Lokasi Umum</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="lokasi_umum" name="lokasi_umum"
                                    placeholder="Masukan Lokasi" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-10 mt-3">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                        </div>
                    </form>
                </div>
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
                ajax: "{{ route('location.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'lokasi_umum',
                        name: 'lokasi_umum'
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
            $('#LocationForm').trigger("reset");
            $('#modalHeader').html("Tambah Lokasi");
            $('#location-model').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ route('location.edit') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#modalHeader').html("Edit Lokasi");
                    $('#location-model').modal('show');
                    $('#id').val(res.id);
                    $('#lokasi_umum').val(res.lokasi_umum);
                }
            });
        }

        function deleteFunc(id) {
            var id = id;
            $.ajax({
                type: "DELETE",
                url: "{{ route('location.destroy') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    var oTable = $('#myTable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }

        $('#LocationForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('location.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (response) => {
                    $("#location-model").modal('hide');
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
