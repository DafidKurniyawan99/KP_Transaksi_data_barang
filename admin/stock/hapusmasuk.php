<?php
require 'functions.php';
session_start();

//hapus di bagian barang busana

$id_masuk = $_GET["id"];

	if (hapusmasuk($id_masuk) > 0 ){

		echo "<script>
					alert('Data Berhasil DiHapus');
					document.location.href = 'barangmasuk.php';
				 </script>";
	}	
	else {
			echo "<script>
					alert('Data Gagal DiHapus');
					document.location.href = 'barangmasuk.php';
				</script>";
	}
?>