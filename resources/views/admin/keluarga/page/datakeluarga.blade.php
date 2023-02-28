@php
    
    $cari = request('cari');

        if ($cari) {
            $datakeluarga = App\Models\Datakeluarga::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $datakeluarga = App\Models\Datakeluarga::latest()->paginate(10);
        }

@endphp
   
   
   <a href="/admin/tahunan/datakeluarga/create" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>
  
    <div class="float-right">
      <form action="" method="get">
      <div class="input-group input-group-sm">
          <input type="text" name="cari" class="form-control" placeholder="Cari..">
          <span class="input-group-append">
            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
            <a href="/admin/posts/keluarga" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
          </span>
        </div>
        </form>
    </div>
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Tahun</th>
        <th>Nama</th>
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
        <td><b>{{$row->tahun}}</b></td>
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

  
  <!-- /.card-body -->
  
  
  