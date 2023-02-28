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


        @if (isset($remaja))
        <form action="/admin/tahunan/remaja/{{$remaja->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/remaja" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($remaja) ? $remaja->tanggal : old('tanggal')}}" placeholder="Tanggal">
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
                      <option value="{{ $item->nik }}" {{ isset($remaja) ? $remaja->nik == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


              

              <div class="form-group">
                <label for="">Kesertaam PIKR</label>
                <select name="kesertaan_pikr" id="" class="form-control  @error('kesertaan_pikr') is-invalid @enderror">
                  <option value="">-- Kesertaam PIKR --</option>
                  <option value="YA" {{ isset($remaja) ? $remaja->kesertaan_pikr == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($remaja) ? $remaja->kesertaan_pikr == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('kesertaan_pikr')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


              <div class="form-group">
                <label for="">Keaktidan PIKR</label>
                <select name="keaktifan_pikr" id="" class="form-control  @error('keaktifan_pikr') is-invalid @enderror">
                  <option value="">-- Keaktidan PIKR --</option>
                  <option value="YA" {{ isset($remaja) ? $remaja->keaktifan_pikr == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($remaja) ? $remaja->keaktifan_pikr == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('keaktifan_pikr')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>


            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($remaja) ? $remaja : null)!!} --}}

          <a href="/admin/dp/keluarga/{{ getTheSession('keluarga_id') }}?page=remaja" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

