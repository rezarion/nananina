<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//if(ISSET($_POST['save'])){
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_keberadaan'];	
		$tahun = $_POST['tahun'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$keberadaan = $_POST['banyak_sarana'];
	
		$sql2 = mysql_query("SELECT * FROM keberadaan_sarana WHERE tahun='$tahun' and id_kelurahan='$kelurahan'");
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKeberadaan/'>";
		}else{
			if(mysql_num_rows($sql2) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKeberadaan'/>";
			}else{
				//$klasifikasi = "";
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
				
				$sql = "INSERT INTO keberadaan_sarana (id_keberadaan,tahun,id_kelurahan,banyak_sarana,id_klasifikasikeberadaan)
						VALUES ('','$tahun','$kelurahan','$keberadaan','$klasifikasi')";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data keberadaan sarana')";
				
				$hasil = mysql_query($sql);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){			
					//echo mysql_error();
					$_SESSION['success'] = "Data berhasil ditambahkan";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKeberadaan'/>";
				}else{
						//echo mysql_error();
						$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
						echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKeberadaan'/>";
					};
			};
		};
	//}else{
		//echo mysql_error();
		//$_SESSION['error'] = "Proses Dibatalkan";
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=../main.php?menu=formKeberadaan\">";
	//};
?>