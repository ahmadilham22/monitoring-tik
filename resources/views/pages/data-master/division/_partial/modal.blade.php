<div class="modal fade" id="division-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Divisi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="divisionForm" name="divisionForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="kode_divisi" class="form-label">Kode Divisi</label>
                            <input type="text" name="kode_divisi" id="kode_divisi" class="form-control"
                                placeholder="Masukan Kode...">
                        </div>
                        <div class="mb-3">
                            <label for="nama_divisi" class="form-label">Nama Divisi</label>
                            <input type="text" name="nama_divisi" id="nama_divisi" class="form-control"
                                placeholder="Masukan Kode...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
