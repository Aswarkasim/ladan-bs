
  @php
  $penduduk = App\Models\Penduduk::whereNoKk(getTheSession('no_kk'))->get();
  // dd($penduduk);
@endphp


@php
$kat1 = 'Dibawah 20 Tahun';
$kat2 = '21 Tahun - 35 Tahun';
$kat3 = '35 Tahun - 49 Tahun';

$iud = 'IUD';
$mow = 'MOW';
$mop = 'MOP';
$kondom = 'KONDOM';
$implan = 'IMPLAN';
$suntik = 'SUNTIK';
$pil = 'PIL';

$h = 'H';
$ias = 'IAS';
$iat = 'IAT';
$tial = 'TIAL';

$pemerintah = 'PEMERINTAH';
$swasta = 'SWASTA';
@endphp
        

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

      


        <hr>

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text text-danger">:message</div>')) !!}
        @endif


        @if (isset($pus))
        <form action="/admin/tahunan/pus/{{$pus->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/pus" method="POST">  
          
        @endif
          @csrf

          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          {{-- <input type="hidden" name="nik_suami" value="{{ request('nik_suami') }}">
          <input type="hidden" name="nik_istri" value="{{ request('nik_istri') }}"> --}}
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


              <div class="form-group">
                <label for="">NIK Suami</label>
                <select name="nik_suami" class="form-control @error('nik_suami') is-invalid @enderror" id="">
                  <option value="">-- NIK Suami --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($pus) ? $pus->nik_suami == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik_suami')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


              <div class="form-group">
                <label for="">NIK Istri</label>
                <select name="nik_istri" class="form-control @error('nik_istri') is-invalid @enderror" id="">
                  <option value="">-- NIK Istri --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($pus) ? $pus->nik_istri == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik_istri')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($pus) ? $pus->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Kelompok Umur</label>
                <select name="kelompok_umur" id="" class="form-control  @error('kelompok_umur') is-invalid @enderror">
                  <option value="">-- Kelompok Umur --</option>
                  <option value="{{ $kat1 }}" {{ isset($pus) ? $pus->kelompok_umur == $kat1 ? 'selected' : '' : '' }}>{{ $kat1 }}</option>
                  <option value="{{ $kat2 }}" {{ isset($pus) ? $pus->kelompok_umur == $kat2 ? 'selected' : '' : '' }}>{{ $kat2 }}</option>
                  <option value="{{ $kat3 }}" {{ isset($pus) ? $pus->kelompok_umur == $kat3 ? 'selected' : '' : '' }}>{{ $kat3 }}</option>
                </select>
                 @error('kelompok_umur')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>
             


            </div>

            <div class="col-md-6">

             

             

          

          <div class="form-group">
            <label for="">Kesertaan BeKB</label>
            <select name="kesertaan_berkb" id="" class="form-control  @error('kesertaan_berkb') is-invalid @enderror">
              <option value="">-- Kesertaan BeKB --</option>
              <option value="{{ $iud }}" {{ isset($pus) ? $pus->kesertaan_berkb == $iud ? 'selected' : '' : '' }}>{{ $iud }}</option>
              <option value="{{ $iud }}" {{ isset($pus) ? $pus->kesertaan_berkb == $iud ? 'selected' : '' : '' }}>{{ $iud }}</option>
              <option value="{{ $mow }}" {{ isset($pus) ? $pus->kesertaan_berkb == $mow ? 'selected' : '' : '' }}>{{ $mow }}</option>
              <option value="{{ $mop }}" {{ isset($pus) ? $pus->kesertaan_berkb == $mop ? 'selected' : '' : '' }}>{{ $mop }}</option>
              <option value="{{ $kondom }}" {{ isset($pus) ? $pus->kesertaan_berkb == $kondom ? 'selected' : '' : '' }}>{{ $kondom }}</option>
              <option value="{{ $suntik }}" {{ isset($pus) ? $pus->kesertaan_berkb == $suntik ? 'selected' : '' : '' }}>{{ $suntik }}</option>
              <option value="{{ $pil }}" {{ isset($pus) ? $pus->kesertaan_berkb == $pil ? 'selected' : '' : '' }}>{{ $pil }}</option>
            </select>
             @error('kesertaan_berkb')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Jika Tidak BerKB</label>
            <select name="jika_tidak_berkb" id="" class="form-control  @error('jika_tidak_berkb') is-invalid @enderror">
              <option value="">-- Jika Tidak BerKB --</option>
              <option value="{{ $h }}" {{ isset($pus) ? $pus->jika_tidak_berkb == $h ? 'selected' : '' : '' }}>{{ $h }}</option>
              <option value="{{ $ias }}" {{ isset($pus) ? $pus->jika_tidak_berkb == $ias ? 'selected' : '' : '' }}>{{ $ias }}</option>
              <option value="{{ $iat }}" {{ isset($pus) ? $pus->jika_tidak_berkb == $iat ? 'selected' : '' : '' }}>{{ $iat }}</option>
              <option value="{{ $tial }}" {{ isset($pus) ? $pus->jika_tidak_berkb == $tial ? 'selected' : '' : '' }}>{{ $tial }}</option>
          </select>
             @error('jika_tidak_berkb')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Jalur</label>
            <select name="jalur" id="" class="form-control  @error('jalur') is-invalid @enderror">
              <option value="">-- Jalur --</option>
              <option value="{{ $pemerintah }}" {{ isset($pus) ? $pus->jalur == $pemerintah ? 'selected' : '' : '' }}>{{ $pemerintah }}</option>
              <option value="{{ $swasta }}" {{ isset($pus) ? $pus->jalur == $swasta ? 'selected' : '' : '' }}>{{ $swasta }}</option>
          </select>
             @error('jalur')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           
          </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($pus) ? $pus : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=pus" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

