<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/print-label.css">
  <title>Label</title>
</head>

<body>

  <div class="no-print">
    <span class="btn-print" onclick="window.print()">Print</span>
    <span class="btn-close" onclick="window.close()">close</span>
  </div>

  @foreach ($labels as $label)
  
    <div class="content">
      <div class="text">
        <h1>{{ $label['cust_code'] }}</h1>
        <h2>{{ $label['shop_order'] }}</h2>
        <h3>{{ $label['due_date'] }}</h3>
      </div>

      <div class="qr-code">
        {!! QrCode::size(114)->generate($label['shop_order']) !!}
      </div>
    </div>

  @endforeach 

  <script>
    (function() {
      window.print()
    })()
  </script>

</body>

</html>