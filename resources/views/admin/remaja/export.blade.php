
  <table id="example1" class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Pertanggal</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Umur</th>
        <th>Jenis Kelamin</th>
        <th>Kesertaan PIKR</th>
        <th>Keaktifan PIKR</th>
      </tr>
    </thead>
    
    <tbody>
      @foreach ($remaja as $row)
          
      <tr>
        <td width="50px">{{$loop->iteration}}</td>
        <td>{{$row->tanggal}}</td>
        <td>{{'\''.$row->nik}}</td>
        <td>{{$row->nama}}</td>
        <td>{{$row->umur}}</td>
        <td>{{$row->jenis_kelamin}}</td>
        <td>{{$row->kesertaan_pikr}}</td>
        <td>{{$row->keaktifan_pikr}}</td>
        
      </tr>
    
      @endforeach
    
    </tbody>
    </table>


<!-- /.card-body -->


