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
                console.log(response);
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
