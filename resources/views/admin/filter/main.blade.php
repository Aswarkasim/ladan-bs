<div class="row">
    <div class="offset-3 col-md-6">

      <form action="" method="get">
        
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="">Dari Tanggal</label>  
            </div>
            <div class="col-md-9">
              <input type="date" name="tanggal_start" value="{{ request('tanggal_start') }}" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="">Hingga Tanggal</label>  
            </div>
            <div class="col-md-9">
              <input type="date" name="tanggal_end" value="{{ request('tanggal_end') }}" class="form-control" required>
            </div>
          </div>
        </div>

        @php
            $kecamatan = App\Models\Kecamatan::get();
        @endphp

        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              <label for="">Kecamatan</label>  
            </div>
            <div class="col-md-9">
              <select name="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror" required id="">
                <option value="">-- Kecamatan --</option>
                @foreach ($kecamatan as $item)
                <option value="{{ $item->id }}" {{  request('kecamatan_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>


        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              {{-- <label for="">Hingga Tanggal</label>   --}}
            </div>
            <div class="col-md-9">
              <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
              <a href="/admin/tahunan/{{ Request::segment(3) }}/export?tanggal_start={{ request('tanggal_start') }}&tanggal_end={{ request('tanggal_end') }}&kecamatan_id={{ request('kecamatan_id') }}" class="btn btn-info mx-1 {{ request('tanggal_start') == '' ? 'disabled' : '' }}" ><i class="fas fa-download"></i> Export</a>
              <a href="/admin/tahunan/{{ Request::segment(3) }}" class="btn btn-success"><i class="fas fa-sync-alt"></i> Segarkan</a>
            </div>
          </div>
        </div>



        <div class="d-flex justify-content-start">
          
        </div>
      </form>

    </div>
  </div>