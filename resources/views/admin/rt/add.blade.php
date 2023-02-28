<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($rt))
          <form action="/admin/wilayah/rt/{{$rt->id}}" method="POST">  
          @method('PUT')
        @else
          <form action="/admin/wilayah/rt" method="POST">  
        @endif
          @csrf

          <input type="hidden" name="dusun_id" value="{{ $dusun->id }}">
          <input type="hidden" name="desa_id" value="{{ $dusun->desa_id }}">
          <input type="hidden" name="kecamatan_id" value="{{ $dusun->kecamatan_id }}">

          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($rt) ? $rt->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>


     {{-- {!!form_input($errors, 'name', 'Nama', isset($rt) ? $rt : null)!!} --}}

          <a href="/admin/wilayah/rt?dusun_id={{ $dusun->id }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

