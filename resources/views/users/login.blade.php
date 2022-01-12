<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>

  <!-- Favicons -->
  <link href="/img/favicon.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="/css/login.css">
</head>

<body>

  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="mb-3">

              <div class="card-body border-0">

                <div class="pb-1">
                  <h5 class="card-title text-center pb-0 fs-1">Login</h5>
                </div>

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

                <form class="row g-3 needs-validation" action="/login" method="POST">
                  @csrf
                  <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Belum memiliki akun? <a href="/register" class="text-primary">Buat akun</a></p>
                  </div>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </div>

  <!-- Vendor JS Files -->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>