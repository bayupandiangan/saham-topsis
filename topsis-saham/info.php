<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Informasi Fundamental Saham</title>
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
          <li class="nav-item"><a
              class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'beranda.php' ? 'active' : '' ?>"
              href="beranda.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'info.php' ? 'active' : '' ?>"
              href="info.php">Info</a></li>
          <li class="nav-item"><a class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'data.php' ? 'active' : '' ?>"
              href="data.php">Data</a></li>
          <li class="nav-item"><a
              class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'perhitungan.php' ? 'active' : '' ?>"
              href="perhitungan.php">Perhitungan</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten Utama -->
  <div class="container my-5">
    <h3 class="mb-4 text-primary">📘 Informasi Elemen Fundamental Saham</h3>

    <?php
    $kriteria = [
      'DER' => 'DER adalah rasio yang digunakan untuk mengukur seberapa besar proporsi utang perusahaan dibandingkan dengan ekuitasnya. Semakin rendah DER, semakin kecil risiko keuangan perusahaan.',
      'DPR' => 'DPR menunjukkan persentase laba bersih perusahaan yang dibayarkan kepada pemegang saham sebagai dividen. Rasio ini membantu investor menilai stabilitas dan kebijakan dividen perusahaan.',
      'EPS' => 'EPS mengukur laba bersih yang diperoleh perusahaan untuk setiap lembar saham yang beredar. Semakin tinggi EPS, semakin baik profitabilitas perusahaan bagi investor.',
      'PBV' => 'PBV membandingkan harga pasar saham dengan nilai buku per saham. Rasio ini digunakan untuk menilai apakah saham undervalued atau overvalued.',
      'ROA' => 'ROA mengukur kemampuan perusahaan dalam menghasilkan laba dari total aset yang dimilikinya. Semakin tinggi ROA, semakin efisien perusahaan dalam menggunakan asetnya.',
      'ROE' => 'ROE menunjukkan seberapa besar keuntungan yang dihasilkan perusahaan dari modal yang diberikan oleh pemegang saham. Rasio ini sangat penting dalam menilai efisiensi perusahaan dalam mengelola ekuitas.',
    ];

    foreach ($kriteria as $judul => $penjelasan): ?>
      <div class="card mb-3 shadow-sm fade-in">
        <div class="card-body">
          <h5 class="card-title"><?= $judul ?> (<?= match ($judul) {
               'DER' => 'Debt to Equity Ratio',
               'DPR' => 'Dividend Payout Ratio',
               'EPS' => 'Earnings Per Share',
               'PBV' => 'Price to Book Value',
               'ROA' => 'Return on Assets',
               'ROE' => 'Return on Equity',
             } ?>)</h5>
          <p class="card-text"><?= $penjelasan ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Footer -->
  <footer class="footer-custom text-center mt-5">
    <div class="container">
      <p class="mb-0">© <?= date('Y'); ?> Aplikasi Rekomendasi Saham - Metode TOPSIS</p>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>