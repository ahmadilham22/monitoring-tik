 <div class="row">
     <div class="mb-3">
         <label for="kode_sub_kategori" class="form-label">Kode Sub
             Kategori</label>
         <input type="text" name="kode_sub_kategori" class="form-control" placeholder="Masukan Kode...">
     </div>
     <div class="mb-3">
         <label for="nama_sub_kategori" class="form-label">Nama Sub
             Kategori</label>
         <input type="text" name="nama_sub_kategori" class="form-control" placeholder="Masukan Kode...">
     </div>
     <div class="mb-3" style="z-index: 100">
         <label class="form-label">Kategori</label>
         <select id="cat_id" class="form-select form-select mb-3 outline-primary" name="categories_id"
             aria-label="Large select example">
             <option value="">Pilih...</option>
             @foreach ($data as $item)
                 <option value="{{ $item->id }}">{{ $item->nama_kategori }}
                 </option>
             @endforeach
         </select>
     </div>
 </div>
