<?php 

//untuk mengkoneksikan ke database
$conn = mysqli_connect("localhost", "root", "", "nn");

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

// function bagian registrasi
function registrasi($data)
{
 	global $conn;
 	$username = strtolower(htmlspecialchars($data['username']));
 	$nama = htmlspecialchars($data['nama']);
 	$telfon = strtolower(htmlspecialchars($data['telfon']));
 	$alamat = htmlspecialchars($data['alamat']); 
 	$password = mysqli_real_escape_string($conn, $data["password"]);
 	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

 	//Cek Username yang sudah terdaftar

 	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

 	if( mysqli_fetch_assoc($result) ) {
 		echo "<script>
 				alert('Username Yang Anda Masukan Sudah Terdaftar !');
 			  </script>";
 		return false;
 	}

 	//konfirmasi password

 	if( $password !== $password2) {
 		echo "<script>
 				alert('Konfirmasi password tidak sesuai !');
 			</script>";
 		return false;
 	}
 	// enkripsi password

 	$password = password_hash($password, PASSWORD_DEFAULT);

 	// menambah user baru ke database
 	mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$nama', '$telfon', '$alamat', '$password')");

 	return mysqli_affected_rows($conn);
}

//<---------------Functions  bagian awal album------------------------->
// Functions tambah
// 	Untuk menambah Album
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

//Uploa album	
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
		 move_uploaded_file($tmpName, '../img/' . $newname);

		 return $newname;
	}

//functions hapus
	//album
	function hapus($id_album){
		global $conn;
		mysqli_query($conn, "DELETE FROM album WHERE idalbum = $id_album");
		return mysqli_affected_rows($conn);
	}

//function edit ubah album
	function edit($data){

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
// function pencarian album
	function cari($katakunci) {

		$query = "SELECT * FROM album WHERE  deskripsi_album LIKE '%$katakunci%' OR nama_album LIKE '%$katakunci%' ";

		return query($query);
	}
// <-------------------------akhir bagian functions album-------------------->

// <--------------------------Bagian pelanggan------------------------------->
	//hapus pelanggan
	function hapuspl($id_pelanggan){
		global $conn;
		mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_pelanggan");
		return mysqli_affected_rows($conn);
	}

	//cari pelnggan
	function search($kunci) {
		$query = "SELECT * FROM users WHERE username LIKE '%$kunci%'";

		return query($query);
	}
//<-------------------------Bagian Akhir pelanggan---------------------------->

//<-------------------------Bagian Awal Barang busana---------------------------->
	//edit busana
	function ubahbusan($data){

		global $conn;

		$id = $data["id"];
		$oldbusana = htmlspecialchars($data["oldbusana"]);
		$harga = htmlspecialchars($data["harga_busana"]);
		$deskripsi = htmlspecialchars($data["desk_busana"]);

		if ( $_FILES['busana']['error'] === 4 ) {
			$busana = $oldbusana;
		}
		else {
			$busana = uploadbusana();
		}

		$query = "UPDATE busanaku SET 
				 busana = '$busana',
				 
				 harga_busana = '$harga', 
				 
				 desk_busana = '$deskripsi'
				 
				 WHERE id_busana = $id";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);

	}

	//hapus busana
	function hapusbusana($id_busana){
		global $conn;
		mysqli_query($conn, "DELETE FROM busanaku WHERE id_busana = $id_busana");
		return mysqli_affected_rows($conn);
	}
	//tambah busana
	function tambahbusan($data) {
		
		global $conn;

		$hargabusana = htmlspecialchars($data["harga_busana"]);
		$desk = htmlspecialchars($data["desk_busana"]);

		//upload busana
		$busana = uploadbusana();
		if (!$busana) {
			return false;
		}

		$query = "INSERT INTO busanaku VALUES('','$busana','$hargabusana','$desk')";

		mysqli_query($conn,$query);

		return mysqli_affected_rows($conn);
	}
	//fungsi upload busana
	function uploadbusana(){

		$namaFile = $_FILES['busana']['name'];
		$ukuranFile = $_FILES['busana']['size'];
		$error  = $_FILES['busana']['error'];
		$tmpName = $_FILES['busana']['tmp_name'];

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
			 move_uploaded_file($tmpName, '../img/' . $newname);

		 	return $newname;
	}

	//cari busa
	function mencari($key) {

		$query = "SELECT * FROM busanaku 

		WHERE desk_busana LIKE '%$key%' OR harga_busana LIKE '%$key%' ";

		return query($query);
	}
//<-------------------------Bagian Akhir Barang---------------------------->