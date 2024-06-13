<script>
    $(document).ready(function() {
        $('#categories_id').select2({
            placeholder: 'Pilih...',
            dropdownParent: $('#AddSubCategoryModal'),
        })
    })

    $(document).ready(function() {
        $('#edit_categories_id').select2({
            placeholder: 'Pilih...',
            dropdownParent: $('#EditSubCategoryModal'),
        })
    })

    $(document).ready(function() {

        $(document).on('click', '#delete_subcategory', function(e) {
            e.preventDefault();

            let subcategoryId = $(this).val();
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
                            id: subcategoryId
                        },
                        url: "sub-category/delete/" + subcategoryId,
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

        $(document).on('click', '#edit_subcategory', function(e) {
            e.preventDefault();

            let subcategoryId = $(this).val();

            $('#EditSubCategoryModal').modal('show');
            $.ajax({
                type: 'GET',
                url: "sub-category/edit/" + subcategoryId,
                success: function(response) {
                    // console.log(response);
                    $('#edit_subcategory_id').val(response.data.id);
                    $('#edit_categories_id').val(response.data.categories_id);
                    $('#edit_kode_sub_kategori').val(response.data.kode_sub_kategori);
                    $('#edit_nama_sub_kategori').val(response.data.nama_sub_kategori);
                    $('#edit_categories_id').val(response.data.categories_id).trigger(
                        'change');

                },
                error: function(error) {
                    console.error(error);
                }
            })
        });

        $(document).on('click', '#update_subcategory', function(e) {
            e.preventDefault();

            let subcategoryId = $('#edit_subcategory_id').val();
            // console.log(subcategoryId);
            let data = {
                'categories_id': $('#edit_categories_id').val(),
                'kode_sub_kategori': $('#edit_kode_sub_kategori').val(),
                'nama_sub_kategori': $('#edit_nama_sub_kategori').val(),
            }

            $.ajax({
                type: 'PUT',
                url: "sub-category/update/" + subcategoryId,
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#edit_subcategory_id').val(response.data.id);
                    $('#edit_categories_id').val(response.data.categories_id);
                    $('#edit_kode_sub_kategori').val(response.data.kode_sub_kategori);
                    $('#edit_nama_sub_kategori').val(response.data.nama_sub_kategori);
                    if (response.success) {
                        $("#EditSubCategoryModal").modal('hide');
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
                        $('#edit_subcategoryForm').trigger("reset");
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
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
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

        $(document).on('click', '#add_subcategory', function(e) {
            e.preventDefault();

            let data = {
                'categories_id': $('#categories_id').val(),
                'kode_sub_kategori': $('#kode_sub_kategori').val(),
                'nama_sub_kategori': $('#nama_sub_kategori').val(),
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('sub-category.store') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $("#AddSubCategoryModal").modal('hide');
                        var table = $('#myTable').DataTable();
                        table.ajax.reload(null, false);
                        $('#add_subcategoryForm').trigger("reset");
                        $('#categories_id').val('')
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
                        var oTable = $('#myTable').dataTable();
                        oTable.fnDraw(false);
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
