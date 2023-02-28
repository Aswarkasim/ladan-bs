@php
    $penduduk = App\Models\Penduduk::whereNoKk(getTheSession('no_kk'))->get();

@endphp
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">

            <form action="" method="GET">
              <div class="d-flex">
                <input type="text" class="form-control  @error('nik') is-invalid @enderror" value="{{ request('nik') }}"  name="nik" placeholder="NIK">
                <button class="btn btn-primary"> Cari</button>
              </div>
            </form>

            @if (request('nik'))
              @if ($penduduk == 'kosong')
                <span class="text-danger"> Data tidak ditemukan</span>
              @endif
            @endif

          </div>
        </div>

        <hr>

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text text-danger">:message</div>')) !!}
        @endif


        @if (isset($lansia))
        <form action="/admin/tahunan/lansia/{{$lansia->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/lansia" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="nik" value="{{ request('nik') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">Nomor KK</label>
                <input type="text" class="form-control  @error('no_kk') is-invalid @enderror"  name="no_kk" 
                value="{{ $penduduk != 'kosong' ? $penduduk->no_kk : ''}}" placeholder="Nomor KK">
                @error('no_kk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control  @error('nama') is-invalid @enderror" disabled  name="nama" 
                value="{{ $penduduk != 'kosong' ? $penduduk->nama : ''}}" placeholder="Nama">
                @error('nama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="text" class="form-control  @error('tanggal_lahir') is-invalid @enderror" disabled  name="tanggal_lahir"  value="{{ $penduduk != 'kosong' ? $penduduk->tanggal_lahir : ''}}" placeholder="Tanggal Lahir">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <input type="text" class="form-control  @error('jenis_kelamin') is-invalid @enderror" disabled  name="jenis_kelamin"  value="{{ $penduduk != 'kosong' ? $penduduk->jenis_kelamin : ''}}" placeholder="Jenis Kelamin">
                @error('jenis_kelamin')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">Tahun</label>
                <input type="text" class="form-control  @error('tahun') is-invalid @enderror"  name="tahun"  value="{{isset($lansia) ? $lansia->tahun : old('tahun')}}" placeholder="Tahun">
                 @error('tahun')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">POKTAN BKL</label>
                <select name="poktan_bkl" id="" class="form-control  @error('poktan_bkl') is-invalid @enderror">
                  <option value="">-- POKTAN BKL --</option>
                  <option value="YA" {{ isset($lansia) ? $lansia->poktan_bkl == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($lansia) ? $lansia->poktan_bkl == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('poktan_bkl')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              
            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($lansia) ? $lansia : null)!!} --}}

          <a href="/admin/tahunan/lansia" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

