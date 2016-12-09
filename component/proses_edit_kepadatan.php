<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//$query =mysql_query("SELECT * FROM kepadatan_penduduk a, kelurahan b WHERE a.id_kelurahan = b.id_kelurahan");
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_kepadatan'];
		$kepadatan = $_POST['nilai_kepadatan'];
		
		//$cek = mysql_query("SELECT * FROM kepadatan_penduduk WHERE id_kepadatan = '$id'");
		
		/*** Nilai/Skor menurut BPS Nomor 37 Tahun 2010 Pasal 3 ***/
		if ($kepadatan < 1250 ) { //Sangat Renggang
			$klasifikasi = "1";
		}
		else if ($kepadatan >= 1250 && $kepadatan < 2500) { //Renggang
			$klasifikasi = "2";
		} 
		else  if ($kepadatan >= 2500 && $kepadatan < 4000){ // Cukup Renggang
			$klasifikasi = "3";
		}
		else  if ($kepadatan >= 4000 && $kepadatan < 6000){ //Sedang
			$klasifikasi = "4";
		}
		else  if ($kepadatan >= 6000 && $kepadatan < 8000){ //Cukup Padat
			$klasifikasi = "5";
		}
		else  if ($kepadatan >= 7500 && $kepadatan < 8500){ //Padat
			$klasifikasi = "6";
		}
		else  if ($kepadatan >= 8500){ //Sangat Padat
			$klasifikasi = "7";
		};
		
		$sql = "UPDATE kepadatan_penduduk 
				SET nilai_kepadatan = '$kepadatan', id_klasifikasikepadatan = '$klasifikasi'
				WHERE id_kepadatan = '$id'";
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data kepadatan penduduk')";
			$status2 = mysql_query($status);
		
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKepadatan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatKepadatan");
			
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKepadatan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatKepadatan");
			
		};
		
	}else{
		echo mysql_error();
		$_SESSION['error'] = "Proses Dibatalkan";
		echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKepadatan'/>";
		//header("Location: http://localhost/ta/main.php?menu=lihatKepadatan");
	};		
?>
