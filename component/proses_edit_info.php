<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	
	$x = mysql_query("SELECT * FROM info WHERE id_info = '$_GET[id]'");
	$g = mysql_fetch_array($x);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		$id = $_GET['id'];
		$judul = $_POST['judul'];	
		$isi = $_POST['isi'];

		// foto
		$gambar = $_FILES['gambar']['name'];
		$source = $_FILES['gambar']['tmp_name'];
		$target = $_FILES['gambar']['name'];
		move_uploaded_file($source,'upload/'.$target);
		
		$x1 = mysql_query("SELECT * FROM info WHERE id_info = '$_GET[id]'");
		$g1 = mysql_fetch_array($x1);
		
		if($target == ""){
				$tar = $g1['gambar'];
		}else{
				$tar = $target;
		}
		
		if(mysql_num_rows($x1) == 0){
			$sql = "UPDATE info
					SET judul = '$judul', isi = '$isi', gambar = '$tar'
					WHERE id_info = '$id'";
		}else{
			$sql = "UPDATE info
					SET judul = '$judul', isi = '$isi', gambar = '$tar'
					WHERE id_info = '$id'";
			};
			
			$hasil = mysql_query($sql);
		
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data info peraturan dan syarat')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil diubah</strong></div>";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatInfo'/>";
				//exit();
				//header("Location: http://localhost/ta2/main.php?menu=lihatLokasi");

			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editInfo'/>";
			};
			
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editInfo'/>";
		};
					
?>