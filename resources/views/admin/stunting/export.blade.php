
  <table id="example1" class="table table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Pertanggal</th>
        <th>NO KK</th>
        <th>Jumlah Anggota Keluarga</th>
        <th>Jumlah Baduta</th>
        <th>Jumlah Balita</th>
    </tr>
    </thead>
    
    <tbody>
    @foreach ($stunting as $row)
        
    <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->no_kk}}</td>
        <td>{{$row->jumlah_anggota_keluarga}}</td>
        <td>{{$row->jumlah_baduta}}</td>
        <td>{{$row->jumlah_balita}}</td>

    </tr>
    
    @endforeach
    
    </tbody>
    </table>



