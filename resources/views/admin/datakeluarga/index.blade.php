<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  <a href="/admin/tahunan/dp/keluarga" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>


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
              <a href="/admin/tahunan/datakeluarga/export?tanggal_start={{ request('tanggal_start') }}&tanggal_end={{ request('tanggal_end') }}&kecamatan_id={{ request('kecamatan_id') }}" class="btn btn-info mx-1 {{ request('tanggal_start') == '' ? 'disabled' : '' }}" ><i class="fas fa-download"></i> Export</a>
            </div>
          </div>
        </div>



        <div class="d-flex justify-content-start">
          
        </div>
      </form>

    </div>
  </div>
  

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/posts/datakeluarga" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Pertanggal</th>
        <th>No KK</th>
        <th>Balita</th>
        <th>Remaja</th>
        <th>Lansia</th>
        <th>Tahapan KS</th>
        <th>Action</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($datakeluarga as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td><b>{{format_indo($row->tanggal)}}</b></td>
        <td>{{$row->no_kk}}</td>
        <td>{{$row->jumlah_balita}}</td>
        <td>{{$row->jumlah_remaja}}</td>
        <td>{{$row->jumlah_lansia}}</td>
        <td>{{$row->tahapan_ks}}</td>
        <td>
          <div class="btn-group">
              <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
              <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                <a class="dropdown-item" href="/admin/tahunan/datakeluarga/{{$row->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                  <div class="dropdown-divider"></div>
                  <form action="/admin/tahunan/datakeluarga/{{$row->id}}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" id="delete" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</button>
                  </form>
              </div>
            </div>
        </td>
      </tr>
  
      @endforeach
  
    </tbody>
  </table>

  <div class="float-right">
    {{$datakeluarga->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


