<?php
session_start();
include '../config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $_SESSION['user_login'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['login'] = true;
    $_SESSION['role'] = 'user';
    header("Location: ../user/index.php");
    exit;
} else {
    echo "<script>alert('Login gagal!'); window.location='user_login.php';</script>";
}
?>
