<?php 
    
    session_start();
    include 'db.php';
   
    date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");

    if( isset($_POST["login"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];
    
        $result = mysqli_query($conn, "SELECT * FROM staf WHERE email = '$email'");
    
        //cek username
    
        if( mysqli_num_rows($result) === 1 ) {
    
            // cek password
            $row = mysqli_fetch_assoc($result);
            $_SESSION['time'] = $timenow;
            $_SESSION['nama'] = $row['nama_admin']; 
    
            if (password_verify($password, $row["password"]) ) {
    
                $_SESSION["signin"] = true;
    
                echo "<meta http-equiv='refresh' content='2; url= index.php'/>  ";
                exit;
            }
        }
        $error = true;
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
        <title>Login - Admin </title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                     <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Admin Nunung Pasurenan</h3></div>
                                        <?php  if (isset($error)) : ?>
                                            <div class="alert alert-danger" >
                                                <center>
                                                    <strong>Password & Username tidak valid</strong>
                                                </center>
                                            </div>
                                        <?php endif; ?>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
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
