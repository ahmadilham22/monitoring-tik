<div class="modal fade" id="procurement-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Pengadaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="procurementForm" name="procurementForm" class="form-horizontal" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="mitra" class="form-label">Mitra</label>
                            <input type="text" name="mitra" id="mitra" class="form-control"
                                placeholder="Masukan mitra...">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_pengadaan" class="form-label">Jenis Pengadaan</label>
                            <input type="text" name="jenis_pengadaan" id="jenis_pengadaan" class="form-control"
                                placeholder="Masukan jenis pengadaan...">
                        </div>
                        <div class="mb-3">
                            <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                            <input type="date" name="tahun_pengadaan" id="tahun_pengadaan" class="form-control"
                                placeholder="Masukan tahun pengadaan...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
