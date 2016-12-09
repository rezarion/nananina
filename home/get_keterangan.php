<?php
ini_set('display_errors',0);
include "koneksi.php";

$id_kat = $_POST['id_kat']; 

$id_select = $_POST['is_select'];

if ($id_kat == ''){
	/* exit; */
}else if (($id_kat == 1) || ($id_kat == 2) || ($id_kat == 3)){
	$query = "SELECT id_sumber, nama_sumber FROM sumber ORDER BY id_sumber";
	$getKeterangan = mysql_query($query) or die ('Query Gagal');
    while($data = mysql_fetch_array($getKeterangan)){
		if($id_select == $data['id_sumber']){
          echo '<option value="'.$data['id_sumber'].'" selected>'.$data['nama_sumber'].'</option>';
		}else{
          echo '<option value="'.$data['id_sumber'].'">'.$data['nama_sumber'].'</option>';
		}
    }
    /* exit;     */
}else if ($id_kat == 4){
	$query = "SELECT id_kb, nama_kb FROM jenis_kb ORDER BY id_kb";
	$getKeterangan = mysql_query($query) or die ('Query Gagal');
    while($data = mysql_fetch_array($getKeterangan)){
		if($id_select == $data['id_kb']){
         echo '<option value="'.$data['id_kb'].'">'.$data['nama_kb'].'</option>';
		}else{
		echo '<option value="'.$data['id_kb'].'">'.$data['nama_kb'].'</option>';
		}
    }
    // exit;    
}else if ($id_kat == 5){
	$query = "SELECT id_ket, ket_kb FROM ket_kb ORDER BY id_ket";
	$getKeterangan = mysql_query($query) or die ('Query Gagal');
    while($data = mysql_fetch_array($getKeterangan)){
		if($id_select == $data['id_ket']){
         echo '<option value="'.$data['id_ket'].'">'.$data['ket_kb'].'</option>';
		}else{
         echo '<option value="'.$data['id_ket'].'">'.$data['ket_kb'].'</option>';
		}
    }
    /* exit;     */
}else{
}  
?>