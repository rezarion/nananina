<?php

//require ('config/koneksi.php');
include "config/koneksi.php";

$sql = "SELECT * FROM `lokasi_pasar`";
			
$data = mysql_query($sql);
$json = '{"penempatantoko": {';
$json .= '"lokasi_pasar":[ ';
while($x = mysql_fetch_array($data)){
	$json .= '{';
	$json .= '"idpasar":"'.$x['id_pasar'].'",
		"nama_pasar":"'.htmlspecialchars($x['nama_pasar']).'",
		"x":"'.$x['lat'].'",
		"y":"'.$x['lng'].'"
	},';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';
$json .= '}}';

echo $json;

?>
