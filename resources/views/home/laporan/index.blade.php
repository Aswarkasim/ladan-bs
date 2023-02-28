<div class="container mt-3">

  <div class="text-center">
      <h4><b>Laporan Data</b></h4>
      <p>Ringkasan jumlah data yang tertampung dalam rekapan tahun dan bulan</p>
  </div>
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-body ktc-shadow-sm bg-white">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="d-flex justify-content-center">
                        <img src="/img/report.png" width="70%" alt="" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                      </div>
                    </div>

                    <div class="col-md-6">

                        <form action="" method="get" data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
        
                          <div class="form-group mt-1">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="">Dari Tanggal</label>  
                              </div>
                              <div class="col-md-9">
                                <input type="date" name="tanggal_start" value="{{ request('tanggal_start') }}" class="form-control" required>
                              </div>
                            </div>
                          </div>
                  
                          <div class="form-group mt-1">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="">Hingga Tanggal</label>  
                              </div>
                              <div class="col-md-9">
                                <input type="date" name="tanggal_end" value="{{ request('tanggal_end') }}" class="form-control" required>
                              </div>
                            </div>
                          </div>
                  
                          @php
                              $kecamatan = App\Models\Kecamatan::get();
                          @endphp
                  
                          <div class="form-group mt-1">
                            <div class="row">
                              <div class="col-md-3">
                                <label for="">Kecamatan</label>  
                              </div>
                              <div class="col-md-9">
                                <select name="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror" required id="">
                                  <option value="">-- Kecamatan --</option>
                                  @foreach ($kecamatan as $item)
                                  <option value="{{ $item->id }}" {{  request('kecamatan_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                  
                  
                          <div class="form-group mt-1">
                            <div class="row">
                              <div class="col-md-3">
                                {{-- <label for="">Hingga Tanggal</label>   --}}
                              </div>
                              <div class="col-md-9 mt-3">
                                <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                                <a href="/admin/tahunan/{{ Request::segment(3) }}/export?tanggal_start={{ request('tanggal_start') }}&tanggal_end={{ request('tanggal_end') }}&kecamatan_id={{ request('kecamatan_id') }}" class="btn btn-info mx-1 {{ request('tanggal_start') == '' ? 'disabled' : '' }}" ><i class="fas fa-download"></i> Export</a>
                                <a href="/home/ikhtisar" class="btn btn-success"><i class="fas fa-sync-alt"></i> Segarkan</a>
                              </div>
                            </div>
                          </div>
                      </form>

                    </div>
                  </div>

                 
                      


              </div>
          </div>
      </div>
  </div>
</div>