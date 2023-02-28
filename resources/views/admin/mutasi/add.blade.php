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


        @if (isset($mutasi))
        <form action="/admin/tahunan/mutasi/{{$mutasi->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/mutasi" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">Pertanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($mutasi) ? $mutasi->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">NIK</label>
                <select name="nik" class="form-control @error('nik') is-invalid @enderror" id="">
                  <option value="">-- NIK --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($mutasi) ? $mutasi->nik == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


              

              @php
                   $tidak = App\Enums\MutasiEnum::TIDAK;
                $kelahiran = App\Enums\MutasiEnum::KELAHIRAN;
                $kematian = App\Enums\MutasiEnum::KEMATIAN;
                $pindahmasuk = App\Enums\MutasiEnum::PINDAHMASUK;
                $pindahdatang = App\Enums\MutasiEnum::PINDAHDATANG;
              @endphp

              <div class="form-group">
                <label for="">Mutasi</label>
                <select name="mutasi" id="" class="form-control  @error('mutasi') is-invalid @enderror">
                  <option value="">-- Mutasi --</option>
                  <option value="{{ $kelahiran }}" {{ isset($mutasi) ? $mutasi->mutasi == $kelahiran ? 'selected' : '' : '' }}>{{ $kelahiran }}</option>
                  <option value="{{ $kematian }}" {{ isset($mutasi) ? $mutasi->mutasi == $kematian ? 'selected' : '' : '' }}>{{ $kematian }}</option>
                  <option value="{{ $pindahmasuk }}" {{ isset($mutasi) ? $mutasi->mutasi == $pindahmasuk ? 'selected' : '' : '' }}>{{ $pindahmasuk }}</option>
                  <option value="{{ $pindahdatang }}" {{ isset($mutasi) ? $mutasi->mutasi == $pindahdatang ? 'selected' : '' : '' }}>{{ $pindahdatang }}</option>
                </select>
                 @error('mutasi')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              

            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($mutasi) ? $mutasi : null)!!} --}}

          <a href="/admin/tahunan/mutasi" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

