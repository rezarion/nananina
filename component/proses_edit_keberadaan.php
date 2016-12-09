<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//$query =mysql_query("SELECT * FROM keberadaan_sarana a, kelurahan b WHERE a.id_kelurahan = b.id_kelurahan");
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_keberadaan'];
		$keberadaan = $_POST['banyak_sarana'];
		
		//$cek = mysql_query("SELECT * FROM keberadaan_sarana WHERE id_keberadaan = '$id'");
		
		/*** Nilai/Skor berdasarkan klaster statistika ***/
		if ($keberadaan <= 100 ) { //sedikit
			$klasifikasi = "1";
		}
		else if ($keberadaan > 100 && $keberadaan <= 200) { //kurang
			$klasifikasi = "2";
		} 
		else if ($keberadaan > 200 && $keberadaan <= 300) { //sedang
			$klasifikasi = "3";
		} 
		else if ($keberadaan > 300 && $keberadaan <= 400) { //cukup
			$klasifikasi = "4";
		} 
		else  if ($keberadaan > 400){ //banyak
			$klasifikasi = "5";
		};
		
		$sql = "UPDATE keberadaan_sarana 
				SET banyak_sarana = '$keberadaan', id_klasifikasikeberadaan = '$klasifikasi'
				WHERE id_keberadaan = '$id'";
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data keberadaan sarana')";
			$status2 = mysql_query($status);
		
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKeberadaan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatKeberadaan");
			
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKeberadaan'/>";
			//header("Location: http://localhost/ta/main.php?menu=lihatKeberadaan");
			
		};
		
	}else{
		echo mysql_error();
		$_SESSION['error'] = "Proses Dibatalkan";
		echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKeberadaan'/>";
		//header("Location: http://localhost/ta/main.php?menu=lihatKeberadaan");
	};		
?>
