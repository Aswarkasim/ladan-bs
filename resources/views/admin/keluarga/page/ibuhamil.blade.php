@php
    

    $cari = request('cari');

        if ($cari) {
            $ibuhamil = App\Models\Ibuhamil::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $ibuhamil = App\Models\Ibuhamil::latest()->paginate(10);
        }


@endphp

<a href="/admin/tahunan/ibuhamil/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/posts/ibuhamil" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
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
      <th>Kehamilan Ke</th>
      <th>Tanggal Mulai Hamil</th>
      <th>Perkiraan Kehalihan</th>
      <th>Tanggal Kelahiran</th>
      <th>Status</th>
      <th>Jenis Kehamilan</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($ibuhamil as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{$row->tanggal}}</td>
      <td>{{$row->nik_istri}}</td>
      <td>{{$row->kehamilan_keberapa}}</td>
      <td>{{$row->tanggal_mulai_hamil}}</td>
      <td>{{$row->perkiraan_kelahiran}}</td>
      <td>{{$row->tanggal_kelahiran}}</td>
      <td>{{$row->status}}</td>
      <td>{{$row->jenis_kehamilan}}</td>
      <td>
        <div class="btn-group">
            <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu" x-placement="bottom-start">
              <a class="dropdown-item" href="/admin/tahunan/ibuhamil/{{$row->id}}/edit?nik_suami={{ $row->nik_suami }}&nik_istri={{ $row->nik_istri }}"><i class="fa fa-edit"></i> Edit</a>
                <div class="dropdown-divider"></div>
                <form action="/admin/tahunan/ibuhamil/{{$row->id}}" method="post">
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
    {{$ibuhamil->links()}}
  </div>