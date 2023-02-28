
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Pertanggal</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Umur</th>
      <th>Berat Badan</th>
      <th>Tinggi Badan</th>
      <th>LILA</th>
      <th>HB</th>
      <th>Terpapar Rokok</th>
      <th>Perokok</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($catin as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td>{{ $row->tanggal }}</td>
      <td>{{'\''.$row->nik}}</td>
      <td>{{ $row->nama }}</td>
      <td>{{ $row->jenis_kelamin }}</td>
      <td>{{ $row->umur }}</td>
      <td>{{ $row->berat_badan }}</td>
      <td>{{ $row->tinggi_badan }}</td>
      <td>{{ $row->lingkar_lengan_atas }}</td>
      <td>{{ $row->hb }}</td>
      <td>{{ $row->terpapar_rokok }}</td>
      <td>{{ $row->perokok }}</td>
     
    </tr>

    @endforeach

  </tbody>
</table>


