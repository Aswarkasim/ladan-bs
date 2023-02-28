
      

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
        @if (isset($keluarga))
        <form action="/admin/tahunan/datapenduduk/{{$keluarga->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/datapenduduk" method="POST">  
          
        @endif
          @csrf

         

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
                <label for="">Tahun</label>
                <input type="text" class="form-control  @error('tahun') is-invalid @enderror"  name="tahun"  value="{{isset($datapenduduk) ? $datapenduduk->tahun : old('tahun')}}" placeholder="Tahun">
                 @error('tahun')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Alamat</label>
                <input type="text" class="form-control  @error('tahun') is-invalid @enderror"  name="tahun"  value="{{isset($datapenduduk) ? $datapenduduk->tahun : old('tahun')}}" placeholder="Alamat">
                 @error('tahun')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Usia Kawin Pertama</label>
                <input type="text" class="form-control  @error('usia_kawin_pertama') is-invalid @enderror"  name="usia_kawin_pertama"  value="{{isset($datapenduduk) ? $datapenduduk->usia_kawin_pertama : old('usia_kawin_pertama')}}" placeholder="Usia Kawin Pertama">
                 @error('usia_kawin_pertama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Pekerjaan</label>
                <input type="text" class="form-control  @error('memiliki_akta_lahir') is-invalid @enderror"  name="memiliki_akta_lahir"  value="{{isset($datapenduduk) ? $datapenduduk->memiliki_akta_lahir : old('memiliki_akta_lahir')}}" placeholder="Pekerjaan">
                 @error('memiliki_akta_lahir')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Status Perkawinan</label>
                <input type="text" class="form-control  @error('pekerjaan') is-invalid @enderror"  name="pekerjaan"  value="{{isset($datapenduduk) ? $datapenduduk->pekerjaan : old('pekerjaan')}}" placeholder="Status Perkawinan">
                 @error('pekerjaan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              


            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">PBI</label>
                <input type="text" class="form-control  @error('pbi') is-invalid @enderror"  name="pbi"  value="{{isset($datapenduduk) ? $datapenduduk->pbi : old('pbi')}}" placeholder="PBI">
                 @error('pbi')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">BPJS</label>
                <input type="text" class="form-control  @error('bpjs') is-invalid @enderror"  name="bpjs"  value="{{isset($datapenduduk) ? $datapenduduk->bpjs : old('bpjs')}}" placeholder="BPJS">
                 @error('bpjs')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Asuransi</label>
                <input type="text" class="form-control  @error('asuransi') is-invalid @enderror"  name="asuransi"  value="{{isset($datapenduduk) ? $datapenduduk->asuransi : old('asuransi')}}" placeholder="Asuransi">
                 @error('asuransi')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Kepemilikan KTP</label>
                <input type="text" class="form-control  @error('kepemilikan_ktp') is-invalid @enderror"  name="kepemilikan_ktp"  value="{{isset($datapenduduk) ? $datapenduduk->kepemilikan_ktp : old('kepemilikan_ktp')}}" placeholder="Kepemilikan KTP">
                 @error('kepemilikan_ktp')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Status Dalam Keluarga</label>
                <input type="text" class="form-control  @error('status_dalam_keluarga') is-invalid @enderror"  name="status_dalam_keluarga"  value="{{isset($datapenduduk) ? $datapenduduk->status_dalam_keluarga : old('status_dalam_keluarga')}}" placeholder="Status Dalam Keluarga">
                 @error('status_dalam_keluarga')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Pendidikan</label>
                <input type="text" class="form-control  @error('pendidikan') is-invalid @enderror"  name="pendidikan"  value="{{isset($datapenduduk) ? $datapenduduk->pendidikan : old('pendidikan')}}" placeholder="Pendidikan">
                 @error('pendidikan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Memiliki Akta Lahir</label>
                <input type="text" class="form-control  @error('pekerjaan') is-invalid @enderror"  name="pekerjaan"  value="{{isset($datapenduduk) ? $datapenduduk->pekerjaan : old('pekerjaan')}}" placeholder="Memiliki Akta Lahir">
                 @error('pekerjaan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

            </div>
          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($keluarga) ? $keluarga : null)!!} --}}

          <a href="/admin/tahunan/datapenduduk" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

