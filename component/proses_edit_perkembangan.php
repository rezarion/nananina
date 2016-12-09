<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//$query =mysql_query("SELECT * FROM perkembangan_pemukiman a, kelurahan b WHERE a.id_kelurahan = b.id_kelurahan");
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_perkembangan'];
		$perkembangan = $_POST['nilai_perkembangan'];
		
		//$cek = mysql_query("SELECT * FROM perkembangan_pemukiman WHERE id_perkembangan = '$id'");
		
		/*** Nilai/Skor berdasarkan klaster statistika ***/
		if ($perkembangan <= 16774 ) { //Rendah
			$klasifikasi = "1";
		}
		else if ($perkembangan > 16774 && $perkembangan < 33548) { //Sedang
			$klasifikasi = "2";
		} 
		else  if ($perkembangan >= 33548){ //Tinggi
			$klasifikasi = "3";
		};
		
		$sql = "UPDATE perkembangan_pemukiman 
				SET nilai_perkembangan = '$perkembangan', id_klasifikasiperkembangan = '$klasifikasi'
				WHERE id_perkembangan = '$id'";
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data perkembangan pemukiman baru')";
			$status2 = mysql_query($status);
		
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPerkembangan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatPerkembangan");
			
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPerkembangan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatPerkembangan");
			
		};
		
	}else{
		echo mysql_error();
		$_SESSION['error'] = "Proses Dibatalkan";
		echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPerkembangan'/>";
		//header("Location: http://localhost/ta/main.php?menu=lihatPerkembangan");
	};		
?>
