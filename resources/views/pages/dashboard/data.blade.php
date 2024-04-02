  @foreach ($data as $item)
      <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
          <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between pb-0">
                  <div class="card-title mb-0">
                      <h5 class="m-0 me-2 mb-3">{{ $item->nama_kategori }}
                      </h5>
                  </div>
              </div>
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="d-flex flex-column align-items-center gap-1">
                          <h2 class="mb-2">{{ $item->total_kategori }}</h2>
                      </div>
                  </div>
                  <ul class="p-0 m-0">
                      <li class="d-flex mb-4 pb-1 me-2">
                          <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-info"><i class="bx bx-check"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                  <h6 class="mb-0">Baik</h6>
                              </div>
                              <div class="user-progress">
                                  <small class="fw-semibold">{{ $item->baik }}</small>
                              </div>
                          </div>
                      </li>
                      <li class="d-flex mb-4 pb-1 me-2">
                          <div class="avatar flex-shrink-0 me-3">
                              <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-x"></i></span>
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                  <h6 class="mb-0">Rusak</h6>
                              </div>
                              <div class="user-progress">
                                  <small class="fw-semibold">{{ $item->rusak }}</small>
                              </div>
                          </div>
                      </li>
                  </ul>
                  <div class="col-lg-12 d-flex">
                      <a href="{{ route('asset-fixed.index') }}/?id_category={{ $item->id }}"
                          class="btn btn-primary ms-auto text-white">Selengkapnya</a>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
