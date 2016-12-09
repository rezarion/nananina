<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	//$id = $_GET['id_pasar'];
	//if(isset($_GET['id_pasar'])){ $id = $_GET['id_pasar']; } 
	//$query = mysql_query('SELECT * FROM lokasi_pasar WHERE id_pasar='.$id);
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_pasar'];
		//$id = isset($_GET['id_pasar']) ? $_GET['id_pasar'] : '';
		$nama = $_POST['nama'];
		$golongan = $_POST['golongan'];
		$uptd = $_POST['uptd'];
		$alamat = $_POST['alamat'];
		$tahun = $_POST['tahun'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$cek = mysql_query("SELECT * FROM lokasi_pasar WHERE id_pasar = '$id'");
			
		if(mysql_num_rows($cek) == 0){
			$sql = "UPDATE lokasi_pasar
					SET nama_pasar = '$nama', golongan = '$golongan', uptd = '$uptd', alamat_pasar = '$alamat', tahun = '$tahun', lat = '$lat', lng = '$lng'
					WHERE id_pasar = '$id'";
		}else{
			$sql = "UPDATE lokasi_pasar
					SET nama_pasar = '$nama', golongan = '$golongan', uptd = '$uptd', alamat_pasar = '$alamat', tahun = '$tahun', lat = '$lat', lng = '$lng'
					WHERE id_pasar = '$id'";
			};
			
			$hasil = mysql_query($sql);
		
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data lokasi pasar tradisional')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil diubah</strong></div>";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPasar'/>";
				//exit();
				//header("Location: http://localhost/ta2/main.php?menu=lihatPasar");

			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editPasar'/>";
			};
			
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editPasar'/>";
		};
					
?>
