
	<?php
	include "koneksi.php";
	
	//session_start();
	$id = $_GET['kode'];
	$username = md5($_GET['username']);
	
	//$pass = $_POST['password'];
	//echo $id;
	//echo $username;
	$update = mysql_query("UPDATE user SET password='$username' where id_user='$id'");
	
	 if($update){
		$_SESSION['success']=1;
		echo mysql_error();
		echo "<script>alert('Sukses Reset Paswword');document.location='../TA2/main.php?menu=lihatUser'</script>";
		mysql_close();
	}else{
		echo mysql_error();
		$_SESSION['error']=1;
		echo "<script>alert('Gagal');document.location='../TA2/main.php?menu=lihatUser'</script>";
		mysql_close();
	}
	 			
	?>