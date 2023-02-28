
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kelompok Umur</th>
        <th>Kesertaan BerKB</th>
        <th>Jika Tidak BerKB</th>
        <th>Jalur</th>
      </tr>
    </thead>
    
    <tbody>
      @foreach ($pus as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->no_kk}}</td>
        <td>{{$row->kesertaan_berkb}}</td>
        <td>{{$row->jika_tidak_berkb}}</td>
        <td>{{$row->jalur}}</td>
      
      </tr>
    
      @endforeach
    
    </tbody>
    </table>



