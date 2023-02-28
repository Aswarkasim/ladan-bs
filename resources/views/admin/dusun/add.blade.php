<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($dusun))
          <form action="/admin/wilayah/dusun/{{$dusun->id}}" method="POST">  
          @method('PUT')
        @else
          <form action="/admin/wilayah/dusun" method="POST">  
        @endif
          @csrf

          <input type="hidden" name="desa_id" value="{{ $desa->id }}">
          <input type="hidden" name="kecamatan_id" value="{{ $desa->kecamatan_id }}">

          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($dusun) ? $dusun->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>


     {{-- {!!form_input($errors, 'name', 'Nama', isset($dusun) ? $dusun : null)!!} --}}

          <a href="/admin/wilayah/dusun?desa_id={{ $desa->id }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

