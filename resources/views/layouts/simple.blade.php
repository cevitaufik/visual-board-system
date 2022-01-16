<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ ($title) ?? 'Catura' }}</title>

  <!-- Favicons -->
  <link href="/img/favicon.png" rel="icon">
  <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="/css/mycss.css">

  <script src="/js/jquery.js"></script>
</head>

<body class="my-bg-main my-text-white">
  <main class="container">

    @yield('main')

  </main>  
  <!-- Vendor JS Files -->
  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>