<?php
require 'functions.php';
session_start();

$id_produk = $_GET["id"];

	if (hapusproduk($id_produk) > 0 ){

		echo "<script>
					alert('Data Berhasil DiHapus');
					document.location.href = 'produk.php';
				 </script>";
	}	
	else {
			echo "<script>
					alert('Data Gagal DiHapus');
					document.location.href = 'produk.php';
				</script>";
	}
?>