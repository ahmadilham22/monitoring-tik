<script>
    function add() {
        $('#procurementForm').trigger("reset");
        $('#modalHeader').html("Add Pengadaan");
        $('#procurement-modal').modal('show');
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
                $('#modalHeader').html("Edit Pengadaan");
                $('#procurement-modal').modal('show');
                $('#id').val(res.id);
                $('#mitra').val(res.mitra);
                $('#jenis_pengadaan').val(res.jenis_pengadaan);
                $('#tahun_pengadaan').val(res.tahun_pengadaan);
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
                    url: "{{ route('procurement.destroy') }}",
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

    $('#procurementForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('procurement.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                $("#procurement-modal").modal('hide');
                var table = $('#myTable').DataTable();
                table.ajax.reload(null, false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
                if (response.success == true) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        timer: 2000,
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false
                    });
                } else if (response.success == false) {
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
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
