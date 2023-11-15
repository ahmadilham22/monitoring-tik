<div class="modal fade" id="location-model" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="LocationForm" name="LocationForm" class="form-horizontal"
                    method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="lokasi_umum" class="col-sm-2 control-label">Lokasi Umum</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lokasi_umum" name="lokasi_umum"
                                placeholder="Masukan Lokasi" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-10 mt-3">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
