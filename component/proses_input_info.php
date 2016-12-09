<?php
	session_start();
	include "config/koneksi.php";
	include "library/injection.php";
	

		$judul = $_POST['judul'];
		$isi = $_POST['isi'];
		//upload
		$gambar = $_FILES['gambar']['name'];
		$source = $_FILES['gambar']['tmp_name'];
		$target = $_FILES['gambar']['name'];
		move_uploaded_file($source,'upload/'.$target);

		$query = "INSERT INTO info(id_info,id_user,judul,gambar,isi) 
				 VALUES('', '$_SESSION[id_user]', '$judul', '$target', '$isi')";
			
		$status ="INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]', 'Tambah data info peraturan dan syarat')";
		
		$hasil = mysql_query($query);
				
		$stat = mysql_query($status);
		
		if(($hasil)||($stat)){
						$_SESSION['success'] = "Data berhasil ditambahkan";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInfo'/>";
					}else{
							$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInfo'/>";
		};

?>