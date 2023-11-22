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
                // console.log(res);
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
        $.ajax({
            type: "DELETE",
            url: "{{ route('division.destroy') }}",
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
            success: (data) => {
                $("#division-modal").modal('hide');
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
