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

    <div class="col-2 p-1 mb-3">
      <label for="no_drawing" class="d-block">Nomor drawing</label>
      <input type="text" name="no_drawing" class="form-control @error('no_drawing') is-invalid @enderror"
        value="{{ old('no_drawing') }}">
      @error('no_drawing')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="container-fluid" id="table">
      <div class="row bg-success fw-bold py-2">
        <div class="col-1 border-end text-center">OP</div>
        <div class="col-2 border-end text-center">Work center</div>
        <div class="col border-end text-center">Deskripsi</div>
        <div class="col-2 border-end text-center">Estimasi (menit)</div>
        <div class="col-2 text-center">Aksi</div>
      </div>

      <form action="" class="row py-2 op-number-row" data-op="10" id="row-10">
        <div class="col-1 align-self-center text-center p-1">
          <input type="hidden" name="op_number" value="10">
          <span class="number-row">10</span>
        </div>        
        <div class="col-2 align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col-2 align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col-2 align-self-center text-center p-1">
          <span class="badge bg-success add-btn" onclick="addRow(10)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </span>
          <span class="badge bg-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-arrow-up-square my-hover" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
            </svg>
          </span>
          <span class="badge bg-danger delete-btn" onclick="deleteRow(10)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
          </span>
        </div>
      </form>      

    </div>

  </main>

  <script>
    // menambah baris
    function addRow(row) {
      let numberRow = row + 10

      $('#row-' + row).after(
        `<form action="" class="row py-2 op-number-row" data-op="${numberRow}" id="row-${numberRow}">
        <div class="col-1 align-self-center text-center p-1">
          <input type="hidden" name="op_number" value="${numberRow}">          
          <span class="number-row">${numberRow}</span>
        </div>
        <div class="col-2 align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col-2 align-self-center p-1">
          <input type="text" class="form-control">
        </div>
        <div class="col-2 align-self-center text-center p-1">
          <span class="badge bg-success add-btn" onclick="addRow(${numberRow})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </span>
          <span class="badge bg-warning">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-arrow-up-square my-hover" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
            </svg>
          </span>
          <span class="badge bg-danger delete-btn" onclick="deleteRow(${numberRow})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
          </span>
        </div>
      </form>`
      )

      refreshRow()
    }

    function refreshRow(current) {
      $('.op-number-row').each(function(i) {
        let number = $(this).data('op')
        let index = i * 10 + 10
        
        $(this).attr('data-op', index)
        $(this).attr('id', `row-${index}`)
        $(this).find('.number-row').text(index)        
        $(this).find('input[name="op_number"]').val(index)
        $(this).find('.add-btn').attr('onclick', `addRow(${index})`)
        $(this).find('.delete-btn').attr('onclick', `deleteRow(${index})`)
        }
      )
    }

    // menghapus baris
    function deleteRow(row) {
      $('form').remove('#row-' + row)

      refreshRow()
    }
  </script>
</body>

</html>