<?php
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "penempatantoko";

	$connect = mysql_connect($host, $username, $password);
	mysql_select_db($database, $connect) or Die("MySQL Gagal Koneksi");
	
	
	/*
	$server = "localhost";
	$user = "root";
	$password = "";
	  
	$id_mysql = mysql_connect($server, $user, $password);	
	$db_toko = mysql_select_db("penempatantoko", $id_mysql);
	*/
	
	$base_url = 'http://localhost/ta2/'
	
?>
