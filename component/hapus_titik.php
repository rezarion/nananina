<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	//membaca ID dari data yg akan dihapus
	$id= $_GET['id_titik'];
	
	//query hapus data berdasarkan ID
	$query = "DELETE FROM titik_rekomendasi WHERE id_titik = '$id'";
	$hasil = mysql_query($query);
	
	//query aktivitas user hapus data
	$status = "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]', 'Hapus data titik rekomendasi')";
	$stat = mysql_query($status);
	
	//konfirmasi penghapusan
	//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil dihapus</strong></div>";
	$_SESSION['success'] = "Data berhasil dihapus";
	
	//redirect ke halaman form sebelumnya dengan menggunakan sintag meta
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatTitik'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM titik_rekomendasi ORDER BY id_titik";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_titik'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE titik_rekomendasi SET id_titik = $no WHERE id_titik = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE titik_rekomendasi AUTO_INCREMENT = $no";
	mysql_query($query);

?>

