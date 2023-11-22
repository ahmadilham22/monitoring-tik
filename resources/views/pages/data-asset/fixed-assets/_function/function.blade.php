<script>
    $(document).ready(function() {
        $('#subcategorySelect').select2({
            placeholder: 'Pilih...'
        })
        $('#specifiLocationSelect').select2({
            placeholder: 'Pilih...'
        })
        $('#procurementSelect').select2({
            placeholder: 'Pilih...'
        })
        $('#penanggungJawabSelect').select2({
            placeholder: 'Pilih...'
        })
    })
    // $(document).ready(function() {
    //     $('.form-select-category').select2({
    //         // theme: 'bootstrap5',
    //         placeholder: 'Pilih Kategori',
    //         ajax: {
    //             url: "{{ route('selectCategory') }}",
    //             processResults: function({
    //                 data
    //             }) {
    //                 return {
    //                     results: $.map(data, function(item) {
    //                         return {
    //                             id: item.id,
    //                             text: item.nama_kategori
    //                         }
    //                     })
    //                 }
    //             }
    //         }
    //     });

    //     $(".form-select-category").change(function() {
    //         let id = $('.form-select-category').val();

    //         $(".form-select-subcategory").select2({
    //             placeholder: 'Pilih Sub Kategori',
    //             ajax: {
    //                 url: "{{ url('data-assets/fixed/selectSubCategory') }}/" + id,
    //                 processResults: function({
    //                     data
    //                 }) {
    //                     return {
    //                         results: $.map(data, function(item) {
    //                             return {
    //                                 id: item.id,
    //                                 text: item.nama_sub_kategori
    //                             }
    //                         })
    //                     }
    //                 }
    //             }
    //         });
    //     });
    // });

    // $(document).ready(function() {
    //     $('#subCategorySelect').select2({
    //         placeholder: 'Sub Kategori',
    //     });
    // });

    // $('#categorySelect').on('select2:select', function(e) {
    //     var data = e.params.data;
    //     var selectedCategoryId = data.id;

    //     $('#subcategorySelect').val(null).trigger('change');
    //     $('#subcategorySelect option').hide();

    //     $('#subcategorySelect option[data-category-id="' + selectedCategoryId + '"]').show();
    // });
</script>
