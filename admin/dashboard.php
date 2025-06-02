<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['username'] != 'admin') {
  header('Location: ../auth/login.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="css/main.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Anda berhasil login ke dashboard.</p>
    <a href="../user/index.php" class="btn btn-primary">Masuk ke Halaman Presensi</a>
    <a href="admin_data_presensi.php" class="btn btn-success">Lihat Data Presensi</a>
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
</body>
</html>
