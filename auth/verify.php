<?php
session_start();
include '../config.php';

// Tambahkan autoload PHPMailer di sini
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.10.0/src/Exception.php';
require 'PHPMailer-6.10.0/src/PHPMailer.php';
require 'PHPMailer-6.10.0/src/SMTP.php';

$success = "";
$error = "";

// Pastikan user dari register
if (!isset($_SESSION['reg_email'])) {
    header("Location: register.php");
    exit;
}
$email = $_SESSION['reg_email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $otp = $_POST['otp'];
    $now = date('Y-m-d H:i:s');
    $q = "SELECT * FROM user WHERE email='$email' AND otp_code='$otp' AND is_verified=0 AND otp_expiry > '$now'";
    $cek = mysqli_query($conn, $q);
    if (mysqli_num_rows($cek) == 1) {
        $up = "UPDATE user SET is_verified=1, otp_code='', otp_expiry=NULL WHERE email='$email'";
        mysqli_query($conn, $up);
        $success = "Verifikasi berhasil! Silakan login.";
        unset($_SESSION['reg_email']);
    } else {
        $cek_expired = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND otp_code='$otp' AND is_verified=0");
        if (mysqli_num_rows($cek_expired) == 1) {
            $error = "Kode OTP sudah kadaluarsa. Silakan klik 'Kirim Ulang OTP'.";
        } else {
            $error = "Kode OTP salah atau sudah diverifikasi.";
        }
    }
}

// Resend OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend'])) {
    $otp = rand(100000, 999999);
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    $update = mysqli_query($conn, "UPDATE user SET otp_code='$otp', otp_expiry='$otp_expiry' WHERE email='$email'");
    if ($update) {
        // Kirim ulang via email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('', 'SI-PRESMA');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Baru SI-PRESMA';
            $mail->Body    = "Kode OTP baru kamu adalah: <b>$otp</b><br> Berlaku sampai: $otp_expiry WIB.";
            $mail->send();
            $error = "Kode OTP baru sudah dikirim ke email!";
        } catch (Exception $e) {
            $error = "Gagal mengirim ulang OTP. Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Gagal mengirim ulang OTP. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verifikasi Akun - SI-PRESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card p-4 shadow" style="width: 24rem;">
        <h4 class="mb-3 text-center">Verifikasi OTP</h4>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <div class="text-center">
                <a href="user_login.php" class="btn btn-success w-100">Ke Login</a>
            </div>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Kode OTP</label>
                    <input type="text" class="form-control" name="otp" placeholder="Masukkan Kode OTP" required>
                </div>
                <button type="submit" name="verify" class="btn btn-primary w-100">Verifikasi</button>
            </form>
            <form method="post" style="margin-top:10px;">
                <button type="submit" name="resend" class="btn btn-link w-100">Kirim Ulang OTP</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
