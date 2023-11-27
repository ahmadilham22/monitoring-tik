<script>
    // SELECT2
    $(document).ready(function() {
        $('#location_id').select2({
            dropdownParent: $('#specificLocation-modal'),
            placeholder: 'Pilih...'
        })
    })
    // SELECT2

    function add() {
        $('#specificLocationForm').trigger("reset");
        $('#modalHeader').html("Tambah Lokasi");
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
                $('#modalHeader').html("Edit Lokasi");
                $('#specificLocation-modal').modal('show');
                $('#id').val(res.id);
                $('#kode_lokasi').val(res.kode_lokasi);
                $('#location_id').val(res.location_id);
                $('#lokasi_khusus').val(res.lokasi_khusus);
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
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
