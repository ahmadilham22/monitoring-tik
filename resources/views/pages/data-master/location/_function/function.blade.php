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
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 2000,
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
                console.log(response);
                $("#location-model").modal('hide');
                var oTable = $('#myTable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
                if (response.success == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1000,
                        showConfirmButton: false
                    });
                } else if (response.success == false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.error('Error - ' + errorMessage);

                // Sweet Alert for Error
                // Swal.fire({
                //     icon: 'error',
                //     title: 'Error',
                //     text: 'Failed to save data. Please try again later.',
                //     timer: 2000,
                //     showConfirmButton: false
                // });
            }
        });
    });
</script>
