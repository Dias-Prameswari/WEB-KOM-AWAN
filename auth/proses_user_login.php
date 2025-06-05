<?php
session_start();
include '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil user berdasarkan username
$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Cek verifikasi
    if ($row['is_verified'] == 0) {
        echo "<script>alert('Akun belum diverifikasi!'); window.location='../user_login.php';</script>";
        exit;
    }

    // Cek password
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'user';
        header("Location: ../user/index.php");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location='../user_login.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='../user_login.php';</script>";
    exit;
}
?>
