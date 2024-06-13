<script>
    $(document).ready(function() {

        $(document).on('click', '#delete_category', function(e) {
            e.preventDefault();

            let categoryId = $(this).val();
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
                            id: categoryId
                        },
                        url: "category/delete/" + categoryId,
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
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

        $(document).on('click', '#edit_category', function(e) {
            e.preventDefault();

            let categoryId = $(this).val();

            $('#EditCategoryModal').modal('show');
            $.ajax({
                type: 'GET',
                url: "category/edit/" + categoryId,
                success: function(response) {
                    $('#edit_category_id').val(response.data.id);
                    $('#edit_kode_kategori').val(response.data.kode_kategori);
                    $('#edit_nama_kategori').val(response.data.nama_kategori);
                },
                error: function(error) {
                    {{-- console.error(error); --}}
                }
            })
        });

        $(document).on('click', '#update_category', function(e) {
            e.preventDefault();

            let categoryId = $('#edit_category_id').val();
            console.log(categoryId);
            let data = {
                'kode_kategori': $('#edit_kode_kategori').val(),
                'nama_kategori': $('#edit_nama_kategori').val(),
            }

            $.ajax({
                type: 'PUT',
                url: "category/update/" + categoryId,
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#edit_category_id').val(response.data.id);
                    $('#edit_kode_kategori').val(response.data.kode_kategori);
                    $('#edit_nama_kategori').val(response.data.nama_kategori);
                    if (response.success) {
                        $("#EditCategoryModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#edit_categoryForm').trigger("reset");
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(error) {
                    if (error.responseJSON) {
                        {{-- $("#AddCategoryModal").modal('hide'); --}}
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        {{-- $('#add_categoryForm').trigger("reset"); --}}
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'error',
                            title: 'Error',
                            text: error.responseJSON[0],
                            showConfirmButton: false
                        });
                    }
                }
            })
        });

        $(document).on('click', '#add_category', function(e) {
            e.preventDefault();

            let data = {
                'kode_kategori': $('#kode_kategori').val(),
                'nama_kategori': $('#nama_kategori').val(),
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('category.store') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $("#AddCategoryModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#add_categoryForm').trigger("reset");
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false
                        });
                    }
                    {{-- else if (response.error) {
                        $("#AddCategoryModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#add_categoryForm').trigger("reset");
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'error',
                            title: 'Failed',
                            text: response.message,
                            showConfirmButton: false
                        });
                    } --}}
                },
                error: function(error) {
                    if (error.responseJSON) {
                        {{-- $("#AddCategoryModal").modal('hide'); --}}
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        {{-- $('#add_categoryForm').trigger("reset"); --}}
                        Swal.fire({
                            toast: true,
                            position: "top-end",
                            timer: 2000,
                            icon: 'error',
                            title: 'Error',
                            text: error.responseJSON[0],
                            showConfirmButton: false
                        });
                    }
                }
            })
        });
    });
</script>
