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
    <form action="/flow-process" id="order-detail" method="POST">
      @csrf

      <div class="row">
        <h3 class="col">Tambah proses</h3>
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

            <div class="col-12 p-1">
              <label for="no_drawing" class="d-block">Nomor drawing</label>
              <input type="text" name="no_drawing" class="form-control @error('no_drawing') is-invalid @enderror"
                value="{{ old('no_drawing') }}">
              @error('no_drawing')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="op_number" class="d-block">No. operasi</label>
              <input type="text" name="op_number" class="form-control @error('op_number') is-invalid @enderror"
                value="{{ old('op_number') }}">
              @error('op_number')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="work_center" class="d-block">Work center</label>
              <input type="text" name="work_center" class="form-control @error('work_center') is-invalid @enderror"
                value="{{ old('work_center') }}">
              @error('work_center')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="description" class="d-block">Deskripsi</label>
              <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description') }}">
              @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="estimation" class="d-block">estimasi</label>
              <input type="text" name="estimation" class="form-control @error('estimation') is-invalid @enderror"
                value="{{ old('estimation') }}">
              @error('estimation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            
          </div>

        </div>

      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Tambah</button>
      </div>      
    </form>

  </main>
</body>

</html>