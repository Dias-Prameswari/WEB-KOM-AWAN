<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
  header("Location: login.php");
  exit;
}
?>

<table id="tabelPresensi" class="display">
  <thead>
    <tr>
      <th>No</th>
      <th>NSS</th>
      <th>Nama Pengisi</th>
      <th>Jabatan</th>
      <th>Keterangan</th>
      <th>Waktu Presensi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include '../config.php';
    $result = mysqli_query($conn, "SELECT * FROM presensi_sekolah");
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) :
    ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nss'] ?></td>
      <td><?= htmlspecialchars($row['nama_pengisi']) ?></td>
      <td><?= htmlspecialchars($row['jabatan']) ?></td>
      <td><?= htmlspecialchars($row['keterangan']) ?></td>
      <td><?= $row['waktu_presensi'] ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<a href="dashboard.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;">
  ← Kembali ke Dashboard
</a>

<!-- Tambahkan link CSS dan JS datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#tabelPresensi').DataTable();
  });
</script>
