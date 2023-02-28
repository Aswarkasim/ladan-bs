
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
      </tr>
    </thead>
  
    <tbody>
      @foreach ($ibuhamil as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik_istri}}</td>
        <td>{{$row->kehamilan_keberapa}}</td>
        <td>{{$row->tanggal_mulai_hamil}}</td>
        <td>{{$row->perkiraan_kelahiran}}</td>
        <td>{{$row->tanggal_kelahiran}}</td>
        <td>{{$row->status}}</td>
        <td>{{$row->jenis_kehamilan}}</td>

      </tr>
  
      @endforeach
  
    </tbody>
  </table>



