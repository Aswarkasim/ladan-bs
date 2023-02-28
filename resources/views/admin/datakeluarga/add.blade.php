
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        {{-- <div class="row">
          <div class="col-md-6">

            <form action="" method="GET">
              <div class="d-flex">
                <input type="text" class="form-control  @error('no_kk') is-invalid @enderror" value="{{ request('no_kk') }}"  name="no_kk" placeholder="NIK">
                <button class="btn btn-primary">Cari</button>
              </div>
            </form>

            @if (request('no_kk'))
              @if ($penduduk == 'kosong')
                <span class="text-danger"> Data tidak ditemukan</span>
              @endif
            @endif

          </div>
        </div> --}}

        <hr>
        @if (isset($datakeluarga))
        <form action="/admin/tahunan/datakeluarga/{{$datakeluarga->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/datakeluarga" method="POST">  
          
        @endif
          @csrf


          @php
              $no_kk = getTheSession('no_kk');
          @endphp

          <input type="hidden" name="no_kk" value="{{ $no_kk }}">

          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">No. KK</label>
                <input type="text" class="form-control  @error('no_kk') is-invalid @enderror" disabled  name="no_kk" 
                value="{{  $no_kk }}" placeholder="Nama">
                @error('no_kk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($datakeluarga) ? $datakeluarga->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              @php
              $kps = 'KPS';
              $ks1 = 'KS1';
              $ks2 = 'KS2';
              $ks3 = 'KS3';
          @endphp

          <div class="form-group">
            <label for="">Tahapan Keluarga Sejahtera</label>
            <select name="tahapan_ks" id="" class="form-control  @error('tahapan_ks') is-invalid @enderror">
              <option value="">-- Tahapan Keluarga Sejahtera --</option>
              <option value="{{ $kps }}" {{ isset($datakeluarga) ? $datakeluarga->tahapan_ks == $kps ? 'selected' : '' : '' }}>{{ $kps }}</option>
              <option value="{{ $ks1 }}" {{ isset($datakeluarga) ? $datakeluarga->tahapan_ks == $ks1 ? 'selected' : '' : '' }}>{{ $ks1 }}</option>
              <option value="{{ $ks2 }}" {{ isset($datakeluarga) ? $datakeluarga->tahapan_ks == $ks2 ? 'selected' : '' : '' }}>{{ $ks2 }}</option>
              <option value="{{ $ks3 }}" {{ isset($datakeluarga) ? $datakeluarga->tahapan_ks == $ks3 ? 'selected' : '' : '' }}>{{ $ks3 }}</option>
            </select>
             @error('tahapan_ks')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>


            </div>

            <div class="col-md-6">

             

              
            </div>
          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($keluarga) ? $keluarga : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ Illuminate\Support\Facades\Session::get('keluarga_id') }}?page=datakeluarga" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

