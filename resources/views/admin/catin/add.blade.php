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


        @if (isset($catin))
        <form action="/admin/tahunan/catin/{{$catin->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/catin" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">NIK</label>
                <select name="nik" class="form-control @error('nik') is-invalid @enderror" id="">
                  <option value="">-- NIK --</option>
                  @foreach ($penduduk as $item)
                      <option value="{{ $item->nik }}" {{ isset($catin) ? $catin->nik == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($catin) ? $catin->tanggal : old('tanggal')}}" placeholder="Tanggal">
                 @error('tanggal')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Berat Badan</label>
                <input type="number" class="form-control  @error('berat_badan') is-invalid @enderror"  name="berat_badan"  value="{{isset($catin) ? $catin->berat_badan : old('berat_badan')}}" placeholder="Berat Badan">
                 @error('berat_badan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Tinggi Badan</label>
                <input type="number" class="form-control  @error('tinggi_badan') is-invalid @enderror"  name="tinggi_badan"  value="{{isset($catin) ? $catin->tinggi_badan : old('tinggi_badan')}}" placeholder="Tinggi Badan">
                 @error('tinggi_badan')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label for="">Lingkar Lengan Atas</label>
                <input type="number" class="form-control  @error('lingkar_lengan_atas') is-invalid @enderror"  name="lingkar_lengan_atas"  value="{{isset($catin) ? $catin->lingkar_lengan_atas : old('lingkar_lengan_atas')}}" placeholder="Lingkat Lengan Atas">
                 @error('lingkar_lengan_atas')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Hemoglobin (HB)</label>
                <input type="number" class="form-control  @error('hb') is-invalid @enderror"  name="hb"  value="{{isset($catin) ? $catin->hb : old('hb')}}" placeholder="HB">
                 @error('hb')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Terpapar Rokok</label>
                <select name="terpapar_rokok" id="" class="form-control  @error('terpapar_rokok') is-invalid @enderror">
                  <option value="">-- Terpapar Rokok --</option>
                  <option value="YA" {{ isset($catin) ? $catin->terpapar_rokok == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($catin) ? $catin->terpapar_rokok == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('terpapar_rokok')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

              <div class="form-group">
                <label for="">Perokok</label>
                <select name="perokok" id="" class="form-control  @error('perokok') is-invalid @enderror">
                  <option value="">-- Perokok --</option>
                  <option value="YA" {{ isset($catin) ? $catin->perokok == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($catin) ? $catin->perokok == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('perokok')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>
            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($catin) ? $catin : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=catin" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

