<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
		
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_pasar'];
		$nama = $_POST['nama'];
		$golongan = $_POST['golongan'];
		$uptd = $_POST['uptd'];
		$kelurahan = clear_injection($_POST['kelurahan']);
		$alamat = $_POST['alamat'];
		$tahun = $_POST['tahun'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$s = mysql_query("SELECT * FROM lokasi_pasar WHERE nama_pasar='$nama' and id_kelurahan='$kelurahan'") or die (mysql_error());
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formPasar/'>";
		}else{	
			if(mysql_num_rows($s) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPasar'/>";
			}else{	
				$query ="INSERT INTO lokasi_pasar(id_pasar,nama_pasar,golongan,uptd,id_kelurahan,alamat_pasar,tahun,lat,lng)
						VALUES ('','$nama', '$golongan', '$uptd' '$kelurahan', '$alamat', '$tahun', '$lat','$lng' )";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data lokasi pasar tradisional')";
				
				$hasil = mysql_query($query);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){
						$_SESSION['success'] = "Data berhasil ditambahkan";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPasar'/>";
					}else{
							$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPasar'/>";
				};
			};

		};				
?>
