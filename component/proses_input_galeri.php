<?php
		session_start();
		include"koneksi.php";

		$id_user = $_SESSION['id_user'];
		$nama = addslashes(htmlentities(trim($_POST['nama_galeri'])));	
		$kat = addslashes(htmlentities(trim($_POST['id_kategori'])));
		
		$gambar = $_FILES['gambar']['name'];
		$source = $_FILES['gambar']['tmp_name'];
		$target = $_FILES['gambar']['name'];
		$size = ($_FILES['gambar']['size']/1024);
		
		if (($target == "") || ($size < 3)){
			$_SESSION['error'] = "GAGAL, Anda belum memilih file atau ukuran file terlalu besar";
			echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=formGaleri'/>";
		}else{
			move_uploaded_file($source,'../component/gambar/'.$target);
			$query ="INSERT INTO gallery (nama_galeri,gambar,id_user,id_kategori) VALUES ('$nama', '$target', '$id_user','$kat' )";
			$status="INSERT INTO user_log(id_user,status) VALUES ('$id_user','tambah gallery')";
			$hasil = mysql_query($query);
			$stat = mysql_query($status);
			
			if(($hasil) && ($stat)){
				//echo "berhasil";
				$_SESSION['success'] = "gallery Berhasil Ditambah";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=formGaleri'/>";
				//echo mysql_error();
			}else{
				$_SESSION['error'] = "GAGAL, Terjadi Kesalahan : ".mysql_error();
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=formGaleri'/>";
			}
		}

?>
		
