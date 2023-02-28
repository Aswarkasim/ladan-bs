
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
      </tr>
    </thead>
  
    <tbody>
      @foreach ($balita as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{format_indo($row->tanggal_lahir)}}</td>
        <td>{{$row->poktan_bkb}}</td>
      </tr>
  
      @endforeach
  
    </tbody>
  </table>