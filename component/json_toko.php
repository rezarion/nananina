<?php

//require ('config/koneksi.php');
include "config/koneksi.php";

$sql = "SELECT * FROM `lokasi_toko`";
			
$data = mysql_query($sql);
$json = '{"penempatantoko": {';
$json .= '"lokasi_toko":[ ';
while($x = mysql_fetch_array($data)){
	$json .= '{';
	$json .= '"idtoko":"'.$x['id_toko'].'",
		"nama_toko":"'.htmlspecialchars($x['nama_toko']).'",
		"x":"'.$x['lat'].'",
		"y":"'.$x['lng'].'"
	},';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';
$json .= '}}';

echo $json;

?>
