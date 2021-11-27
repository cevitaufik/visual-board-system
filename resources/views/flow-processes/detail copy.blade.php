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
    <form action="/flow-process/{{ $process->id }}" id="order-detail" method="POST">
      @method('put')
      @csrf

      <div class="row">
        <h3 class="col">{{ $process->no_drawing }}</h3>
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
                value="{{ old('no_drawing', $process->no_drawing) }}">
              @error('no_drawing')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="op_number" class="d-block">No. operasi</label>
              <input type="text" name="op_number" class="form-control @error('op_number') is-invalid @enderror"
                value="{{ old('op_number', $process->op_number) }}">
              @error('op_number')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="work_center" class="d-block">Work center</label>
              <input type="text" name="work_center" class="form-control @error('work_center') is-invalid @enderror"
                value="{{ old('work_center', $process->work_center) }}">
              @error('work_center')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="description" class="d-block">Deskripsi</label>
              <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $process->description) }}">
              @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-12 p-1">
              <label for="estimation" class="d-block">estimasi</label>
              <input type="text" name="estimation" class="form-control @error('estimation') is-invalid @enderror"
                value="{{ old('estimation', $process->estimation) }}">
              @error('estimation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            
          </div>

          <div class="row px-2">

            <div class="col-md-2 px-1 pt-1">
              <small>Tanggal dibuat</small>
              <h6>{{ date('d F Y', strtotime($process->created_at)) }}</h6>
            </div>
            
            <div class="col-md-2 px-1 pt-1">
              <small>Terakhir diperbarui</small>
              <h6>{{ date('d F Y', strtotime($process->updated_at)) }}</h6>
            </div>
           
          </div>

        </div>

      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <a class="btn btn-danger me-3" onclick="return confirm('Apakah anda yakin?')" id="delete">Hapus</a>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Perbarui</button>
      </div>      
    </form>

  </main>

  <script>
    $('#delete').on('click', function(event) {
      event.preventDefault();
      $('input[name="_method"]').val('DELETE')

      let formData = $('#order-detail').serialize()

      let id = '{{ $process->id }}'

      $.ajax({
        url: `/flow-process/${id}`,
        method: 'POST',
        data: formData,
        success: function() {          
          parent.closeModal();
        },
        error: function(error) {
          console.log(error);
        }
      })
    })
  </script>

  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>