<script type="text/javascript">
var xmlhttp;
function dropdown_kelurahan(){
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4)
		{
			document.getElementById("display_hasil").innerHTML=xmlhttp.responseText;
		}
	}
	var kecamatan= document.getElementById('s1').value;
	var url = "http://localhost/ta2/component/ajax_kelurahan.php";
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("kecamatan="+kecamatan);
}
</script>

<?php
	include "config/koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_arus'])));
	$query = mysql_query("SELECT * FROM arus_lalulintas, kelurahan, kecamatan
							WHERE id_arus = '$id'
							AND arus_lalulintas.id_kelurahan = kelurahan.id_kelurahan
							AND kelurahan.id_kecamatan = kecamatan.id_kecamatan							
							ORDER BY tahun DESC, kecamatan.id_kecamatan ASC");
							//JOIN arus_lalulintas ON arus_lalulintas.id_kelurahan = kelurahan.id_kelurahan
							//JOIN kelurahan ON arus_lalulintas.id_kecamatan = kelurahan.id_kelurahan
							//JOIN kecamatan ON kelurahan.id_kecamatan = kecamatan.id_kecamatan
	//$query = mysql_query("SELECT * FROM arus_lalulintas WHERE id_arus = '$id'");
	$pecah = mysql_fetch_array($query);
	$i = 1;
	
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	} 
?>	


<div class="widget">
	<h4 class="widgettitle">Form Ubah Data Arus Lalu Lintas</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_arus.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>No. </label>
				<span class="field"><input type="text" id="" name="id_arus" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>
			
			<p>
				<label>Tahun </label>
				<span class="field"><input type="text" id="" name="tahun" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $pecah['tahun']; ?>" readonly /></span>
				<!--<span class="field">
					<select id="" name="tahun" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="<?php// echo $pecah['tahun']; ?>"> </option>
						<?php
							//$today = mktime();
							//$tahun = date("Y",$today);
							//for($i=2014;$i<=$tahun;$i++)
							{
						?>
							<option value="<?php// echo $i?>" ><?php// echo $i;?></option>
						<?php
							}
						?>								
					</select>	
				</span>-->
			</p>
			
			<p>
				<label>Kecamatan </label>
				<span class="field"><input type="text" id="" name="kecamatan" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $pecah['nama_kecamatan']; ?>" readonly /></span>
				<!--<span class="field">
					<select id="s1" name="kecamatan" onchange="dropdown_kelurahan()" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="<?php// echo $pecah['nama_kecamatan']; ?>"> </option>
						<?Php /*											
							//require "config.php";// connection to database 
							include "component/config/koneksi.php";
							$sql=mysql_query("SELECT DISTINCT id_kecamatan, nama_kecamatan FROM kecamatan");
							while($pecahss = mysql_fetch_array($sql))
							{		
								echo "<option value='$pecahss[id_kecamatan]'>$pecahss[nama_kecamatan]</option>";
							}*/
						?>								
					</select>	
				</span>-->
			</p>
			
			<p>
				<label>Kelurahan </label>
				<span class="field"><input type="text" id="" name="kelurahan" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $pecah['Kelurahan']; ?>" readonly /></span>
				<!--<span class="field" id="display_hasil">
					<select name="kelurahan" class="chzn-select" style="width:200px !important" onchange=ajaxFunction('s2'); data-rel="chosen">
						<option value="<?php// echo $pecah['Kelurahan']; ?>"> </option>
					</select>
					</br> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu
				</span>-->
			</p>
			
			<p>
				<label>Nilai </label>
				<span class="field"> <input type="text" id="" name="nilai_arus" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $pecah['nilai_arus']; ?>"  required/></span>
			</p>
			
			<p class="stdformbutton">
				<button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>