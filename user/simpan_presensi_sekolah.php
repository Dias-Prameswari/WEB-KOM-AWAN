<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nss = $_POST['nss'];
    $nama_sekolah  = $_POST['nama_sekolah'];
    $alamat        = $_POST['alamat'];
    $kelurahan     = $_POST['kelurahan'];
    $kecamatan     = $_POST['kecamatan'];
    $telepon       = $_POST['telepon'];
    $nama_pengisi  = $_POST['nama_pengisi'];
    $id_status     = $_POST['id_status'];
    $id_keterangan = $_POST['id_keterangan'];
    $waktu         = date('Y-m-d H:i:s');

    // **Pilih target table berdasarkan nama_sekolah** (ambil SMA 1-5 saja!)
    // Nama tabel harus sudah kamu buat, misal presensi_sma1, presensi_sma2, dst
    $mapTable = [
        'SMA Negeri 01' => 'presensi_sma1',
        'SMA Negeri 02' => 'presensi_sma2',
        'SMA Negeri 03' => 'presensi_sma3',
        'SMA Negeri 04' => 'presensi_sma4',
        'SMA Negeri 05' => 'presensi_sma5'
    ];

    if (isset($mapTable[$nama_sekolah])) {
        $table = $mapTable[$nama_sekolah];
    } else {
        $table = 'presensi_sekolah_lain';
    }


    // Insert ke table presensi_sma1/dst
    $sql = "INSERT INTO $table (nss, nama_pengisi, id_status, id_keterangan, waktu_presensi) 
            VALUES ('$nss', '$nama_pengisi', '$id_status', '$id_keterangan', '$waktu')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Presensi berhasil!'); window.location.href='presensi_sekolah.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
