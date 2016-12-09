<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	$id = $_GET['id_potensi'];
	
	$query = "DELETE FROM potensi_ekonomi WHERE id_potensi='$id'";
	$hasil = mysql_query($query);
	
	$status= "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]','Hapus data potensi ekonomi')";
	$stat = mysql_query($status);
	
	$query2 = "DELETE FROM potensi_ekonomi WHERE nilai_potensi<100";
	$hasil2 = mysql_query($query2);
	
	$_SESSION['success'] = "Data berhasil dihapus";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatPotensi'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM potensi_ekonomi ORDER BY id_potensi";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_potensi'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE potensi_ekonomi SET id_potensi = $no WHERE id_potensi = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE potensi_ekonomi AUTO_INCREMENT = $no";
	mysql_query($query);
?>

