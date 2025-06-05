<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['username'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

include '../config.php';

// Data sekolah dan tabelnya
$tables = [
    "presensi_sma1" => "SMA Negeri 01",
    "presensi_sma2" => "SMA Negeri 02",
    "presensi_sma3" => "SMA Negeri 03",
    "presensi_sma4" => "SMA Negeri 04",
    "presensi_sma5" => "SMA Negeri 05",
    "presensi_sekolah_lain" => "Sekolah Lain"
];

// 1. Rekap presensi hari ini per sekolah
$rekap = [];
$today = date('Y-m-d');
foreach ($tables as $table => $namaSekolah) {
    // Rekap hadir, izin, sakit
    $hadir = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as jumlah FROM $table WHERE DATE(waktu_presensi)='$today' AND id_keterangan=1"))['jumlah'];
    $izin = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as jumlah FROM $table WHERE DATE(waktu_presensi)='$today' AND id_keterangan=2"))['jumlah'];
    $sakit = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) as jumlah FROM $table WHERE DATE(waktu_presensi)='$today' AND id_keterangan=3"))['jumlah'];

    $total = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COUNT(*) as jumlah FROM $table WHERE DATE(waktu_presensi)='$today'"))['jumlah'];

    $rekap[$namaSekolah] = [
        'total' => $total,
        'hadir' => $hadir,
        'izin' => $izin,
        'sakit' => $sakit
    ];
}

// 2. Info singkat total presensi hari ini
$totalPresensi = 0;
foreach ($rekap as $r) {
    $totalPresensi += $r['total'];
}

// 3. Notifikasi 5 presensi terbaru
$unionQuery = [];
foreach ($tables as $table => $namaSekolah) {
    $unionQuery[] = "(SELECT '$namaSekolah' as sekolah, nama_pengisi, waktu_presensi, id_status FROM $table ORDER BY waktu_presensi DESC LIMIT 2)";
}
$sqlNotif = implode(" UNION ALL ", $unionQuery) . " ORDER BY waktu_presensi DESC LIMIT 5";
$notifikasi = mysqli_query($conn, $sqlNotif);

// Ambil nama status untuk notifikasi
$statusMap = [];
$q = mysqli_query($conn, "SELECT * FROM status");
while($row = mysqli_fetch_assoc($q)) {
    $statusMap[$row['id']] = $row['nama_status'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - SI HADIR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .summary-card { min-height: 120px; }
    .summary-title { font-size: 1.1rem; font-weight: 600;}
    .summary-value { font-size: 2.2rem; font-weight: 700;}
    .notif-list li { margin-bottom: .3em;}
  </style>
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="mb-0">Dashboard Admin SI HADIR</h2>
      <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="mb-3">Selamat datang, <b><?= htmlspecialchars($_SESSION['username']) ?></b>!</div>
    <div class="row mb-4">
      <!-- Rekap per sekolah -->
      <?php foreach ($rekap as $namaSekolah => $r): ?>
        <div class="col-lg-4 col-md-6 mb-3">
          <div class="card summary-card shadow-sm">
            <div class="card-body">
              <div class="summary-title text-primary mb-1"><?= $namaSekolah ?></div>
              <div class="summary-value"><?= $r['total'] ?></div>
              <div class="small">
                Hadir: <b class="text-success"><?= $r['hadir'] ?></b> |
                Izin: <b class="text-warning"><?= $r['izin'] ?></b> |
                Sakit: <b class="text-danger"><?= $r['sakit'] ?></b>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- Info singkat -->
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="card summary-card bg-info bg-gradient text-white shadow-sm">
          <div class="card-body">
            <div class="summary-title mb-1">Total Presensi Hari Ini</div>
            <div class="summary-value"><?= $totalPresensi ?></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Notifikasi terbaru -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-warning fw-bold">Notifikasi: 5 Presensi Terbaru</div>
      <div class="card-body">
        <ul class="notif-list ps-3 mb-0">
          <?php if (mysqli_num_rows($notifikasi) == 0): ?>
            <li>Tidak ada presensi terbaru.</li>
          <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($notifikasi)): ?>
              <li>
                <b><?= htmlspecialchars($row['sekolah']) ?></b> -
                <?= htmlspecialchars($row['nama_pengisi']) ?> -
                <?= isset($statusMap[$row['id_status']]) ? $statusMap[$row['id_status']] : '' ?> -
                <span class="text-secondary"><?= $row['waktu_presensi'] ?></span>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <div class="mb-3">
      <a href="admin_data_presensi.php" class="btn btn-success">Lihat Data Presensi Lengkap</a>
      <a href="../user/index.php" class="btn btn-primary">Masuk ke Halaman Presensi User</a>
    </div>
  </div>
</body>
</html>
