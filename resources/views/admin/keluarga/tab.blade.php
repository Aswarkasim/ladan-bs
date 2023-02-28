@php
    $page = request('page');

@endphp
<nav class="nav nav-pills flex-column flex-sm-row mb-2">
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'penduduk' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=penduduk">Penduduk</a>
    {{-- <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'datapenduduk' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=datapenduduk">Keadaan Penduduk</a> --}}
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'mutasi' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=mutasi">Mutasi</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'datakeluarga' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=datakeluarga">Data Keluarga</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'lansia' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=lansia">Lansia</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'wus' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=wus">WUS</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'remaja' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=remaja">Remaja</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'catin' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=catin">Catin</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'pus' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=pus">PUS</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'balita' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=balita">Balita</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'ibuhamil' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=ibuhamil">Ibu Hamil</a>
    <a class="flex-sm-fill text-sm-center nav-link {{ $page == 'stunting' ? 'active' : ''  }}" href="/admin/dp/keluarga/{{ $keluarga->id }}?page=stunting">Risiko Stunting</a>
  </nav>