
@php
    
    $cari = request('cari');

    if ($cari) {
        $penduduk = App\Models\Penduduk::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
    } else {
        $penduduk = App\Models\Penduduk::latest()->paginate(10);
    } 
@endphp

{{-- @dd($penduduk) --}}
<a href="/admin/dp/penduduk/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>

<div class="float-right">
  <form action="" method="get">
  <div class="input-group input-group-sm">
      <input type="text" name="cari" class="form-control" placeholder="Cari..">
      <span class="input-group-append">
        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
        <a href="/admin/posts/penduduk" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
      </span>
    </div>
    </form>
</div>

{{-- {{ rupiah(200000) }} --}}
<div class="table-responsive">
  <table class="table">
      <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tempat Lahir</th>
          <th>Tanggal Lahir</th>
          <th>Umur</th>
          <th>Agama</th>
          <th>Peran</th>
          <th>Action</th>
      </tr>

      @foreach ($penduduk as $item)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->nik }}</td>
          <td>
              <a href="/admin/tahunan/datapenduduk/bynik?nik={{ $item->nik }}"><b>{{ $item->nama }}</b></a> <br>
              {{-- <span>{{ $item->nik }}</span> --}}
          </td>
          <td>{{ $item->jenis_kelamin }}</td>
          <td>{{ $item->tempat_lahir }}</td>
          <td>{{ $item->tanggal_lahir }}</td>
          <td>{{ hitung_umur($item->tanggal_lahir) }}</td>
          <td>{{ $item->agama }}</td>
          <td>{{ $item->peran }}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-primary"><i class="fa fa-cogs"></i></button>
              <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu" x-placement="bottom-start">
                <a class="dropdown-item" href="/admin/dp/penduduk/{{$item->id}}/edit"><i class="fa fa-edit"></i> Edit</a>
                  <div class="dropdown-divider"></div>
                  <form action="/admin/dp/penduduk/{{$item->id}}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" id="delete" class="dropdown-item"><i class="fa fa-trash"></i> Hapus</button>
                  </form>
              </div>
            </div>
          </td>
      </tr>
      @endforeach
  </table>
</div>

<div class="float-right">
  {{$penduduk->links()}}
</div>