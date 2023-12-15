<div class="modal fade" id="location-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Lokasi Khusus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="LocationForm" name="LocationForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="kode_lokasi" class="col-12 control-label">Kode Lokasi</label>
                            <input type="text" class="form-control" id="kode_lokasi" name="kode_lokasi"
                                placeholder="Masukan Lokasi" maxlength="50" required="">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi_umum" class="col-12 control-label">Lokasi Umum</label>
                            <input type="text" class="form-control" id="lokasi_umum" name="lokasi_umum"
                                placeholder="Masukan Lokasi" maxlength="50" required="">
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
