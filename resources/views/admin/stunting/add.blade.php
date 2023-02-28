@php
    $penduduk = App\Models\Penduduk::whereNoKk(getTheSession('no_kk'))->get();
    // dd($penduduk);

    $jumlah_anggota_keluarga = count($penduduk);
    $jumlah_baduta = 0;
    $jumlah_balita = 0;

    foreach ($penduduk as $item) {
      $umur = hitung_umur_bulan($item->tanggal_lahir);
      if($umur >= 0 && $umur <=24){
        $jumlah_baduta = $jumlah_baduta+1;
      }

      if($umur >= 25 && $umur <=59){
        $jumlah_balita = $jumlah_balita+1;
      }

      // echo $item->nama.':'.hitung_umur_bulan($item->tanggal_lahir).'<br>';
    }

    $indikator_1 = App\Enums\IndikatorStunting::indikator_1;
    $indikator_2 = App\Enums\IndikatorStunting::indikator_2;
    $indikator_3 = App\Enums\IndikatorStunting::indikator_3;
    $indikator_4 = App\Enums\IndikatorStunting::indikator_4;
    $indikator_5 = App\Enums\IndikatorStunting::indikator_5;
    $indikator_6 = App\Enums\IndikatorStunting::indikator_6;
    $indikator_7 = App\Enums\IndikatorStunting::indikator_7;
    $indikator_8 = App\Enums\IndikatorStunting::indikator_8;
    $indikator_9 = App\Enums\IndikatorStunting::indikator_9;
    $indikator_10 = App\Enums\IndikatorStunting::indikator_10;
    $indikator_11 = App\Enums\IndikatorStunting::indikator_11;
    $indikator_12 = App\Enums\IndikatorStunting::indikator_12;
@endphp
      

<div class="row">
  <div class="col-md-12">
    <div class="p-3  card">
      <div class="card-body">

        <hr>

        @if($errors->any())
            {!! implode('', $errors->all('<div class="text text-danger">:message</div>')) !!}
        @endif


        @if (isset($stunting))
        <form action="/admin/tahunan/stunting/{{$stunting->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/stunting" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              {{-- <div class="form-group">
                <label for="">NIK</label>
                <select name="no_kk" class="form-control @error('no_kk') is-invalid @enderror" id="">
                  <option value="">-- NIK --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->no_kk }}" {{ isset($stunting) ? $stunting->no_kk == $item->no_kk ? 'selected' : '' : '' }}>{{ $item->no_kk.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('no_kk')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div> --}}


              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($stunting) ? $stunting->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              <div class="form-group">
                <label for="">Jumlah Anggota Keluarga</label>
                <input type="number" class="form-control  @error('jumlah_anggota_keluarga') is-invalid @enderror"  name="jumlah_anggota_keluarga"  value="{{$jumlah_anggota_keluarga}}" placeholder="Jumlah Anggota Keluarga">
                 @error('jumlah_anggota_keluarga')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Jumlah Baduta</label>
                <input type="number" class="form-control  @error('jumlah_baduta') is-invalid @enderror"  name="jumlah_baduta"  value="{{$jumlah_baduta }}" placeholder="Jumlah Balita">
                 @error('jumlah_baduta')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Jumlah Balita</label>
                <input type="nember" class="form-control  @error('jumlah_balita') is-invalid @enderror"  name="jumlah_balita"  value="{{$jumlah_balita}}" placeholder="Jumlah Balita">
                 @error('jumlah_balita')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_1 }}</label>
                <select name="indikator_1" id="" class="form-control  @error('indikator_1') is-invalid @enderror">
                  <option value="">-- {{ $indikator_1 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_1 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_1 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_1')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              <div class="form-group">
                <label for="">{{ $indikator_2 }}</label>
                <select name="indikator_2" id="" class="form-control  @error('indikator_2') is-invalid @enderror">
                  <option value="">-- {{ $indikator_2 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_2 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_2 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_2')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_3 }}</label>
                <select name="indikator_3" id="" class="form-control  @error('indikator_3') is-invalid @enderror">
                  <option value="">-- {{ $indikator_3 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_3 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_3 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_3')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_4 }}</label>
                <select name="indikator_4" id="" class="form-control  @error('indikator_4') is-invalid @enderror">
                  <option value="">-- {{ $indikator_4 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_4 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_4 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_4')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

            
            </div>
            <div class="col-md-6">

              

              <div class="form-group">
                <label for="">{{ $indikator_5 }}</label>
                <select name="indikator_5" id="" class="form-control  @error('indikator_5') is-invalid @enderror">
                  <option value="">-- {{ $indikator_5 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_5 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_5 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_5')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_6 }}</label>
                <select name="indikator_6" id="" class="form-control  @error('indikator_6') is-invalid @enderror">
                  <option value="">-- {{ $indikator_6 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_6 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_6 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_6')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_7 }}</label>
                <select name="indikator_7" id="" class="form-control  @error('indikator_7') is-invalid @enderror">
                  <option value="">-- {{ $indikator_7 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_7 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_7 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_7')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_8 }}</label>
                <select name="indikator_8" id="" class="form-control  @error('indikator_8') is-invalid @enderror">
                  <option value="">-- {{ $indikator_8 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_8 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_8 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_8')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_9 }}</label>
                <select name="indikator_9" id="" class="form-control  @error('indikator_9') is-invalid @enderror">
                  <option value="">-- {{ $indikator_9 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_9 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_9 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_9')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_10 }}</label>
                <select name="indikator_10" id="" class="form-control  @error('indikator_10') is-invalid @enderror">
                  <option value="">-- {{ $indikator_10 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_10 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_10 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_10')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_11 }}</label>
                <select name="indikator_11" id="" class="form-control  @error('indikator_11') is-invalid @enderror">
                  <option value="">-- {{ $indikator_11 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_11 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_11 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_11')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">{{ $indikator_12 }}</label>
                <select name="indikator_12" id="" class="form-control  @error('indikator_12') is-invalid @enderror">
                  <option value="">-- {{ $indikator_12 }} --</option>
                  <option value="YA" {{ isset($stunting) ? $stunting->indikator_12 == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($stunting) ? $stunting->indikator_12 == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('indikator_12')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($stunting) ? $stunting : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=stunting" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

