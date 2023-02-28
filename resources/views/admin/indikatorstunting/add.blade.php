<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($indikatorstunting))
        <form action="/admin/tahunan/stunting/indikatorstunting/{{$indikatorstunting->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/tahunan/stunting/indikatorstunting" method="POST">  
          
        @endif
          @csrf
          <div class="form-group">
            <label for="">Indikator</label>
            <input type="text" class="form-control  @error('desc') is-invalid @enderror"  name="desc"  value="{{isset($indikatorstunting) ? $indikatorstunting->desc : old('desc')}}" placeholder="Indikator">
             @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($indikatorstunting) ? $indikatorstunting : null)!!} --}}

          <a href="/admin/tahunan/stunting/indikatorstunting" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

