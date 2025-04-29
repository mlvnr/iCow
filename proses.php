<?php
include 'data_gejala.php';
include 'data_penyakit.php';
include 'koneksi.php';

$gejala_input = $_POST['gejala'] ?? [];
$hasil = [];

foreach ($penyakit as $nama => $aturan) {
    $intersect = array_intersect($aturan, $gejala_input);
    $match = count($intersect);
    $total = count($aturan);
    $persentase = round(($match / $total) * 100);

    if ($persentase > 0) {
        $hasil[$nama] = $persentase;
    }
}

arsort($hasil);

$gejala_terpilih = implode(", ", $gejala_input);
$top = array_key_first($hasil);
$persen = $hasil[$top];

mysqli_query($koneksi, "INSERT INTO hasil_diagnosa (gejala_terpilih, penyakit, persentase)
VALUES ('$gejala_terpilih', '$top', $persen)");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Diagnosa</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #chart-container {
      position: relative;
      width: 100%;
      max-width: 600px;
      margin: auto;
      height: 300px;
    }
    ul {
      list-style: none;
      padding: 0;
    }
    li {
      margin-bottom: 15px;
      padding: 10px;
      background-color: #f0f0f0;
      border-left: 5px solid #4CAF50;
    }
  </style>
</head>
<body>
  <h1>Hasil Diagnosa</h1>
  <?php if (empty($hasil)): ?>
    <p>Tidak ditemukan penyakit berdasarkan gejala yang dipilih.</p>
  <?php else: ?>
    
    <div id="chart-container">
      <canvas id="chartHasil"></canvas>
    </div>

    <h2>Detail Diagnosa:</h2>
    <ul>
      <?php foreach ($hasil as $nama_penyakit => $persentase): ?>
        <li>
          <strong><?= $nama_penyakit ?></strong><br>
          Persentase Kecocokan: <?= $persentase ?>%<br>
          Solusi Penanganan: <?= $solusi[$nama_penyakit] ?? 'Belum tersedia' ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <script>
      const ctx = document.getElementById('chartHasil').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_keys($hasil)) ?>,
          datasets: [{
            label: 'Persentase Kecocokan (%)',
            data: <?= json_encode(array_values($hasil)) ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              max: 100
            }
          }
        }
      });
    </script>

  <?php endif; ?>

  <div style="margin-top: 1rem; text-align: center;">
    <a href="diagnosa.php">
      <button style="padding: 0.5rem 1rem;">Kembali ke Diagnosa</button>
    </a>
  </div>
</body>
</html>
