<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//if(ISSET($_POST['save'])){
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_kepadatan'];	
		$tahun = $_POST['tahun'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$kepadatan = $_POST['nilai_kepadatan'];
	
		$sql2 = mysql_query("SELECT * FROM kepadatan_penduduk WHERE tahun='$tahun' and id_kelurahan='$kelurahan'");
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKepadatan/'>";
		}else{
			if(mysql_num_rows($sql2) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKepadatan'/>";
			}else{
				//$klasifikasi = "";
				/*** Nilai/Skor menurut BPS Nomor 37 Tahun 2010 Pasal 3 ***/
				if ($kepadatan < 1250 ) { //Sangat Renggang
					$klasifikasi = "1";
				}
				else if ($kepadatan >= 1250 && $kepadatan < 2500) { //Renggang
					$klasifikasi = "2";
				} 
				else  if ($kepadatan >= 2500 && $kepadatan < 4000){ //Cukup Renggang
					$klasifikasi = "3";
				}
				else  if ($kepadatan >= 4000 && $kepadatan < 6000){ //Sedang
					$klasifikasi = "4";
				}
				else  if ($kepadatan >= 6000 && $kepadatan < 7500){ //Cukup Padat
					$klasifikasi = "5";
				}
				else  if ($kepadatan >= 7500 && $kepadatan < 8500){ //Padat
					$klasifikasi = "6";
				}
				else  if ($kepadatan >= 8500){ //Sangat Padat
					$klasifikasi = "7";
				};
				
				$sql = "INSERT INTO kepadatan_penduduk (id_kepadatan,tahun,id_kelurahan,nilai_kepadatan,id_klasifikasikepadatan)
						VALUES ('','$tahun','$kelurahan','$kepadatan','$klasifikasi')";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data kepadatan penduduk')";
				
				$hasil = mysql_query($sql);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){			
					//echo mysql_error();
					$_SESSION['success'] = "Data berhasil ditambahkan";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKepadatan'/>";
				}else{
						//echo mysql_error();
						$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
						echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formKepadatan'/>";
					};
			};
		};
	//}else{
		//echo mysql_error();
		//$_SESSION['error'] = "Proses Dibatalkan";
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=../main.php?menu=formKepadatan\">";
	//};
?>