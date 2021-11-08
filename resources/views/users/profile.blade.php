@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<h1 class="fw-bold">Profile</h1>

@if (session()->has('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="m-0 p-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('failed'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p class="m-0 p-0">{{ session('failed') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<section class="">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

          <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          <h2 class="text-capitalize mt-3">{{ $user->name }}</h2>
          <h3>{{ $user->position }}</h3>
          <p>
            @if ($user->status)
              Aktif
            @else
              Nonaktif  
            @endif
          </p>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            @if (auth()->user()->username == $user->username || auth()->user()->position == 'superadmin')
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
            @endif

            @if (auth()->user()->username == $user->username)
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>
            @endif

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Tentang</h5>
              <p class="small fst-italic">{{ $user->about }}</p>

              <h5 class="card-title">Profile Details</h5>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label ">Nama lengkap</div>
                <div class="col-lg-9 col-md-8 text-capitalize">{{ $user->name }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Username</div>
                <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Posisi</div>
                <div class="col-lg-9 col-md-8 text-capitalize">{{ $user->position }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Nomor telpon</div>
                <div class="col-lg-9 col-md-8">{{ $user->phone }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Alamat</div>
                <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Tanggal bergabung</div>
                <div class="col-lg-9 col-md-8">{{ $user->created_at }}</div>
              </div>

            </div>

            @if (auth()->user()->username == $user->username || auth()->user()->position == 'superadmin')
            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form action="/user/{{ $user->username }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Poto profile</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="/img/profile-img.jpg" alt="Profile">
                    <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                          <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                          <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                        </svg>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama lengkap</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="about" class="form-control @error('about') is-invalid @enderror" id="about" style="height: 100px">{{ old('about', $user->about) }}</textarea>
                    @error('about')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username', $user->username) }}">
                    @error('username')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="position" class="col-md-4 col-lg-3 col-form-label">Position</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="position" type="text" class="form-control " id="position" value="{{ $user->position }}" readonly>
                    @error('position')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="phone" class="col-md-4 col-lg-3 col-form-label">Nomor telpon</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>

                <div class="row mb-3">
                  <label for="address" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address', $user->address) }}">
                    @error('address')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>                  
                </div>               

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                </div>
              </form><!-- End Profile Edit Form -->
            </div>
            @endif

            @if (auth()->user()->username == $user->username)
            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form action="/user/{{ $user->username }}/update-password" method="POST">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password lama</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentPassword" type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" required>
                    @error('currentPassword')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="password" class="col-md-4 col-lg-3 col-form-label">Password baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" id="password" required>
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Masukan ulang password baru</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" required>
                    @error('password_confirmation')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Perbarui password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>
            @endif

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>

@endsection