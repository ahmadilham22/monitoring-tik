<script>
    function add() {
        $('#unitForm').trigger("reset");
        $('#modalHeader').html("Tambah Satuan");
        $('#unit-model').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('unit.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#modalHeader').html("Edit Satuan");
                $('#unit-model').modal('show');
                $('#id').val(res.id);
                $('#nama').val(res.nama);
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
                    url: "{{ route('unit.destroy') }}",
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

    $('#unitForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('unit.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                console.log(response);
                $("#unit-model").modal('hide');
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
