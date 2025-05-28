<?php
// include 'config.php';

// $nss           = $_POST['nss'];
// $nama_pengisi  = $_POST['nama_pengisi'];
// $jabatan       = $_POST['jabatan'];
// $keterangan    = $_POST['keterangan'];

// $query = "INSERT INTO presensi_sekolah (nss, nama_pengisi, jabatan, keterangan)
//           VALUES ('$nss', '$nama_pengisi', '$jabatan', '$keterangan')";

// mysqli_query($conn, $query);
// echo "<script>alert('Presensi berhasil disimpan!'); window.location='karyawan.html';</script>";


include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nss = $_POST['nss'];
    $nama_pengisi = $_POST['nama_pengisi'];
    $jabatan = $_POST['jabatan'];
    $keterangan = $_POST['keterangan'];
    $waktu = date('Y-m-d H:i:s'); // waktu otomatis

    $query = "INSERT INTO presensi_sekolah (nss, nama_pengisi, jabatan, keterangan, waktu_presensi)
              VALUES ('$nss', '$nama_pengisi', '$jabatan', '$keterangan', '$waktu')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Presensi berhasil!'); window.location.href='../user/presensi_sekolah.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>
