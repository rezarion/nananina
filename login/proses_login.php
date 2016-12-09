<?php
include "component/koneksi.php";

session_start();

$userid = $_POST['username'];
$password = md5($_POST['password']);

if ((!$userid) or (!$password)) {
echo "<script lang=java>
                    window.alert('ACCESS DENIED !');
                </script>
                <meta http-equiv='refresh' content='1;url=main.php'>";
}
else
{

	//echo $password."test ";
	$query_login = mysql_query("select * from admin where username='$userid' and password='$password'") ;
	

	//echo "select * from admin where username='$userid' and password='$password'";

	//or die (mysql_eror());
	$dd = mysql_fetch_array($query_login);
	$row = mysql_num_rows($query_login);
	if ($row==1){
		$_SESSION ['admin'] = $dd ['username'] ;
		$_SESSION ['id_admin'] = $dd['id_admin'] ;
		
		echo"<meta http-equiv='refresh' content='0;url=index.php'/>"; 
	//}else{
		//echo $password."test ";
	//	$query_login = mysql_query("select * from member where member_id='$userid' and password='$password'") ;
		
		//echo "select * from admin where username='$userid' and password='$password'";

		//or die (mysql_eror());
		//$mm = mysql_fetch_array($query_login);
		//$mrow = mysql_num_rows($query_login);
		//if ($mrow==1){
			//$_SESSION ['member_name'] = $mm['member_name'] ;
			//$_SESSION ['member_id'] = $mm['member_id'] ;
	//		echo"<meta http-equiv='refresh' content='0;url=member.php'/>"; 	
		}else{
			echo $row."password salah";
			echo"<meta http-equiv='refresh' content='0;url=login.php'/>"; //redirect ke halaman form sebelumnya dengan menggunakan sintag meta
		}
	}
}
?>