<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
		
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_toko'];
		$nama = $_POST['nama'];
		$jenis = $_POST['jenis'];
		$ijin = $_POST['ijin'];
		$terbit = $_POST['terbit'];
		//$terbit = date('d-m-Y, H:i:s', strtotime($_POST['terbit']));
		$kelurahan = clear_injection($_POST['kelurahan']);
		$alamat = $_POST['alamat'];
		$tahun = $_POST['tahun'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$s = mysql_query("SELECT * FROM lokasi_toko WHERE nama_toko='$nama' and id_kelurahan='$kelurahan'") or die (mysql_error());
		
		if(($tahun==0) || ($kelurahan==0)){
			$_SESSION['error'] = "Data belum lengkap. Tahun, Kecamatan, dan Kelurahan harap diisi";
			//echo mysql_error();
			echo "<meta http-equiv='refresh' content='0; url=../main.php?menu=formToko/'>";
		}else{	
			if(mysql_num_rows($s) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formToko'/>";
			}else{	
				$query ="INSERT INTO lokasi_toko(id_toko,nama_toko,jenis,ijin,terbit,id_kelurahan,alamat_toko,tahun,lat,lng)
						VALUES ('','$nama', '$jenis', '$ijin', '$terbit', '$kelurahan', '$alamat', '$tahun', '$lat','$lng' )";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data lokasi toko modern')";
				
				$hasil = mysql_query($query);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){
						$_SESSION['success'] = "Data berhasil ditambahkan";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formToko'/>";
					}else{
							$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formToko'/>";
				};
			};

		};				
?>
