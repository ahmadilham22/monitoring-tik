<script>
    function add() {
        $('#categoryForm').trigger("reset");
        $('#modalHeader').html("Tambah Kategori");
        $('#category-model').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('category.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#modalHeader').html("Edit Kategori");
                $('#category-model').modal('show');
                $('#id').val(res.id);
                $('#kode_kategori').val(res.kode_kategori);
                $('#nama_kategori').val(res.nama_kategori);
            }
        });
    }

    function deleteFunc(id) {
        var id = id;
        $.ajax({
            type: "DELETE",
            url: "{{ route('category.destroy') }}",
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

    $('#categoryForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('category.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                $("#category-model").modal('hide');
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
