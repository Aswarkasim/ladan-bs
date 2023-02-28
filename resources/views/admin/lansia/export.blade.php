
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>Pertanggal</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>POKTAN BKL</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($lansia as $row)
          
      <tr>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->tanggal_lahir}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{$row->poktan_bkl}}</td>

      </tr>
  
      @endforeach
  
    </tbody>
  </table>


