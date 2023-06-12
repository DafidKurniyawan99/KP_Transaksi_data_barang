<?php 
    require 'functions.php';

    date_default_timezone_set("Asia/Bangkok");
    $orderids = $_GET['orderid'];
    $liatcust = mysqli_query($conn,"select * from staf s, pesanan p where orderid='$orderids' and p.id_admin=s.id_admin");
    $checkdb = mysqli_fetch_array($liatcust);
    // Mengubah Barang di pesanan
    if(isset($_POST['updateorder']))
	{
        $qtybrg = $_POST['qtybrg'];
		$idbrg = $_POST['idbrg'];
		$idorder = $checkdb['orderid'];
		
		$lihatqtydetpesanan  = mysqli_query($conn,"select * from detpesanan where idbarang='$idbrg' and orderid='$idorder'");
		$fstock = mysqli_fetch_array($lihatqtydetpesanan);
        
		
		$lihatstock  = mysqli_query($conn,"select * from barang where idbarang='$idbrg'");
		$dstock = mysqli_fetch_array($lihatstock);
		
		if($qtybrg<=$fstock['qty']){
		$selisihminus = $fstock['qty'] - $qtybrg;
		$arrayplus = $dstock['stok'] + $selisihminus;
            $updatedetpesanan = mysqli_query($conn,"update detpesanan set qty='$qtybrg' where orderid='$idorder' and idbarang='$idbrg'");
            $updatedatakeluar = mysqli_query($conn,"update keluar set jumlah='$qtybrg' where penerima='$idorder' and idbarang='$idbrg'");
            $tambahinstock = mysqli_query($conn,"update barang set stok='$arrayplus' where idbarang='$idbrg'");
                if($updatedetpesanan&&$updatedatakeluar&&$tambahinstock){
                echo " <script>
                        alert('Jumlah Barang Berhasil Di Ubah');
                        document.location.href = 'viewpesanan.php?orderid=".$idorder."';
                        </script>";
                } else { echo "<script>
                    alert('Jumlah Barang Gagal Di Ubah');
                    document.location.href = 'viewpesanan.php?orderid=".$idorder."';
                    </script>";
                }
        
			 
		} else {
			$selisihplus = $qtybrg - $fstock['qty'];
			$arraymin = $dstock['stok'] - $selisihplus;
			if($dstock['stok']>=$qtybrg){
                $updatedetpo1 = mysqli_query($conn,"update detpesanan set qty='$qtybrg' where orderid='$idorder' and idbarang='$idbrg'");
                $updatedatakeluar1 = mysqli_query($conn,"update keluar set jumlah='$qtybrg' where penerima='$idorder' and idbarang='$idbrg'");
                $kuranginstock = mysqli_query($conn,"update barang set stok='$arraymin' where idbarang='$idbrg'");
				if($updatedetpo1&&$updatedatakeluar1&&$kuranginstock){
				echo "  <script>
                alert('Jumlah Barang Berhasil Di Ubah');
                document.location.href = 'viewpesanan.php?orderid=".$idorder."';
                </script>";
				} else { echo "<script>
                    alert('Jumlah barang Gagal Di ubah');
                    document.location.href = 'viewpesanan.php?orderid=".$idorder."';
                </script>";
				}
            }else{
                echo "  <script>
                            alert('Stok Tidak Cukup');
                            document.location.href = 'viewpesanan.php?orderid=".$idorder."';
                        </script>";
            }
            
		}
		// <meta http-equiv='refresh' content='1; url= viewpesanan.php?orderid=".$idorder."'/>
	};
    // Hapus Barang
    if(isset($_POST['deletebarang']))
	{
		$idbarangdel = $_POST['idbarangdel'];
		$idorderdel = $_POST['idorderdel'];
		$lihatqtydetpo1  = mysqli_query($conn,"select * from detpesanan where idbarang='$idbarangdel' and orderid='$idorderdel'");
		$fstock1 = mysqli_fetch_array($lihatqtydetpo1);
		$lihatstockbrg  = mysqli_query($conn,"select * from barang where idbarang='$idbarangdel'");
		$dstock1 = mysqli_fetch_array($lihatstockbrg);
		
		$balikin = $dstock1['stok'] + $fstock1['qty'];
			  
		$updatestockbaru = mysqli_query($conn,"update barang set stok='$balikin' where idbarang='$idbarangdel'");
		$hapusbrgkeluar = mysqli_query($conn,"delete from keluar where penerima='$idorderdel' and idbarang='$idbarangdel'");
		$hapusdetpo = mysqli_query($conn,"delete from detpesanan where orderid='$idorderdel' and idbarang='$idbarangdel'");
		if($updatestockbaru&&$hapusbrgkeluar&&$hapusdetpo){
		echo " <script>
                    alert('Berhasil di hapus');
                    document.location.href = 'viewpesanan.php?orderid=".$idorderdel."';
                </script>";
		} else { echo "
			<script>
                    alert('Gagal di hapus');
                    document.location.href = 'viewpesanan.php?orderid=".$idorderdel."';
                </script>
		  ";
		 
		}
		
	};
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pesanan</title>
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
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
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
           
                    <div class="card mb-4">
                        <div class="card-header">
                            <button  data-toggle="modal" data-target="#input" class="btn btn-info col-md-2">Input Produk</button>
                            <a href="exportdetbar.php?orderid=<?php echo $orderids ?>" target="_blank" class="btn btn-info">Export Data</a>
                        </div> 
                            <div class="card-body">
                            
                            <!--- input Produk --->
                            <div id="input" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h4 class="modal-title">Tambah Pesanan Baru</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="form-group">
                                                        <label>Produk</label>
                                                        <select name="produk" class="custom-select form-control">
                                                        <option selected>Pilih Produk</option>
                                                        <?php
                                                        $det=mysqli_query($conn,"SELECT*FROM barang where idbarang not in (select idbarang from detpesanan where orderid='$orderids') order by idbarang ASC ");
                                                        while($d=mysqli_fetch_array($det)){
                                                        ?>
                                                            <option value="<?php echo $d['idbarang'] ?>"><?php echo $d['namabarang']?>(Stok : <?php echo $d['stok']?>) | Rp<?php echo number_format($d['harga']) ?> </option>
                                                            <?php
                                                    }
                                                    ?>		
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <input name="qty" type="number" min="1" class="form-control" placeholder="Qty" required>
                                                    </div>
                                                    <input type="hidden" name="idpesanan" value="<?php echo $orderids ?>" \>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <input name="adddetailorder" type="submit" class="btn btn-primary" value="Simpan">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <!-- akhir -->
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h3>Order id : #<?php echo $orderids ?></h3>
                                    
                                        </div>
                                        <p>Nama Staff Penginput : <?php echo $checkdb['nama_admin']; ?></p>
                                        <p>Keperluan : <?php echo $checkdb['keperluan']; ?></p>
                                        <p>Waktu Order : <?php echo $checkdb['tanggal']; ?></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Sub-Total</th>
                                                <?php
												if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
												echo '
												<th>Opsi</th>
												';
												} else {
													
												}
												?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $barangpesan = mysqli_query($conn ,"SELECT * FROM detpesanan d, barang b WHERE orderid='$orderids' and d.idbarang = b.idbarang");
                                            $no=1;
                                            while($data=mysqli_fetch_array($barangpesan)) {
                                                $subtotal = $data['harga']*$data['qty'];
                                                $idb = $data['idbarang'];
                                                $idp = $data['iddetailpes'];

                                                $result = mysqli_query($conn,"SELECT SUM(d.qty*b.harga) AS count FROM detpesanan d, barang b where orderid='$orderids' and b.idbarang=d.idbarang ");
                                                $row = mysqli_fetch_assoc($result);
                                                $cekrow = mysqli_num_rows($result);
                                                $count = $row['count'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $data['namabarang'] ?> (<?php echo $data['deskripsi'] ?>)</td>
                                                <td><?php echo $data['qty'] ?></td>
                                                <td>Rp.<?php echo number_format($data['harga']) ?></td>
                                                <td>Rp.<?php echo number_format($subtotal) ?></td>
                                                <td>
                                                    <form method='post'>
                                                    <button data-toggle="modal" data-target="#editbarangmasuk<?php echo $data['idbarang']; ?>"class='btn btn-warning' type="button" class="icon"><i class='fa fa-cog'></i></div></button>
                                                    <input type='hidden' name='idbarangdel' value="<?php echo $data['idbarang'];?>" >
                                                    <input type='hidden' name='idorderdel' value="<?php echo $data['orderid'];?>">
                                                    <button name='deletebarang' type='submit' class='btn btn-danger' alt='Delete'><div class='icon'><i class='fa fa-trash'></i></div></button>
                                                    </form>
                                                </td>
                                            </tr>
                                                <!-- modal input -->
                                                <div id="editbarangmasuk<?php echo $data['idbarang']; ?>" class="modal fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Ubah <?= $data['namabarang']; ?></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post">
                                                                        <div class="form-group">
                                                                            <label>Nama</label>
                                                                            <input name="namabrg" type="text" class="form-control" value="<?= $data['namabarang']; ?>(Stok : <?=$data['stok']; ?>)" disabled>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>QTY</label>
                                                                            <input name="qtybrg" type="text" class="form-control" value="<?= $data['qty']; ?>" min="1" required>
                                                                        </div>
                                                                        <input type="hidden" name="idbrg" value="<?= $idb;?>">
                                                                        <input type="hidden" name="idp" value="<?= $idp;?>">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                        <input name ="updateorder" type="submit" class="btn btn-primary" value="Simpan">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <!-- modal input -->
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                                <tr>
                                                    <th colspan="4" style="text-align:right">Total:</th>
                                                    <th>Rp<?php 
                                                    
                                                    $result1 = mysqli_query($conn,"SELECT SUM(d.qty*b.harga) AS count FROM detpesanan d, barang b where orderid='$orderids' and b.idbarang=d.idbarang ");
                                                    $cekrow = mysqli_num_rows($result1);
                                                    $row1 = mysqli_fetch_assoc($result1);
                                                    $count = $row1['count'];
                                                    if($cekrow > 0){
                                                        echo number_format($count);
                                                        } else {
                                                            echo 'No data';
                                                        }?></th>
                                                </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- status -->
                                <div class="row mt-5 mb-5">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                            <h4>Status : <?php echo $checkdb['status'] ?></h4>
                                                
                                                
                                                <form method="post">
                                                    <div class="row">
                                                    <div class="col">
                                                    <div class="form-group">
                                                        <select name="statusorder" class="form-control">
                                                        <?php 
                                                        
                                                        $liatrow = mysqli_num_rows($brgs);

                                                        $stat = $checkdb['status'];
                                                        if($stat=='Diproses'){ echo '
                                                        <option value="Processed">Diproses</option>
                                                        <option value="Selesai">Selesai</option>
                                                        ';
                                                            if($liatrow < 1){
                                                            echo '
                                                            <option value="Dibatalkan">Dibatalkan</option>
                                                            ';
                                                            }
                                                        } else if($stat=='Processed'){
                                                            echo '
                                                            <option value="Selesai">Selesai</option>
                                                            ';
                                                            if($liatrow < 1){
                                                            echo '
                                                            <option value="Dibatalkan">Dibatalkan</option>
                                                            ';
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                        <p class="bg-danger text-white mt-2" > Jika Anda ingin membatalkan Pesanan, Anda harus mengosongkan item pesanan</p>
                                                    </div>
                                                    <input type="hidden" name="orderids" class="form-control" value="<?php echo $orderids ?>" \>
                                                    </div>
                                                    <div class="col">
                                                    
                                                    <?php
                                                    if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
                                                    echo '
                                                    <div class="form-group">
                                                    <button type="submit" name="simpanstatus" class="btn btn-primary"\>Update Status</button>
                                                    </div>
                                                    ';
                                                    } else {
                                                        
                                                    }
                                                    ?>
                                                    
                                                    </div>
                                                    </div>
                                                    
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                 
                                <!-- status -->
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
