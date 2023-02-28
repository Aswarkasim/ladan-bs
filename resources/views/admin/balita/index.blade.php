<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  <a href="/admin/tahunan/balita/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

  @include('admin.filter.main')
  
  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/posts/balita" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Data</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>POKTAN BKB</th>
        <th>Action</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($balita as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{format_indo($row->tanggal)}}</td>
        <td>{{$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{format_indo($row->tanggal_lahir)}}</td>
        <td>{{$row->poktan_bkb}}</td>
        <td>
          <div class="btn-group">
              <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
              <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                <a class="dropdown-item" href="/admin/tahunan/balita/{{$row->id}}/edit?nik={{ $row->nik }}"><i class="fa fa-edit"></i> Edit</a>
                  <div class="dropdown-divider"></div>
                  <form action="/admin/tahunan/balita/{{$row->id}}" method="post">
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
    {{$balita->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


