<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Generate Code</title>
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/mycss.css">
  <script src="/js/jquery.js"></script>
</head>

<body>

  <div class="container mt-3 mb-5">
    <h3>Masukan text</h3>
    <input type="text" class="form-control" id="input">
    <div onclick="generate()" class="btn btn-primary mt-2">Buat</div>
  </div>

  <div class="container mt-4 mb-5">
    <div class="card">
      <div class="card-header">
        <h2>Barcode</h2>
      </div>
      <div class="card-body text-center">
        <p id="barcode">*test*</p>
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-header">
        <h2>QR Code</h2>
      </div>
      <div class="card-body text-center" id="qr">
        {!! QrCode::size(300)->generate('tes qr') !!}
      </div>
    </div>

    <audio style="display: none;" id="notification" preload src="/asset/success.mp3">

  </div>

  <script>
    function generate() {
        let input = $('#input').val()

        $.ajax({
          url: `/qr/${input}`,
          method: 'GET',
          success: function(data) {
            $('#qr').html(data)
          }
        })

        $('#barcode').text('*' + input + '*')
        document.getElementById('notification').play()
      }
  </script>
</body>

</html>