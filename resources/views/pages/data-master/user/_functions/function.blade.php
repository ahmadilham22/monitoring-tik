<script>
    function add() {
        $('#userForm').trigger("reset");
        $('#modalHeader').html("Tambah Sub Kategori");
        $('#user-model').modal('show');
        $('#id').val('');
    }

    function editFunc(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('user.edit') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                $('#modalHeader').html("Edit User");
                $('#user-model').modal('show');
                $('#id').val(res.id);
                $('#nama').val(res.nama);
                $('#email').val(res.email);
                $('#password').val(res.password);
                $('#role').val(res.role);
                $('#division_id').val(res.division_id);
            }
        });
    }

    function deleteFunc(id) {
        var id = id;
        $.ajax({
            type: "DELETE",
            url: "{{ route('user.destroy') }}",
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

    $('#userForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('user.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (response) => {
                console.log(response);
                $("#user-model").modal('hide');
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
