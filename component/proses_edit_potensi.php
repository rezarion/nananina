<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//$query =mysql_query("SELECT * FROM potensi_ekonomi a, kelurahan b WHERE a.id_kelurahan = b.id_kelurahan");
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_potensi'];
		$potensi = $_POST['nilai_potensi'];
		
		//$cek = mysql_query("SELECT * FROM potensi_ekonomi WHERE id_potensi = '$id'");
		
		/*** Nilai/Skor berdasarkan klaster statistika ***/
		if ($potensi <= 913864.56 ) { //Rendah
			$klasifikasi = "1";
		}
		else if ($potensi > 913864.56 && $potensi < 1827729.13) { //Sedang
			$klasifikasi = "2";
		} 
		else  if ($potensi >= 1827729.13){ //Tinggi
			$klasifikasi = "3";
		};
		
		$sql = "UPDATE potensi_ekonomi 
				SET nilai_potensi = '$potensi', id_klasifikasipotensi = '$klasifikasi'
				WHERE id_potensi = '$id'";
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data potensi ekonomi')";
			$status2 = mysql_query($status);
		
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPotensi'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatPotensi");
			
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPotensi'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatPotensi");
			
		};
		
	}else{
		echo mysql_error();
		$_SESSION['error'] = "Proses Dibatalkan";
		echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPotensi'/>";
		//header("Location: http://localhost/ta/main.php?menu=lihatPotensi");
	};		
?>
