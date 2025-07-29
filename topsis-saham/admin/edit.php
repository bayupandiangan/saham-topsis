<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Ambil ID dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: saham.php");
  exit;
}
$id = intval($_GET['id']);

// Ambil data untuk prefill form
$result = mysqli_query($conn, "SELECT * FROM saham WHERE id = $id");
$data = mysqli_fetch_assoc($result);
if (!$data) {
  echo "<div class='container mt-5'><div class='alert alert-danger'>Data tidak ditemukan.</div></div>";
  exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id   = $_POST['id'];
  $kode = $_POST['kode_saham'];
  $nama = $_POST['nama_perusahaan'];
  $eps  = $_POST['eps'];
  $pbv  = $_POST['pbv'];
  $dpr  = $_POST['dpr'];
  $der  = $_POST['der'];
  $roa  = $_POST['roa'];
  $roe  = $_POST['roe'];

  $stmt = $conn->prepare("UPDATE saham SET kode_saham=?, nama_perusahaan=?, eps=?, pbv=?, dpr=?, der=?, roa=?, roe=? WHERE id=?");
  $stmt->bind_param("ssddddddi", $kode, $nama, $eps, $pbv, $dpr, $der, $roa, $roe, $id);
  $stmt->execute();

  header("Location: saham.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Saham</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h4 class="mb-4">Edit Data Saham</h4>
    <form method="POST">
      <!-- ID tetap disimpan hidden -->
      <input type="hidden" name="id" value="<?= $data['id'] ?>">

      <!-- Kode Saham -->
      <div class="mb-3">
        <label class="form-label">Kode Saham</label>
        <input type="text" name="kode_saham" class="form-control" value="<?= htmlspecialchars($data['kode_saham']) ?>" required>
      </div>

      <!-- Nama Perusahaan -->
      <div class="mb-3">
        <label class="form-label">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" value="<?= htmlspecialchars($data['nama_perusahaan']) ?>" required>
      </div>

      <!-- Rasio Keuangan -->
      <div class="row">
        <?php
        $rasio = ['eps' => 'EPS', 'pbv' => 'PBV', 'dpr' => 'DPR', 'der' => 'DER', 'roa' => 'ROA', 'roe' => 'ROE'];
        foreach ($rasio as $key => $label): ?>
          <div class="col-md-4 mb-3">
            <label class="form-label"><?= $label ?></label>
            <input type="number" step="any" name="<?= $key ?>" class="form-control" value="<?= $data[$key] ?>" required>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="d-flex justify-content-between">
        <a href="saham.php" class="btn btn-secondary">← Batal</a>
        <button type="submit" class="btn btn-warning">💾 Simpan Perubahan</button>
      </div>
    </form>
  </div>
</body>
</html>
