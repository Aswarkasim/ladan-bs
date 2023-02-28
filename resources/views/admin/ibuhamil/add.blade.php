@php
    $penduduk = App\Models\Penduduk::whereNoKk(getTheSession('no_kk'))->get();
    // dd($penduduk);
@endphp

      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

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

         
          {{-- <input type="hidden" name="nik_suami" value="{{ request('nik_suami') }}">
          <input type="hidden" name="nik_istri" value="{{ request('nik_istri') }}"> --}}

          


          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
              <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($ibuhamil) ? $ibuhamil->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">NIK</label>
                <select name="nik_istri" class="form-control @error('nik_istri') is-invalid @enderror" id="">
                  <option value="">-- NIK --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($ibuhamil) ? $ibuhamil->nik_istri == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik_istri')
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

             


            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label for="">Perkiraan Kelahiran</label>
                <input type="date" class="form-control  @error('perkiraan_melahirkan') is-invalid @enderror"  name="perkiraan_melahirkan"  value="{{isset($ibuhamil) ? $ibuhamil->perkiraan_melahirkan : old('perkiraan_melahirkan')}}" placeholder="Perkiraan Kelahiran">
                 @error('perkiraan_melahirkan')
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


                  $diinginkan = 'Kehamilan yang diinginkan';
                  $tidakdiinginkan = 'Kehamilan yang tidak diinginkan';
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


          <div class="form-group">
            <label for="">Jenis Kehamilan</label>
            <select name="jenis_kehamilan" id="" class="form-control  @error('jenis_kehamilan') is-invalid @enderror">
              <option value="">-- Jenis Kehamilan --</option>
              <option value="{{ $diinginkan }}" {{ isset($ibuhamil) ? $ibuhamil->jenis_kehamilan == $diinginkan ? 'selected' : '' : '' }}>{{ $diinginkan }}</option>
              <option value="{{ $tidakdiinginkan }}" {{ isset($ibuhamil) ? $ibuhamil->jenis_kehamilan == $tidakdiinginkan ? 'selected' : '' : '' }}>{{ $tidakdiinginkan }}</option>
          </select>
             @error('jenis_kehamilan')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           
          </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($ibuhamil) ? $ibuhamil : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=ibuhamil" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

