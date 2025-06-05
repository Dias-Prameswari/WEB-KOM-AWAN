<?php
include '../config.php';

// Ambil data sekolah
$q_sekolah = mysqli_query($conn, "SELECT * FROM sekolah_semarang_fix_2");

// Ambil data status
$q_status = mysqli_query($conn, "SELECT * FROM status");

// Ambil data keterangan
$q_keterangan = mysqli_query($conn, "SELECT * FROM keterangan_presensi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Presensi Sekolah</title>
    <link rel="stylesheet" href="../css/presensi.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 mb-5" style="max-width:600px">
    <h2 class="gradient-brand mb-4">Presensi Sekolah</h2>
    <form action="simpan_presensi_sekolah.php" method="POST">
        <!-- Nama Sekolah -->
        <div class="mb-3">
            <label class="form-label">Nama Sekolah</label>
            <select class="form-select" id="nama_sekolah" name="nama_sekolah" onchange="isiOtomatis()" required>
                <option value="">-- Pilih Sekolah --</option>
                <?php while($sk = mysqli_fetch_assoc($q_sekolah)): ?>
                <option 
                    value="<?= htmlspecialchars($sk['nama_sekolah']) ?>"
                    data-nss="<?= htmlspecialchars($sk['nss']) ?>"
                    data-alamat="<?= htmlspecialchars($sk['alamat_sekolah']) ?>"
                    data-kelurahan="<?= htmlspecialchars($sk['kelurahan']) ?>"
                    data-kecamatan="<?= htmlspecialchars($sk['kecamatan']) ?>"
                    data-telepon="<?= htmlspecialchars($sk['nomor_telepon']) ?>"
                ><?= htmlspecialchars($sk['nama_sekolah']) ?></option>
                <?php endwhile; ?>
            </select>
            <input type="hidden" id="nss" name="nss">
        </div>
        <!-- Alamat Sekolah -->
        <div class="mb-3">
            <label class="form-label">Alamat Sekolah</label>
            <input type="text" class="form-control" id="alamat" name="alamat" readonly>
        </div>
        <!-- Kelurahan -->
        <div class="mb-3">
            <label class="form-label">Kelurahan</label>
            <input type="text" class="form-control" id="kelurahan" name="kelurahan" readonly>
        </div>
        <!-- Kecamatan -->
        <div class="mb-3">
            <label class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" readonly>
        </div>
        <!-- Nomor Telepon -->
        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" readonly>
        </div>
        <!-- Nama Pengisi -->
        <div class="mb-3">
            <label class="form-label">Nama Pengisi</label>
            <input type="text" class="form-control" name="nama_pengisi" required>
        </div>
        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="id_status" required>
                <option value="">-- Pilih Status --</option>
                <?php 
                mysqli_data_seek($q_status, 0); // Reset pointer jika sudah pernah di-fetch
                while($st = mysqli_fetch_assoc($q_status)): ?>
                    <option value="<?= $st['id'] ?>"><?= htmlspecialchars($st['nama_status']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <!-- Keterangan -->
        <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <select class="form-select" name="id_keterangan" required>
            <option value="">-- Pilih Keterangan --</option>
            <?php while($kt = mysqli_fetch_assoc($q_keterangan)): ?>
                <option value="<?= $kt['id'] ?>"><?= htmlspecialchars($kt['nama_keterangan']) ?></option>
            <?php endwhile; ?>
        </select>
        </div>
       <button type="submit" class="btn-presensi full-width">Presensi</button>
  <a href="index.php" class="btn-kembali full-width">Kembali</a>
    </form>
</div>
<script>
function isiOtomatis() {
    const select = document.getElementById('nama_sekolah');
    const option = select.options[select.selectedIndex];
    document.getElementById('alamat').value = option.getAttribute('data-alamat') || '';
    document.getElementById('kelurahan').value = option.getAttribute('data-kelurahan') || '';
    document.getElementById('kecamatan').value = option.getAttribute('data-kecamatan') || '';
    document.getElementById('telepon').value = option.getAttribute('data-telepon') || '';
    document.getElementById('nss').value       = option.getAttribute('data-nss') || '';
}
</script>
</body>
</html>
