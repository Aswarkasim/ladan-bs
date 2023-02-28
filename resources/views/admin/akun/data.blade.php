<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                <form action="/admin/akun/data" method="POST">
                    @method('PUT')
                    @csrf


                    @php
                        $current_year = date('Y');
                        $year = auth()->user()->tahun;
                        $desa_id = auth()->user()->desa_id;
                        // echo $desa_id;
                    @endphp

                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select name="tahun" class="form-control" id="">
                            <option value="">-- Tahun --</option>
                            @for ($i = 2010; $i <= $current_year; $i++)
                            <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}<option>
                            @endfor
                        </select>

                        @error('tahun')
                            <div class="invalid-feedback">
                              {{$message}}
                            </div>
                         @enderror
                    </div>

                    

                <div class="form-group">
                    <label for="">Kecamatan</label>
                    <input type="text" value="{{ $kecamatan->name }}" class="form-control" disabled>
                </div>


                <div class="form-group">
                    <label for="">Desa</label>
                    <select name="desa_id" id="desa" class="form-control @error('desa_id') is-invalid @enderror" id="">
                        <option value="">-- Desa --</option>
                        @foreach ($desa as $k)
                            <option value="{{$k->id}}" {{ $k->id == $desa_id ? 'selected' : '' }}>{{$k->name}}</option>
                        @endforeach
                    </select>
                    @error('desa_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
        
                {{-- <div class="form-group">
                    <label for="">Dusun</label>
                    <select class="form-control" id="dusun" name="dusun_id" disabled required>
                        <option value="">--Pilih Dusun--</option>
                    </select>
                    @error('dusun_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                
                </div> --}}

                

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>

            </form>


            </div>
        </div>
    </div>
</div>



<script src="/plugins/jquery/jquery.min.js"></script>
{{-- <script>
    console.log('adakah');
    $(document).ready(function(){
      $('#desa option[value=""]').prop('selected',true);
      $('#dusun option[value!=""]').remove();
  
      desa = $('#desa')
      desa.on('change', function() {
          $this = $(this)
          dusun = $('#dusun')
  
          if ($this.val() !== '') {
              $.ajax({
                  url: "{{url('/region/get-dusun')}}" +'/' +$this.val() , 
                  type: 'GET',
                  dataType: 'json',
                  success: function(response){
                      if (response !== 'NOT OK') {
                          dusun.removeAttr('disabled')
                          dusun.html(response)
                      }
                  }
              });
          } else {
              dusun.prop('disabled', true)
              dusun.find('option').val('').text('Pilih Dusun')
          }
      })  
    });
  </script> --}}