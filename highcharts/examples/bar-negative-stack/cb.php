<?php
	include "koneksi.php";
	$sql = mysql_query("SELECT p.* FROM jumlah_penduduk_umur p, range_umur r WHERE r.id_range= p.id_range AND id_sumber = 1 AND tahun = 2010");
	//$hsl = mysql_fetch_array($sql);
	$i = 1;
	while($hsl = mysql_fetch_array($sql)){
		
	echo (-($hsl['laki'])); 
	echo',';
	//echo $hsl['perempuan'];
	
	$i++;}
	
?>