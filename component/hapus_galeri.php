<?php
	include "koneksi.php";
	
	$get_hapus = $_GET['kode'];
	mysql_query ("DELETE FROM gallery WHERE id_galeri = '$get_hapus'");
	//echo "data dengan kode = $get_hapus sudah dihapus.</div>";
	echo"<meta http-equiv='refresh' content='0;url=main.php?menu=lihatGaleri'/>"; //redirect ke halaman form sebelumnya dengan menggunakan sintag meta
	
?>

