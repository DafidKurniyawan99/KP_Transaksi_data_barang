<?php
require 'functions.php';
session_start();

//hapus di bagian barang busana

$idbarang = $_GET["id"];

	if (hapusbarang($idbarang) > 0 ){

		echo "<script>
					alert('Data Berhasil DiHapus');
					document.location.href = 'stok.php';
				 </script>";
	}	
	else {
			echo "<script>
					alert('Data Gagal DiHapus');
					document.location.href = 'stok.php';
				</script>";
	}
?>