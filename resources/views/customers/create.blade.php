<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/mycss.css">

  <!-- Jquery -->
  <script src="/js/jquery.js"></script>
</head>

<body class="my-bg-element">
  <main class="container-fluid p-3">
    <form action="/customer" method="POST">
      @csrf

      <div class="row">
        <h3 class="col">Tambah customer baru</h3>
      </div>

      @if (session()->has('success'))    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="m-0 p-0">{{ session('success') }}</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row mb-3">
        <div class="col-lg-12">
          <div class="row px-2">

            <div class="col-sm-2 p-1">
              <label for="code" class="d-block">Kode</label>
              <input type="text" name="code" id="code"
                class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code') }}" required>
              @error('code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-4 p-1">
              <label for="name" class="d-block">Nama perusahaan</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-4 p-1">
              <label for="email" class="d-block">Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-2 p-1">
              <label for="phone" class="d-block">Nomor telpon</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone') }}">
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

          </div>

          <div class="col-12">
            <label for="address" class="d-block">Alamat</label>
            <textarea name="address" style="height: 100px"
              class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

        </div>
      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Simpan</button>
      </div>
    </form>
  </main>

  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>