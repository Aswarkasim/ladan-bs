<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">


          <form action="/admin/konfigurasi/update" method="POST" enctype="multipart/form-data">  
            @method('PUT')
          @csrf
        
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama Aplikasi</label>
                <input type="text" class="form-control  @error('app_name') is-invalid @enderror"  name="app_name"  value="{{isset($konfigurasi) ? $konfigurasi->app_name : old('app_name')}}" placeholder="Nama">
                @error('app_name')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($konfigurasi) ? $konfigurasi->alamat : old('alamat')}}" placeholder="Alamat">
                @error('alamat')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">No. Telepon</label>
                <input type="text" class="form-control  @error('no_telp') is-invalid @enderror"  name="no_telp"  value="{{isset($konfigurasi) ? $konfigurasi->no_telp : old('no_telp')}}" placeholder="No. Telepon">
                @error('no_telp')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control  @error('email') is-invalid @enderror"  name="email"  value="{{isset($konfigurasi) ? $konfigurasi->email : old('email')}}" placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

                <div class="form-group">
                  <label for="">Logo</label>
                  <input type="file" class="form-control  @error('logo') is-invalid @enderror"  name="logo"  placeholder="logo">
                  {{-- <input type="file" class="form-control  @error('logo') is-invalid @enderror"  name="logo"  placeholder="logo"> --}}
                  @error('logo')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                  @enderror

                  @if (isset($konfigurasi))
                      <img src="/{{$konfigurasi->logo}}" width="100%" class="py-3" alt="">
                  @endif
                </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Link Facebook</label>
                <input type="text" class="form-control  @error('fb') is-invalid @enderror"  name="fb"  value="{{isset($konfigurasi) ? $konfigurasi->fb : old('fb')}}" placeholder="Facebook">
                @error('fb')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Link Instagram</label>
                <input type="text" class="form-control  @error('ig') is-invalid @enderror"  name="ig"  value="{{isset($konfigurasi) ? $konfigurasi->ig : old('ig')}}" placeholder="Instagram">
                @error('ig')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Link Whatsapp</label>
                <input type="text" class="form-control  @error('wa') is-invalid @enderror"  name="wa"  value="{{isset($konfigurasi) ? $konfigurasi->wa : old('wa')}}" placeholder="Alamat">
                @error('wa')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Link Twitter</label>
                <input type="text" class="form-control  @error('tw') is-invalid @enderror"  name="tw"  value="{{isset($konfigurasi) ? $konfigurasi->tw : old('tw')}}" placeholder="Twitter">
                @error('tw')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Link Map</label>
                <input type="text" class="form-control  @error('maps') is-invalid @enderror"  name="maps"  value="{{isset($konfigurasi) ? $konfigurasi->maps : old('maps')}}" placeholder="Map">
                @error('maps')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

            </div>
          </div>
          

       

          <a href="/admin/konfigurasi" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

