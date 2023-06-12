<?php 
    session_start();
	
    if ( !isset($_SESSION["signin"])) {
        header("Location: login.php");
        exit;
    }
    require 'db.php';
    
    date_default_timezone_set("Asia/Bangkok");

    $itungcust = mysqli_query($conn,"select count(id_admin) as jumlahcust from staf");
	$itungcust2 = mysqli_fetch_assoc($itungcust);
	$itungcust3 = $itungcust2['jumlahcust'];
	
	$itungorder = mysqli_query($conn,"select count(orderid) as jumlahorder from pesanan where status not 
                                like 'Completed' and status not like 'Canceled'");
	$itungorder2 = mysqli_fetch_assoc($itungorder);
	$itungorder3 = $itungorder2['jumlahorder'];
	
	$itungtrans = mysqli_query($conn,"select count(orderid) as jumlahtrans from pesanan where status='Completed'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Nunung Pasurenan</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Dashboard</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
            </ul>
        </nav>

        <!-- Bagian Awal sidebar -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Profile Umk</div>
                            <a class="nav-link" href="stock/galeri.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-camera-retro"></i></div>
                                Galeri
                            </a>
                            <a class="nav-link" href="stock/produk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Produk
                            </a>
                            <div class="sb-sidenav-menu-heading">Transaksi Data Barang</div>
                            <a class="nav-link" href="stock/pesanan.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-book"></i></div>
                                Pesanan
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="stock/stok.php">Stok</a>
                                    <a class="nav-link" href="stock/barangmasuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="stock/barangkeluar.php">Barang Keluar</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="stock/staf.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                                Kelola Staff
                            </a>
                            <a class="nav-link" href="stock/logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        NN UMK 
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
                        <!-- page title area end -->
            <div class="main-content-inner">
                <div class="container">
                
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-secondary text-white">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Staff</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungcust3 ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="s-report-inner pr--10 pt--20 mb-3">
                                    <div class="icon"><i class="fa fa-book"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pesanan</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungorder3 ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-link"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h5 class="header-title mb-0" >Transaksi Selesai</h5>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungtrans3 ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                
                </div>
                <!-- overview area end -->
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Selamat Datang</h2>
                                </div>
                                <div class="market-status-table mt-4">
                                    Anda masuk sebagai <strong><?php echo $_SESSION['nama']   ?></strong>
									<p>Anda login pada <?php echo $_SESSION['time'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
		
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
