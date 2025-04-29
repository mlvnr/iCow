<?php include 'data_gejala.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Diagnosa Penyakit Sapi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    body {
        background-color: #fff6f1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding-top: 80px;
      }

      .navbar-custom {
        background-color: #f69759;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      .navbar-nav .nav-link {
        color: white !important;
        font-weight: 500;
        transition: color 0.3s;
      }

      .navbar-nav .nav-link:hover {
        color: #ffe5d0 !important;
      }
      
  </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="icow_logo.png" alt="iCow Logo" width="75" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="diagnosa.php">Diagnosa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tentangkami.php">Tentang Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      

  <h1>Sistem Pakar Diagnosa Penyakit Sapi</h1>
  <form method="post" action="proses.php">
    <h2>Pilih Gejala yang Dialami Sapi:</h2>
    <div class="gejala-list">
      <?php foreach ($gejala as $kode => $nama): ?>
        <label><input type="checkbox" name="gejala[]" value="<?= $kode ?>"> <?= "$kode - $nama" ?></label><br>
      <?php endforeach; ?>
    </div>
    <button type="submit">Diagnosa</button>
  </form>

  <!-- Tombol kembali ke beranda -->
  <div style="margin-top: 1rem; text-align: center;">
    <a href="index.php">
      <button style="padding: 0.5rem 1rem;">Kembali ke Beranda</button>
    </a>
  </div>
</body>

<script>
  document.querySelector('form').addEventListener('submit', function(event) {
    const checkboxes = document.querySelectorAll('input[name="gejala[]"]:checked');
    if (checkboxes.length === 0) {
      alert('Silakan pilih setidaknya satu gejala sebelum melakukan diagnosa.');
      event.preventDefault();
    }
  });
</script>
</html>
