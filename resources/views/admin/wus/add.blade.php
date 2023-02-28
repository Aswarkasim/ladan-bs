@php
    $penduduk = App\Models\Penduduk::whereNoKk(getTheSession('no_kk'))->get();
    // dd($penduduk);
@endphp
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        <hr>

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text text-danger">:message</div>')) !!}
        @endif


        @if (isset($wus))
        <form action="/admin/tahunan/wus/{{$wus->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/wus" method="POST">  
          
        @endif
          @csrf

          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          {{-- <input type="hidden" name="nik" value="{{ request('nik') }}"> --}}
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">NIK</label>
                <select name="nik" class="form-control @error('nik') is-invalid @enderror" id="">
                  <option value="">-- NIK --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($wus) ? $wus->nik == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


              <div class="form-group">
                <label for="">Tahun</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($wus) ? $wus->tanggal : old('tanggal')}}" placeholder="Tahun">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              @php
                $janda = 'Janda';
                $belum = 'Belum Menikah';
              @endphp

            <div class="form-group">
              <label for="">Status Perkawinan</label>
              <select name="status_pernikahan" id="" class="form-control  @error('status_pernikahan') is-invalid @enderror">
                <option value="">-- Status Pernikahan --</option>
                <option value="{{ $janda }}" {{ isset($wus) ? $wus->status_pernikahan == $janda ? 'selected' : '' : '' }}>{{ $janda }}</option>
                <option value="{{ $belum }}" {{ isset($wus) ? $wus->status_pernikahan == $belum ? 'selected' : '' : '' }}>{{ $belum }}</option>
              </select>
              @error('status_pernikahan')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
              @enderror
            </div>

             

            </div>

            <div class="col-md-6">

              

             


              
            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($wus) ? $wus : null)!!} --}}

          <a href="/admin/tahunan/wus" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

