<?php
include 'config/db.php';
$emiten = mysqli_query($conn, "SELECT kodesaham, namaperusahaan FROM datasaham ORDER BY kodesaham ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard TOPSIS Saham</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="app.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Topsis Saham</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'beranda.php' ? 'active' : '' ?>" href="beranda.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'info.php' ? 'active' : '' ?>" href="info.php">Info</a></li>
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'data.php' ? 'active' : '' ?>" href="data.php">Data</a></li>
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'perhitungan.php' ? 'active' : '' ?>" href="perhitungan.php">Perhitungan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Info Section -->
  <div class="container my-4">
    <div class="card fade-in">
      <div class="card-body">
        <h4 class="card-title">Selamat Datang</h4>
        <p class="card-text">
          Ini adalah aplikasi pendukung keputusan dalam pemilihan saham dengan membandingkan aspek kuantitatif dari analisis fundamental menggunakan metode <strong>TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)</strong>.
        </p>
      </div>
    </div>

    <div class="card fade-in">
      <div class="card-body">
        <h5 class="card-title text-danger">⚠️ PENTING</h5>
        <p class="card-text">
          Aplikasi ini dirancang untuk membantu proses pengambilan keputusan dalam memilih saham untuk investasi berdasarkan aspek fundamental dengan pendekatan objektif dan kuantitatif.
          <br><br>
          <strong>Catatan:</strong> Tetap lakukan analisis fundamental kualitatif secara mandiri untuk hasil yang optimal.
        </p>
      </div>
    </div>

    <!-- Saham dan Grafik -->
    <div class="row mt-4">
      <!-- Sidebar Saham -->
      <div class="col-md-3">
        <h5 class="mb-3">📌 Daftar Saham LQ45</h5>
        <div class="list-group sidebar" id="sahamList">
          <?php mysqli_data_seek($emiten, 0); ?>
          <?php while ($row = mysqli_fetch_assoc($emiten)): ?>
            <a class="list-group-item list-group-item-action saham-item"
               data-kode="<?= htmlspecialchars($row['kodesaham']) ?>">
              <?= htmlspecialchars($row['kodesaham']) ?> - <?= htmlspecialchars($row['namaperusahaan']) ?>
            </a>
          <?php endwhile; ?>
        </div>
      </div>

      <!-- Grafik TradingView -->
      <div class="col-md-9 chart-container">
        <div id="tv_chart_container" class="bg-white shadow-sm border rounded-lg" style="height: 500px;"></div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer-custom text-center mt-5">
    <div class="container">
      <p class="mb-0">© <?= date('Y'); ?> Aplikasi Rekomendasi Saham - Metode TOPSIS</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://s3.tradingview.com/tv.js"></script>
  <script src="script/grafik.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
