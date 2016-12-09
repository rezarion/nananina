<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//$query =mysql_query("SELECT * FROM arus_lalulintas a, kelurahan b WHERE a.id_kelurahan = b.id_kelurahan");
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_arus'];
		$arus = $_POST['nilai_arus'];
		
		//$cek = mysql_query("SELECT * FROM arus_lalulintas WHERE id_arus = '$id'");
		
		/*** Nilai/Skor menurut Peraturan Menteri Perhubungan berdasarkan
		KM 14 Tahun 2006 tentang Manajemen dan Rekayasa Lalu Lintas di Jalan ***/
		if ($arus < 0.6 ) { //LoS A
			$klasifikasi = "1";
		}
		else if ($arus >= 0.6 && $arus < 0.7) { //LoS B
			$klasifikasi = "2";
		} 
		else  if ($arus >= 0.7 && $arus < 0.8){ //LoS C
			$klasifikasi = "3";
		}
		else  if ($arus >= 0.8 && $arus < 0.9){ //LoS D
			$klasifikasi = "4";
		}
		else  if ($arus >= 0.9 && $arus < 1.0){ //LoS E
			$klasifikasi = "5";
		}
		else  if ($arus >= 1.0){ //LoS F
			$klasifikasi = "6";
		};
		
		$sql = "UPDATE arus_lalulintas 
				SET nilai_arus = '$arus', id_klasifikasiarus = '$klasifikasi'
				WHERE id_arus = '$id'";
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data arus lalu lintas')";
			$status2 = mysql_query($status);
		
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatArus'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatArus");
			
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatArus'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatArus");
			
		};
		
	}else{
		echo mysql_error();
		$_SESSION['error'] = "Proses Dibatalkan";
		echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatArus'/>";
		//header("Location: http://localhost/ta/main.php?menu=lihatArus");
	};		
?>
