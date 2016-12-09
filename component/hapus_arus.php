<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	$id = $_GET['id_arus'];
	
	$query = "DELETE FROM arus_lalulintas WHERE id_arus='$id'";
	$hasil = mysql_query($query);
	
	$status= "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]','Hapus data arus lalu lintas')";
	$stat = mysql_query($status);
	
	$_SESSION['success'] = "Data berhasil dihapus";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatArus'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM arus_lalulintas ORDER BY id_arus";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_arus'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE arus_lalulintas SET id_arus = $no WHERE id_arus = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE arus_lalulintas AUTO_INCREMENT = $no";
	mysql_query($query);
?>

