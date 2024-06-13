<script>
    function add() {
        $('#divisionForm').trigger("reset");
        $('#modalHeader').html("Tambah Divisi");
        $('#division-modal').modal('show');
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
                $('#modalHeader').html("Edit Divisi");
                $('#division-modal').modal('show');
                $('#id').val(res.id);
                $('#kode_divisi').val(res.kode_divisi);
                $('#nama_divisi').val(res.nama_divisi);
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
                    url: "{{ route('division.destroy') }}",
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

    $('#divisionForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('division.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                $("#division-modal").modal('hide');
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
