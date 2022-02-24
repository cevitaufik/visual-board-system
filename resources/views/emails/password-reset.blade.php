<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <title>Email konfirmasi</title>
</head>
<body>
  
  <h1>Password reset</h1>
  <p>Hi, {{ $msg['user_name'] }}</p>
  <p>Klik link dibawah ini untuk mengatur ulang password anda.</p>
  <p><a href="{{ $msg['link'] }}">Link reset password</a></p>
  <p>Jika link di atas tidak berjalan, silahkan copy link dibawah ini dan buka di browser anda</p>
  <p><a href="{{ $msg['link'] }}">{{ $msg['link'] }}</a></p>
  <p>Abaikan pesan ini jika anda merasa tidak melakukannya.</p>

</body>
</html>