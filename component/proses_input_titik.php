<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
		
		$id_user = $_SESSION['id_user'];
		//$id = $_GET['id_titik'];
		$nama_titik = $_POST['nama_titik'];
		$keberadaan = $_POST['keberadaan'];
		$kepadatan = $_POST['kepadatan'];
		$perkembangan = $_POST['perkembangan'];
		$potensi = $_POST['potensi'];
		$arus = $_POST['arus'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$s = mysql_query("SELECT * FROM titik_rekomendasi WHERE nama_titik='$nama_titik'") or die (mysql_error());
		
			if(mysql_num_rows($s) > 0){
					$_SESSION['error'] = "Data sudah ada ";
					echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formTitik'/>";
			}else{	
				$query ="INSERT INTO titik_rekomendasi(id_titik,nama_titik,c1,c2,c3,c4,c5,lat,lng)
						VALUES ('','$nama_titik', '$keberadaan', '$kepadatan', '$perkembangan', '$potensi', '$arus','$lat','$lng' )";
				
				$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data titik rekomendasi')";
				
				$hasil = mysql_query($query);
				
				$stat = mysql_query($status);
				
				if(($hasil)||($stat)){
						$_SESSION['success'] = "Data berhasil ditambahkan";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formTitik'/>";
					}else{
							$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formTitik'/>";
				};
			};

		//}				
?>
