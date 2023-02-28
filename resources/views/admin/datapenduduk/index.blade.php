<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  <a href="/admin/tahunan/datapenduduk/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

<div class="d-flex justify-content-center">
  <h5><b>Filter</b></h5>
</div>
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
              <select name="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror" id="">
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
              <a href="/admin/tahunan/datapenduduk/export?tanggal_start={{ request('tanggal_start') }}&tanggal_end={{ request('tanggal_end') }}" class="btn btn-info mx-1 {{ request('tanggal_start') == '' ? 'disabled' : '' }}" ><i class="fas fa-download"></i> Export</a>
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
          <a href="/admin/posts/datapenduduk" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Pertanggal</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Pekerjaan</th>
      <th>Status Perkawinan</th>
      <th>PBI</th>
      <th>BPJS</th>
      <th>Status Dalam Keluarga</th>
      <th>Pendidikan Terakhir</th>
      <th>Memiliki KTP</th>
      <th>Memiliki Akta Kelahiran</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($datapenduduk as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{format_indo($row->tanggal)}}</td>
      <td>{{$row->nik}}</td>
      <td>{{$row->nama}}</td>
      <td>{{$row->pekerjaan}}</td>
      <td>{{$row->status_perkawinan}}</td>
      <td>{{$row->pbi}}</td>
      <td>{{$row->bpjs}}</td>
      <td>{{$row->status_dalam_kk}}</td>
      <td>{{$row->pendidikan_terakhir}}</td>
      <td>{{$row->kepemilikan_ktp}}</td>
      <td>{{$row->kepemilikan_akta_kelahiran}}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
              <a class="dropdown-item" href="/admin/tahunan/datapenduduk/{{$row->id}}/edit?nik={{ $row->nik }}"><i class="fa fa-edit"></i> Edit</a>
                <div class="dropdown-divider"></div>
                <form action="/admin/tahunan/datapenduduk/{{$row->id}}" method="post">
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

@if (count($datapenduduk) <=0 )
<div class="d-flex justify-content-center">
  <img src="/img/empty.png" width="40%"/><br>
</div>
<h5 class="text-center">Data Kosong..</h5>
@endif
<img src="" alt="">
  <div class="float-right">
    {{$datapenduduk->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


