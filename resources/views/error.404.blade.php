<!DOCTYPE html>
<html>
<head>
  <title>Error 404 - Halaman Tidak Ditemukan</title>
  <link rel="stylesheet" href="{{ asset('css/error.css') }}">  </head>
<body>
  <h1>Oops! Halaman yang Anda cari tidak ditemukan.</h1>
  <p>
    <?php echo isset($message) ? $message : 'Halaman yang diminta tidak tersedia.'; ?>
  </p>
  <a href="{{ url('/') }}">Kembali ke halaman utama</a>
</body>
</html>