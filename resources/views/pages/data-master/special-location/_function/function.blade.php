<script>
    // SELECT2
    $(document).ready(function() {
        $('#location_id').select2({
            placeholder: 'Pilih...',
            dropdownParent: $('#specificLocation-modal'),
        })
    })
    // SELECT2

    function add() {
        $('#specificLocationForm')[0].reset();
        $('#location_id').val(null).trigger('change');
        $('#modalHeader').html("Tambah Sub Lokasi");
        $('#specificLocation-modal').modal('show');
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
                $('#modalHeader').html("Edit Sub Lokasi");
                $('#specificLocation-modal').modal('show');
                $('#id').val(res.id);
                $('#kode_lokasi').val(res.kode_lokasi);
                $('#location_id').val(res.location_id);
                $('#lokasi_khusus').val(res.lokasi_khusus);
                $('#location_id').val(res.location_id).trigger('change');
            }
        });
    }

    function deleteFunc(id) {
        var id = id;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('special-location.destroy') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var table = $('#myTable').DataTable();
                        table.ajax.reload(null, false);
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            showConfirmButton: false
                        })
                    }
                });
            }
        });
    }

    $('#specificLocationForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('special-location.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                $("#specificLocation-modal").modal('hide');
                var table = $('#myTable').DataTable();
                table.ajax.reload(null, false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false
                    });
                }
            },
            error: function(error) {
                if (error.responseJSON) {
                    var oTable = $('#myTable').dataTable();
                    oTable.fnDraw(false);
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        icon: 'error',
                        title: 'Error',
                        text: error.responseJSON[0],
                        showConfirmButton: false
                    });
                }
            }
        });
    });
</script>
