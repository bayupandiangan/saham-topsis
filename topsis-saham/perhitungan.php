<?php
$conn = new mysqli("localhost", "root", "", "topsis_saham");
$daftarEmiten = [];
$result = $conn->query("SELECT kode_saham, nama_perusahaan FROM saham ORDER BY kode_saham ASC");
while ($row = $result->fetch_assoc()) {
  $daftarEmiten[] = [
    'kode' => $row['kode_saham'],
    'nama' => $row['nama_perusahaan']
  ];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perhitungan TOPSIS</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
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

<!-- Form Perhitungan -->
<div class="container my-5">
  <div class="card shadow-sm fade-in">
    <div class="card-body">
      <h4 class="mb-4 text-primary">🔍 Pilih Emiten untuk Perhitungan</h4>

      <form action="hasil.php" method="POST">
        <div id="emiten-container" class="mb-3"></div>
        <button type="button" class="btn btn-secondary mb-3" onclick="tambahEmiten()">+ Tambah Emiten</button>
        <button type="submit" class="btn btn-hitung">🔎 HITUNG</button>
      </form>

      <div class="legend mt-4">
        <strong>Keterangan:</strong>
        <span>Pilih minimal 2 emiten. Sistem akan menghitung ranking otomatis menggunakan metode TOPSIS berdasarkan rasio fundamental (EPS, PBV, DPR, DER, ROA, ROE).</span>
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
<script>
  const daftarEmiten = <?= json_encode($daftarEmiten); ?>;
  let counter = 0;

  function tambahEmiten() {
    if (counter >= daftarEmiten.length) {
      alert("Semua emiten sudah dipilih.");
      return;
    }

    const container = document.getElementById('emiten-container');
    const wrapper = document.createElement('div');
    wrapper.className = "d-flex align-items-center mb-2 gap-2";

    const select = document.createElement('select');
    select.name = "emiten[]";
    select.required = true;
    select.className = "form-select";

    const defaultOpt = document.createElement('option');
    defaultOpt.value = "";
    defaultOpt.text = "-- Pilih Emiten --";
    select.appendChild(defaultOpt);

    daftarEmiten.forEach(item => {
      const opt = document.createElement('option');
      opt.value = item.kode;
      opt.text = `${item.kode} - ${item.nama}`;
      select.appendChild(opt);
    });

    select.addEventListener('change', updateDuplicateSelects);

    const btnHapus = document.createElement('button');
    btnHapus.type = "button";
    btnHapus.className = "btn btn-danger btn-sm";
    btnHapus.textContent = "Hapus";
    btnHapus.onclick = function () {
      wrapper.remove();
      counter--;
      updateDuplicateSelects();
    };

    wrapper.appendChild(select);
    wrapper.appendChild(btnHapus);
    container.appendChild(wrapper);
    counter++;

    updateDuplicateSelects();
  }

  function updateDuplicateSelects() {
    const selects = document.querySelectorAll('select[name="emiten[]"]');
    const selectedValues = Array.from(selects).map(sel => sel.value);

    selects.forEach(sel => {
      Array.from(sel.options).forEach(opt => {
        opt.disabled = selectedValues.includes(opt.value) && opt.value !== sel.value && opt.value !== "";
      });
    });
  }

  // Tambahkan 3 input default saat halaman dibuka
  window.onload = () => {
    tambahEmiten();
    tambahEmiten();
    tambahEmiten();
  };
  
  // Validasi saat submit form
  document.querySelector('form').addEventListener('submit', function (e) {
    const selects = document.querySelectorAll('select[name="emiten[]"]');
    const selected = Array.from(selects).filter(sel => sel.value.trim() !== "");
    
    if (selected.length < 2) {
      e.preventDefault(); // cegah form dikirim
      alert("Minimal pilih 2 emiten untuk dilakukan perhitungan!");
    }
  });

</script>

</body>
</html>
