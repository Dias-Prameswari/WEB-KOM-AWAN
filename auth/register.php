<?php
session_start();
include "../config.php";

// Tambahkan autoload PHPMailer di sini
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.10.0/src/Exception.php';
require 'PHPMailer-6.10.0/src/PHPMailer.php';
require 'PHPMailer-6.10.0/src/SMTP.php';

$errors = [];

// ...[kode sebelumnya]...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validasi server-side
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        $errors[] = "Password minimal 8 karakter, ada huruf besar dan angka.";
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Cek duplikat username/email
        $check = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' OR username='$username'");
        if(mysqli_num_rows($check) > 0){
            $errors[] = "Email atau username sudah terdaftar!";
        } else {
            $otp = rand(100000, 999999);
            $otp_expiry = date('Y-m-d H:i:s', strtotime('+5 minutes')); // Expired 5 menit

            $query = "INSERT INTO user (nama_lengkap, username, password, email, otp_code, otp_expiry, is_verified)
                      VALUES ('$nama', '$username', '$password_hash', '$email', '$otp', '$otp_expiry', 0)";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Kirim email OTP di sini!
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = ''; // email kamu
                    $mail->Password   = '';   // app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    $mail->setFrom('', 'SI-PRESMA');
                    $mail->addAddress($email, $nama);

                    $mail->isHTML(true);
                    $mail->Subject = 'Kode OTP SI-PRESMA';
                    $mail->Body    = "Kode OTP kamu adalah: <b>$otp</b><br> Berlaku sampai: $otp_expiry WIB.";

                    $mail->send();

                    $_SESSION['reg_email'] = $email;
                    header("Location: verify.php");
                    exit;
                } catch (Exception $e) {
                    // Hapus user kalau OTP gagal dikirim
                    mysqli_query($conn, "DELETE FROM user WHERE email='$email'");
                    $errors[] = "Gagal mengirim email OTP. Error: {$mail->ErrorInfo}";
                }
            } else {
                $errors[] = "Registrasi gagal!";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register SI-PRESMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card p-4 shadow" style="width: 24rem;">
        <h4 class="mb-3 text-center">Daftar Akun SI-PRESMA</h4>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach($errors as $e): ?>
                        <li><?= $e ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" id="formReg">
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email Aktif</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <input type="password" class="form-control" name="password" id="pw" required minlength="8" pattern="(?=.*[A-Z])(?=.*[0-9]).{8,}">
            <button type="button" class="btn btn-outline-secondary" id="togglePW">👁️</button>
        </div>
        <div id="pwStrength" class="form-text"></div>
    </div>
    <button type="submit" class="btn btn-warning w-100">Daftar</button>
</form>
<script>
// Show/Hide password
document.getElementById('togglePW').onclick = function() {
    var pw = document.getElementById('pw');
    pw.type = (pw.type === "password") ? "text" : "password";
};
// Password strength
document.getElementById('pw').oninput = function() {
    var pw = this.value;
    var msg = "";
    if (pw.length < 8) msg += "Min 8 karakter. ";
    if (!/[A-Z]/.test(pw)) msg += "Ada huruf besar. ";
    if (!/[0-9]/.test(pw)) msg += "Ada angka. ";
    document.getElementById('pwStrength').innerText = msg || "Kuat!";
};
</script>

        <div class="mt-3 text-center">
            <a href="user_login.php" class="text-decoration-none">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>
