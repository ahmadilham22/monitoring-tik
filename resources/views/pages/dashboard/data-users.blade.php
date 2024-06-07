 @foreach ($dataUsers as $item)
     <div class="col-md-4 col-lg-4 col-xl-4 order-0 mb-4">
         <div class="card h-100">
             <div class="card-body">
                 <div class="d-flex justify-content-between align-items-center mb-3">
                     <div class="d-flex align-items-center gap-1 mb-3">
                         <img src="{{ asset('assets/img/avatars/1.png') }}" class="img-fluid rounded me-3" height="50"
                             width="50" alt="">
                         <h4 class="mb-2">{{ $item->user_name }}</h4>
                     </div>
                 </div>
                 <div class="">
                     <h5><strong>Penanggung Jawab Aset</strong></h5>
                 </div>
                 <div class="d-flex justify-content-between align-items-center mb-3">
                     <div class="d-flex flex-column align-items-center gap-1">
                         <h2 class="mb-2"></h2>
                     </div>
                 </div>
                 <ul class="p-0 m-0">
                     @foreach (json_decode($item->category) as $category)
                         <li class="d-flex mb-4 pb-1 me-2">
                             <div class="avatar flex-shrink-0 me-3">
                                 <span class="avatar-initial rounded bg-label-info"><i
                                         class="fa-solid fa-folder"></i></span>
                             </div>
                             <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                 <div class="me-2">
                                     <h6 class="mb-0">{{ $category->category_name }}</h6>
                                 </div>
                                 <div class="user-progress">
                                     <small class="fw-semibold">{{ $category->category_count }}</small>
                                 </div>
                             </div>
                         </li>
                     @endforeach
                 </ul>
             </div>
             <div class="col-lg-12 d-flex justify-content-end">
                 {{-- <a class="btn btn-primary mb-4 text-white me-4"
                     href="{{ route('asset-fixed.index') }}/?id_user={{ $item->user_id }}">Selengkapnya</a> --}}
                 <a class="btn btn-primary mb-4 text-white me-4"
                     href="{{ route('asset-fixed.index') }}/?kode_lokasi={{ $item->user_id }}">Selengkapnya</a>
             </div>
         </div>
     </div>
 @endforeach
