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
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
?>


<div class="widget">	
	<h4 class="widgettitle">Form Data Lokasi Toko Modern</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_toko.php" method="post" enctype="multipart/form-data">		
						
			<p>
				<label>Nama Toko</label>
				<span class="field">
					<input type="text" id="nama" name="nama" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan nama toko modern" required/>
				</span>
			</p>

			<p>
				<label>Jenis</label>
				<span class="field">
					<input type="text" id="jenis" name="jenis" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan jenis toko modern" required/>
				</span>
			</p>
			
			<p>
				<label>Ijin</label>
				<span class="field">
					<input type="text" id="ijin" name="ijin" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan ijin toko modern" required/>
				</span>
			</p>

			<p>
				<label>Terbit</label>
				<span class="field">
					<input type="text" id="datepicker" name="terbit" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan tanggal terbit ijin" required/>
				</span>
			</p>

			<p>
				<label>Kecamatan</label>
				<span class="field">
					<select id="s1" name="kecamatan" onchange="dropdown_kelurahan()" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="0">Pilih salah satu ...</option>
						<?Php											
							//require "config.php";// connection to database 
							include "component/config/koneksi.php";
							$sql=mysql_query("SELECT DISTINCT id_kecamatan, nama_kecamatan FROM kecamatan");
							while($pecah = mysql_fetch_array($sql))
							{		
								echo "<option value='$pecah[id_kecamatan]'>$pecah[nama_kecamatan]</option>";
							}
						?>								
					</select>	
				</span>
			</p>
			
			<p>
				<label>Kelurahan</label>
				<span class="field" id="display_hasil">
					<select name="kelurahan" class="chzn-select" style="width:200px !important" onchange=ajaxFunction('s2'); disabled="disabled" data-rel="chosen">
						<option value='0'>Pilih salah satu ...</option>
					</select>
					<!--</br> <small class="desc"> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu.</small>-->
				</span>
				<small class="desc"> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu.</small>
			</p>
			
			<p>
				<label>Alamat</label>
				<span class="field">
					<textarea id="autoResizeTA" name="alamat" class="input-xlarge" style="resize: vertical; height: 117px;" rows="5" cols="80" placeholder="masukkan alamat toko modern" required/></textarea>
				</span>
			</p>
			<p>
				<label>Tahun</label>
				<span class="field">
					<select id="" name="tahun" data-rel="chosen" class="chzn-select" style="width:200px !important">
						<option value="0">Pilih salah satu ...</option>
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
			</p>
			<p>
				<label>Koordinat</label>
				<span class="field">
					<input type="text" id="lat" name="lat" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan latitude" required/>
					<input type="text" id="lng" name="lng" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan langitude" required/>
				</span>
			</p>
			
			<p class="stdformbutton">
                <button type="submit" class="btn btn-primary" name="input" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"></span>Submit</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>