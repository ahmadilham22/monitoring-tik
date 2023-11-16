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
        // ajax
        $.ajax({
            type: "DELETE",
            url: "{{ route('procurement.destroy') }}",
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
            success: (data) => {
                $("#procurement-modal").modal('hide');
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
