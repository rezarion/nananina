<?php
	SESSION_start();
	include"koneksi.php";
	include "library/injection.php";
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_pegawai'];
		$nama = $_POST['nama_pegawai'];
		$gender = $_POST['gender'];
		$jabatan = $_POST['jabatan'];		
		$bday = $_POST['tanggal_lahir'];
		$place = $_POST['tempat_lahir'];
		
		$foto = $_FILES['foto']['name'];
		$source = $_FILES['foto']['tmp_name'];
		$target = $_FILES['foto']['name'];
		$size = ($_FILES['foto']['size']/1024);
		
		if(($_FILES['foto']['type']=="image/png") || ($_FILES['foto']['type']=="image/jpeg")){	
		
		move_uploaded_file($source,'../component/foto/'.$target);
		
		$s = mysql_query("SELECT * FROM pegawai WHERE id_pegawai='$id'");
		
			if(mysql_num_rows($s) > 0){
					$_SESSION['error'] = "DATA DENGAN $id SUDAH ADA ";
					echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPegawai'/>";
			}else{	
				$query ="INSERT INTO pegawai(id_pegawai,nama_pegawai,gender,jabatan,tanggal_lahir,foto,id_user,tempat_lahir) VALUES ('$id', '$nama', '$gender', '$jabatan', '$bday', '$target','$id_user','$place' )";
				
				$status ="INSERT INTO user_log(id_user,status) VALUES ('$id_user', 'Tambah data pegawai')";
				
				$hasil = mysql_query($query);
				
				$stat = mysql_query($status);
				if(($hasil)||($stat)){
						$_SESSION['success'] = "Data berhasil ditambahkan";
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPegawai'/>";
					}else{
							$_SESSION['error'] = "Proses Gagal, Terjadi Kesalahan : ".mysql_error();
							echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPegawai'/>";
				};
			};
		}else{
			$_SESSION['error'] = "Proses Gagal. Anda belum memasukkan foto atau foto yang Anda masukkan melebihi ukuran ";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=formPegawai'/>";
		}
		//}				
?>
