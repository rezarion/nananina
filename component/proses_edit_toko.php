<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	//$id = $_GET['id_toko'];
	//if(isset($_GET['id_toko'])){ $id = $_GET['id_toko']; } 
	//$query = mysql_query('SELECT * FROM lokasi_toko WHERE id_toko='.$id);
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_toko'];
		//$id = isset($_GET['id_toko']) ? $_GET['id_toko'] : '';
		$nama = $_POST['nama'];
		$jenis = $_POST['jenis'];
		$ijin = $_POST['ijin'];
		$terbit = $_POST['terbit'];
		$alamat = $_POST['alamat'];
		$tahun = $_POST['tahun'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		
		$cek = mysql_query("SELECT * FROM lokasi_toko WHERE id_toko = '$id'");
			
		if(mysql_num_rows($cek) == 0){
			$sql = "UPDATE lokasi_toko
					SET nama_toko = '$nama', jenis = '$jenis', ijin = '$ijin', terbit = '$terbit', alamat_toko = '$alamat', tahun = '$tahun', lat = '$lat', lng = '$lng'
					WHERE id_toko = '$id'";
		}else{
			$sql = "UPDATE lokasi_toko
					SET nama_toko = '$nama', jenis = '$jenis', ijin = '$ijin', terbit = '$terbit', alamat_toko = '$alamat', tahun = '$tahun', lat = '$lat', lng = '$lng'
					WHERE id_toko = '$id'";
			};
			
			$hasil = mysql_query($sql);
		
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data lokasi toko modern')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil diubah</strong></div>";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatToko'/>";
				//exit();
				//header("Location: http://localhost/ta2/main.php?menu=lihatToko");

			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editToko'/>";
			};
			
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editToko'/>";
		};
					
?>
