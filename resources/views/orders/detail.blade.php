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
    <form action="/order/{{ $order->shop_order }}" id="order-detail" method="POST">
      @method('put')
      @csrf

      <div class="row">
        <h3 class="col">{{ $order->cust_code }}</h3>
      </div>

      @if (session()->has('success'))    
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="m-0 p-0">{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      <div class="row mb-3">
        <div class="col-lg-8">
          <div class="row px-2">
            <div class="col-md-3 p-1">
              <label for="shop_order" class="d-block">Shop order</label>
              <input type="text" name="shop_order" id="shop_order"
                class="form-control @error('shop_order') is-invalid @enderror"
                value="{{ old('shop_order', $order->shop_order) }}" disabled>
              @error('shop_order')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="quantity" class="d-block">Quantity</label>
              <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                value="{{ old('quantity', $order->quantity) }}">
              @error('quantity')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col md-3 p-1">
              <label for="job_type" class="d-block">Tipe pekerjaan</label>
              <select id="job_type_code" name="job_type_code" class="form-select">
                @foreach ($jobTypes as $jobType)
                  @if (old('job_type_code', $order->job_type_code) == $jobType->code)
                    <option value="{{ $jobType->code }}" selected>{{ $jobType->code . ' - ' . $jobType->description }}</option>
                  @else
                    <option value="{{ $jobType->code }}">{{ $jobType->code . ' - ' . $jobType->description }}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div class="col md-3 p-1">
              <label for="po_number" class="d-block">Nomor PO</label>
              <input type="text" name="po_number" class="form-control @error('po_number') is-invalid @enderror"
                value="{{ old('po_number', $order->po_number) }}">
              @error('po_number')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row px-2">
            <div class="col-md-3 p-1">
              <small>Tanggal order</small>
              <h6>{{ date('d F Y', strtotime($order->created_at)) }}</h6>
            </div>

            <div class="col-md-3 p-1">
              <label for="due_date" class="d-block">Target kirim</label>
              <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                value="{{ old('due_date', $order->due_date) }}">
              @error('due_date')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="no_drawing" class="d-block">Nomor drawing</label>
              <input type="text" id="no_drawing" name="no_drawing" class="form-control @error('no_drawing') is-invalid @enderror"
                value="{{ old('no_drawing', $order->no_drawing) }}">
              @error('no_drawing')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="tool_code" class="d-block">Kode tool</label>
              <input type="text" id="tool_code" name="tool_code" class="form-control @error('tool_code') is-invalid @enderror"
                value="{{ old('tool_code', $order->tool_code) }}">
              @error('tool_code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-12 py-2">
            <label for="description" class="d-block">Deskripsi</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
              value="{{ old('description', $order->description) }}">
            @error('description')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-12">
            <label for="note" class="d-block">Catatan</label>
            <textarea name="note" style="height: 100px"
              class="form-control @error('note') is-invalid @enderror">{{ old('note', $order->note) }}</textarea>
            @error('note')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row">
            <div class="col-md-3 p-1">
              <small>Terakhir diperbarui oleh</small>
              <h6>{{ $order->updated_by }}</h6>
            </div>

            <div class="col-md-3 p-1">
              <small>Terakhir diperbarui</small>
              <h6>{{ date('d F Y', strtotime($order->updated_at)) }}</h6>
            </div>

            <div class="col-md-3 p-1">
              <small>Dibuat oleh</small>
              <h6></h6>
            </div>            
          </div>

          <div class="row">
            <div class="col-md-3 pt-2">
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dwgProd"
                aria-expanded="false" aria-controls="dwgProd" @if (!isset($order->tool->dwg_production))
                disabled
                @endif>
                Dwg produksi
              </button>
            </div>

            <div class="col-md-3 pt-2">
              <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dwgCust"
                aria-expanded="false" aria-controls="dwgCust" @if (!isset($order->tool->dwg_customer))
                disabled
                @endif>
                Dwg customer
              </button>
            </div>

          </div>

        </div>

        <div class="col-lg-4 border border-white rounded">
          
          @if (count($processes))
            <h3 class="my-2">Flow process</h3>
            <div class="py-1">
              <button class="btn btn-warning" type="button" onclick="showFlowProces({{ $order->tool->flowProcess[0]->id }})">
                Edit flow proses
              </button>
            </div>
            <table>
              @foreach ($processes as $process)
                <tr class="px-2">
                  <td class="px-2 @if($loop->iteration <= 2) text-success @endif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    </svg>
                  </td>
                  <td class="px-2">
                    <span>{{ $process->work_center }}</span>
                  </td>
                  <td class="px-2">
                    <span>{{ $process->description }}</span>
                  </td>
                  <td class="px-2">
                    <span>{{ $process->estimation }} menit</span>
                  </td>
                </tr>
              @endforeach
            </table>
          @else
              <h1 class="py-3">Belum ada flow process</h1>
              <div class="pt-2">
                <button class="btn btn-primary" type="button" onclick="addFlowProces('{{ $order->no_drawing }}')">
                  Buat flow proses
                </button>
              </div>
          @endif
        </div>
      </div>

      @if (isset($order->tool->dwg_production))
        <div class="ratio ratio-16x9 collapse mb-3" id="dwgProd">
          <object data="{{ asset('storage/'. $order->tool->dwg_production) }}" type="application/pdf" title="Drawing produksi" allowfullscreen>Perangkat tidak mendukung</object>
        </div>
      @endif

      @if (isset($order->tool->dwg_customer))
        <div class="ratio ratio-16x9 collapse" id="dwgCust">
          <object data="{{ asset('storage/'. $order->tool->dwg_customer) }}" type="application/pdf" title="Drawing produksi" allowfullscreen>Perangkat tidak mendukung</object>
        </div>
      @endif

      <div class="position-fixed bottom-0 end-0 m-3">
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
    //melihat flow proses yang sudah ada
    function showFlowProces(id) {
      $('iframe').attr('src', `/flow-process/${id}`)
      $('.modal-detail').modal('show')
    }

    // menambah flow process
    function addFlowProces(data) {
      $('iframe').attr('src', `/flow-process/create-new/${data}`)
      $('.modal-detail').modal('show')
    }

    // mengatur tinggi iframe
    const height = $(window).height() * 0.92;
    $('iframe').css('height', height +'px');

    // menutup modal ketika mengklik tombol close
    $('#close').on('click', function() {
      $('.modal-detail').modal('hide')
      getTable()
    })

    // mengisi nomor drawing secara otomatis
    $('#tool_code').on('change', function() {
      let toolCode = $('#tool_code').val()
      let cust = '{{ $order->cust_code }}'

      $.ajax({
        url: `/tool/get-drawing/${toolCode}/${cust}`,
        method: 'GET',
        success: function(data){
          $('#no_drawing').val(data)
          $('#tool_code').val(toolCode.toUpperCase())
        },
        error: function(error){
          alert('error ' + error.responseText);
          console.log(error);
        }        
      })
    })
  </script>

  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>