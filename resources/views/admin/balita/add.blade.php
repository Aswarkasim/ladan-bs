
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


        @if (isset($balita))
        <form action="/admin/tahunan/balita/{{$balita->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/balita" method="POST">  
          
        @endif
          @csrf

         
          <input type="hidden" name="no_kk" value="{{ getTheSession('no_kk') }}">
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($balita) ? $balita->tanggal : old('tanggal')}}" placeholder="Tanggal">
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
                      <option value="{{ $item->nik }}" {{ isset($balita) ? $balita->nik == $item->nik ? 'selected' : '' : '' }}>{{ $item->nik.' - '.$item->nama }}</option>
                  @endforeach
                </select>
                @error('nik')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                @enderror
              </div>


             

              <div class="form-group">
                <label for="">POKTAN BKB</label>
                <select name="poktan_bkb" id="" class="form-control  @error('poktan_bkb') is-invalid @enderror">
                  <option value="">-- POKTAN BKB --</option>
                  <option value="YA" {{ isset($balita) ? $balita->poktan_bkb == 'YA' ? 'selected' : '' : '' }}>YA</option>
                  <option value="TIDAK" {{ isset($balita) ? $balita->poktan_bkb == 'TIDAK' ? 'selected' : '' : '' }}>TIDAK</option>
                </select>
                 @error('poktan_bkb')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                 @enderror
              </div>

           

            </div>

            <div class="col-md-6">

              


              
            </div>

          </div>

          

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($balita) ? $balita : null)!!} --}}

          <a href="/admin/dp/keluarga/{{getTheSession('keluarga_id')}}?page=balita" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>

        
        
      </div>
    </div>
  </div>
</div>

