<style>
  .active-home{
    background-color: #05adcf;
    color: white !important;
  }

  .nav-link:hover{
    background-color: #05adcf;
    color: white !important;
    transition: 0.3s;
  }
</style>

<header>
  <nav class="navbar navbar-expand-md navbar-light bg-white ktc-shadow-m">
    <div class="container">
      <a class="navbar-brand" href="/">
       <img src="/img/icon_logo.png" alt="Logo" width="40px" class="" style="opacity: .8"> <b class="text-primary-color"> LADAN BASI</b>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item">
            <a class="nav-link font-weight-bold text-secondary {{ Request::is('/') ? 'active-home' : '' }} " href="/"><b>Beranda</b></a>
          </li>

          <li class="nav-item">
            <a class="nav-link font-weight-bold text-secondary {{ Request::is('home/tentang') ? 'active-home' : '' }}" href="/home/tentang"><b>Tentang</b></a>
          </li>

          <li class="nav-item">
            <a class="nav-link font-weight-bold text-secondary {{ Request::is('home/ikhtisar') ? 'active-home' : '' }}" href="/home/ikhtisar"><b>Ikhtisar Data</b></a>
          </li>

          <li class="nav-item">
            <a class="nav-link font-weight-bold text-secondary {{ Request::is('home/laporan') ? 'active-home' : '' }}" href="/home/laporan"><b>Laporan</b></a>
          </li>


         
        </ul>

        @auth
        <a href="/profile" class="btn btn-info btn-sm mx-2">
          <i class="fas fa-user"></i> Profile
        </a>
       
        @else
          <a href="/admin/auth" class="btn btn-info btn-sm">
            <i class="fas fa-sign-in-alt"></i> Masuk
          </a>
        @endauth

      </div>
    </div>
  </nav>
</header> 