<?php 
    session_start();
    
    if ( !isset($_SESSION["signin"])) {
        header("Location: ../login.php");
        exit;
    }

    require 'functions.php';

    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pesanan - Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Pesanan</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                  
                </li>
            </ul>
        </nav>

        <!-- Bagian Awal sidebar -->
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
            <!-- bagian akhir sidebar -->

            <!-- bagian AWal konten -->
            <div id="layoutSidenav_content">
                <main>
                   <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-7 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix mt-3">
                        <ul class="notification-area pull-right">
                            <h3><div class="date">
								<script type='text/javascript'>
						//<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <div class="container">
            
                        <div class="card mb-4">
                            <div class="card-header">
                                <button data-toggle="modal" data-target="#pesanan" type="button" class="btn btn-info col-md-3 ml-3">Tambah Pesanan Baru</button>
                                <a href="exportpesanan.php" class="btn btn-success">Export</a> 
                            </div>       
                                <!-- modall tambah pesanan -->
                                <div id="pesanan" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Pesanan Baru</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="form-group">
                                                        <label>Nama Staff</label>
                                                        <select name="kastemer" class="custom-select form-control">
                                                        <option selected>Pilih Staff</option>
                                                        <?php
                                                        $det=mysqli_query($conn,"SELECT*FROM staf");
                                                        while($d=mysqli_fetch_array($det)){
                                                        ?>
                                                            <option value="<?php echo $d['id_admin'] ?>"><?php echo $d['nama_admin'] ?></option>
                                                            <?php
                                                        }
                                                        ?>		
                                                        </select>
                                                    </div>
                                                        <div>
                                                        <label>Keperluan</label>
                                                        <input name="untuk" type="text"  class="form-control" placeholder="Keterangan Keperluan" required>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <input name ="addorder" type="submit" class="btn btn-primary" value="Simpan">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal akhir -->
                            <div class="card-body">
                            <?php 
                        $periksa_bahan=mysqli_query($conn,"select * from barang where stok <10");
                        while($p=mysqli_fetch_array($periksa_bahan)){	
                            if($p['stok']>=1){	
                                ?>	
                                <script>
                                    $(document).ready(function(){
                                        $('#pesan_sedia').css("color","white");
                                        $('#pesan_sedia').append("<i class='ti-flag'></i>");
                                    });
                                </script>
                                <?php
                                echo "<div class='alert alert-danger alert-dismissible fade show mb-2'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>".$p['namabarang']. "</u></strong> yang tersisa kurang dari 10</div>";		
                            }
                        }
                    ?>
                           
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Staff</th>
                                                <th>Keperluan</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $pesan = mysqli_query($conn ,"SELECT * FROM pesanan p, staf s WHERE p.id_admin = s.id_admin");
                                            $no=1;
                                            while($data=mysqli_fetch_array($pesan)) {
                                                $orderid = $data['orderid'];
                                                $tanggal = $data['tanggal'];
                                                $nama_admin = $data['nama_admin'];
                                                $kep = $data['keperluan'];
                                                $status = $data['status'];

                                            //Menghitung Barang yang di pesan 
                                            $hitungjumlah = mysqli_query($conn, "SELECT * FROM detpesanan WHERE orderid='$orderid'");
                                            $jumlah = mysqli_num_rows($hitungjumlah);
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><strong><a href="viewpesanan.php?orderid=<?php echo $data['orderid'] ?>">#<?php echo $data['orderid'] ?></a></strong></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $nama_admin; ?></td>
                                                <td><?= $kep; ?></td>
                                                <td><?= $jumlah; ?> Produk Pesanan</td>
                                                <td><?= $status; ?></td>
                                                <td><a href="viewpesanan.php?orderid=<?php echo $data['orderid'] ?>" class="btn btn-info">Tampilkan</a></td>
                                                
                                            </tr>
                                      
                                        <?php
                                            }
                                        ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
