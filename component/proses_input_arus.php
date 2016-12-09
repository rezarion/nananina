<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//if(ISSET($_POST['save'])){
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_arus'];	
		$tahun = $_POST['tahun'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$arus = $_POST['nilai_arus'];
	
		$sql2 = mysql_query("SELECT * FROM arus_lalulintas WHERE tahun='$tahun' and id_kelurahan='$kelurahan'");
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formArus/'>";
		}else{
			if(mysql_num_rows($sql2) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formArus'/>";
			}else{
				//$klasifikasi = "";
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
				
				$sql = "INSERT INTO arus_lalulintas (id_arus,tahun,id_kelurahan,nilai_arus,id_klasifikasiarus)
						VALUES ('','$tahun','$kelurahan','$arus','$klasifikasi')";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data arus lalu lintas')";
				
				$hasil = mysql_query($sql);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){			
					//echo mysql_error();
					$_SESSION['success'] = "Data berhasil ditambahkan";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formArus'/>";
				}else{
						//echo mysql_error();
						$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
						echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formArus'/>";
					};
			};
		};
	//}else{
		//echo mysql_error();
		//$_SESSION['error'] = "Proses Dibatalkan";
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=../main.php?menu=formArus\">";
	//};
?>