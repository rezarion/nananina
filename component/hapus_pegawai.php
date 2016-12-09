<?php
	include "koneksi.php";
	
	$get_hapus = $_GET['kode'];
	
	$query = "DELETE FROM pegawai WHERE id_pegawai = '$get_hapus'";
	$hasil = mysql_query($query);
	
	$status = "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]', 'Hapus data pegawai')";
	$stat = mysql_query($status);
	
	//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>'data dengan id = $get_hapus sudah dihapus'</strong></div>";
	$_SESSION['success'] = "Data berhasil dihapus";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatPegawai'/>";
	
?>

