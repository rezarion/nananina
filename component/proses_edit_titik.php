<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	//$id = $_GET['id_titik'];
	//if(isset($_GET['id_titik'])){ $id = $_GET['id_titik']; } 
	//$query = mysql_query('SELECT * FROM titik_rekomendasi WHERE id_titik='.$id);
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_titik'];
		//$id = isset($_GET['id_titik']) ? $_GET['id_titik'] : '';
		$nama_titik = $_POST['nama_titik'];
		$keberadaan = $_POST['keberadaan'];
		$kepadatan = $_POST['kepadatan'];
		$perkembangan = $_POST['perkembangan'];
		$potensi = $_POST['potensi'];
		$arus = $_POST['arus'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$cek = mysql_query("SELECT * FROM titik_rekomendasi WHERE id_titik = '$id'");
			
		if(mysql_num_rows($cek) == 0){
			$sql = "UPDATE titik_rekomendasi
					SET nama_titik = '$nama_titik ', c1 = '$keberadaan', c2 = '$kepadatan', c3 = '$perkembangan', c4 = '$potensi', c5 = '$arus', lat = '$lat', lng = '$lng'
					WHERE id_titik = '$id'";
		}else{
			$sql = "UPDATE titik_rekomendasi
					SET nama_titik = '$nama_titik ', c1 = '$keberadaan', c2 = '$kepadatan', c3 = '$perkembangan', c4 = '$potensi', c5 = '$arus', lat = '$lat', lng = '$lng'
					WHERE id_titik = '$id'";
			};
			
			$hasil = mysql_query($sql);
		
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data titik rekomendasi')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil diubah</strong></div>";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatTitik'/>";
				//exit();
				//header("Location: http://localhost/ta2/main.php?menu=lihatTitik");

			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editTitik'/>";
			};
			
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editTitik'/>";
		};
					
?>
