
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">

            <form action="" method="GET">
              <div class="d-flex">
                <input type="text" class="form-control  @error('nik') is-invalid @enderror" value="{{ request('nik') }}"  name="nik" placeholder="NIK">
                <button class="btn btn-primary">Cari</button>
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


        @if (isset($keluarga))
        <form action="/admin/tahunan/datapenduduk/{{$keluarga->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/datapenduduk" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="nik" value="{{ request('nik') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

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

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($datapenduduk) ? $datapenduduk->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control  @error('alamat') is-invalid @enderror"  name="alamat"  value="{{isset($datapenduduk) ? $datapenduduk->alamat : old('alamat')}}" placeholder="Alamat">
                 @error('alamat')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              {{-- <div class="form-group">
                <label for="">Usia Kawin Pertama</label>
                <input type="number" class="form-control  @error('usia_kawin_pertama') is-invalid @enderror"  name="usia_kawin_pertama"  value="{{isset($datapenduduk) ? $datapenduduk->usia_kawin_pertama : old('usia_kawin_pertama')}}" placeholder="0">
                 @error('usia_kawin_pertama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div> --}}

              <div class="form-group">
                <label for="">Pekerjaan</label>
                <input type="text" class="form-control  @error('pekerjaan') is-invalid @enderror"  name="pekerjaan"  value="{{isset($datapenduduk) ? $datapenduduk->pekerjaan : old('pekerjaan')}}" placeholder="Pekerjaan">
                 @error('pekerjaan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              @php
                  $menikah = 'Menikah';
                  $janda = 'Janda';
                  $duda = 'Duda';
                  $belum = 'Belum Menikah';
              @endphp

              <div class="form-group">
                <label for="">Status Perkawinan</label>
                <select name="status_perkawinan" id="" class="form-control  @error('status_perkawinan') is-invalid @enderror">
                  <option value="">-- Status Pernikahan --</option>
                  <option value="{{ $menikah }}" {{ isset($datapenduduk) ? $datapenduduk->status_perkawinan == $menikah ? 'selected' : '' : '' }}>{{ $menikah }}</option>
                  <option value="{{ $janda }}" {{ isset($datapenduduk) ? $datapenduduk->status_perkawinan == $janda ? 'selected' : '' : '' }}>{{ $janda }}</option>
                  <option value="{{ $duda }}" {{ isset($datapenduduk) ? $datapenduduk->status_perkawinan == $duda ? 'selected' : '' : '' }}>{{ $duda }}</option>
                  <option value="{{ $belum }}" {{ isset($datapenduduk) ? $datapenduduk->status_perkawinan == $belum ? 'selected' : '' : '' }}>{{ $belum }}</option>
                </select>
                 @error('status_perkawinan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              


            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">PBI</label>
                <select name="pbi" id="" class="form-control  @error('pbi') is-invalid @enderror">
                  <option value="">-- PBI --</option>
                  <option value="YA" {{ isset($datapenduduk) ? $datapenduduk->pbi == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($datapenduduk) ? $datapenduduk->pbi == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('pbi')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">BPJS</label>
                <select name="bpjs" id="" class="form-control  @error('bpjs') is-invalid @enderror">
                  <option value="">-- BPJS --</option>
                  <option value="YA" {{ isset($datapenduduk) ? $datapenduduk->bpjs == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($datapenduduk) ? $datapenduduk->bpjs == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('bpjs')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Asuransi Swasta</label>
                <input type="text" class="form-control  @error('asuransi_swasta') is-invalid @enderror"  name="asuransi_swasta"  value="{{isset($datapenduduk) ? $datapenduduk->asuransi_swasta : old('asuransi_swasta')}}" placeholder="Asuransi Swasta">
                 @error('asuransi_swasta')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              

              <div class="form-group">
                <label for="">Status Dalam Keluarga</label>
                <select name="status_dalam_kk" id="" class="form-control  @error('status_dalam_kk') is-invalid @enderror">
                  <option value="">-- Status Dalam Keluarga --</option>
                  <option value="SUAMI" {{ isset($datapenduduk) ? $datapenduduk->status_dalam_kk == 'SUAMI' ? 'selected' : '' : '' }}>SUAMI</option>
                  <option value="ISTRI" {{ isset($datapenduduk) ? $datapenduduk->status_dalam_kk == 'ISTRI' ? 'selected' : '' : '' }}>ISTRI</option>
                  <option value="BALITA" {{ isset($datapenduduk) ? $datapenduduk->status_dalam_kk == 'BALITA' ? 'selected' : '' : '' }}>BALITA</option>
                  <option value="REMAJA" {{ isset($datapenduduk) ? $datapenduduk->status_dalam_kk == 'REMAJA' ? 'selected' : '' : '' }}>REMAJA</option>
                  <option value="LANSIA" {{ isset($datapenduduk) ? $datapenduduk->status_dalam_kk == 'LANSIA' ? 'selected' : '' : '' }}>LANSIA</option>
                </select>
                 @error('status_dalam_kk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Pendidikan Terakhir</label>
                <input type="text" class="form-control  @error('pendidikan_terakhir') is-invalid @enderror"  name="pendidikan_terakhir"  value="{{isset($datapenduduk) ? $datapenduduk->pendidikan_terakhir : old('pendidikan_terakhir')}}" placeholder="Pendidikan">
                 @error('pendidikan_terakhir')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Kepemilikan KTP</label>
                <select name="kepemilikan_ktp" id="" class="form-control  @error('kepemilikan_ktp') is-invalid @enderror">
                  <option value="">-- Kepemilikan KTP --</option>
                  <option value="YA" {{ isset($datapenduduk) ? $datapenduduk->kepemilikan_ktp == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($datapenduduk) ? $datapenduduk->kepemilikan_ktp == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('kepemilikan_ktp')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Memiliki Akta Kelahiran</label>
                <select name="memiliki_akta_kelahiran" id="" class="form-control  @error('memiliki_akta_kelahiran') is-invalid @enderror">
                  <option value="">-- Memiliki Akta Kelahiran --</option>
                  <option value="YA" {{ isset($datapenduduk) ? $datapenduduk->memiliki_akta_kelahiran == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($datapenduduk) ? $datapenduduk->memiliki_akta_kelahiran == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('memiliki_akta_kelahiran')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

            </div>
          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($keluarga) ? $keluarga : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=penduduk" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

