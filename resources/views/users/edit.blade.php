@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="row justify-content-center">
  <div class="col-lg-8 my-bg-element p-4 rounded">
    <h2 class="mb-5 text-center">Perbarui data pengguna</h2>
    <form class="row g-3" action="/user/{{ $user->username }}" method="POST">
      @method('PUT')
      @csrf
      <div class="col-md-6">
        <label for="name" class="form-label">Nama lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
          value="{{ old('name', $user->name) }}">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="username" class="form-label">Nama pengguna</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
          value="{{ old('username', $user->username) }}">
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
          value="{{ old('email', $user->email) }}">
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="phone" class="form-label">Nomor telpon</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
        @error('phone')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="password" class="form-label">Password baru</label>        
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
          name="password">        
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>        
        @enderror
        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
      </div>

      <div class="col-md-6">
        <label for="password_confirmation" class="form-label">Ketik ulang password baru</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
          name="password_confirmation">
        @error('password_confirmation')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-6">
        <label for="position" class="form-label">Posisi</label>
        <select id="position" class="form-select" name="position">
          <option class="text-black" @if (old('position', $user->position)=='operator' ) selected @endif value="operator">Operator
          </option>
          <option class="text-black" @if (old('position', $user->position)=='PPIC' ) selected @endif value="PPIC">PPIC</option>
          <option class="text-black" @if (old('position', $user->position)=='logistic' ) selected @endif value="logistic">Logistic
          </option>
          <option class="text-black" @if (old('position', $user->position)=='engineering' ) selected @endif value="engineering">
            Engineering</option>
          <option class="text-black" @if (old('position', $user->position)=='marketing' ) selected @endif value="marketing">Marketing
          </option>
          <option class="text-black" @if (old('position', $user->position)=='sales' ) selected @endif value="sales">Sales</option>
        </select>
      </div>

      <div class="col-md-6">
        <p class="mb-2">Status</p>
        <div class="form-check form-switch">        
          <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" 
          @if (old('status', $user->status))
            checked
          @endif>
          <label class="form-check-label" for="status">Aktif</label>
        </div>
      </div>

      <div>
        <h4 class="mb-1 text-center mt-2 border-top pt-2">Hak akses</h4>
        <h5>Pengguna</h5>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="user-viewAny" id="user-viewAny" name="role[0]" 
          @if (old('role.0', (str_contains($user->role, 'user-viewAny')) ? 'user-viewAny' : '') == 'user-viewAny' ) checked @endif>
          <label class="form-check-label" for="user-viewAny">
            Melihat daftar pengguna
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="user-create" id="user-create" name="role[1]" 
          @if (old('role.1', (str_contains($user->role, 'user-create')) ? 'user-create' : '') == 'user-create' ) checked @endif>
          <label class="form-check-label" for="user-create">
            Membuat akun pengguna baru
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="user-update" id="user-update" name="role[2]" 
          @if (old('role.2', (str_contains($user->role, 'user-update')) ? 'user-update' : '') == 'user-update' ) checked @endif>
          <label class="form-check-label" for="user-update">
            Memperbarui data pengguna
          </label>
        </div>

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="user-delete" id="user-delete" name="role[3]" 
          @if (old('role.3', (str_contains($user->role, 'user-delete')) ? 'user-delete' : '') == 'user-delete' ) checked @endif>
          <label class="form-check-label" for="user-delete">
            Menghapus pengguna
          </label>
        </div>

      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary d-block ms-auto px-5">Perbarui</button>
      </div>
    </form>
  </div>
</div>

@endsection