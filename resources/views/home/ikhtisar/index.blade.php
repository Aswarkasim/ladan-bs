<div class="container mt-3">

    <div class="text-center">
        <h4><b>Ikhtisar Data</b></h4>
        <p>Ringkasan jumlah data yang tertampung dalam rekapan tahun dan bulan</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ktc-shadow-sm bg-white">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                          <img src="/img/ikhtisar.png" width="70%" alt=""  data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                        </div>
                      </div>

                      <div class="col-md-6">

                          <form action="" method="get"  data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000">
          
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
    <div class="row">
        @for ($i = 0; $i < 12; $i++)
            
        
        <div class="col-md-3 mt-3" data-aos="flip-left" data-aos-delay="{{ $i*200 }}" data-aos-duration="1000">
            <div class="card">
                <div class="card-body ktc-shadow-sm">
                    <div class="float-end">
                        <div class="badge bg-info">

                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Keluarga</h5>
                    <h3 class="mt-3 mb-3">36,254</h3>
                    <p class="mb-0 text-muted">
                        {{-- <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 5.27%</span> --}}
                        <span class="text-nowrap">Data Per Januari 2023</span>  
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>

        @endfor



    </div>
</div>