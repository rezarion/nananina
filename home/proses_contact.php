<?php
	
		include "koneksi.php";

		if(ISSET($_POST['save'])){
		$nama = $_POST['nama'];
		$email = $_POST['email'];	
		$pesan = $_POST['pesan'];
		$status = $_POST['status'];
				
		$query ="INSERT INTO guest(nama,email,pesan,status) VALUES ('$nama', '$email', '$pesan','0')";
		
		$hasil = mysql_query($query);
		}
			if($hasil){
				//echo "berhasil";
				//$_SESSION['success'] = "OK";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=contact'/>";
				//echo mysql_error();
			}else{
				//$_SESSION['error'] = "GAGAL, Terjadi Kesalahan : ".mysql_error();
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=contact'/>";
			}
	

?>
		
