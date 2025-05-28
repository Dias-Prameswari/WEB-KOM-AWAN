<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Presensi Sekolah</title>
  <link rel="stylesheet" href="../css/presensi.css" />
</head>
<body>
  <div class="container" role="main">
    <h1>Presensi Sekolah</h1>
    <?php
    include '../config.php';
    $result = mysqli_query($conn, "SELECT * FROM sekolah_semarang_fix_2");
    ?>
    <form action="simpan_presensi_sekolah.php" method="POST">
    <label for="nama_sekolah">Nama Sekolah</label>
    <select id="nama_sekolah" name="nss" onchange="isiOtomatis()" required>
      <option value="">-- Pilih Sekolah --</option>
      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <option value="<?= $row['nss'] ?>"
          data-alamat="<?= $row['alamat_sekolah'] ?>" 
          data-kelurahan="<?= $row['kelurahan'] ?>"
          data-kecamatan="<?= $row['kecamatan'] ?>"
          data-telepon="<?= $row['nomor_telepon'] ?>"
        >
          <?= $row['nama_sekolah'] ?>
        </option>
      <?php endwhile; ?>
    </select>

    <label>Alamat Sekolah</label>
    <input type="text" id="alamat" name="alamat" readonly>

    <label>Kelurahan</label>
    <input type="text" id="kelurahan" name="kelurahan" readonly>

    <label>Kecamatan</label>
    <input type="text" id="kecamatan" name="kecamatan" readonly>

    <label>Nomor Telepon</label>
    <input type="text" id="telepon" name="telepon" readonly>

    <label>Nama Pengisi</label>
    <input type="text" name="nama_pengisi" required>

    <label>Jabatan</label>
    <input type="text" name="jabatan" required>

    <label>Keterangan</label>
    <input type="text" name="keterangan" required>

    <button type="submit">Presensi</button>
    <button type="button" onclick="window.location.href='index.php'">Kembali</button>

  </form>

  </div>

  <script>
  function isiOtomatis() {
    const select = document.getElementById('nama_sekolah');
    const selected = select.options[select.selectedIndex];

    document.getElementById('alamat').value = selected.getAttribute('data-alamat');
    document.getElementById('kelurahan').value = selected.getAttribute('data-kelurahan');
    document.getElementById('kecamatan').value = selected.getAttribute('data-kecamatan');
    document.getElementById('telepon').value = selected.getAttribute('data-telepon');
  }
  </script>

</body>
</html>