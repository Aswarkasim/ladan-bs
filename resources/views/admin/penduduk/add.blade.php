<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($penduduk))
        <form action="/admin/dp/penduduk/{{$penduduk->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/dp/penduduk" method="POST">  
          
        @endif
          @csrf


         <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">No KK</label>
              <input type="text" class="form-control  @error('no_kk') is-invalid @enderror" required  name="no_kk"  value="{{Illuminate\Support\Facades\Session::get('no_kk')}}" placeholder="No KK">
              @error('no_kk')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
  
            
            <div class="form-group">
              <label for="">NIK</label>
              <input type="text" class="form-control  @error('nik') is-invalid @enderror" required  name="nik"  value="{{isset($penduduk) ? $penduduk->nik : old('nik')}}" placeholder="NIK">
               @error('nik')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>
  
            <div class="form-group">
              <label for="">Nama</label>
              <input type="text" class="form-control  @error('nama') is-invalid @enderror" required  name="nama"  value="{{isset($penduduk) ? $penduduk->nama : old('nama')}}" placeholder="Nama">
               @error('nama')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>
  
            <div class="form-group">
              <label for="">Jenis Kelamin</label>
             <select name="jenis_kelamin" id="" class="form-control  @error('jenis_kelamin') is-invalid @enderror">
                <option value="">-- Jenis Kelamin --</option>
                <option value="Laki-laki" {{ isset($penduduk) ? $penduduk->jenis_kelamin == 'Laki-laki' ? 'selected' : '' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ isset($penduduk) ? $penduduk->jenis_kelamin == 'Perempuan' ? 'selected' : '' : '' }}>Perempuan</option>
             </select>
               @error('jenis_kelamin')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Tempat Lahir</label>
              <input type="text" class="form-control  @error('tempat_lahir') is-invalid @enderror" required  name="tempat_lahir"  value="{{isset($penduduk) ? $penduduk->tempat_lahir : old('tempat_lahir')}}" placeholder="Tempat Lahir">
               @error('tempat_lahir')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>

            <div class="form-group">
              <label for="">Tanggal Lahir</label>
              <input type="date" class="form-control  @error('tanggal_lahir') is-invalid @enderror" required  name="tanggal_lahir"  value="{{isset($penduduk) ? $penduduk->tanggal_lahir : old('tanggal_lahir')}}" placeholder="Tanggal Lahir">
               @error('tanggal_lahir')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>

            <div class="form-group">
              <label for="">Agama</label>
              <input type="text" class="form-control  @error('agama') is-invalid @enderror" required  name="agama"  value="{{isset($penduduk) ? $penduduk->agama : old('agama')}}" placeholder="Agama">
               @error('agama')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
            </div>

            @php
                $kepala_keluarga = App\Enums\PeranKeluarga::KEPALA_KELUARGA;
                $istri = App\Enums\PeranKeluarga::ISTRI;
                $anggota = App\Enums\PeranKeluarga::ANGGOTA;

               
            @endphp
            <div class="form-group">
              <label for="">Peran</label>
             <select name="peran" id="" class="form-control  @error('peran') is-invalid @enderror">
                <option value="">-- Peran --</option>
                <option value="{{ $kepala_keluarga }}" {{ isset($penduduk) ? $penduduk->peran == $kepala_keluarga ? 'selected' : '' : '' }}>{{ $kepala_keluarga }}</option>
                <option value="{{ $istri }}" {{ isset($penduduk) ? $penduduk->peran == $istri ? 'selected' : '' : '' }}>{{ $istri }}</option>
                <option value="{{ $anggota }}" {{ isset($penduduk) ? $penduduk->peran == $anggota ? 'selected' : '' : '' }}>{{ $anggota }}</option>
             </select>
               @error('peran')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               @enderror
                </div>


          </div>
         </div>
          

     {{-- {!!form_input($errors, 'name', 'Nama', isset($penduduk) ? $penduduk : null)!!} --}}

          <a href="/admin/dp/penduduk" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

