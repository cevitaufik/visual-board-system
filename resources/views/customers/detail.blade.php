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
    <form action="/customer/{{ $customer->code }}" id="customer-detail" method="POST">
      @method('put')
      @csrf

      <div class="row">
        <h3 class="col">{{ $customer->name }}</h3>
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
            <div class="col-sm-1 p-1">
              <label for="code" class="d-block">Kode</label>
              <input type="text" name="code" id="code"
                class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $customer->code) }}" disabled>
              @error('code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-5 p-1">
              <label for="name" class="d-block">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $customer->name) }}">
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="phone" class="d-block">Nomor telpon</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $customer->phone) }}">
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="email" class="d-block">Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $customer->email) }}">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-12">
            <label for="address" class="d-block">Alamat</label>
            <textarea name="address" style="height: 100px"
              class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer->address) }}</textarea>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row px-2">

            <div class="col-md-2 p-1">
              <small>Tanggal dibuat</small>
              <h6>{{ date('d F Y', strtotime($customer->created_at)) }}</h6>
            </div>

            <div class="col-md-2 p-1">
              <small>Terakhir diperbarui</small>
              <h6>{{ date('d F Y', strtotime($customer->updated_at)) }}</h6>
            </div>

          </div>
        </div>

      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <a class="btn btn-danger me-3" onclick="return confirm('Apakah anda yakin ingin menghapus?')" id="delete">Hapus</a>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin memperbarui?')">Perbarui</button>
      </div>

    </form>

    <!-- Modal -->
    <div class="modal fade modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen position-relative">
        <div class="modal-content my-bg-element p-1">
          <div class="modal-body p-3 m-0">
            <iframe title="Detail order" class="w-100 d-inline-block" id="iframe"></iframe>
          </div>
          <div class="position-absolute top-0 end-0 mt-2 me-3">
            <button type="button" class="btn btn-danger btn-sm" id="close" data-bs-toggle="tooltip"
              data-bs-placement="bottom" title="Tutup">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script>
    // mengatur tingging iframe
    const height = $(window).height() * 0.92;
    $('iframe').css('height', height +'px');

    // menutup modal ketika mengklik tombol close
    $('#close').on('click', function() {
      $('.modal-detail').modal('hide')
    })

    $('#delete').on('click', function(event) {
      event.preventDefault();
      $('input[name="_method"]').val('DELETE')

      let formData = $('#customer-detail').serialize()
      let code = '{{ $customer->code }}'

      $.ajax({
        url: `/customer/{{ $customer->code }}`,
        method: 'POST',
        data: formData,
        success: function(data) {          
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