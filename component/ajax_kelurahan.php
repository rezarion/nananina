<?php
	$kecamatan=$_POST['kecamatan'];
	
	echo "<span class='field'>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
				<select name='kelurahan' class=\'chzn-select\' style=\'width:200px !important\' data-rel=\'chosen\'>
				<option value='0'>Pilih salah satu   ....</option>";
				include "koneksi.php";
				$sql=mysql_query("SELECT DISTINCT id_kelurahan, Kelurahan FROM kelurahan WHERE id_kecamatan='$kecamatan'");
				while($pecah = mysql_fetch_array($sql))
				{	
					echo "<option value='$pecah[id_kelurahan]'>$pecah[Kelurahan]</option>";
				}
				
	echo	"</select>
		   </span>";
?>