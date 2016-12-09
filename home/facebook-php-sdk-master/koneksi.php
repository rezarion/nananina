<?php
	
	//definisi konstanta konfigurasi parameter keperluan koneksi database
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'dashboard';

	$koneksi = mysql_connect($host,$user,$password) or die(mysql_error());
	mysql_select_db($database) or die(mysql_error());
?>