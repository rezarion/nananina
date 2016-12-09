	<?php
	SESSION_start();
	include "koneksi.php";
	include "library/injection.php";
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id = $_GET['id_user'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$pass = $_POST['password'];
		$level = $_POST['level'];
			
		if(($_FILES['foto']['name'] == "") || !ISSET($_FILES['foto']['name'])){
			$tar = '';
		}else{
			$foto = $_FILES['foto']['name'];
			$source = $_FILES['foto']['tmp_name'];
			$target = $_FILES['foto']['name'];
			$size = ($_FILES['foto']['size']/1024);
			move_uploaded_file($source,'../component/foto/'.$target);
			$tar = "foto='".$target."',";
		}
		
		$cek = mysql_query("SELECT foto FROM user WHERE id_user='$id'");
			
		if(mysql_num_rows($cek) == 0){
			$sql = "UPDATE user
								SET nama='$nama', username='$username', password='$pass', $tar level='$level'
								WHERE id_user='$id'";
		}else{
			$sql = "UPDATE user
								SET nama='$nama', username='$username', password='$pass' ,$tar level='$level'
								WHERE id_user='$id'";
		}
		
		$hasil = mysql_query($sql);
		
		if($hasil){
			$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data user')";
			$status2 = mysql_query($status);
			
			echo mysql_error();
			$_SESSION['success'] = "Data berhasil diubah";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatUser'/>";
		
		}else{
			echo mysql_error();
			$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editProfile'/>";
		}
	
	}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editProfile'/>";
		};
					
?>
