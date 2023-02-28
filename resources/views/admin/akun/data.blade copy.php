<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                <label for="">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan" class="form-control @error('kecamatan_id') is-invalid @enderror" id="">
                    <option value="">-- Kecamatan --</option>
                    @foreach ($kecamatan as $k)
                        <option value="{{$k->id}}" {{ isset($pasar) ? $pasar->kecamatan_id == $k->id ? 'selected' : '' : ''  }}>{{$k->name}}</option>
                    @endforeach
                </select>
                    @error('kecamatan_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="">Desa</label>
                    <select class="form-control" id="desa" name="desa_id" disabled required>
                        <option value="">--Pilih Desa--</option>
                    </select>
                    @error('desa_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                
                </div>

                <div class="form-group">
                    <label for="">Tahun</label>
                    <input type="text" class="form-control  @error('tahun') is-invalid @enderror"  name="tahun"  value="{{isset($ibuhamil) ? $ibuhamil->tahun : old('tahun')}}" placeholder="Tahun">
                     @error('tahun')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                     @enderror
                  </div>
            </div>
        </div>
    </div>
</div>



<script src="/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      $('#kecamatan option[value=""]').prop('selected',true);
      $('#desa option[value!=""]').remove();
  
      kecamatan = $('#kecamatan')
      kecamatan.on('change', function() {
          $this = $(this)
          desa = $('#desa')
  
          if ($this.val() !== '') {
              $.ajax({
                  url: "{{url('/region/get-desa')}}" +'/' +$this.val() , 
                  type: 'GET',
                  dataType: 'json',
                  success: function(response){
                      if (response !== 'NOT OK') {
                          desa.removeAttr('disabled')
                          desa.html(response)
                      }
                  }
              });
          } else {
              desa.prop('disabled', true)
              desa.find('option').val('').text('Pilih Kecamatan')
          }
      })  
    });
  </script>