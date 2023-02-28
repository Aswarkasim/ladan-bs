
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        <form action="" method="GET">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <label for="">NIK Suami</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control  @error('nik_suami') is-invalid @enderror" value="{{ request('nik_suami') }}"  name="nik_suami" placeholder="NIK Suami">

                  @if (request('nik_suami'))
                    @if ($suami == 'kosong')
                      <span class="text-danger"> Data tidak ditemukan</span>
                    @endif
                  @endif

                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                  <label for="">NIK Istri</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control  @error('nik_istri') is-invalid @enderror" value="{{ request('nik_istri') }}"  name="nik_istri" placeholder="NIK Istri">

                  @if (request('nik_istri'))
                    @if ($suami == 'kosong')
                      <span class="text-danger"> Data tidak ditemukan</span>
                    @endif
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                  <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>
              </div>
            </div>


            

          </div>
        </div>
            </form>


        <hr>

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text text-danger">:message</div>')) !!}
        @endif


        @if (isset($ibuhamil))
        <form action="/admin/tahunan/ibuhamil/{{$ibuhamil->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/ibuhamil" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="nik_suami" value="{{ request('nik_suami') }}">
          <input type="hidden" name="nik_istri" value="{{ request('nik_istri') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">Nomor KK</label>
                <input type="text" class="form-control  @error('no_kk') is-invalid @enderror"  name="no_kk" 
                value="{{ $suami != 'kosong' ? $suami->no_kk : ''}}" placeholder="Nomor KK">
                @error('no_kk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>
              <hr>
              <div class="form-group">
                <label for="">Nama Suami</label>
                <input type="text" class="form-control  @error('nama') is-invalid @enderror" disabled  name="nama" 
                value="{{ $suami != 'kosong' ? $suami->nama : ''}}" placeholder="Nama">
                @error('nama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal Lahir Suami</label>
                <input type="text" class="form-control  @error('tanggal_lahir') is-invalid @enderror" disabled  name="tanggal_lahir"  value="{{ $suami != 'kosong' ? $suami->tanggal_lahir : ''}}" placeholder="Tanggal Lahir">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <hr>

              <div class="form-group">
                <label for="">Nama Istri</label>
                <input type="text" class="form-control  @error('nama') is-invalid @enderror" disabled  name="nama" 
                value="{{ $istri != 'kosong' ? $istri->nama : ''}}" placeholder="Nama">
                @error('nama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal Lahir Istri</label>
                <input type="text" class="form-control  @error('tanggal_lahir') is-invalid @enderror" disabled  name="tanggal_lahir"  value="{{ $istri != 'kosong' ? $istri->tanggal_lahir : ''}}" placeholder="Tanggal Lahir">
                @error('tanggal_lahir')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <hr>

            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">Tahun</label>
                <input type="text" class="form-control  @error('tahun') is-invalid @enderror"  name="tahun"  value="{{isset($ibuhamil) ? $ibuhamil->tahun : old('tahun')}}" placeholder="Tahun">
                 @error('tahun')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Kehamilan Keberapa</label>
                <input type="number" class="form-control  @error('kehamilan_keberapa') is-invalid @enderror"  name="kehamilan_keberapa"  value="{{isset($ibuhamil) ? $ibuhamil->kehamilan_keberapa : old('kehamilan_keberapa')}}" placeholder="Kehamilan Keberapa">
                 @error('kehamilan_keberapa')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal Mulai Hamil</label>
                <input type="date" class="form-control  @error('tanggal_mulai_hamil') is-invalid @enderror"  name="tanggal_mulai_hamil"  value="{{isset($ibuhamil) ? $ibuhamil->tanggal_mulai_hamil : old('tanggal_mulai_hamil')}}" placeholder="Tanggal Mulai Hamil">
                 @error('tanggal_mulai_hamil')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Perkiraan Kelahiran</label>
                <input type="date" class="form-control  @error('perkiraan_kelahiran') is-invalid @enderror"  name="perkiraan_kelahiran"  value="{{isset($ibuhamil) ? $ibuhamil->perkiraan_kelahiran : old('perkiraan_kelahiran')}}" placeholder="Perkiraan Kelahiran">
                 @error('perkiraan_kelahiran')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal Kelahiran</label>
                <input type="date" class="form-control  @error('tanggal_kelahiran') is-invalid @enderror"  name="tanggal_kelahiran"  value="{{isset($ibuhamil) ? $ibuhamil->tanggal_kelahiran : old('tanggal_kelahiran')}}" placeholder="Tanggal Kelahiran">
                 @error('tanggal_kelahiran')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              @php
                  $melahirkan = 'Melahirkan';
                  $mengandung = 'Mengandung';
              @endphp

          

          <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control  @error('status') is-invalid @enderror">
              <option value="">-- Status --</option>
              <option value="{{ $melahirkan }}" {{ isset($ibuhamil) ? $ibuhamil->status == $melahirkan ? 'selected' : '' : '' }}>{{ $melahirkan }}</option>
              <option value="{{ $mengandung }}" {{ isset($ibuhamil) ? $ibuhamil->status == $mengandung ? 'selected' : '' : '' }}>{{ $mengandung }}</option>
          </select>
             @error('status')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           
          </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($ibuhamil) ? $ibuhamil : null)!!} --}}

          <a href="/admin/tahunan/ibuhamil" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

