  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/ktc_logo_line.png" alt="AdminLTE Logo" width="15px" class="" style="opacity: .8"> 
      <span class="brand-text font-weight-light"><img src="/img/icon_logo.png" width="10%" alt=""> <b>LADAN</b> BASI</span>
    </a>

    @php
        
        $role = auth()->user()->role;

    @endphp

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-header">Data Master</li>
          <li class="nav-item {{Request::is('admin/dp*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/dp*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Penduduk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/dp/penduduk" class="nav-link {{ Request::is('admin/dp/penduduk*') ? 'child-active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penduduk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/dp/keluarga" class="nav-link {{ Request::is('admin/dp/keluarga*') ? 'child-active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keluarga</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{Request::is('admin/wilayah*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/wilayah*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-map"></i>
              <p>
                Wilayah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/wilayah/kecamatan" class="nav-link {{ Request::is('admin/wilayah/kecamatan*') ? 'child-active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kecamatan</p>
                </a>
              </li>
            </ul>
          </li>

          


          <li class="nav-header">Data Tahunan</li>

          <li class="nav-item">
            <a href="/admin/tahunan/ibuhamil" class="nav-link {{Request::is('admin/tahunan/ibuhamil') ? 'active' : ''}}">
              <i class="nav-icon fas fa-baby-carriage"></i>
              <p>
                Ibu Hamil
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/balita" class="nav-link {{Request::is('admin/tahunan/balita*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-baby"></i>
              <p>
                Balita
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/pus" class="nav-link {{Request::is('admin/tahunan/pus*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-spinner"></i>
              <p>
                PUS
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/catin" class="nav-link {{Request::is('admin/tahunan/catin*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-ring"></i>
              <p>
                Catin
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/remaja" class="nav-link {{Request::is('admin/tahunan/remaja*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-bolt"></i>
              <p>
                Remaja
              </p>
            </a>
          </li>


        

          <li class="nav-item">
            <a href="/admin/tahunan/stunting" class="nav-link {{Request::is('admin/tahunan/stunting*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Stunting
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/wus" class="nav-link {{Request::is('admin/tahunan/wus*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-female"></i>
              <p>
                WUS
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/lansia" class="nav-link {{Request::is('admin/tahunan/lansia*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-hourglass"></i>
              <p>
                Lansia
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/mutasi" class="nav-link {{Request::is('admin/tahunan/mutasi*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Mutasi
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/admin/tahunan/datapenduduk" class="nav-link {{Request::is('admin/tahunan/datapenduduk') ? 'active' : ''}}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Keadaan Penduduk
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/tahunan/datakeluarga" class="nav-link {{Request::is('admin/tahunan/datakeluarga') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Keadaan Keluarga
              </p>
            </a>
          </li>

          

          


          @if ($role == 'Admin')
              

          <li class="nav-item {{Request::is('admin/user*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('admin/user*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/user?role=user" class="nav-link {{request('role')== 'user' ? 'child-active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/user?role=admin" class="nav-link  {{request('role')== 'admin' ? 'child-active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
            </ul>
          </li>

          @endif


          

          

          
          <li class="nav-item">
            <a href="/admin/akun/data" class="nav-link {{Request::is('admin/akun/data*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Akun
              </p>
            </a>
          </li>

          


          {{-- <li class="nav-item">
            <a href="/admin/konfigurasi" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Konfigurasi
              </p>
            </a>
          </li> --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


