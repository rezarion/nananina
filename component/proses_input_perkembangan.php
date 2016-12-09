<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//if(ISSET($_POST['save'])){
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_perkembangan'];	
		$tahun = $_POST['tahun'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$perkembangan = $_POST['nilai_perkembangan'];
	
		$sql2 = mysql_query("SELECT * FROM perkembangan_pemukiman WHERE tahun='$tahun' and id_kelurahan='$kelurahan'");
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPerkembangan/'>";
		}else{
			if(mysql_num_rows($sql2) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPerkembangan'/>";
			}else{
				//$klasifikasi = "";
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
				
				$sql = "INSERT INTO perkembangan_pemukiman (id_perkembangan,tahun,id_kelurahan,nilai_perkembangan,id_klasifikasiperkembangan)
						VALUES ('','$tahun','$kelurahan','$perkembangan','$klasifikasi')";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data perkembangan pemukiman baru')";
				
				$hasil = mysql_query($sql);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){			
					//echo mysql_error();
					$_SESSION['success'] = "Data berhasil ditambahkan";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPerkembangan'/>";
				}else{
						//echo mysql_error();
						$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
						echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPerkembangan'/>";
					};
			};
		};
	//}else{
		//echo mysql_error();
		//$_SESSION['error'] = "Proses Dibatalkan";
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=../main.php?menu=formPerkembangan\">";
	//};
?>