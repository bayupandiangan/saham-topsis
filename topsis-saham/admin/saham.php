<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Data Saham</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Kelola Data Saham</h4>
    <div>
      <a href="dashboard.php" class="btn btn-secondary btn-sm">⬅ Kembali</a>
      <a href="tambah.php" class="btn btn-primary btn-sm">+ Tambah Saham</a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
      <thead class="table-dark">
        <tr>
          <th>id</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>EPS</th>
          <th>PBV</th>
          <th>DPR</th>
          <th>DER</th>
          <th>ROA</th>
          <th>ROE</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM saham ORDER BY id ASC");
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
echo "<tr>
  <td>{$row['id']}</td>
  <td>{$row['kode_saham']}</td>
  <td>{$row['nama_perusahaan']}</td>
  <td>{$row['eps']}</td>
  <td>{$row['pbv']}</td>
  <td>{$row['dpr']}</td>
  <td>{$row['der']}</td>
  <td>{$row['roa']}</td>
  <td>{$row['roe']}</td>
  <td>
    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
    <a href='hapus.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
  </td>
</tr>";

          }
        } else {
          echo "<tr><td colspan='10'>Belum ada data saham.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p class="mb-0">© <?= date('Y'); ?> Aplikasi Rekomendasi Pemilihan Saham</p>
  </footer>
</body>
</html>
