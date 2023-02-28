@php
    $page = request('page');

@endphp



@switch($page)
    @case('penduduk')
        @include('admin.keluarga.page.penduduk')
        @break

        @case('mutasi')
    @include('admin.keluarga.page.mutasi')
        @break
    
    @case('datapenduduk')
    @include('admin.keluarga.page.datapenduduk')
        @break

    @case('datakeluarga')
    @include('admin.keluarga.page.datakeluarga')
        @break

        @case('lansia')
    @include('admin.keluarga.page.lansia')
        @break


        @case('wus')
    @include('admin.keluarga.page.wus')
        @break

        @case('remaja')
    @include('admin.keluarga.page.remaja')
        @break

        @case('catin')
    @include('admin.keluarga.page.catin')
        @break

        @case('pus')
    @include('admin.keluarga.page.pus')
        @break

        @case('balita')
    @include('admin.keluarga.page.balita')
        @break

        @case('ibuhamil')
    @include('admin.keluarga.page.ibuhamil')
        @break

        @case('stunting')
    @include('admin.keluarga.page.stunting')
        @break


    @default
        
@endswitch