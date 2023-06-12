<?php
require 'functions.php';
session_start();

//hapus di bagian barang busana

$id_album = $_GET["id"];

	if (hapusgaleri($id_album) > 0 ){

		echo "<script>
					alert('Data Berhasil DiHapus');
					document.location.href = 'galeri.php';
				 </script>";
	}	
	else {
			echo "<script>
					alert('Data Gagal DiHapus');
					document.location.href = 'galeri.php';
				</script>";
	}
?>