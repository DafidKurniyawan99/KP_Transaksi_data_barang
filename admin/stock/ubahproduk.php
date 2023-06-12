<?php
    require 'functions.php';
    $produku = query("SELECT * FROM produk");

   //Pengambilan data
    $id =$_GET["id"];

    // tombol sudah dipencet atau belum
	if ( isset($_POST['editproduk']) ){ 


		// Konfirmasi Keberhasilan
		if (editproduk($_POST) > 0) {
				echo "<script>
						alert('Data Berhasil Diedit');
						document.location.href = 'produk.php';
					  </script>";

		}	
		else {
				echo "<script>
						alert('Data Gagal Diedit');
						document.location.href = 'ubahproduk.php';
					</script>";
				
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Galeri-nn umk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--  Bagian Navbar !-->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">NN umk</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                <ul class="navbar-nav ml-auto ml-md-0 " >
                    <li class="nav-item dropdown">
                       
                    </li>
                </ul>
        </nav>
        <!--  Bagian Navbar !-->

        <!--  Bagian sidebar !-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="../index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Profile Umk</div>
                            <a class="nav-link" href="galeri.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-camera-retro"></i></div>
                                Galeri
                            </a>
                            <a class="nav-link" href="produk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Produk
                            </a>
                            <div class="sb-sidenav-menu-heading">Transaksi Data Barang</div>
                            <a class="nav-link" href="pesanan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Pesanan
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="stok.php">Stok</a>
                                    <a class="nav-link" href="barangmasuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="barangkeluar.php">Barang Keluar</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="staf.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                Kelola Staff
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        ADMIN 
                    </div>
                </nav>
            </div>
            <!--  Bagian sidebar !-->

            <!--  Bagian conten !-->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4">Menu Edit Data Produk</h2>
                        <div class="card mb-4">
                            <div class="card-header">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php  $prdk = query("SELECT * FROM produk WHERE id_produk = $id")[0];?>
                                
                                    <input type="hidden" name="id" value="<?= $prdk['id_produk'] ?>">
                                    <input type="hidden" name="gambaroldproduk" value="<?= $prdk['gambar_produk'] ?>">

                                    <label for="usr">Nama:</label>
                                    <input type="text" name="nama_produk" class="form-control" required value="<?= $prdk["nama_produk"]?>">
                                        
                                    <label for="usr">Gambar:</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="../gambar/produk/<?= $prdk['gambar_produk'] ?>" class="rounded"  width="100">
                                        </div>
                                    </div>
                                    <input type="file" name="gambar_produk" class="form-control"  >
                                        
                                    <label for="usr">Harga:</label>
                                    <input type="text" name="harga_produk"  class="form-control" required value="<?= $prdk['harga_produk'] ?>">
                                        
                                    <label for="usr">Deskripsi:</label>
                                    <input type="text" name="deskripsi_produk"  class="form-control" required value="<?= $prdk['deskripsi_produk'] ?>">
                                        <br>
                                            <button type="submit" name="editproduk" class="btn btn-primary">Ubah!</button>
                                            <a href="produk.php" class="btn btn-success">< Kembali</a>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!--  Bagian conten !-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
