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
	<h4 class="widgettitle">Form Data Perkembangan Pemukiman Baru</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_perkembangan.php" method="post" enctype="multipart/form-data">
									
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
					<!--</br> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu-->
				</span>
				<small class="desc"> &nbsp &nbsp &nbsp &nbsp &nbsp keterangan: harus memilih kecamatan dahulu.</small>
			</p>
			
			<p>
				<label>Nilai</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="" name="nilai_perkembangan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" placeholder="masukkan nilai perkembangan pemukiman baru" required/></span>
			</p>
			
			<p class="stdformbutton">
                <button type="submit" class="btn btn-primary" name="input" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"></span>Submit</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>