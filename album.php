<?php 
// session_start();

// if ( !isset($_SESSION["login"])) {
// 	header("Location: login.php");
// 	exit;
// }

require 'functions.php';

$albumku = query("SELECT * FROM album"); 

// //Tombol cari di tekan
//  if (isset($_POST['pencari']) ) {

//  	$albumku = cari($_POST["katakunci"]);
//  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Album Dokumentasi</title>

  <link rel="shortcut icon" href="assets/ns-icon.png" type="image/x-icon">

  <link rel="stylesheet" href="assets/css/maicons.css">

  <link rel="stylesheet" href="assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">

  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <link rel="stylesheet" href="assets/css/nunung.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-floating">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="assets/ns-iconred.png" alt="" width="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-lg-5 mt-3 mt-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Beranda</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item active" href="index.php">Nunung Salon</a>
            <a class="dropdown-item" href="index-2.php">NN</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.php">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="album.php">Album</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak.php">Kontak</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  
<main class="bg-light">

<div class="page-hero-section bg-image hero-mini" style="background-image: url(assets/img/hero_mini2.svg);">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row justify-content-center align-items-center text-center h-100">
        <div class="col-lg-6">
          <h3 class="mb-4 fw-medium">Album Dokumentasi</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">Album</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<main>

<div class="page-section pt-5">
  <div class="container">
    <!-- <div class="row justify-content-center">
        <div class="card-page"> -->
          <h5 class="fg-dark">Foto - foto dokumentasi Nunung Salon Pasurenan</h5>
          <hr>
						<div class="row">
							<?php foreach ( $albumku as $row ) : ?>
								<div class="col-md-5"> 
                  <div class="card-page">
                    <div class="row justify-content-center">
                      <div class="img-fluid" alt="Wild Landscape">
                        <img src="admin/gambar/galeri/<?php echo $row["gambar_album"];?>" style="width: 150px; height: 150px">
                        <div class="caption">
                          <h5><?php echo $row["nama_album"]; ?></h5>
                          <p><?php echo $row["deskripsi_album"]; ?></p>
                        </div>	
                      </div>
                    </div>
                  </div>
                <br>
							  </div>
							<?php endforeach; ?>
			  </div>
    </div>
  </div>
      
</main>

<!-- footer -->
<div class="page-footer-section bg-dark fg-white">
  <div class="container">
    <div class="row mb-5 py-3">
      <div class="col-sm-6 col-lg-2 py-3">
        <h5 class="mb-3">Halaman Lain</h5>
        <ul class="menu-link">
          <li><a href="#" class="">NN</a></li>
          <li><a href="#" class="">Produk</a></li>
          <li><a href="#" class="">Alamat</a></li>
          <li><a href="#" class="">Kontak</a></li>
        </ul>
      </div>
      <div class="col-sm-6 col-lg-2 py-3">
        <h5 class="mb-3">Perusahaan</h5>
        <ul class="menu-link">
          <li><a href="#" class="">Profil</a></li>
          <li><a href="#" class="">Owner</a></li>
          <li><a href="#" class="">Tim Kerja</a></li>
          <li><a href="#" class=""></a></li>
        </ul>
      </div>
      <div class="col-md-6 col-lg-4 py-3">
        <h5 class="mb-3">Kontak</h5>
        <ul class="menu-link">
          <li><a href="#" class="">Alamat</a></li>
          <li><a href="#" class="">Rohmisaja@gmail.com</a></li>
          <li><a href="#" class="">nunungumk@gmail.com</a></li>
          <li><a href="#" class="">+62 8520 1385 401</a></li>
        </ul>
      </div>
      <div class="col-md-6 col-lg-4 py-3">
        <h5 class="mb-3">Langganan</h5>
        <p>Dapatkan keuntungaan dengan ikut berlangganan bersama kami </p>
        <form method="POST">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Masukkan emailmu di sini..">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary"><span class="mai-send"></span></button>
            </div>
          </div>
        </form>

        <!-- Social Media Button -->
        <div class="mt-4">
          <a href="https://www.youtube.com/channel/UC1kJm1NUx0x1E0dDhBtwfJA" class="btn btn-fab btn-primary fg-white"><span class="mai-logo-youtube"></span></a>
          <a href="https://www.whatsapp.com/catalog/6285201385401/" class="btn btn-fab btn-primary fg-white"><span class="mai-logo-whatsapp"></span></a>
          <a href="https://www.instagram.com/nunung_pasurenan/" class="btn btn-fab btn-primary fg-white"><span class="mai-logo-instagram"></span></a>
          <a href="https://g.page/nunung-salon-dan-busana?share" class="btn btn-fab btn-primary fg-white"><span class="mai-logo-google"></span></a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 py-2">
        <img src="assets/ns-icon.png" alt="" width="60">
        <p class="d-inline-block ml-2">Copyright &copy; <a href="https://www.nunungpasurenan.com/" class="fg-white fw-medium">Nunung Pasurenan</a>. All rights reserved</p>
      </div>
      <div class="col-12 col-md-6 py-2">
        <ul class="nav justify-content-end">
          <li class="nav-item"><a href="#" class="nav-link">Terms of Use</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Privacy Policy</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Cookie Policy</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/jquery-3.5.1.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="assets/vendor/wow/wow.min.js"></script>

<script src="assets/js/nunung.js"></script>

</body>
</html>