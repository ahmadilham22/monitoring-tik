@extends('layouts.app')


@section('content')
    <div class="container flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-lg-12 order-0">
                <div class="card">
                    <div class="card-header">
                        <h4>Satuan</h4>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary" onclick="add()">Tambah
                            Satuan
                        </a>
                        <div class="table-responsive text-nowrap mt-4">
                            <table id="myTable" class="table table-bordered w-100 table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Terakhir update</th>
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

    @include('pages.data-master.unit._partial.modal')
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
                serverSide: true,
                processing: true,
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: "{{ route('unit.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return moment(data).format('DD/MM/YYYY');
                            }
                            return data;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
    @include('pages.data-master.unit._function.function')
@endpush
