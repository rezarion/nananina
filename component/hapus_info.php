<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	//membaca ID dari data yg akan dihapus
	$id= $_GET['id_info'];
	
	//query hapus data berdasarkan ID
	$query = "DELETE FROM info WHERE id_info = '$id'";
	$hasil = mysql_query($query);
	
	//query aktivitas user hapus data
	$status = "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]', 'Hapus data info peraturan dan syarat')";
	$stat = mysql_query($status);
	
	//konfirmasi penghapusan
	//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil dihapus</strong></div>";
	$_SESSION['success'] = "Data berhasil dihapus";
	
	//redirect ke halaman form sebelumnya dengan menggunakan sintag meta
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatInfo'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM info ORDER BY id_info";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_info'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE info SET id_info = $no WHERE id_info = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE info AUTO_INCREMENT = $no";
	mysql_query($query);

?>