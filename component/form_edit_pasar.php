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
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_pasar'])));
	//$id = isset($_GET['id']) ? $_GET['id'] : '';
	$query =mysql_query("SELECT * FROM lokasi_pasar, kelurahan, kecamatan
							WHERE id_pasar = '$id'
							AND lokasi_pasar.id_kelurahan = kelurahan.id_kelurahan
							AND kelurahan.id_kecamatan = kecamatan.id_kecamatan
							ORDER BY tahun DESC, kecamatan.id_kecamatan ASC");
	$ss = mysql_fetch_array($query);
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
	<h4 class="widgettitle">Form Edit Data Lokasi Pasar Tradisional</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_pasar.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>No.</label>
				<span class="field"><input type="text" name="id_pasar" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>
				
			<p>
				<label>Nama Pasar</label>
				<span class="field"><input type="text" id="nama" name="nama" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" value="<?php echo $ss['nama_pasar']; ?>" required/></span>
			</p>
			
			<p>
				<label>Golongan</label>
				<span class="field"><input type="text" id="golongan" name="golongan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" value="<?php echo $ss['golongan']; ?>" required/></span>
			</p>
			
			<p>
				<label>UPTD</label>
				<span class="field"><input type="text" id="uptd" name="uptd" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" value="<?php echo $ss['uptd']; ?>" required/></span>
			</p>
			
			<p>
				<label>Kecamatan </label>
				<span class="field"><input type="text" id="s1" name="kecamatan" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $ss['nama_kecamatan']; ?>" readonly /></span>
				<!--<span class="field">
					<select id="s1" name="kecamatan" onchange="dropdown_kelurahan()" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="<?php// echo $ss['nama_kecamatan']; ?>"> </option>
						<?Php /*											
							//require "config.php";// connection to database 
							include "component/config/koneksi.php";
							$sql=mysql_query("SELECT DISTINCT id_kecamatan, nama_kecamatan FROM kecamatan");
							while($ssss = mysql_fetch_array($sql))
							{		
								echo "<option value='$ssss[id_kecamatan]'>$ssss[nama_kecamatan]</option>";
							}*/
						?>								
					</select>	
				</span>-->
			</p>
			
			<p>
				<label>Kelurahan </label>
				<span class="field"><input type="text" id="display_hasil" name="kelurahan" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $ss['Kelurahan']; ?>" readonly /></span>
				<!--<span class="field" id="display_hasil">
					<select name="kelurahan" class="chzn-select" style="width:200px !important" onchange=ajaxFunction('s2'); data-rel="chosen">
						<option value="<?php// echo $ss['Kelurahan']; ?>"> </option>
					</select>
					</br> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu
				</span>-->
			</p>
			
			<p>
				<label>Alamat</label>
				<span class="field">
					<textarea id="autoResizeTA" name="alamat" class="input-xlarge" style="resize: vertical; height: 117px;" rows="5" cols="80" required/> <?php echo $ss['alamat_pasar']; ?> </textarea>
				</span>
			</p>
			<p>
				<label>Tahun </label>
				<!--<span class="field"><input type="text" id="tahun" name="tahun" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $ss['tahun']; ?>" required /></span>-->
				<span class="field">
					<select id="tahun" name="tahun" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="<?php echo $ss['tahun']; ?>" required><?php echo $ss['tahun']; ?></option>
						<?php
							$today = mktime();
							$tahun = date("Y",$today);
							for($i=2014;$i<=$tahun;$i++)
							{
						?>
							<option value="<?php echo $i?>" ><?php echo $i;?></option>
						<?php
							}
						?>								
					</select>	
				</span>
			<p>
				<label>Koordinat</label>
				<span class="field">
					<input type="text" id="lat" name="lat" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['lat']; ?>" required/>
					<input type="text" id="lng" name="lng" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['lng']; ?>" required/>
				</span>
			</p>
			
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>