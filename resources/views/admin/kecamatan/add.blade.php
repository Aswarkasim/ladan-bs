<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($kecamatan))
        <form action="/admin/wilayah/kecamatan/{{$kecamatan->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/wilayah/kecamatan" method="POST">  
          
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($kecamatan) ? $kecamatan->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($kecamatan) ? $kecamatan : null)!!} --}}

          <a href="/admin/wilayah/kecamatan" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

