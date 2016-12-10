
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
		//echo "<script>alert('Sukses Reset Pasword');url='../main.php?menu=lihatUser'</script>";
		echo "<script>alert('Sukses Reset Password')</script>";
		echo "<script>location.href=\"main.php?menu=lihatUser\"</script>";
		mysql_close();
	}else{
		echo mysql_error();
		$_SESSION['error']=1;
		//echo "<script>alert('Gagal');url='../main.php?menu=lihatUser'</script>";
		echo "<script>alert('Gagal')</script>";
		echo "<script>location.href=\"main.php?menu=lihatUser\"</script>";
		mysql_close();
	}
	 			
	?>