<?php
	session_start();
	
	include"koneksi.php";
	
	$tombol = $_POST["tombolproses"];
	if (!empty($tombol))
	{
		$passold = $_POST["passwordlama"]; //password lama dari form
		$passnew = $_POST["passwordbaru"]; //password baru dari form
		
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
				
		$sql = "SELECT * FROM user WHERE id_user='$username'";
		$hasil = mysql_query($sql);
		
		$baris = mysql_fetch_row($hasil);
		$passdb = $baris[2]; //password di DB
		
		$pass = md5($passold);
		$passwordnew = md5($passnew);
		
		//echo "Password form = ".$pass;
		//echo "<br>";
		//echo "password di database".$passdb;
		if ($passdb == $pass){
		$sql = "UPDATE user SET password ='$passwordnew' WHERE id_user='$username' ";
		$query = mysql_query($sql);
			echo "<script>alert('Password berhasil diganti')</script>";
			
			$_SESSION["password"] = $passnew;
			echo "<script>location.href=\"main.php?menu=editProfile\"</script>";
		}
		else
		{
			echo "<script>alert('Password gagal diganti')</script>";
			echo "<script>location.href=\"main.php?menu=editProfile\"</script>";
		}
		
	}else
	{
		echo "<script> alert('Tidak Ada Kode');
		url='main.php'</script>";
	}
?>

