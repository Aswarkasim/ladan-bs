@php
    $cari = request('cari');

    if ($cari) {
        $remaja = App\Models\Remaja::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
    } else {
        $remaja = App\Models\Remaja::latest()->paginate(10);
    }
@endphp

<a href="/admin/tahunan/remaja/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

<div class="float-right">
  <form action="" method="get">
  <div class="input-group input-group-sm">
      <input type="text" name="cari" class="form-control" placeholder="Cari..">
      <span class="input-group-append">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
        <a href="/admin/posts/remaja" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
      </span>
    </div>
    </form>
</div>
<table id="example1" class="table table-striped">
<thead>
  <tr>
    <th>No</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>Umur</th>
    <th>Kesertaan PIKR</th>
    <th>Keaktifan PIKR</th>
    <th>Action</th>
  </tr>
</thead>

<tbody>
  @foreach ($remaja as $row)
      
  <tr>
    <td width="50px">{{$loop->iteration}}</td>
    <td>{{$row->nik}}</td>
    <td>{{$row->nama}}</td>
    <td>{{$row->umur}}</td>
    <td>{{$row->jenis_kelamin}}</td>
    <td>{{$row->kesertaan_pikr}}</td>
    <td>{{$row->keaktifan_pikr}}</td>
    <td>
      <div class="btn-group">
          <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
          <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu" role="menu" x-placement="bottom-start">
            <a class="dropdown-item" href="/admin/tahunan/remaja/{{$row->id}}/edit?nik={{ $row->nik }}"><i class="fa fa-edit"></i> Edit</a>
              <div class="dropdown-divider"></div>
              <form action="/admin/tahunan/remaja/{{$row->id}}" method="post">
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
  {{$remaja->links()}}
</div>