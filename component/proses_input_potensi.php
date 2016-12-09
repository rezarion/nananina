<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	//if(ISSET($_POST['save'])){
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_potensi'];	
		$tahun = $_POST['tahun'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$potensi = $_POST['nilai_potensi'];
	
		$sql2 = mysql_query("SELECT * FROM potensi_ekonomi WHERE tahun='$tahun' and id_kelurahan='$kelurahan'");
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPotensi/'>";
		}else{
			if(mysql_num_rows($sql2) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPotensi'/>";
			}else{
				//$klasifikasi = "";
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
				
				$sql = "INSERT INTO potensi_ekonomi (id_potensi,tahun,id_kelurahan,nilai_potensi,id_klasifikasipotensi)
						VALUES ('','$tahun','$kelurahan','$potensi','$klasifikasi')";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data potensi ekonomi')";
				
				$hasil = mysql_query($sql);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){			
					//echo mysql_error();
					$_SESSION['success'] = "Data berhasil ditambahkan";
					echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPotensi'/>";
				}else{
						//echo mysql_error();
						$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
						echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPotensi'/>";
					};
			};
		};
	//}else{
		//echo mysql_error();
		//$_SESSION['error'] = "Proses Dibatalkan";
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=../main.php?menu=formPotensi\">";
	//};
?>