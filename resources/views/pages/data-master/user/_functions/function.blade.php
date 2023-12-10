<script>
    $(document).ready(function() {

        $(document).on('click', '#delete_user', function(e) {
            e.preventDefault();

            let userId = $(this).val();
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
                        data: {
                            id: userId
                        },
                        url: "user/delete/" + userId,
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#myTable').dataTable();
                            oTable.fnDraw(false);
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
        });

        $(document).on('click', '#edit_user', function(e) {
            e.preventDefault();

            let userId = $(this).val();

            $('#EditUserModal').modal('show');
            $.ajax({
                type: 'GET',
                url: "user/edit/" + userId,
                success: function(response) {
                    console.log(response);
                    $('#edit_user_id').val(response.data.id);
                    $('#edit_nama').val(response.data.nama);
                    $('#edit_email').val(response.data.email);
                    $('#edit_role').val(response.data.role);
                    $('#edit_division_id').val(response.data.division_id);
                },
                error: function(error) {
                    console.error(error);
                }
            })
        });

        $(document).on('click', '#update_user', function(e) {
            e.preventDefault();

            let userId = $('#edit_user_id').val();
            let data = {
                'nama': $('#edit_nama').val(),
                'email': $('#edit_email').val(),
                'password': $('#edit_password').val(),
                'role': $('#edit_role').val(),
                'division_id': $('#edit_division_id').val(),
            }

            $.ajax({
                type: 'PUT',
                url: "user/update/" + userId,
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#edit_user_id').val(response.data.id);
                    $('#edit_nama').val(response.data.nama);
                    $('#edit_email').val(response.data.email);
                    $('#edit_password').val(response.data.password);
                    $('#edit_role').val(response.data.role);
                    $('#edit_division_id').val(response.data.division_id);
                    if (response.success) {
                        $("#EditUserModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#edit_userForm').trigger("reset");
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false
                        });
                    } else if (!response.success) {
                        $("#EditUserModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#edit_userForm').trigger("reset");
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
                error: function(error) {
                    console.error(error);
                }
            })
        });

        $(document).on('click', '#add_user', function(e) {
            e.preventDefault();

            let data = {
                'nama': $('#nama').val(),
                'email': $('#email').val(),
                'password': $('#password').val(),
                'role': $('#role').val(),
                'division_id': $('#division_id').val(),
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('user.store') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        $("#AddUserModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#userForm').trigger("reset");
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false
                        });
                    } else if (!response.success) {
                        $("#AddUserModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#userForm').trigger("reset");
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
                    console.error(error);
                }
            })
        });
    });
</script>
