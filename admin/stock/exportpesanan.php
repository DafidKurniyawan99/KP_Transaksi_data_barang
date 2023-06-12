<?php 
	session_start();
    
    if ( !isset($_SESSION["signin"])) {
        header("Location: ../login.php");
        exit;
    }
    
	include 'functions.php';
	date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");
	?>

<html>
<head>
<title>Data Pesanan per tangal :  <?php echo $timenow ?></title>
<link rel="icon" 
      type="image/png" 
      href="favicon.png">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


</head>

<body>
		<div class="container">
			<h2>Data Pesanan </h2>
			<p>Per tanggal <?php echo $timenow ?></p>
            <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable3" width="auto" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Staff</th>
                                                <th>Keperluan</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Status</th>
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
                                                <td><strong>#<?php echo $data['orderid'] ?></a></strong></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $nama_admin; ?></td>
                                                <td><?= $kep; ?></td>
                                                <td><?= $jumlah; ?> Produk Pesanan</td>
                                                <td><?= $status; ?></td>
                                            </tr>
                                      
                                        <?php
                                            }
                                        ?>
										</tbody>
										</table>
								</div>
						</div>
	
<script>
$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'excel', 'pdf', 'print',
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

	

</body>

</html>