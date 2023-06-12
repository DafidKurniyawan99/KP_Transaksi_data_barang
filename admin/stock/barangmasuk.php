<?php
    session_start();
    
    if ( !isset($_SESSION["signin"])) {
        header("Location: ../login.php");
        exit;
    }
    include '../db.php';
    require 'functions.php';

    if(isset($_POST['hapus']))
	{
		$idbarangdel = $_POST['idbarangdel'];
		$idorderdel = $_POST['idmasukdel'];
		$lihatqtydetpo1  = mysqli_query($conn,"select * from masuk where idbarang='$idbarangdel' and id_masuk='$idorderdel'");
		$fstock1 = mysqli_fetch_array($lihatqtydetpo1);
		$lihatstockbrg  = mysqli_query($conn,"select * from barang where idbarang='$idbarangdel'");
		$dstock1 = mysqli_fetch_array($lihatstockbrg);
		
		$balikin = $dstock1['stok'] - $fstock1['qty_masuk'];
			  
		$updatestockbaru = mysqli_query($conn,"update barang set stok='$balikin' where idbarang='$idbarangdel'");
		$hapusmasuk = mysqli_query($conn,"delete from masuk where id_masuk='$idorderdel' and idbarang='$idbarangdel'");
		if($updatestockbaru&&$hapusmasuk){
		echo " <script>
                    alert('Berhasil di hapus');
                    document.location.href = 'barangmasuk.php';
                </script>";
		} else { echo "
			<script>
                    alert('Gagal di hapus');
                    document.location.href = 'barangmasuk.php';
                </script>
		  ";
		 
		}
		
	};
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk - Transaksi</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                                echo "<div class='alert alert-danger alert-dismissible fade show mt-3'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>".$p['namabarang']. "</u></strong> yang tersisa kurang dari 10</div>";		
                            }
                        }
                    ?>
                        <h2 class="mt-4">Menu Data Produk Masuk</h2>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button data-toggle="modal" data-target="#tambahbarangmasuk" type="button" class="btn btn-info mr-2">Tambah Produk Masuk</button>
                                <a href="exportbarangmasuk.php" class="btn btn-success">Export</a>
                                <div class="row ml-1 mt-2" >
                                <form action="" method="post" class="form-inline">
                                    <label for="tgl_mulai"><strong>Dari</strong></label>
                                    <input type="date" name="tgl_mulai" class="form-control mr-2 ml-2">
                                    <label for="tgl_selesai"><strong>Sampai</strong></label>
                                    <input type="date" name="tgl_selesai" class="form-control mr-2 ml-2">
                                    <button type="submit" name="filter" class="btn btn-warning">Filter</button>
                                </form>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="auto" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Quantity</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php $x = 1;

                                            if(isset($_POST['filter'])){
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if($mulai!=NULL || $selesai!=NULL){
                                                    $datamasuk = mysqli_query($conn, "SELECT * FROM masuk m, barang b WHERE m.idbarang = b.idbarang 
                                                    and tanggal_masuk BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) ORDER BY id_masuk DESC");
                                                }
                                                else{
                                                    $datamasuk = mysqli_query($conn, "SELECT * FROM masuk m, barang b WHERE m.idbarang = b.idbarang ORDER BY id_masuk DESC");    
                                                }
                                                
                                            }
                                            else{
                                                $datamasuk = mysqli_query($conn, "SELECT * FROM masuk m, barang b WHERE m.idbarang = b.idbarang ORDER BY id_masuk DESC");
                                            }
                                                while($data = mysqli_fetch_array($datamasuk)){
                                                    $namabarang = $data['namabarang'];
                                                    $tanggal = $data['tanggal_masuk'];
                                                    $qty = $data['qty_masuk'];
                                                    $Input = $data['Input'];
                                                    $idb = $data['idbarang'];
                                                    $idmasuk = $data['id_masuk'];
                                        ?>
                                        <tbody>
                                            <tr>
                                            <td><?= $x++;  ?></td>
												<td><?= $namabarang; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $Input; ?></td>
												<td><?= $qty; ?></td>
												<td>
                                                    <form action="" method="post">
                                                        <button name='hapus' type='submit' class='btn btn-danger' alt='Delete'><div class='icon'><i class='fa fa-trash'></i></div></button>
                                                        <input type='hidden' name='idbarangdel' value="<?= $idb;?>" >
                                                        <input type='hidden' name='idmasukdel' value="<?= $idmasuk;?>">
                                                        <button data-toggle="modal" data-target="#editmasuk<?= $idmasuk; ?>" type="button" class="btn btn-warning"><i class='fa fa-cog'></i></button>
                                                    </form>
                                                </td>                                                
                                            </tr>
                                            <!-- modal input -->
                                            <div id="editmasuk<?= $idmasuk; ?>" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Ubah <?= $namabarang; ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post">
                                                                        <div class="form-group">
                                                                            <label>Nama</label>
                                                                            <input name="namabarang" type="text" class="form-control" value="<?= $namabarang; ?>" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Deskripsi</label>
                                                                            <input name="deskripsibarang" type="text" class="form-control" value="<?= $Input; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>QTY</label>
                                                                            <input name="qty" type="number" min="0" class="form-control" value="<?= $qty; ?>">
                                                                        </div>
                                                                            <input type="hidden" name="idb" value="<?= $idb; ?>">
                                                                            <input type="hidden" name="idm" value="<?= $idmasuk; ?>">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                        <input name ="editbarangmasuk" type="submit" class="btn btn-primary" value="Simpan">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!-- modal input -->
											<?php }; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!--  Bagian conten !-->
            
             <!-- modal input -->
                    <div id="tambahbarangmasuk" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    
                                    <h4 class="modal-title">Tambah Barang Masuk</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <label for="usr">Nama : </label>
                                            <select name="barangnya" id="barangnya" class="form-control" required>
                                                <option value="">
                                                     Pilih Produk 
                                                </option>
                                                <?php 
                                                    $barangnya = mysqli_query($conn, "SELECT * FROM barang");
                                                    while($data_barangnya = mysqli_fetch_array($barangnya)){
                                                        echo '<option value="'.$data_barangnya["idbarang"].'">'.$data_barangnya['namabarang'].' ('.$data_barangnya['deskripsi'].') | Stok'.$data_barangnya['stok'].' </option>';
                                                    }        
                                                ?>
                                            </select>
                                        <div class="form-group">
                                            <label>QTY</label>
                                            <input name="qty_masuk" type="number" min="0" class="form-control" placeholder="Qty" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input name="input" type="text"  class="form-control" placeholder="Keterangan" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <input name ="tambahbarangmasuk" type="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- modal input -->

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
