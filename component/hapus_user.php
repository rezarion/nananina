<?php
	include "koneksi.php";
	
	$get_hapus = $_GET['kode'];
	
	$query = "DELETE FROM user WHERE id_user = '$get_hapus'";
	$hasil = mysql_query($query);
	
	$status = "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]', 'Hapus data user')";
	$stat = mysql_query($status);
	
	$_SESSION['success'] = "Data berhasil dihapus";
	//echo "data dengan id = $get_hapus sudah dihapus.</div>";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatUser'/>";
	
?>

