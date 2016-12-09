<?php
	session_start();
	include "koneksi.php";
	
	$update = $_POST['update'];
	
		if (ISSET($update)){
			$nama = addslashes(htmlentities(trim($_POST['nama'])));
			$username = addslashes(htmlentities(trim($_POST['username'])));
		
			$q = mysql_query("SELECT password FROM user WHERE id_user='$_SESSION[id_user]'");
			$s = mysql_fetch_array($q);
			if($_POST['password'] == $s['password']){
				$pass = $s['password'];
			}else{
				$pass = md5($_POST['password']);
			}
		
			if(($_FILES['foto']['name'] == "") || !ISSET($_FILES['foto']['name'])){
				$tar = '';
				$target = "";
			}else{
				$foto = $_FILES['foto']['name'];
				$source = $_FILES['foto']['tmp_name'];
				$target = $_FILES['foto']['name'];
				$size = ($_FILES['foto']['size']/1024);
				$tar = "foto='".$target."',";
			}
			$cek = mysql_query("SELECT foto FROM user WHERE id_user='$_SESSION[id_user]'");
			
			if(($_FILES['foto']['type']=="image/png") || ($_FILES['foto']['type']=="image/jpeg")){	
				move_uploaded_file($source,'../component/foto/'.$target);
				
				$ssas = mysql_query("UPDATE user SET nama='$nama', username='$username', $tar password='$pass' where id_user='$_SESSION[id_user]'");
			}else{
				$ssas = mysql_query("UPDATE user SET nama='$nama', username='$username', password='$pass' where id_user='$_SESSION[id_user]'");
				//$_SESSION['error'] = "GAGAL. Foto yang anda masukkan melebihi ukuran ";
			}
			
			if($ssas){
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editProfile'/>"; //redirect ke halaman form sebelumnya dengan menggunakan sintag meta
			}else{
				echo mysql_error();
				echo "GAGAL LAGI";
			}
		}else {
			echo "aaaaa";
		
		}
		
					
	?>
