	<?php
	SESSION_start();
	include "koneksi.php";
	
		$update = $_POST['update'];
		
		if (ISSET($update)){		
		$id_user = $_SESSION['id_user'];
		$id = $_GET['id_galeri'];
		$nama = addslashes(htmlentities(trim($_POST['nama_galeri'])));	
		$kat = addslashes(htmlentities(trim($_POST['id_kategori'])));
		

			if(($_FILES['gambar']['name'] == "") || !ISSET($_FILES['gambar']['name'])){
				$tar = '';
			}else{
				$gambar = $_FILES['gambar']['name'];
				$source = $_FILES['gambar']['tmp_name'];
				$target = $_FILES['gambar']['name'];
				move_uploaded_file($source,'../component/gambar/'.$target);
				$tar = "gambar='".$target."',";
			}
			$cek = mysql_query("SELECT gambar FROM gallery WHERE id_galeri='$id'");
			if(mysql_num_rows($cek) == 0){
				$sql = mysql_query("UPDATE gallery SET nama_galeri='$nama', id_kategori='$kat', $tar id_user='$id_user' where id_galeri='$id'");
				$status=" INSERT INTO user_log(id_user,status) VALUES ('$id_user','edit galeri dengan id $id')";
			}else{
				$sql = mysql_query("UPDATE gallery SET nama_galeri='$nama', id_kategori='$kat', $tar id_user='$id_user' where id_galeri='$id'");
				$status=" INSERT INTO user_log(id_user,status) VALUES ('$id_user','edit galeri dengan id $id')";
				$stat = mysql_query($status);
			}
			
			if(($sql) && ($stat)){
				//echo "berhasil";
				//	$_SESSION['success'] = "Update Gallery Berhasil";
					echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatGaleri'/>";
					//echo mysql_error();
				}else{
				//	$_SESSION['error'] = "GAGAL, Terjadi Kesalahan : ".mysql_error();
					echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=editGaleri'/>";
					};
				};
	?>
