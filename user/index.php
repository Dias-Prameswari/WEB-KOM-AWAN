<?php
session_start();

if (
    !isset($_SESSION['login']) ||
    !isset($_SESSION['role']) ||
    ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'admin')
) {
    header('Location: ../auth/user_login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SI-PRESMA</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="../css/main.css" rel="stylesheet" />
  </head>
  <body>
    <!-- header starts -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">
            <span class="gradient-brand">SI-PRESMA</span>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a href="../auth/user_logout.php" class="btn btn-danger btn-sm ms-3 rounded-pill px-3">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- header ends -->

    <!-- main starts -->
    <main>
      <!-- slider starts -->
      <div
        id="carouselExampleIndicators"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            class="active"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            class="active"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../img/gambar-1.jpg" class="d-block w-100" alt="..." />
            <!-- ...existing code... -->

        <!-- ...existing code... -->
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="bottom: 20%; max-width: 700px; margin: 0 auto;"">
              <h5 style="font-size: 2rem;">SI-PRESMA (Sistem Presensi SMA)</h5>
              <p style="font-size: 1rem; line-height: 1.5; text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
                SI-PRESMA (Sistem Presensi SMA) merupakan aplikasi absensi online berbasis web 
                yang mendukung pencatatan kehadiran seluruh civitas SMA—baik siswa, guru, maupun staf. 
                Dengan antarmuka yang sederhana dan terintegrasi dengan database MySQL, 
                pencatatan presensi menjadi lebih mudah, cepat, dan akurat.
              </p>
              <p><a href="#services" class="btn btn-warning mt-3">Presensi Sekarang</a></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../img/gambar-2.jpg" class="d-block w-100" alt="..." />
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="bottom: 20%; max-width: 700px; margin: 0 auto;">
              <h5 style="font-size: 2rem;">Akses Mudah, Di Mana Saja</h5>
              <p style="font-size: 1rem; line-height: 1.5; text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
                Sistem dapat dijalankan secara lokal di komputer/laptop dan diakses secara publik 
                melalui layanan tunneling (Ngrok), sehingga bisa digunakan untuk demo atau kebutuhan 
                sekolah yang belum memiliki server online. Data presensi tersimpan aman di database, 
                dan dapat diekspor dalam format Excel/PDF untuk keperluan laporan.
              </p>
              <!-- <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p> -->
            </div>
          </div>
          <div class="carousel-item ">
            <img src="../img/gambar-3.jpg" class="d-block w-100" alt="..." />
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="bottom: 20%; max-width: 700px; margin: 0 auto;"">
              <h5 style="font-size: 2rem;">Terintegrasi Database</h5>
              <p style="font-size: 1rem; line-height: 1.5; text-shadow: 1px 1px 4px rgba(0,0,0,0.7);">
                Data kehadiran dicatat dan dikelola secara otomatis menggunakan database MySQL, 
                sehingga mudah dalam proses pelaporan, pencarian, maupun backup data presensi.
              </p>
              <!-- <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p> -->
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- slider ends -->


      <!-- services section Starts -->
      <section class="services section-padding" id="services">
        <div class="container">
          <div class="row justify-content-center" data-aos="fade-up">
            <div class="">
              <div class="section-header text-center pb-5">
                <h2>Our Services</h2>
                <p class="mx-auto" style="max-width: 600px;">
                Layanan ini memudahkan siswa SMA/SMK untuk 
                melakukan presensi secara daring dengan cepat, 
                aman, dan akurat.
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center" data-aos="fade-up">
            
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card text-white text-center bg-dark pb-2">
                <div class="card-body">
                  <i class="bi bi-journal"></i>
                  <h3 class="card-title">Presensi Siswa</h3>
                  <p class="lead">
                    Silahkan Klik Presensi Sekarang
                  </p>
                  <a href="../user/presensi_sekolah.php" class="btn btn-warning text-dark">Presensi Sekarang</a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- services section Ends -->

    </main>
    <!-- main ends -->
    <!-- footer starts -->
    <footer class="bg-dark p-2 text-center">
      <div class="container">
        <p class="text-white">All Right Reserved By @SI-PRESMA</p>
      </div>
    </footer>
    <!-- footer ends -->

    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
  <!-- Bootstrap JS (wajib untuk carousel) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

</html>

