<?php
// session_start();
// if (!isset($_SESSION['login'])) {
//   header("Location: ../auth/login.php");
//   exit;
// }
?>

<?php
session_start();
if (!isset($_SESSION['user_login'])) {
    header("Location: ../auth/user_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Si Hadir</title>
    <link href="../css/main.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />
  </head>
  <body>
    <!-- header starts -->
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#">
          <span class="text-warning">Si Hadir</span>
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
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#portfolio">Buy</a>
              </li>
              <li class="nav-item">
                <a href="../auth/user_logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
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
            <div class="carousel-caption">
              <h5>SI HADIR</h5>
              <p>
                Selamat Datang Di Website Presensi 
              </p>
              <p><a href="#services" class="btn btn-warning mt-3">Presensi Sekarang</a></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../img/gambar-2.jpg" class="d-block w-100" alt="..." />
            <div class="carousel-caption">
              <h5>Always Dedicated</h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Maxime, nulla, tempore. Deserunt excepturi quas vero.
              </p>
              <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../img/gambar-3.jpg" class="d-block w-100" alt="..." />
            <div class="carousel-caption">
              <h5>True Construction</h5>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Maxime, nulla, tempore. Deserunt excepturi quas vero.
              </p>
              <p><a href="#" class="btn btn-warning mt-3">Learn More</a></p>
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
                <p>
                  Lorem ipsum dolor sit amet, consectetur <br />adipisicing
                  elit. Non, quo.
                </p>
              </div>
            </div>
          </div>
          <div class="row justify-content-center" data-aos="fade-up">
            
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card text-white text-center bg-dark pb-2">
                <div class="card-body">
                  <i class="bi bi-journal"></i>
                  <h3 class="card-title">Mahasiswa</h3>
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
        <p class="text-white">All Right Reserved By @Si Hadir</p>
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

