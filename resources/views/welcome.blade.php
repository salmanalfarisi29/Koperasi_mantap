<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    @yield('title_prefix', config('adminlte.title_prefix', ''))
    @yield('title', config('adminlte.title', 'AdminLTE 3'))
    @yield('title_postfix', config('adminlte.title_postfix', ''))
  </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <style>
    .content {
      display: grid;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body>
  <div class="container pb-5">
    <div class="content">
      <div class="d-flex justify-content-center text-center">
        <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_1pxqjqps.json" background="transparent"
          speed="1.5" mode="bounce" style="width: 100%; height: 100%; max-width: 300px; max-height: 300px;" loop
          autoplay>
      </div>
      </lottie-player>
      <div class="user-select-none text-center">
        <h4 class="display-6" style="text-transform: capitalize;">Selamat datang👋</h4>
        <p class="lead text-muted">silahkan pilih menu dibawah ini untuk lanjut</p>
      </div>
      <div class="d-flex align-items-center flex-wrap gap-4 justify-content-center">
        <a href="{{ route('login') }}" class="btn btn-success"
          style="width: 100%; height: 100%; max-width: 200px; max-height: 200px;">
          <div class="d-flex flex-column align-items-center text-center">
            <i class="bi bi-person-heart" style="font-size: 100px;"></i>
            <p style="letter-spacing: 2px;">Pengunjung</p>
          </div>
        </a>
        <a href="{{ route('login') }}" class="btn btn-dark"
          style="width: 100%; height: 100%; max-width: 200px; max-height: 200px;">
          <div class="d-flex flex-column align-items-center text-center">
            <i class="bi bi-person-fill-gear" style="font-size: 100px;"></i>
            <p style="letter-spacing: 2px;">Admin</p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</body>

</html>
