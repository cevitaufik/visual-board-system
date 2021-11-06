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
        <label for="password" class="form-label">Password baru</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
          name="password">
        @error('password')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="col-md-4">
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

      <div>
        <p class="mb-0">Status</p>
        <div class="form-check form-switch">        
          <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" 
          @if (old('status', $user->status))
            checked
          @endif>
          <label class="form-check-label" for="status">Aktif</label>
        </div>
      </div>

      <div>
        <p class="mb-1">Tambahan hak akses</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="opm" id="opm" name="access[0]" 
          @if (old('access.0', ($user->access[0]) ?? '') == 'opm' ) checked @endif>
          <label class="form-check-label" for="opm">
            Monitoring pekerjaan
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="utility" id="utility" name="access[1]" 
          @if (old('access.1', ($user->access[1]) ?? '') == 'utility' ) checked @endif>
          <label class="form-check-label" for="utility">
            Utility
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="stock part standar" id="stockPartStandar"
            name="access[2]" @if (old('access.2', ($user->access[2]) ?? '') == 'stock part standar' ) checked @endif>
          <label class="form-check-label" for="stockPartStandar">
            Stock part standar
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