@extends('layouts.simple')
@section('main')

<div class="container">

  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="mb-3">

            <div class="card-body border-0">

              <div class="pb-1 border-bottom">
                <h5 class="card-title text-center fs-1 mb-3">Lupa password</h5>
              </div>

              <form class="row g-3 needs-validation" action="/forgot-password" method="POST">
                @csrf
                <div class="col-12 py-3">
                  <p class="text-center">Silahkan masukan email yang anda gunakan.</p>
                  <div class="input-group">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" required autofocus="on" placeholder="Email">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="col-12 border-top">
                  <button class="btn btn-primary w-100 mt-3" type="submit">Reset password</button>
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