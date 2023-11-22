<script>
    // SELECT2
    $(document).ready(function() {
        $('#cat_id').select2({
            dropdownParent: $('#subCategory-model'),
            placeholder: 'Pilih...'
        })
    })
    // SELECT2

    // CRUD
    function add() {
        $('#subCategoryForm').trigger("reset");
        $('#modalHeader').html("Tambah Sub Kategori");
        $('#subCategory-model').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('sub-category.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#modalHeader').html("Edit Sub Kategori");
                $('#subCategory-model').modal('show');
                $('#id').val(res.id);
                $('#kode_sub_kategori').val(res.kode_sub_kategori);
                $('#nama_sub_kategori').val(res.nama_sub_kategori);
                $('#categories_id').val(res.categories_id);
            }
        });
    }

    function deleteFunc(id) {
        var id = id;
        $.ajax({
            type: "DELETE",
            url: "{{ route('sub-category.destroy') }}",
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

    $('#subCategoryForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('sub-category.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                $("#subCategory-model").modal('hide');
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
    // CRUD
</script>
