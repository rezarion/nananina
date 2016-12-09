<?php
	session_start();
	include "component/koneksi.php";

	$userid =  addslashes(htmlentities($_POST['username']));
	$password = md5(addslashes(htmlentities($_POST['password'])));

	if ((!$userid) or (!$password)) {
		echo"<meta http-equiv='refresh' content='0;url=index.php' />";
	}else{

		$query_login = mysql_query("select * from user where username='$userid' and password='$password'");
		//echo (mysql_error());
		$dd = mysql_fetch_array($query_login);
		
		if(mysql_num_rows($query_login) > 0){
			$_SESSION['username'] = $dd['username'];
			$_SESSION['id_user'] = $dd['id_user'];
			$_SESSION['level'] = $dd['level'];
			$_SESSION['nama_user'] = $dd['nama'];
			
			echo"<meta http-equiv='refresh' content='0;url=main.php' />";
		}else{
			echo"<meta http-equiv='refresh' content='0;url=login.php' />";
		}
	}
?>