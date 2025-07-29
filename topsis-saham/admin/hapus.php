<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Aktifkan error detail (saat debug)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: saham.php");
  exit;
}

$id = intval($_GET['id']);

// Hapus data
$stmt = $conn->prepare("DELETE FROM saham WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirect
header("Location: saham.php");
exit;
