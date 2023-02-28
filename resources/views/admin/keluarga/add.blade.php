<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (isset($keluarga))
        <form action="/admin/dp/keluarga/{{$keluarga->id}}" method="POST">  
          @method('PUT')
        @else
        <form action="/admin/dp/keluarga" method="POST">  
          
        @endif
          @csrf

          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          <input type="hidden" name="kecamatan_id" value="{{ auth()->user()->kecamatan_id }}">
          <input type="hidden" name="desa_id" value="{{ auth()->user()->desa_id }}">

          <div class="form-group">
            <label for="">Dusun</label>
            <select name="dusun_id" id="dusun" class="form-control @error('dusun_id') is-invalid @enderror" id="">
                <option value="">-- Dusun --</option>
                @foreach ($dusun as $k)
                    <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
            @error('dusun_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
          <label for="">RT</label>
          <select class="form-control" id="rt" name="rt_id" disabled required>
              <option value="">--Pilih RT--</option>
          </select>
          @error('rt_id')
          <div class="invalid-feedback">
              {{$message}}
          </div>
          @enderror
      
      </div>
          
          
          <div class="form-group">
            <label for="">Nomor Kartu Keluarga</label>
            <input type="text" class="form-control  @error('no_kk') is-invalid @enderror"  name="no_kk"  value="{{isset($keluarga) ? $keluarga->no_kk : old('no_kk')}}" placeholder="Nomor Kartu Keluarga">
             @error('no_kk')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'no_kk', 'Nama', isset($keluarga) ? $keluarga : null)!!} --}}

          <a href="/admin/dp/keluarga" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    console.log('adakah');
    $(document).ready(function(){
      $('#dusun option[value=""]').prop('selected',true);
      $('#rt option[value!=""]').remove();
  
      dusun = $('#dusun')
      dusun.on('change', function() {
          $this = $(this)
          rt = $('#rt')
  
          if ($this.val() !== '') {
              $.ajax({
                  url: "{{url('/region/get-rt')}}" +'/' +$this.val() , 
                  type: 'GET',
                  dataType: 'json',
                  success: function(response){
                      if (response !== 'NOT OK') {
                          rt.removeAttr('disabled')
                          rt.html(response)
                      }
                  }
              });
          } else {
              rt.prop('disabled', true)
              rt.find('option').val('').text('Pilih Dusun')
          }
      })  
    });
  </script>