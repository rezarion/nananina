<?php
	include "koneksi.php";
	
	$get_hapus = $_SESSION['id_user'];
	mysql_query ("DELETE foto FROM user WHERE id_user = '$get_hapus'");
	echo "data dengan kode = $get_hapus sudah dihapus.</div>";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=editprofile'/>"; //redirect ke halaman form sebelumnya dengan menggunakan sintag meta
	
?>

