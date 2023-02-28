{{-- <style>

  .wrapper-img-banner{
    width: 100%;
    height: 400px;
    overflow: hidden;
  }
  .img-banner{
    width: 100%;
  }
</style>
<div class="wrapper-img-banner">
  <img src="/img/banner.jpg" alt="" class="img-banner">
</div> --}}


<style>
  .wrapper-bg-white{
    background-color: white !important;
  }
</style>


<div class="wrapper-bg-white">
  <div class="container p-5">
    <div class="row">
      <div class="col-md-6">
        <div class="container">
          <h1 id="ladan-basi">LADAN BASI</h1>
          <p class="typed">Layanan Data Berbasis Sistem Informasi</p>
        </div>
      </div>
      <div class="col-md-6">
        <img src="/img/isometric-teamwork.png" data-aos="fade-up" data-aos-duration="1000" width="80%" alt="">
      </div>
    </div>
  </div>


<div class="container">

  <div class="text-center">
    <h4><b>Login</b></h4>
    <p>Masuk ke akun untuk mengolah data</p>
  </div>
    <div class="row">
      <div class="col-md-6">
        <div class="d-flex justify-content-center">
          <img src="/img/login.png" width="70%" data-aos="fade-up" data-aos-duration="1000" alt="" data-aos-delay="200">
        </div>
      </div>
      <div class="col-md-6">

        <div class="card" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
          <div class="card-body p-5 ktc-shadow-m">
            <form action="">
              <div class="form-group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="900">
                <label for=""><b>Email</b></label>
                <input type="text" placeholder="Email" class="form-control">
              </div>

              <div class="form-group mt-2" {!! aos_default('fade-up','1000','1000') !!}>
                <label for=""><b>Password</b></label>
                <input type="password" placeholder="Password" class="form-control">
              </div>

              {{-- <button class="btn btn-info mt-2" {!! aos_default('fade-up','1000','1100') !!}>Masuk <i class="fas fa-sign-in-alt"></i></button> --}}

              <button class="btn btn-primary" class="{ !! aos_default()!! }"></button>
            </form>

          </div>
        </div>
      </div>
    </div>
</div>

</div>


