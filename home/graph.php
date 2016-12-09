<?php
	include "koneksi.php";
	
	if(ISSET($_POST['submit'])){

		$kat = $_POST['cmbKat'];
		if($kat == 1){
			include "grap_pend.php";
		}else if($kat == 2){
			include "graph_imr.php";
		}else if($kat == 3){
			include "grap_tfr.php";
		}else if($kat == 4){
			include "graph_kb1.php";
		}else if($kat == 5){
			include "graph_kb2.php";
		}else{
			
		}
	}else{
	
	}
		
?>
