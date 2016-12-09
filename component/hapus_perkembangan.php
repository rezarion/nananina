<?php
	//koneksi ke mysql
	include "config/koneksi.php";
	
	$id = $_GET['id_perkembangan'];
	
	$query = "DELETE FROM perkembangan_pemukiman WHERE id_perkembangan='$id'";
	$hasil = mysql_query($query);
	
	$status= "INSERT INTO user_log(id_log,id_user,status)
				VALUES ('','$_SESSION[id_user]','Hapus data perkembangan pemukiman baru')";
	$stat = mysql_query($status);
	
	$_SESSION['success'] = "Data berhasil dihapus";
	echo"<meta http-equiv='refresh' content='1;url=main.php?menu=lihatPerkembangan'/>";
	
	//query utk membaca semua data dg sorting berdasarkan ID secara descending
	//sorting descending ini utk mengantisipasi record yg urutan ID nya tidak urut dlm setiap barisnya.
	//Misal 1, 4, 2, 5, 3
	$query = "SELECT * FROM perkembangan_pemukiman ORDER BY id_perkembangan";
	$hasil = mysql_query($query);
	
	//nilai awal increment
	$no = 1;
	
	while($data = mysql_fetch_array($hasil))
	{
		//membaca ID dari record yg tersisa dlm tabel
		$id = $data['id_perkembangan'];
		
		//proses updating ID dg nilai $no
		$query2 = "UPDATE perkembangan_pemukiman SET id_perkembangan = $no WHERE id_perkembangan = $id";
		mysql_query($query2);
		
		//increment $no
		$no++;
	}
	
	//mengubah nilai auto increment menjadi $no terakhir ditambah 1
	$query = "ALTER TABLE perkembangan_pemukiman AUTO_INCREMENT = $no";
	mysql_query($query);
?>

