<?php
	SESSION_start();
	include"koneksi.php";
	include "library/injection.php";
	
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_user'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$pass = md5($_POST['password'];		
		$level = $_POST['level'];
		
		$foto = $_FILES['foto']['name'];
		$source = $_FILES['foto']['tmp_name'];
		$target = $_FILES['foto']['name'];
		$size = ($_FILES['foto']['size']/1024);
		
		if((($_FILES['foto']['type']=="image/png") || ($_FILES['foto']['type']=="image/jpeg")) && ($size < 3)){	
		
			move_uploaded_file($source,'../component/foto/'.$target);
			
			$s = mysql_query("SELECT * FROM user WHERE id_user='$id' OR username='$username'");
			
			if($level==0){
				$_SESSION['error'] = "Data belum lengkap ";
				//echo mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInputUser'/>";
			}else{
					if(mysql_num_rows($s) > 0){
							$_SESSION['error'] = "Data sudah ada ";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInputUser'/>";
					}else{	
						$query ="INSERT INTO user(id_user,nama,username,password,level,foto) VALUES ('$id', '$nama', '$username', '$pass', '$level', '$target' )";
						
						$status ="INSERT INTO user_log(id_user,status) VALUES ('$id_user', 'Tambah data user')";
						
						$hasil = mysql_query($query);
						
						$stat = mysql_query($status);
						
						if(($hasil)||($stat)){
								$_SESSION['success'] = "Data berhasil ditambahkan";
									echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInputUser'/>";
							}else{
									$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
									echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInputUser'/>";
						};
					};
			};			
		}else{
			$_SESSION['error'] = "Proses gagal. Anda belum memasukkan foto atau foto yang Anda masukkan melebihi ukuran ";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formInputUser'/>";
		};
?>
