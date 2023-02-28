<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5><strong>NO. KK : {{ request('no_kk') }}</strong></h5>

                

                        <a href="/admin/dp/penduduk/create?no_kk={{ request('no_kk') }}" class="btn btn-primary mb-3">
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



<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->