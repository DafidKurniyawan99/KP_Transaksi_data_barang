<?php 
    // session_start();
	
    // if ( !isset($_SESSION["signin"])) {
    //     header("Location: login.php");
    //     exit;
    // }
    //require ''
    require 'functions.php';

    date_default_timezone_set("Asia/Bangkok");

?>
<html lang="en">
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Staff - Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--  Bagian Navbar !-->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Staff</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                <ul class="navbar-nav ml-auto ml-md-0 " >
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
            </div>
        
            <!--  Bagian sidebar !-->

            <!--  Bagian conten !-->
            <div id="layoutSidenav_content">
               
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4">Daftar Staff</h2>
                                <div class="card mb-4 pr-2">
                                    <div class="container p-2">
									<button  data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2 ml-3">Tambah Staff Baru</button>
                                    
                                  <a href="exportadmin.php" class="btn btn-success ml-2">Export</a>
                                  
                                    </div>
                                    <?php 
                                    if(isset($_POST['adduser']))
                                    {
                                        $username = $_POST['uname'];
                                        $email = $_POST['email'];
                                        $password = $_POST['upass'];
                                        
                                        //email sudah terdaftar atau belum
                                        $cekemail = mysqli_query($conn, "SELECT email FROM staf WHERE email='$email'");
                                            if(mysqli_fetch_assoc($cekemail)){
                                                echo"<script>
                                                        alert('Email Telah Terdaftar!')
                                                    </script>";
                                                return false;
                                                header('location:staf.php');
                                            }

                                        // Enskeipsi Password
                                        $password = password_hash($password, PASSWORD_DEFAULT);
                                            
                                        $tambahuser = mysqli_query($conn,"insert into staf values('','$username','$email','$password')");
                                        if ($tambahuser){
                                        echo " <script>
                                        alert('Staff Berhasil Di tambah');
                                        document.location.href = 'staf.php';
                                      </script>";
                                        } else { echo "<script>
                                            alert('Staff Gagal Di tambah');
                                            document.location.href = 'staf.php';
                                          </script>";
                                        }
                                        
                                    };
                                ?>
                                </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="auto" cellspacing="0">
                                       <thead> 
                                        <tr>
                                               <th>No.</th>
                                               <th>Nama Admin</th>
                                               <th>Email</th>
                                               <th>Opsi</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $brgs=mysqli_query($conn,"SELECT * from staf");
                                           $no=1;
                                           while($p=mysqli_fetch_array($brgs)){

                                               ?>
                                               
                                               <tr>
                                                   <td><?php echo $no++ ?></td>
                                                   <td><?php echo $p['nama_admin'] ?></td>
                                                   <td><?php echo $p['email'] ?></td>
                                                   <td>
                                                   <form method="post">
                                                        <input type="button" class="btn btn-warning" data-toggle="modal" data-target="#staff<?php echo $p['id_admin'];?>" value="Ubah Password" \>
                                                        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#em<?php echo $p['id_admin'];?>" value="Ubah Email & Nama" \>
                                                        <input type="hidden" name="staffidd" value="<?php echo $p['id_admin'] ?>" \>
                                                        <input data-toggle="modal" data-target="#hapus<?php echo $p['id_admin'];?>" type="button" class="btn btn-danger" value="Hapus Staff" \>
                                                   </form>
                                                   </td>
                                               </tr>		
                                               
                                               <!-- modal input -->
                                                       <div id="staff<?php echo $p['id_admin'];?>" class="modal fade">
                                                           <div class="modal-dialog modal-sm">
                                                               <div class="modal-content">
                                                                   <div class="modal-header">
                                                                       <h4 class="modal-title">Ubah Password <strong><?php echo $p['nama_admin'] ?></strong></h4>
                                                                   </div>
                                                                   <div class="modal-body">
                                                                       <form method="post">
                                                                           <div class="form-group">
                                                                               <label>Nama</label>
                                                                               <input type="text" name="stname" class="form-control" value="<?php echo $p['nama_admin'] ?>" disabled>
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label>Email</label>
                                                                               <input type="email" name="stmail" class="form-control" value="<?php echo $p['email'] ?>" disabled>
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label>Password <strong><?php echo $p['nama_admin'] ?></strong> saat ini</label>
                                                                               <input type="password" class="form-control" name="currentpw">
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label>Password baru</label>
                                                                               <input type="password" class="form-control" name="newpw">
                                                                           </div>
                                                                           <input type="hidden" value="<?php echo $p['id_admin'] ?>" name="staffidform">
                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <input name="updatepw" type="submit" class="btn btn-info" value="Update">
                                                                       </div>
                                                                       </form>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       
                                                       <div id="em<?php echo $p['id_admin'];?>" class="modal fade">
                                                           <div class="modal-dialog modal-sm">
                                                               <div class="modal-content">
                                                                   <div class="modal-header">
                                                                       <h4 class="modal-title">Ubah Username Dan Email</h4>
                                                                   </div>
                                                                   <div class="modal-body">
                                                                       <form method="post">
                                                                            <div class="form-group">
                                                                               <label>Nama</label>
                                                                               <input type="text" name="stn" class="form-control" value="<?php echo $p['nama_admin'] ?>" >
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label>Email</label>
                                                                               <input type="email" name="stm" class="form-control" value="<?php echo $p['email'] ?>" >
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label>Verifikasi password saat ini (Masukan sandi dari <strong><?php echo $p['nama_admin'] ?></strong>)</label>
                                                                               <input type="password" class="form-control" name="pws">
                                                                           </div>
                                                                           <input type="hidden" value="<?php echo $p['id_admin'] ?>" name="staffidem">
                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <input name="updateem" type="submit" class="btn btn-info" value="Update">
                                                                       </div>
                                                                       </form>
                                                               </div>
                                                           </div>
                                                       </div>

                                                       <div id="hapus<?php echo $p['id_admin'];?>" class="modal fade">
                                                           <div class="modal-dialog modal-sm">
                                                               <div class="modal-content">
                                                                   <div class="modal-header">
                                                                       <h4 class="modal-title">Apakah Anda yakin ingin menghapus <strong><?php echo $p['nama_admin'] ?></strong>?</h4>
                                                                   </div>
                                                                   <div class="modal-body">
                                                                       <form method="post">
                                                                           <div class="form-group">
                                                                               <label>Verifikasi password saat ini (Masukan Sandi dari <strong><?php echo $p['nama_admin'] ?></strong>)</label>
                                                                               <input type="password" class="form-control" name="pwskrg">
                                                                           </div>
                                                                           <input type="hidden" value="<?php echo $p['id_admin'] ?>" name="staffiddel">
                                                                       </div>
                                                                       <div class="modal-footer">
                                                                           <input name="hapusstaff" type="submit" class="btn btn-danger" value="Hapus">
                                                                       </div>
                                                                       </form>
                                                               </div>
                                                           </div>
                                                       </div>
                                                    
                                        <?php 
                                           }

                                           // hapus staf
                                           if(isset($_POST["hapusstaff"])){
                                                   $staffidd1 = $_POST['staffiddel'];
                                                   $currentpassword = mysqli_real_escape_string($conn,$_POST['pwskrg']);
                                                   $queryuser2 = mysqli_query($conn,"SELECT * FROM staf WHERE id_admin='$staffidd1'");
                                                   $cariuser2 = mysqli_fetch_assoc($queryuser2);
                   
                                                       if(password_verify($currentpassword,$cariuser2['password'])) {
                                                           $hapusin = mysqli_query($conn,"delete from staf where id_admin='$staffidd1'");
                                                           if($hapusin){
                                                           echo " <script>
                                                           alert('Staff Berhasil Di hapus');
                                                           document.location.href = 'staf.php';
                                                         </script>";
                                                           } else { echo "<script>
                                                            alert('Staff Berhasil Di hapus');
                                                            document.location.href = 'staf.php';
                                                          </script>";
                                                           }
                                                           
                                                       } else {
                                                           echo "<script>
                                                           alert('Password Verifikasi salah');
                                                           document.location.href = 'staf.php';
                                                         </script>";
                                                       }
                                                   
                                                   
                                               };
                                        
                                            // Update password
                                           if(isset($_POST["updatepw"])){
                                                   $staffidd2 = $_POST['staffidform'];
                                                   $currentpass = mysqli_real_escape_string($conn,$_POST['currentpw']);
                                                   $newpass = password_hash($_POST['newpw'], PASSWORD_DEFAULT); 
                                                   $queryuser1 = mysqli_query($conn,"SELECT * FROM staf WHERE id_admin='$staffidd2'");
                                                   $cariuser1 = mysqli_fetch_assoc($queryuser1);

                                                       if(password_verify($currentpass,$cariuser1['password'])) {
                                                           $updatepassword = mysqli_query($conn,"update staf set password='$newpass' where id_admin='$staffidd2'");
                                                           
                                                           if($updatepassword){
                                                           echo "<script>
                                                           alert('Password Berhasil Di Update');
                                                           document.location.href = 'staf.php';
                                                         </script>";
                                                
                                                           } else {
                                                           echo "<script>
                                                           alert('Password Gagal Di Update');
                                                           document.location.href = 'staf.php';
                                                         </script>";
                                                           }
                                                           
                                                       } else {
                                                           echo "<script>
                                                           alert('Password Verifikasi salah');
                                                           document.location.href = 'staf.php';
                                                         </script>";
                                                       }
                                           };
                                           
                                           // updata username dan email
                                           if(isset($_POST["updateem"])){
                                            $staffidd3 = $_POST['staffidem'];
                                            $nama = $_POST['stn'];
                                            $email = $_POST['stm'];
                                            $current = mysqli_real_escape_string($conn,$_POST['pws']);
                                            $queryuser3 = mysqli_query($conn,"SELECT * FROM staf WHERE id_admin='$staffidd3'");
                                            $cariuser3 = mysqli_fetch_assoc($queryuser3);
            
                                            if(password_verify($current, $cariuser3['password'])) {
                                                $updateemail = mysqli_query($conn,"update staf set nama_admin='$nama', email='$email' where id_admin='$staffidd3'");
                                                
                                                if($updateemail){
                                                echo " <script>
                                                alert('Nama dan Email Berhasil Di Update');
                                                document.location.href = 'staf.php';
                                              </script>";
                                     
                                                } else {
                                                echo "<script>
                                                alert('Nama dan Email Gagal Di Update');
                                                document.location.href = 'staf.php';
                                              </script>";
                                                }
                                                
                                            } else {
                                                echo "<script>
                                                alert('Password Verifikasi salah');
                                                document.location.href = 'staf.php';
                                              </script>";
                                            }  
                                            
                                            
                                        };
                                           ?>
                                           
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <!--  Bagian conten !-->
            <!--  Modal tambah Staff !-->   
            <div id="myModal" class="modal fade">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title">Tambah User Baru</h4>
                       </div>
                       <div class="modal-body">
                           <form method="post">
                               <div class="form-group">
                                   <label>Nama Staff</label>
                                   <input name="uname" type="text" class="form-control" placeholder="Nama Staff" required autofocus>
                               </div>
                               <div class="form-group">
                                   <label>Email</label>
                                   <input name="email" type="email" class="form-control" placeholder="Email" required autofocus>
                               </div>
                               <div class="form-group">
                                   <label>Password</label>
                                   <input name="upass" type="password" class="form-control" placeholder="Password" required autofocus>
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                               <input name="adduser" type="submit" class="btn btn-primary" value="Simpan">
                           </div>
                       </form>
                   </div>
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