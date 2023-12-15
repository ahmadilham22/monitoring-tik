<script>
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
                console.log(res);
                $('#modalHeader').html("Edit Lokasi");
                $('#location-model').modal('show');
                $('#id').val(res.id);
                $('#kode_lokasi').val(res.kode_lokasi);
                $('#lokasi_umum').val(res.lokasi_umum);
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
                    url: "{{ route('location.destroy') }}",
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
                } else if (response.error) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        icon: 'error',
                        title: 'Failed',
                        text: response.message,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.error('Error - ' + errorMessage);
            }
        });
    });
</script>
