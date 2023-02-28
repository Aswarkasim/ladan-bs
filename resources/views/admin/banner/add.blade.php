<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/banner/create'))
          <form action="/admin/banner" method="POST" enctype="multipart/form-data">  
        @else
          <form action="/admin/banner/{{$banner->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf
          

          <div class="form-group">
            <label for="">Topik</label>
            <input type="text" class="form-control  @error('topik') is-invalid @enderror"  name="topik"  value="{{isset($banner) ? $banner->topik : old('topik')}}" placeholder="Topik">
             @error('topik')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea class="form-control  @error('desc') is-invalid @enderror" id="summernote"  name="desc" placeholder="Deskripsi">{{isset($banner) ? $banner->desc : old('desc')}}</textarea>
            @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>

            <div class="form-group">
              <label for="">Urutan</label>
              <select name="urutan" class="form-control @error('urutan') is-invalid @enderror" >
                <option value="">-- Urutan --</option>
                @for ($i = 1; $i <= 10; $i++)
                        @php
                            $cek = App\Models\Banner::whereUrutan($i)->first();
                        @endphp

                        @if (!$cek)
                            
                    <option value="{{$i}}"
                      <?php 
                        if(isset($banner)){
                          if($banner->urutan == $i){
                            echo 'selected';
                          }
                        }
                        ?>
                      >{{$i}}</option>
                        @endif

             @endfor

            </select>
            @error('urutan')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image"  value="{{isset($banner) ? $banner->image : old('image')}}" placeholder="image">
            {{-- <input type="file" class="form-control  @error('image') is-invalid @enderror"  name="image"  placeholder="image"> --}}
             @error('image')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror

            @if (isset($banner))
                <img src="/{{$banner->image}}" width="100%" class="py-3" alt="">
            @endif
          </div>

     
          <a href="/admin/banner" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

