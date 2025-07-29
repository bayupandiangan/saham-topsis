<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id =$_POST['id'];
  $kode = $_POST['kode_saham'];
  $nama = $_POST['nama_perusahaan'];
  $eps  = $_POST['eps'];
  $pbv  = $_POST['pbv'];
  $dpr  = $_POST['dpr'];
  $der  = $_POST['der'];
  $roa  = $_POST['roa'];
  $roe  = $_POST['roe'];

  $stmt = $conn->prepare("INSERT INTO saham (kode_saham, nama_perusahaan, eps, pbv, dpr, der, roa, roe)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdddddd", $kode, $nama, $eps, $pbv, $dpr, $der, $roa, $roe);
  $stmt->execute();

  header("Location: saham.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Saham</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h4 class="mb-3">Tambah Data Saham</h4>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Kode Saham</label>
      <input type="text" name="kode_saham" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama Perusahaan</label>
      <input type="text" name="nama_perusahaan" class="form-control" required>
    </div>
    <div class="row">
      <?php
        $rasio = ['eps' => 'EPS', 'pbv' => 'PBV', 'dpr' => 'DPR', 'der' => 'DER', 'roa' => 'ROA', 'roe' => 'ROE'];
        foreach ($rasio as $key => $label): ?>
        <div class="col-md-4 mb-3">
          <label class="form-label"><?= $label ?></label>
          <input type="number" name="<?= $key ?>" step="any" class="form-control" required>
        </div>
      <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="saham.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
