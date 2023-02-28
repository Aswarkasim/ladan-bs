@include('sweetalert::alert')  
 
  @if (isset($content))
  @include($content)
  
  @else
  {{'Tidak ada halaman'}}
  @endif
  
