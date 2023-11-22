<div class="modal fade" id="specificLocation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Lokasi Khusus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" id="specificLocationForm" name="specificLocationForm" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label">Lokasi Umum</label>
                            <select class="form-select form-select" name="location_id" id="location_id"
                                aria-label="Large select example">
                                <option></option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kode_lokasi }} / {{ $item->lokasi_umum }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_lokasi" class="form-label">Kode Lokasi</label>
                            <input type="text" name="kode_lokasi" id="kode_lokasi" class="form-control"
                                placeholder="Masukan Kode...">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi Khusus</label>
                            <input type="text" name="lokasi_khusus" id="lokasi_khusus" class="form-control"
                                placeholder="Masukan Kode...">
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
