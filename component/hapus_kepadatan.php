<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	$id = $_GET['id_kepadatan'];
	
	$query = "DELETE FROM kepadatan_penduduk WHERE id_kepadatan='$id'";
	$hasil = mysql_query($query);
	
	$status= "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]','Hapus data kepadatan penduduk')";
	$stat = mysql_query($status);
	
	$_SESSION['success'] = "Data berhasil dihapus";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatKepadatan'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM kepadatan_penduduk ORDER BY id_kepadatan";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_kepadatan'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE kepadatan_penduduk SET id_kepadatan = $no WHERE id_kepadatan = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE kepadatan_penduduk AUTO_INCREMENT = $no";
	mysql_query($query);
?>

