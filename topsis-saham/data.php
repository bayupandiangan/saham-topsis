<?php
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Saham</title>
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

  <!-- Konten -->
  <div class="container my-5">
    <!-- Informasi Sumber -->
    <div class="card shadow-sm mb-4 fade-in">
      <div class="card-body">
        <h6 class="text-warning fw-bold mb-2">📌 Sumber Data</h6>
        <p class="mb-0">
          Data yang digunakan pada aplikasi ini diambil dari publikasi resmi Bursa Efek Indonesia (BEI),
          khususnya dari dokumen <em>“Ringkasan Performa Perusahaan LQ45”</em> untuk periode <strong>Agustus 2024 –
            Januari 2025</strong>.
        </p>
      </div>
    </div>

    <!-- Tabel Data Saham -->
    <div class="card shadow-sm fade-in">
      <div class="card-body">
        <h5 class="mb-3 text-primary">📊 Daftar Saham LQ45</h5>
        <div class="table-responsive mb-4">
          <table class="table table-bordered table-striped text-center">
            <thead class="table-primary">
              <tr>
                <th>No</th>
                <th>Kode Saham</th>
                <th>Nama Perusahaan</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = mysqli_query($conn, "SELECT * FROM datasaham ORDER BY kodesaham ASC");
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                      <td>{$no}</td>
                      <td><strong>{$row['kodesaham']}</strong></td>
                      <td>{$row['namaperusahaan']}</td>
                      <td>{$row['keterangan']}</td>
                    </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>