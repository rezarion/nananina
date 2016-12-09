<?php
	SESSION_start();
	include "koneksi.php";
	include "library/injection.php";
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_GET['id_pegawai'];
		$nama = $_POST['nama_pegawai'];
		$gender = $_POST['gender'];
		$jabatan = $_POST['jabatan'];		
		$bday = $_POST['tanggal_lahir'];
		$place = $_POST['tempat_lahir'];
			
			if(($_FILES['foto']['name'] == "") || !ISSET($_FILES['foto']['name'])){
				$tar = '';
			}else{
				$foto = $_FILES['foto']['name'];
				$source = $_FILES['foto']['tmp_name'];
				$target = $_FILES['foto']['name'];
				move_uploaded_file($source,'../component/foto/'.$target);
				$tar = "foto='".$target."',";
			}
			
			$cek = mysql_query("SELECT foto FROM pegawai WHERE id_pegawai='$id'");
			
			if(mysql_num_rows($cek) == 0){
				$sql = "UPDATE pegawai
						SET nama_pegawai='$nama', gender='$gender', jabatan='$jabatan', id_user='$id_user',tanggal_lahir='$bday', $tar tempat_lahir='$place'
						WHERE id_pegawai='$id'";
			}else{
				$sql = "UPDATE pegawai
						SET nama_pegawai='$nama', gender='$gender', jabatan='$jabatan', id_user='$id_user', tanggal_lahir='$bday', $tar tempat_lahir='$place'
						WHERE id_pegawai='$id'";
			}
			
			$hasil = mysql_query($sql);
			
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data pegawai')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatPegawai'/>";
			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=editPegawai'/";
			}
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editPegawai'/>";
		};
					
?>
