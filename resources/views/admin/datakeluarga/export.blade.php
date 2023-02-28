
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>Pertanggal</th>
        <th>No KK</th>
        <th>Balita</th>
        <th>Remaja</th>
        <th>Lansia</th>
        <th>Tahapan KS</th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($datakeluarga as $row)
          
      <tr>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->no_kk}}</td>
        <td>{{$row->jumlah_balita}}</td>
        <td>{{$row->jumlah_remaja}}</td>
        <td>{{$row->jumlah_lansia}}</td>
        <td>{{$row->tahapan_ks}}</td>

      </tr>
  
      @endforeach
  
    </tbody>
  </table>

  