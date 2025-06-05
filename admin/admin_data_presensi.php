<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  header("Location: login.php");
  exit;
}

include '../config.php';

// Array nama tabel & label sekolah
$tables = [
  "presensi_sma1" => "SMA Negeri 01",
  "presensi_sma2" => "SMA Negeri 02",
  "presensi_sma3" => "SMA Negeri 03",
  "presensi_sma4" => "SMA Negeri 04",
  "presensi_sma5" => "SMA Negeri 05",
  "presensi_sekolah_lain" => "Sekolah Lain"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Presensi Semua Sekolah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
</head>
<body class="bg-light">
<div class="container my-5">
  <h2>Data Presensi Sekolah (Admin)</h2>
  <a href="dashboard.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
  <?php foreach ($tables as $table => $namaSekolah): ?>
    <div class="card my-4">
      <div class="card-header bg-primary text-white"><?= $namaSekolah ?></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped presensi-table" id="table-<?= $table ?>">
            <thead>
              <tr>
                <th>No</th>
                <th>NSS</th>
                <th>Nama Pengisi</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Waktu Presensi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT 
                              p.*, 
                              s.nama_status, 
                              k.nama_keterangan
                          FROM $table p
                          LEFT JOIN status s ON p.id_status = s.id
                          LEFT JOIN keterangan_presensi k ON p.id_keterangan = k.id
                          ORDER BY waktu_presensi DESC
                          ";
              $result = mysqli_query($conn, $sql);
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['nss']) ?></td>
                  <td><?= htmlspecialchars($row['nama_pengisi']) ?></td>
                  <td><?= htmlspecialchars($row['nama_status']) ?></td>
                  <td><?= htmlspecialchars($row['nama_keterangan']) ?></td>
                  <td><?= htmlspecialchars($row['waktu_presensi']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<!-- DataTables & Buttons CDN JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {
  $('.presensi-table').each(function(){
    let tableName = $(this).closest('.card').find('.card-header').text().trim();
    $(this).DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'excelHtml5',
          title: tableName + ' - Data Presensi',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'pdfHtml5',
          title: tableName + ' - Data Presensi',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'print',
          title: tableName + ' - Data Presensi',
          exportOptions: {
            columns: ':visible'
          }
        }
      ]
    });
  });
});
</script>
</body>
</html>
