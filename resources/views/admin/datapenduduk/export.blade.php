<table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>Pertanggal</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Pekerjaan</th>
        <th>Status Perkawinan</th>
        <th>PBI</th>
        <th>BPJS</th>
        <th>Status Dalam Keluarga</th>
        <th>Pendidikan Terakhir</th>
        <th>Memiliki KTP</th>
        <th>Memiliki Akta Kelahiran</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($datapenduduk as $row)
          
      <tr>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->tanggal_lahir}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{$row->pekerjaan}}</td>
        <td>{{$row->status_perkawinan}}</td>
        <td>{{$row->pbi}}</td>
        <td>{{$row->bpjs}}</td>
        <td>{{$row->status_dalam_kk}}</td>
        <td>{{$row->pendidikan_terakhir}}</td>
        <td>{{$row->kepemilikan_ktp}}</td>
        <td>{{$row->kepemilikan_akta_kelahiran}}</td>
      </tr>
  
      @endforeach
  
    </tbody>
  </table>