<?php 
	session_start();
	include 'functions.php';
    $orderids = $_GET['orderid'];
    $liatcust = mysqli_query($conn,"select * from staf s, pesanan p where orderid='$orderids' and p.id_admin=s.id_admin");
    $checkdb = mysqli_fetch_array($liatcust);
	date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");
	?>

<html>
<head>
    <title>
        Data Pesanan #<?php echo $orderids ?>
        
        Nama Staff Penginput : <?php echo $checkdb['nama_admin']; ?>

        Keperluan : <?php echo $checkdb['keperluan']; ?>

        Waktu Order : <?php echo $checkdb['tanggal']; ?>

        Per tanggal <?php echo $timenow ?>
    </title>
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
       
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <h2>Data Pesanan #<?php echo $orderids ?></h2>
                <p>Nama Staff Penginput : <?php echo $checkdb['nama_admin']; ?></p>
                <p>Keperluan : <?php echo $checkdb['keperluan']; ?></p>
                <p>Waktu Order : <?php echo $checkdb['tanggal']; ?></p>
                    <p>Per tanggal <?php echo $timenow ?></p>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Produk</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                                <th>Sub-Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $barangpesan = mysqli_query($conn ,"SELECT * FROM detpesanan d, barang b WHERE orderid='$orderids' and d.idbarang = b.idbarang");
                                            $no=1;
                                            while($data=mysqli_fetch_array($barangpesan)) {
                                                $subtotal = $data['harga']*$data['qty'];

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
    $('#dataTable1').DataTable( {
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