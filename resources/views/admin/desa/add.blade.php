<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($desa))
          <form action="/admin/wilayah/desa/{{$desa->id}}?kecamatan_id={{ request('kecamatan_id') }}" method="POST">  
          @method('PUT')
        @else
          <form action="/admin/wilayah/desa?kecamatan_id={{ request('kecamatan_id') }}" method="POST">  
        @endif
          @csrf

          <input type="hidden" name="kecamatan_id" value="{{ request('kecamatan_id') }}">
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($desa) ? $desa->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          {{-- <div class="form-group">
            <label for="">Kecamatan</label>
            <select name="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror" id="">
              <option value="">-- Kecamatan --</option>
              @foreach ($kecamatan as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>
             @error('kecamatan_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div> --}}

     {{-- {!!form_input($errors, 'name', 'Nama', isset($desa) ? $desa : null)!!} --}}

          <a href="/admin/wilayah/desa?kecamatan_id={{ request('kecamatan_id') }}" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

