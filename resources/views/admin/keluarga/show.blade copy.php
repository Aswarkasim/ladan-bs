<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h5><strong>NO. KK : {{ $keluarga->no_kk }}</strong></h5>

        @include('admin.keluarga.tab')


        <a href="/admin/dp/penduduk/create?no_kk={{ $keluarga->no_kk }}" class="btn btn-primary mb-3">
          <i class="fas fa-plus"></i> Tambah Anggota Keluarga
        </a>

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
                <b>{{ $item->nama }}</b> <br>
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
      </div>
    </div>
  </div>
</div>