<?php 
require 'functions.php';

$produk = query("SELECT * FROM produk"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>NN Produk</title>

  <link rel="shortcut icon" href="assets/nn_umk.png" type="image/x-icon">

  <link rel="stylesheet" href="assets/css/maicons.css">

  <link rel="stylesheet" href="assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">

  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <link rel="stylesheet" href="assets/css/nunung.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-floating">
  <div class="container">
    <a class="navbar-brand" href="index-2.php">
      <img src="assets/nn_umk.png" alt="" width="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-lg-5 mt-3 mt-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Beranda</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php">Nunung Salon</a>
            <a class="dropdown-item active" href="index-2.php">NN</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil-2.php">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak-2.php">Kontak</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="page-hero-section bg-image hero-mini" style="background-image: url(assets/img/bg_nn.svg);">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row justify-content-center align-items-center text-center h-100">
        <div class="col-lg-6">
          <h3 class="mb-4 fw-medium">Produk - produk NN Company</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="index-2.php">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<main class="mt-3">
<div class="page-section pt-5">
  <div class="container">
    <!-- <div class="row justify-content-center"> -->
        <!-- <div class="card-page"> -->
          <h5 class="fg-dark">Foto - foto produk NN Pasurenan</h5>
          <hr>
						<div class="row">
							<?php foreach ( $produk as $row ) : ?>
								<div class="col-md-3"> 
                  <div class="card-page">
                    <div class="row justify-content-center">
                      <div class="img-fluid" alt="Wild Landscape">
                        <img src="admin/gambar/produk/<?php echo $row["gambar_produk"];?>" style="width: 150px; height: 150px">
                        <div class="caption">
                          <h5><?php echo $row["nama_produk"]; ?></h5>
                          <p><?php echo $row["deskripsi_produk"]; ?></p>
                          <p>Rp.<?php echo number_format($row["harga_produk"]) ?></p>
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
  <div class="container mb-5">
    <div class="row justify-content-center text-center wow fadeInUp">
      <div class="col-lg-8">
        <div class="text-center mb-3">
          <img src="assets/nn_umk.png" alt="" height="120">
        </div>
        <h3 class="mb-3"><span class="fg-success">NN</span>UMK</h3>
        <p class="caption">Tempatnya beli oleh-oleh Khas Dataran Tinggi Dieng</p>

        <ul class="nav justify-content-center py-3">
          <li class="nav-item"><a href="index-2.php" class="nav-link fg-white px-4">Beranda</a></li>
          <li class="nav-item"><a href="profil.php" class="nav-link fg-white px-4">Profil</a></li>
          <li class="nav-item"><a href="produk.php" class="nav-link fg-white px-4">Produk</a></li>
          <li class="nav-item"><a href="kontak.php" class="nav-link fg-white px-4">Kontak</a></li>
        </ul>
      </div>
    </div>
  </div>
  
  <hr>

  <p class="text-center mt-4 wow fadeIn">Copyright &copy; 2020 <a href="https://www.nunungpasurenan.com/" class="fg-white fw-medium">Nunung Pasurenan</a>. All right reserved</p>
</div>

<script src="assets/js/jquery-3.5.1.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="assets/vendor/wow/wow.min.js"></script>

<script src="assets/js/nunung.js"></script>

</body>
</html>