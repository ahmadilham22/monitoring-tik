<div>
    {{-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#qrcodeModal" type="button">
        Tampilkan Qrcode
    </button> --}}
    <img src="{{ asset('storage/qrcodes/locations/' . $data->qrcode) }}" alt="QR Code" class="img-fluid w-100 h-100"
        style="height: 150px; object-fit:cover">
    {{-- {{ $data->qrcode }} --}}
</div>
