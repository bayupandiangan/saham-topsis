<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h3>Selamat Datang, <?= $_SESSION['admin'] ?></h3>
    <a href="saham.php" class="btn btn-primary mt-3">Kelola Data Saham</a>
    <a href="logout.php" class="btn btn-outline-danger mt-3">Logout</a>
  </div>
</body>
</html>
