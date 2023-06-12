<?php 

require '../db.php';
//untuk mengkoneksikan ke database
//$conn = mysqli_connect("localhost", "root", "", "nn");

//Untuk Mengquery

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$wadah = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$wadah[] = $row;
	}
	return  $wadah;
}

//<---------------Functions  bagian awal GALERI------------------------->
// Functions tambah
// 	Untuk menambah GALERI
	function add($data) {
		
		global $conn;

		$nama = htmlspecialchars($data["nama_album"]);
		$deskripsi = htmlspecialchars($data["deskripsi_album"]);

		//Menguploadgamabar

		$gambar = upload();

		if ( !$gambar ) {
			return false;
		}


		$query = "INSERT INTO album VALUES('','$nama','$gambar','$deskripsi')";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);
	}

//Uploa GALERI	
	function upload(){

		$namaFile = $_FILES['gambar_album']['name'];
		$ukuranFile = $_FILES['gambar_album']['size'];
		$error  = $_FILES['gambar_album']['error'];
		$tmpName = $_FILES['gambar_album']['tmp_name'];

		//cek memilih gambar atau tidak
		if ($error === 4) {
			echo "<script>
					alert('Silahkan Pilih Gambar Terlebih dahulu');
				 </script>";
			return false;
		}

		//pemastian gambar yang di upload bukan yang lain
		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar) );

		if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
			echo "<script>
					alert('Pastikan Anda Mengupload File Berupa Gambar');
				 </script>";
			return false;	
		}
		// penyortiran ukuran
		if ($ukuranFile > 2000000) {
		 	echo "<script>
					alert('Gambar Yang Anda Upload Melebihi 2MB Coba Ganti Ke Ukuran Yang Lebih Kecil');
				 </script>";
			return false;
		 } 

		 // agar nama tidak terduplikat
		 $newname = uniqid(); 
		 $newname .= '.';
		 $newname .= $ekstensiGambar;
		 //siap untuk mengupload gambar
		 move_uploaded_file($tmpName, '../gambar/galeri/' . $newname);

		 return $newname;
	}

//functions hapus
	//GALERI
	function hapusgaleri($id_album){
		global $conn;
		mysqli_query($conn, "DELETE FROM album WHERE idalbum = $id_album");
		return mysqli_affected_rows($conn);
	}

//function edit ubah GALERI
	function editgaleri($data){

		global $conn;

		$id = $data["id"];
		$nama = htmlspecialchars($data["nama_album"]);
		$gambarold = htmlspecialchars($data["gambarold"]);
		$deskripsi = htmlspecialchars($data["deskripsi_album"]);


		if ( $_FILES['gambar_album']['error'] === 4 ) {
			$gambar = $gambarold;
		}
		else {
			$gambar = upload();
		}

		$query = "UPDATE album SET 
				 nama_album = '$nama',
				 
				 gambar_album = '$gambar', 
				 
				 deskripsi_album = '$deskripsi'
				 
				 WHERE idalbum = $id";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);	
	}
// function pencarian GALERI
	function cari($katakunci) {

		$query = "SELECT * FROM album WHERE  deskripsi_album LIKE '%$katakunci%' OR nama_album LIKE '%$katakunci%' ";

		return query($query);
	}
// <-------------------------akhir bagian functions GALERI-------------------->

// <-------------------------Funnctions untuk PRODUK-------------------------->
	//Upload gambar produk	
	function uploadproduk(){

		$namaFile = $_FILES['gambar_produk']['name'];
		$ukuranFile = $_FILES['gambar_produk']['size'];
		$error  = $_FILES['gambar_produk']['error'];
		$tmpName = $_FILES['gambar_produk']['tmp_name'];

		//cek memilih gambar atau tidak
		if ($error === 4) {
			echo "<script>
					alert('Silahkan Pilih Gambar Terlebih dahulu');
				 </script>";
			return false;
		}

		//pemastian gambar yang di upload bukan yang lain
		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar) );

		if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
			echo "<script>
					alert('Pastikan Anda Mengupload File Berupa Gambar');
				 </script>";
			return false;	
		}
		// penyortiran ukuran
		if ($ukuranFile > 2000000) {
		 	echo "<script>
					alert('Gambar Yang Anda Upload Melebihi 2MB Coba Ganti Ke Ukuran Yang Lebih Kecil');
				 </script>";
			return false;
		 } 

		 // agar nama tidak terduplikat
		 $newname = uniqid(); 
		 $newname .= '.';
		 $newname .= $ekstensiGambar;
		 //siap untuk mengupload gambar
		 move_uploaded_file($tmpName, '../gambar/produk/' . $newname);

		 return $newname;
	}

	// Tambah Data produk
	function tambahproduk($data) {
			
		global $conn;

		$namaproduk = htmlspecialchars($data["nama_produk"]);
		$hargaproduk = htmlspecialchars($data["harga_produk"]);
		$deskripsiproduk = htmlspecialchars($data["deskripsi_produk"]);

		//Menguploadgamabar

		$gambarproduk = uploadproduk();

		if ( !$gambarproduk ) {
			return false;
		}


		$query = "INSERT INTO produk VALUES('','$namaproduk','$gambarproduk','$hargaproduk','$deskripsiproduk')";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);
	}
	
	// Hapus produk
	function hapusproduk($id_produk){
		global $conn;
		mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");
		return mysqli_affected_rows($conn);
	}

	//Edit Produk
	function editproduk($data){

		global $conn;

		$id = $data["id"];
		$namaproduk = htmlspecialchars($data["nama_produk"]);
		$hargaproduk = htmlspecialchars($data["harga_produk"]);
		$gambaroldproduk = htmlspecialchars($data["gambaroldproduk"]);
		$deskripsiproduk = htmlspecialchars($data["deskripsi_produk"]);


		if ( $_FILES['gambar_produk']['error'] === 4 ) {
			$gambarproduk = $gambaroldproduk;
		}
		else {
			$gambarproduk = uploadproduk();
		}

		$query = "UPDATE produk SET 
				 nama_produk = '$namaproduk',
				 
				 gambar_produk = '$gambarproduk',

				 harga_produk = '$hargaproduk', 
				 
				 deskripsi_produk = '$deskripsiproduk'
				 
				 WHERE id_produk = $id";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);	
	}
// <-------------------------AKHIR FUNCTIONS Produk---------------------------->

// <------------------------- Bagian awal functions Barang--------------------->
	//tambah barang 
	if ( isset($_POST['tambahbarang']) ) {
			
		$namabarang = $_POST['namabarang'];
		$deskripsibarang = $_POST['deskripsibarang'];
		$stok = $_POST['stok'];
		$harga = $_POST['harga'];

		$addbarang = mysqli_query($conn, "INSERT INTO barang (namabarang, deskripsi, stok, harga) 
									VALUES('$namabarang','$deskripsibarang','$stok','$harga')");

		if ($addbarang) {
			echo "<script>
					alert('Data Berhasil Ditambahkan');
					document.location.href = 'stok.php';
				  </script>";
			}	
			else {
			echo "<script>
					alert('Data Gagal Ditambahkan');
					document.location.href = 'stok.php';
				  </script>";
			}
	}

	//Menghapus Data barang
	function hapusbarang($idbarang){
		global $conn;
		mysqli_query($conn, "DELETE FROM barang WHERE idbarang = $idbarang");
		return mysqli_affected_rows($conn);
	}

	//Functions Update barang 
	if ( isset($_POST['editbarang']) ) {
			
		$namabarang = $_POST['namabarang'];
		$deskripsibarang = $_POST['deskripsibarang'];
		$harga = $_POST['harga'];
		$idb = $_POST['idb'];

		$editbarang = mysqli_query($conn, "UPDATE barang SET  
				namabarang='$namabarang', deskripsi='$deskripsibarang', harga='$harga' WHERE idbarang='$idb'");

		if ($editbarang) {
				echo "<script>
				alert('Data Berhasil Di ubah');
				document.location.href = 'stok.php';
			  </script>";
			}	
			else {
			echo "<script>
					alert('Data Gagal Di ubah');
					document.location.href = 'stok.php';
				  </script>";
			}
	}
	
// <------------------------- Bagian Akhir functions Barang-------------------->

// <------------------------ AWAL Functions Barang Masuk----------------------->
	//Tambah barang masuk
	if ( isset($_POST['tambahbarangmasuk']) ){ 
		$barangnya = $_POST['barangnya'];
		$input = $_POST['input'];
		$qty_masuk = $_POST['qty_masuk'];

		//Ambil stok barang dulu
		$cekstokbarangsekarang = mysqli_query($conn, "SELECT * FROM barang WHERE idbarang='$barangnya'");
		$ambildatanya = mysqli_fetch_assoc($cekstokbarangsekarang);
		
		$stoksekarang = $ambildatanya['stok'];
		$tambahbarangdanstok = $stoksekarang+$qty_masuk;

		$addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, qty_masuk, input) 
									VALUES ('$barangnya','$qty_masuk','$input')");
		$updatestokmasuk = mysqli_query($conn, "UPDATE barang set stok='$tambahbarangdanstok' WHERE idbarang='$barangnya'");
			if($addtomasuk&&$updatestokmasuk){
			echo "<script>
						alert('Data Berhasil Ditambahkan');
						document.location.href = 'barangmasuk.php';
				  </script>";
			} else{
			echo"<script>
						alert('Data Gagal Ditambahkan');
						document.location.href = 'barangmasuk.php';
				  </script>";
			}

	}

	//Menghapus Data barang Masuk
	function hapusmasuk($id_masuk){
		global $conn;
		mysqli_query($conn, "DELETE FROM masuk WHERE id_masuk = $id_masuk");
		return mysqli_affected_rows($conn);
	
	}
	// Edit data barang masuk
	if ( isset($_POST['editbarangmasuk']) ) {
		
		$deskripsibarang = $_POST['deskripsibarang'];
		$idb = $_POST['idb'];
		$qty = $_POST['qty'];
		$idmasuk = $_POST['idm'];
		
		$lihatstock =mysqli_query($conn, "SELECT*FROM barang where idbarang='$idb'");
		$stocknya = mysqli_fetch_array($lihatstock);
		$stockskrg = $stocknya['stok'];
		// $editbarang = mysqli_query($conn, "UPDATE barang SET  namabarang='$namabarang', deskripsi='$deskripsibarang', harga='$harga' WHERE idbarang='$idb'");

		$qtysekarang =mysqli_query($conn, "SELECT*FROM masuk where id_masuk='$idmasuk'");
		$qtnya = mysqli_fetch_array($qtysekarang);
		$qtysekarang = $qtnya['qty_masuk'];
		if ($qty>$qtysekarang) {
				$selisih = $qty-$qtysekarang;
				$kurangin = $stockskrg+$selisih; 
				$kurangistoknya = mysqli_query($conn, "UPDATE barang SET stok='$kurangin' WHERE idbarang='$idb'");
				$updatenya = mysqli_query($conn, "UPDATE masuk SET  input='$deskripsibarang', qty_masuk='$qty' 
											WHERE id_masuk='$idmasuk'");
				if($kurangistoknya&&$updatenya){
					echo "	<script>
					alert('Pesanan Berhasil Di Ubah');
					document.location.href = 'barangmasuk.php';
				</script>";
					} else{
						echo "	<script>
						alert('Pesanan Gagal Di Ubah');
						document.location.href = 'barangmasuk.php';
					</script>";
					}
			}	
			else {
				$selisih = $qtysekarang-$qty;
				$kurangin = $stockskrg-$selisih; 
				$kurangistoknya = mysqli_query($conn, "UPDATE barang SET stok='$kurangin' WHERE idbarang='$idb'");
				$updatenya = mysqli_query($conn, "UPDATE masuk SET  input='$deskripsibarang', qty_masuk='$qty' WHERE id_masuk='$idmasuk'");
				if($kurangistoknya&&$updatenya){
					echo "	<script>
					alert('Pesanan Berhasil Di Ubah');
					document.location.href = 'barangmasuk.php';
				</script>";
					} else{
						echo "	<script>
						alert('Pesanan Gagal Di Ubah');
						document.location.href = 'barangmasuk.php';
					</script>";
					}
			}
	}
// <------------------------- AKHIR FUnctions Barang Masuk---------------------->

// <------------------------- AKHIR Functions Barang Keluar --------------------->

// <------------------------- AWAL FUNCTIONS PESANAN ---------------------------->
 //Menambah Pesanan
	if(isset($_POST['addorder']))
	{
		$sttid = $_POST['kastemer'];
		$keperluan = $_POST['untuk'];
		$salt1 = mt_rand(2,999);
		$salt2 = mt_rand(1001,1234);
		$hash1 = date("m") * date("d") + date("i") * date("s");
		$hash2 = $salt1 * $salt2;
		$hashing = $hash1 * $hash2;
		$orderid = crypt($sttid, $hashing);
			
		$tambahorder = mysqli_query($conn,"insert into pesanan values('','$orderid',current_timestamp(),'$sttid','$keperluan','Diproses')");
		if($tambahorder){
				echo"	<script>
				alert('Pesanan Berhasil Di buat');
				document.location.href = 'pesanan.php?orderid=".$orderid."';
			</script>";
		
		} else {echo "<script>
			alert('Pesanan Gagal Di buat');
			document.location.href = 'pesanan.php?orderid=".$orderid."';
		</script>";
		}
		
	}

 //Menginputproduk ke pesanan
 if(isset($_POST['adddetailorder']))
 {
	 $produk = $_POST['produk'];
	 $lihatqtydibarang  = mysqli_query($conn,"select * from barang where idbarang='$produk'");
	 $stock = mysqli_fetch_array($lihatqtydibarang);
	 $qty = $_POST['qty'];
	 $updatestock = $stock['stok'];
	 $orderid = $_POST['idpesanan'];
	 
	if($updatestock>=$qty){

		//Kuringi stock dengan jumlah yang akan di keluarkan
		$selisih =  $updatestock - $qty;

		$addtodetpo = mysqli_query($conn,"insert into detpesanan values('','$orderid','$produk','$qty')");
		$updatestock = mysqli_query($conn,"update barang set stok='$selisih' where idbarang='$produk'");
		$setbarangkeluar = mysqli_query($conn,"insert into keluar values('','$produk',current_timestamp(),'$qty','$orderid')");
		if($addtodetpo&&$updatestock&&$setbarangkeluar){
		echo " <script>
					alert('Barang Berhasil Di tambah');
					document.location.href = 'viewpesanan.php?orderid=".$orderid."';
				</script>";
		} else { echo " <script>
			alert('Barang gagal Di tambah');
			document.location.href = 'viewpesanan.php?orderid=".$orderid."';
		</script>";
		}
	
	}else{
			echo "<script>
					alert('Stok Tidak Cukup');
					document.location.href = 'viewpesanan.php?orderid=".$orderid."';
				</script> ";
	}
 };
 
 //Update Status Pesanan

 if(isset($_POST['simpanstatus']))
	{
		$statusorder = $_POST['statusorder'];
		$orderid = $_POST['orderids'];
			  
		$updatestatus = mysqli_query($conn,"update pesanan set status='$statusorder' where orderid='$orderid'");
		if($updatestatus){
		echo " <script>
				alert('Status Berhasil di perbarui');
				document.location.href = 'viewpesanan.php?orderid=".$orderid."';
				</script>";
		} else { echo "script>
			alert('Status Berhasil di perbarui');
			document.location.href = 'viewpesanan.php?orderid=".$orderid."';
			</script>";
		}
		
	};

// <------------------------- AKHIR FUNCTIONS PESANAN --------------------------->