<!-- Modal -->
<div class="modal fade" id="ImportData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Data Aset</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="file">Choose Excel File</label>
                        <a href="{{ route('export-template') }}" class="text-center">Download template</a>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    {{-- <button type="submit" class="btn btn-primary mt-2">Import</button> --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
