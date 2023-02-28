{{-- @dd($kecamatan) --}}

{{-- @foreach ($kecamatan as $item)
    {{ $item->name }}
@endforeach --}}
<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/user/create'))
          <form action="/admin/user" method="POST">  
        @else
          <form action="/admin/user/{{$user->id}}" method="POST">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($user) ? $user->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"  name="email" value="{{isset($user) ? $user->email : old('email')}}"   placeholder="example@example.com">
             @error('email')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          @php
              $superadmin = App\Enums\RoleEnum::SUPERADMIN;
              $admin = App\Enums\RoleEnum::ADMIN;
              $kecamatan = App\Enums\RoleEnum::KECAMATAN;
              $desa = App\Enums\RoleEnum::DESA;
              $dusun = App\Enums\RoleEnum::DUSUN;
          @endphp
          <div class="form-group">
            <label for="">Role</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror" id="">
              <option value="">-- Role --</option>
              <option value="{{ $superadmin }}" {{ isset($user) ? $user->role == $superadmin ? 'selected' : '' : '' }}>{{ $superadmin }}</option>
              <option value="{{ $admin }}" {{ isset($user) ? $user->role == $admin ? 'selected' : '' : '' }}>{{ $admin }}</option>
              <option value="{{ $kecamatan }}" {{ isset($user) ? $user->role == $kecamatan ? 'selected' : '' : '' }}>{{ $kecamatan }}</option>
              {{-- <option value="{{ $desa }}" {{ isset($user) ? $user->role == $desa ? 'selected' : '' : '' }}>{{ $desa }}</option> --}}
              {{-- <option value="{{ $dusun }}" {{ isset($user) ? $user->role == $dusun ? 'selected' : '' : '' }}>{{ $dusun }}</option> --}}
            </select>
             @error('role')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Kecamatan</label>
            <select name="kecamatan_id" class="form-control @error('kecamatan_id') is-invalid @enderror" id="">
              <option value="">-- Kecamatan --</option>
              @foreach ($datakecamatan as $item)
              <option value="{{ $item->id }}" {{ isset($user) ? $user->kecamatan_id == $item->id ? 'selected' : '' : '' }}>{{ $item->name }}</option>
              @endforeach
            </select>
             @error('kecamatan_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Password">
             @error('password')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Konfirmasi Password</label>
            <input type="password" class="form-control @error('re_password') is-invalid @enderror"  name="re_password" placeholder="Konfirmasi Password">
             @error('re_password')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <a href="/admin/user" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

