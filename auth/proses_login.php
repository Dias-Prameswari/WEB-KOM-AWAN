<?php
// session_start();
// include 'config.php';

// $username = $_POST['username'];
// $password = $_POST['password'];

// $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

// if (mysqli_num_rows($result) === 1) {
//     $_SESSION['login'] = true;
//     header("Location: dashboard.php");
// } else {
//     echo "<script>alert('Login gagal!'); window.location='login.php';</script>";
// }

    session_start();

    $configPath = '../config.php';
    if (!file_exists($configPath)) {
        die("File config.php tidak ditemukan!");
    }

    require_once $configPath;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location='../auth/login.php';</script>";
    }


?>
