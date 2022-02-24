@extends('layouts.simple')
@section('main')

<div class="container">

  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="mb-3">

            <div class="card-body border-0">

              <div class="pb-1 border-bottom">
                <h5 class="card-title text-center fs-1 mb-3">Buat password baru</h5>
              </div>

              <form class="row g-3 needs-validation" action="/reset-password" method="POST">
                @csrf
                <input type="hidden" name="resetToken" value="{{ $resetToken }}">
                <div class="col-12 py-3">
                  <label for="password">Password baru</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autofocus="on">
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="col-12 py-3">
                    <label for="password_confirmation">Masukan ulang password</label>
                    <div class="input-group">
                      <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" required>
                      @error('password_confirmation')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                </div>

                <div class="col-12 border-top">
                  <button class="btn btn-primary w-100 mt-3" type="submit">Simpan</button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

</div>

@endsection