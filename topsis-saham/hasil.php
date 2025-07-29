<?php
$conn = new mysqli("localhost", "root", "", "topsis_saham");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$emitenDipilih = $_POST['emiten'] ?? [];

if (count($emitenDipilih) < 2) {
  echo "<script>alert('Minimal pilih 2 emiten untuk dilakukan perhitungan!'); window.location.href = 'perhitungan.php';</script>";
  exit;
}


$dataEmiten = [];
foreach ($emitenDipilih as $kode) {
  $stmt = $conn->prepare("SELECT * FROM saham WHERE kode_saham = ?");
  $stmt->bind_param("s", $kode);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    $dataEmiten[] = [
      'kode' => $row['kode_saham'],
      'nama' => $row['nama_perusahaan'],
      'eps' => (float)$row['eps'],
      'pbv' => (float)$row['pbv'],
      'dpr' => (float)$row['dpr'],
      'der' => (float)$row['der'],
      'roa' => (float)$row['roa'],
      'roe' => (float)$row['roe'],
    ];
  }
  $stmt->close();
}

// Step 1: Matrix Pembagi
$pembagi = array_fill_keys(['eps','pbv','dpr','der','roa','roe'], 0);
foreach ($dataEmiten as $e) foreach ($pembagi as $k => $_) $pembagi[$k] += pow($e[$k], 2);
foreach ($pembagi as $k => $v) $pembagi[$k] = sqrt($v);

// Step 2: Normalisasi
$normalisasi = [];
foreach ($dataEmiten as $e) {
  $norm = [];
  foreach ($pembagi as $k => $p) $norm[$k] = $p > 0 ? $e[$k] / $p : 0;
  $normalisasi[] = ['kode' => $e['kode'], 'nama' => $e['nama'], 'data' => $norm];
}

// Step 3: Bobot Profesional
$bobot = ['eps'=>0.25, 'pbv'=>0.10, 'dpr'=>0.10, 'der'=>0.15, 'roa'=>0.20, 'roe'=>0.20];

// Step 4: Matrix Bobot
$matrixBobot = [];
foreach ($normalisasi as $n) {
  $weighted = [];
  foreach ($n['data'] as $k => $v) $weighted[$k] = $v * $bobot[$k];
  $matrixBobot[] = ['kode' => $n['kode'], 'nama' => $n['nama'], 'data' => $weighted];
}

// Step 5: Solusi Ideal
$jenisKriteria = ['eps'=>'benefit','pbv'=>'cost','dpr'=>'benefit','der'=>'cost','roa'=>'benefit','roe'=>'benefit'];
$solusiIdeal = ['positif'=>[], 'negatif'=>[]];
foreach ($jenisKriteria as $k => $jenis) {
  $kolom = array_column(array_map(fn($x) => $x['data'], $matrixBobot), $k);
  $solusiIdeal['positif'][$k] = $jenis === 'benefit' ? max($kolom) : min($kolom);
  $solusiIdeal['negatif'][$k] = $jenis === 'benefit' ? min($kolom) : max($kolom);
}

// Step 6: Jarak ke Solusi Ideal
$jarakSolusi = [];
foreach ($matrixBobot as $row) {
  $dPlus = $dMin = 0;
  foreach ($row['data'] as $k => $v) {
    $dPlus += pow($v - $solusiIdeal['positif'][$k], 2);
    $dMin  += pow($v - $solusiIdeal['negatif'][$k], 2);
  }
  $jarakSolusi[] = ['kode'=>$row['kode'], 'nama'=>$row['nama'], 'dplus'=>sqrt($dPlus), 'dmin'=>sqrt($dMin)];
}

// Step 7: Preferensi
$preferensi = [];
foreach ($jarakSolusi as $j) {
  $v = ($j['dplus'] + $j['dmin']) > 0 ? $j['dmin'] / ($j['dplus'] + $j['dmin']) : 0;
  $preferensi[] = ['kode'=>$j['kode'], 'nama'=>$j['nama'], 'v'=>$v];
}
usort($preferensi, fn($a, $b) => $b['v'] <=> $a['v']);
$rekomendasi = $preferensi[0] ?? null;
$kriteria = ['EPS','PBV','DPR','DER','ROA','ROE'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil TOPSIS Saham</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="app.css" rel="stylesheet">
  <style>
    @media print {
      nav, footer, .btn, .mb-4.d-flex { display: none !important; }
      .table { font-size: 12px; }
      body { margin: 20px; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: var(--primary);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Topsis Saham</a>
  </div>
</nav>

<div class="container my-5">
  <!-- Tombol Aksi -->
  <div class="mb-4 d-flex flex-wrap gap-2">
    <a href="perhitungan.php" class="btn btn-secondary">← Kembali ke Perhitungan</a>
    <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak / Export PDF</button>
  </div>
<!-- Rekomendasi Saham (Pindah ke atas) -->
<div class="mb-5">
  <h4 class="text-primary mb-3">📈 Rekomendasi Saham</h4>
  <?php if ($rekomendasi): 
    $kodeRek = $rekomendasi['kode'];
    $namaRek = '';
    foreach ($dataEmiten as $d) {
      if ($d['kode'] === $kodeRek) {
        $namaRek = $d['nama'];
        break;
      }
    }
  ?>
    <div class="alert alert-success shadow-sm">
      Rekomendasi terbaik jatuh pada saham <strong><?= $kodeRek ?> - <?= $namaRek ?></strong> dengan nilai preferensi tertinggi <strong><?= number_format($rekomendasi['v'], 4) ?></strong>.
    </div>

    <div class="bg-light border rounded p-3">
      <p><strong> Rekomendasi Saham :</strong></p>
      <p>
        Berdasarkan metode TOPSIS dan bobot yang telah ditentukan oleh analis profesional, saham <strong><?= $kodeRek ?></strong> unggul dalam beberapa rasio fundamental yang krusial.
        Penilaian ini mempertimbangkan enam kriteria utama:
      </p>
      <ul>
        <li><strong>EPS (Earnings per Share)</strong> [Bobot 25%]: mencerminkan kemampuan perusahaan menghasilkan laba tiap saham yang dimiliki.</li>
        <li><strong>ROA & ROE</strong> [Masing-masing 20%]: menunjukkan efisiensi perusahaan dalam menghasilkan keuntungan dari aset dan modal sendiri.</li>
        <li><strong>DER (Debt to Equity Ratio)</strong> [15%]: rasio utang rendah menandakan risiko finansial lebih kecil.</li>
        <li><strong>DPR & PBV</strong> [Masing-masing 10%]: mengukur kebijakan dividen dan valuasi pasar terhadap nilai buku.</li>
      </ul>
      <p>
        Saham <strong><?= $kodeRek ?></strong> memiliki <strong>nilai EPS, ROA, dan ROE yang tinggi</strong>, serta <strong>DER yang rendah</strong> dibandingkan alternatif lainnya, menjadikannya pilihan yang lebih stabil dan layak untuk dipertimbangkan dalam strategi investasi jangka panjang.
      </p>
    </div>
  <?php else: ?>
    <div class="alert alert-warning">
      Tidak ada rekomendasi yang dapat ditampilkan.
    </div>
  <?php endif; ?>
</div>

  <!-- A. Matrix Data Emiten -->
  <h5 class="mb-3">A. Matrix Data Emiten – Kriteria</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered table-striped text-center">
      <thead class="table-primary">
        <tr><th>Kode - Nama</th><?php foreach ($kriteria as $k) echo "<th>$k</th>"; ?></tr>
      </thead>
      <tbody>
        <?php foreach ($dataEmiten as $e): ?>
        <tr>
          <td><?= $e['kode'] ?> - <?= $e['nama'] ?></td>
          <td><?= $e['eps'] ?></td><td><?= $e['pbv'] ?></td><td><?= $e['dpr'] ?></td>
          <td><?= $e['der'] ?></td><td><?= $e['roa'] ?></td><td><?= $e['roe'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- B. Matrix Pembagi -->
  <h5 class="mb-3">B. Matrix Pembagi</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center">
      <thead class="table-primary">
        <tr><?php foreach ($kriteria as $k) echo "<th>$k</th>"; ?></tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach ($kriteria as $k): ?>
            <td><?= number_format($pembagi[strtolower($k)], 4) ?></td>
          <?php endforeach; ?>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- C. Matrix Normalisasi -->
  <h5 class="mb-3">C. Matrix Normalisasi</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center">
      <thead class="table-primary">
        <tr><th>Emiten</th><?php foreach ($kriteria as $k) echo "<th>$k</th>"; ?></tr>
      </thead>
      <tbody>
        <?php foreach ($normalisasi as $row): ?>
        <tr>
          <td><?= $row['kode'] ?> - <?= $row['nama'] ?></td>
          <?php foreach ($kriteria as $k): ?>
            <td><?= number_format($row['data'][strtolower($k)], 4) ?></td>
          <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- D. Matrix Bobot -->
  <h5 class="mb-3">D. Matrix Bobot</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center">
      <thead class="table-primary">
        <tr><th>Emiten</th><?php foreach ($kriteria as $k) echo "<th>$k</th>"; ?></tr>
      </thead>
      <tbody>
        <?php foreach ($matrixBobot as $row): ?>
        <tr>
          <td><?= $row['kode'] ?> - <?= $row['nama'] ?></td>
          <?php foreach ($kriteria as $k): ?>
            <td><?= number_format($row['data'][strtolower($k)], 4) ?></td>
          <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- E. Solusi Ideal -->
  <h5 class="mb-3">E. Solusi Ideal</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center">
      <thead class="table-primary"><tr><th></th><?php foreach ($kriteria as $k) echo "<th>$k</th>"; ?></tr></thead>
      <tbody>
        <tr><td>A+</td><?php foreach ($kriteria as $k): ?><td><?= number_format($solusiIdeal['positif'][strtolower($k)], 4) ?></td><?php endforeach; ?></tr>
        <tr><td>A−</td><?php foreach ($kriteria as $k): ?><td><?= number_format($solusiIdeal['negatif'][strtolower($k)], 4) ?></td><?php endforeach; ?></tr>
      </tbody>
    </table>
  </div>

  <!-- F. Jarak -->
  <h5 class="mb-3">F. Jarak ke Solusi Ideal</h5>
  <div class="table-responsive mb-4">
    <table class="table table-bordered text-center">
      <thead class="table-primary"><tr><th>Emiten</th><th>D+</th><th>D−</th></tr></thead>
      <tbody>
        <?php foreach ($jarakSolusi as $row): ?>
        <tr>
          <td><?= $row['kode'] ?> - <?= $row['nama'] ?></td>
          <td><?= number_format($row['dplus'], 4) ?></td>
          <td><?= number_format($row['dmin'], 4) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- G. Preferensi -->
  <h5 class="mb-3">G. Matrix Preferensi</h5>
  <div class="table-responsive mb-5">
    <table class="table table-bordered text-center">
      <thead class="table-primary"><tr><th>Emiten</th><th>Nilai V</th></tr></thead>
      <tbody>
        <?php foreach ($preferensi as $p): ?>
        <tr>
          <td><?= $p['kode'] ?> - <?= $p['nama'] ?></td>
          <td><?= number_format($p['v'], 4) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>



</div>

<footer class="text-center text-white py-3" style="background-color: var(--primary);">
  <p class="mb-0">© <?= date('Y') ?> Aplikasi Rekomendasi Saham - Metode TOPSIS</p>
</footer>

</body>
</html>
