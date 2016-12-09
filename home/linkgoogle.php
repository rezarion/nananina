<?php 
	session_start();
	
	$_SESSION['id_data'] = $_GET['id'];
	if(ISSET($_GET['stat'])){
		$_SESSION['unset_id'] = 1;
	}else{
		$_SESSION['unset_id'] = 0;
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"0; url=$_SESSION[authGoogle]\">";
?>