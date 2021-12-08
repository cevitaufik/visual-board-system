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
    <form action="/tool/{{ $tool->drawing }}" id="order-detail" method="POST" enctype="multipart/form-data">
      @method('put')
      @csrf

      <div class="row">
        <h3 class="col">{{ $tool->drawing }}</h3>
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
              <label for="cust_code" class="d-block">Customer</label>
              <input type="text" name="cust_code" id="cust_code"
                class="form-control @error('cust_code') is-invalid @enderror"
                value="{{ old('cust_code', $tool->cust_code) }}" disabled>
              @error('cust_code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="drawing" class="d-block">Nomor drawing</label>
              <input type="text" name="drawing" class="form-control @error('drawing') is-invalid @enderror"
                value="{{ old('drawing', $tool->drawing) }}">
              @error('drawing')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="code" class="d-block">Kode tool</label>
              <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $tool->code) }}">
              @error('code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-2 p-1">
              <label for="dwg_customer" class="d-block">Drawing customer</label>
              <input type="file" name="dwg_customer" class="form-control @error('dwg_customer') is-invalid @enderror"
                value="{{ old('dwg_customer') }}">
              @error('dwg_customer')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-2 p-1">
              <label for="dwg_production" class="d-block">Drawing produksi</label>
              <input type="file" name="dwg_production"
                class="form-control @error('dwg_production') is-invalid @enderror" value="{{ old('dwg_production') }}">
              @error('dwg_production')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row px-2">
            <div class="col-md-10 p-1">
              <label for="description" class="d-block">Deskripsi</label>
              <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $tool->description) }}">
              @error('description')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col-md-2 p-1">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-select">                
                <option value="APPROVAL CUST." @if($tool->status == 'APPROVAL CUST.') selected @endif>APPROVAL CUST.</option>
                <option value="APPROVED" @if($tool->status == 'APPROVED') selected @endif>APPROVED</option>
                <option value="PRODUCTION" @if($tool->status == 'PRODUCTION') selected @endif>PRODUCTION</option>
                <option value="TIDAK DIGUNAKAN" @if($tool->status == 'TIDAK DIGUNAKAN') selected @endif>TIDAK DIGUNAKAN</option>
              </select>
            </div>
          </div>

          <div class="col-12">
            <label for="note" class="d-block">Catatan</label>
            <textarea name="note" style="height: 100px"
              class="form-control @error('note') is-invalid @enderror">{{ old('note', $tool->note) }}</textarea>
            @error('note')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row px-2">

            <div class="col-md-2 p-1">
              <small>Tanggal dibuat</small>
              <h6>{{ date('d F Y', strtotime($tool->created_at)) }}</h6>
            </div>

            <div class="col-md-2 p-1">
              <small>Terakhir diperbarui</small>
              <h6>{{ date('d F Y', strtotime($tool->updated_at)) }}</h6>
            </div>

            <div class="col-md-8">

              <div class="row justify-content-end">

                @if ($tool->flowProcesses->isNotEmpty())
                  <div class="col-md-3 pt-2">
                    <button class="btn btn-success" type="button" onclick="showFlowProces('{{ $tool->flowProcesses->first()->id }}')">
                      Lihat flow proses
                    </button>
                  </div>
                @else
                  <div class="col-md-3 pt-2">
                    <button class="btn btn-primary" type="button" onclick="addFlowProces('{{ $tool->drawing }}')">
                      Buat flow proses
                    </button>
                  </div>
                @endif

                <div class="col-md-3 pt-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dwgCust"
                    aria-expanded="false" aria-controls="dwgCust" @if (!isset($tool->dwg_customer))
                    disabled
                    @endif>
                    Drawing customer
                  </button>
                </div>

                <div class="col-md-3 pt-2">
                  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dwgProd"
                    aria-expanded="false" aria-controls="dwgProd" @if (!isset($tool->dwg_production))
                    disabled
                    @endif>
                    Drawing produksi
                  </button>
                </div>
              </div>

            </div>

          </div>

        </div>

      </div>

      <div class="ratio ratio-16x9 collapse mb-3" id="dwgCust">
        <object data="{{ asset('storage/'. $tool->dwg_customer) }}" type="application/pdf" title="Drawing customer"
          allowfullscreen>Perangkat tidak mendukung</object>
      </div>

      <div class="ratio ratio-16x9 collapse" id="dwgProd">
        <object data="{{ asset('storage/'. $tool->dwg_production) }}" type="application/pdf" title="Drawing produksi"
          allowfullscreen>Perangkat tidak mendukung</object>
      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <a class="btn btn-danger me-3" onclick="return confirm('Apakah anda yakin?')" id="delete">Hapus</a>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Perbarui</button>
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

    //melihat flow proses yang sudah ada
    function showFlowProces(id) {
      $('iframe').attr('src', `/flow-process/${id}`)
      $('.modal-detail').modal('show')
    }

    // menambah flow process
    function addFlowProces(data) {
      console.log(`/flow-process/create-new/${data}`);
      $('iframe').attr('src', `/flow-process/create-new/${data}`)
      $('.modal-detail').modal('show')
    }

    $('#delete').on('click', function(event) {
      event.preventDefault();
      $('input[name="_method"]').val('DELETE')

      let formData = $('#order-detail').serialize()
      let drawing = '{{ $tool->drawing }}'

      $.ajax({
        url: `/tool/${drawing}`,
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