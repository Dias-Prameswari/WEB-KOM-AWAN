<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login User SI-PRESMA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh">
  <div class="card p-4 shadow" style="width: 22rem;">
    <h4 class="mb-3 text-center">Login User SI-PRESMA</h4>
    <form action="../auth/proses_user_login.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <!-- <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="nama_lengkap" class="form-control" name="nama_lengkap" required>
      </div> -->
      <button type="submit" class="btn btn-warning w-100">Login</button>
    </form>
  </div>
</body>
</html>