
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Pertanggal</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Status</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($wus as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->tanggal_lahir}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{$row->status_pernikahan}}</td>

      </tr>
  
      @endforeach
  
    </tbody>
  </table>


