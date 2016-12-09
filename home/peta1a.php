	<h4><center><b>Trend Peta Penyebaran Penduduk Provinsi Jawa Tengah</b></center></h4>
<?php
	include "koneksi.php";
	 
	// ambil data
	$query = "SELECT id_kat, nama_kat FROM kategori ORDER BY id_kat";
	$getKat = mysql_query($query,$id_mysql) or die ('Query Gagal');
?>

<!-- Include Script jQuery, sesuaikan nama versi jQuery yang digunakan pada bagian src -->
<script type="text/javascript" src="../js1/jquery-latest.min.js"></script>
<script type="text/javascript">
jQuery(function() {
	  <?php 
		if(ISSET($_POST['cmbKeterangan'])){
			echo "
				jQuery.ajax({
					 type: 'POST',
					 dataType: 'html',
					 url: 'home/get_keterangan.php',
					 data: 'id_kat=$_POST[cmbKat]&is_select=$_POST[cmbKeterangan]',
					 success: function(msg){
						 if(msg == ''){
								 jQuery('select#cmbKeterangan').html('<option value=\"\">--Pilih Keterangan--</option>');
								 /* $('select#cmbKota').html('<option value=\"\">--Pilih Kota--</option>'); */
						 }else{
								 jQuery('select#cmbKeterangan').html(msg);                                                       
						 }
						 jQuery('img#imgLoad').hide();
		 
						 /* getAjaxAlamat();   */                                                      
					 }
			});";
		}
	  ?>	
		
     jQuery("#cmbKat").change(function(){
          jQuery("img#imgLoad").show();
          var id_kat = $(this).val();
		  
		  
 
          jQuery.ajax({
             type: "POST",
             dataType: "html",
             url: "home/get_keterangan.php",
             data: "id_kat="+id_kat+"&is_select="+'<?php echo (ISSET($_POST['cmbKeterangan']))?$_POST['cmbKeterangan']:''?>',
             success: function(msg){
                 if(msg == ''){
                         jQuery("select#cmbKeterangan").html('<option value="">--Pilih Keterangan--</option>');
                         /* $("select#cmbKota").html('<option value="">--Pilih Kota--</option>'); */
                 }else{
                         jQuery("select#cmbKeterangan").html(msg);                                                       
                 }
                 jQuery("img#imgLoad").hide();
 
                 /* getAjaxAlamat();   */                                                      
             }
          });                    
     });
});
</script>

<!-- PETA -->
<script type='text/javascript'>
	jQuery(document).ready(function(){
		jQuery('.pilih').click(function(){
			id = jQuery(this).attr('id');
			jQuery.ajax({
				type    : 'POST', 
				url     : 'home/peta1.php',
				data    : 'kategori='+id+'&tahun='+jQuery('.tahun').val(),
				success : function(msg){
					jQuery('.showPeta').html(msg);
				}
			})
			return false;
		})
	})
</script>

<!-- graph -->
<script type='text/javascript'>
	jQuery(document).ready(function(){
		jQuery('.pilih').click(function(){
			id = jQuery(this).attr('id');
			jQuery.ajax({
				type    : 'POST', 
				url     : 'home/graph.php',
				data    : 'kategori='+id+'&tahun='+jQuery('.tahun').val(),
				success : function(msg){
					jQuery('.showPeta').html(msg);
				}
			})
			return false;
		})
	})
</script>

<!-- Variabel -->
<div class='data' style='position:absolute; width:200px;height:100%; top:110px; right:10px; max-height:400px;font-size:13px;'>
	<div class='variabel' style='border:1px solid #0866C6;margin-bottom:20px; background:#FFF;'>
		<h1 style='background:#0866C6;padding:10px;margin-top:0px; font-size:14px;color:#FFF;'><b><center>Variabel</b></h1>
		<div style='padding:8px; margin-top:-10px;margin-left:10px;margin-bottom:-10px;'>
			<form method='post'>
			<table style='font-size:13px;' method='POST'>
				<tr>
					<td>
					<select data-placeholder="Pilih Tahun" style="width:auto !important" class="" tabindex="2" select id="selectTahun" name="slctTahun">
						<option value="">--Pilih Tahun--</option>
						<?php
						$i_tahun = (ISSET($_POST['slctTahun']))?$_POST['slctTahun']:"";
						$tahun = date("Y");
						for($i=2010;$i<=($tahun-1);$i++)
						{
							if($i_tahun == $i){
						?>
							
							<option value="<?php echo $i?>" selected><?php echo $i;?></option>
							<?php
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
							?>
					</select>
					</td>
				</tr>
				<tr>
					<td>
						<?php 
							$i_kat = (ISSET($_POST['cmbKat']))?$_POST['cmbKat']:"";
						?>
						<select name="cmbKat" id="cmbKat" style="width:auto">
							<option value="">--Pilih Kategori--</option>
							<?php
								while($data = mysql_fetch_array($getKat)){
									if($i_kat == $data['id_kat']){
										echo '<option value="'.$data['id_kat'].'" selected>'.$data['nama_kat'].'</option>';
									}else{
										echo '<option value="'.$data['id_kat'].'">'.$data['nama_kat'].'</option>';
									}
								}
							?>
						</select>
 					</td>
				</tr>
					<td>
						<select name="cmbKeterangan" id="cmbKeterangan" style="width:auto">
							<option value="">--Pilih Keterangan --</option>					
						</select>
					</td>
				<tr><td> <br><td></tr>
				<tr>
					<td>
						<!--<button class="btn btn-default">Cancel</button> -->
						<button type='submit' name='submit' class="btn btn-primary"><a href="" style="text-decoration=:none; color:white;">Tampilkan</a></button> 
					</td>
				</tr>				
			</table>
			</form>
		</div>
	</div>
	
	
	<div class='variabel' style='border:1px solid #0866C6;margin-bottom:20px; background:#FFF;'>
		<h1 style='background:#0866C6;padding:10px;margin-top:0px; font-size:14px;color:#FFF;'><b><center>Keterangan</b></h1>
		<div style='padding:10px;'>
			<?php
				if(ISSET($_POST['submit'])){
					$kat = $_POST['cmbKat'];
					if($kat == 1){
					echo"
					<table style='font-size:13px;'>
						<tr>
							<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk <800 </td>
						</tr>
						<tr>
							<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk 800-2000 </td>
						</tr>
						<tr>
							<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk >2000 </td>
						</tr>
					</table>";
					}else if($kat == 2){
						echo"
						<table style='font-size:13px;'>
							<tr>
								<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> < rata-rata</td>
							</tr>
							<tr>
								<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> >= Rata-rata</td>
							</tr>
						</table>";
					}else if($kat == 3){
						echo"
						<table style='font-size:13px;'>
							<tr>
								<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> < rata-rata</td>
							</tr>
							<tr>
								<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> >= Rata-rata</td>
							</tr>
						</table>";
					}else if($kat == 4){
						echo"
						<table style='font-size:13px;'>
							<tr>
								<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> < rata-rata</td>
							</tr>
							<tr>
								<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> >= Rata-rata</td>
							</tr>
						</table>";
					}else if($kat == 5){
						echo"
						<table style='font-size:13px;'>
							<tr>
								<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> < rata-rata</td>
							</tr>
							<tr>
								<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td> >= Rata-rata</td>
							</tr>
						</table>";
					}else{
						echo"
						<table style='font-size:13px;'>
							<tr>
								<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td>Kepadatan Penduduk <800 </td>
							</tr>
							<tr>
								<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td>Kepadatan Penduduk 800-2000 </td>
							</tr>
							<tr>
								<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
								<td>Kepadatan Penduduk >2000 </td>
							</tr>
						</table>";
					}
				}else{
				echo"
					<table style='font-size:13px;'>
						<tr>
							<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk <800 </td>
						</tr>
						<tr>
							<td ><div style='background:#61B9DE;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk 800-2000 </td>
						</tr>
						<tr>
							<td ><div style='background:#D9EDF7;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
							<td>Kepadatan Penduduk >2000 </td>
						</tr>
					</table>";
			}
			?>
		</div>
	</div>
</div>
<ul class="nav nav-pills" style='margin-top:8px; margin-left:10px; !important'>
	<li class="active" background="grey"><a href="#peta" data-toggle="tab">Peta</a></li>
	<li><a href="#graph" data-toggle="tab">Graph</a></li>
</ul>

<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade active in" id="peta">
		<div style='min-height:400px;'>
			<div class='showPeta'>
				<?php
					include "home/peta1.php";
				?>
			</div>
			<?php
			if(ISSET($_POST['submit'])){
					$kat = $_POST['cmbKat'];
					if($kat == 1){
						$ids = $_POST['cmbKeterangan'];
						$query = "SELECT nama_sumber FROM sumber where id_sumber='$ids'";
						$getKeterangan = mysql_query($query) or die ('Query Gagal');
						$data = mysql_fetch_array($getKeterangan);
						echo "<p style='margin-top: -270px;margin-left:20%;'>Trend Kepadatan Penduduk Berdasarkan $data[nama_sumber] Tahun $_POST[slctTahun]</p>";
					}else if($kat == 2){
						$ids = $_POST['cmbKeterangan'];
						$query = "SELECT nama_sumber FROM sumber where id_sumber='$ids'";
						$getKeterangan = mysql_query($query) or die ('Query Gagal');
						$data = mysql_fetch_array($getKeterangan);
						echo "<p style='margin-top: -270px;margin-left:20%;'>Trend IMR Berdasarkan $data[nama_sumber] Tahun $_POST[slctTahun]</p>";
					}else if($kat == 3){
						$ids = $_POST['cmbKeterangan'];
						$query = "SELECT nama_sumber FROM sumber where id_sumber='$ids'";
						$getKeterangan = mysql_query($query) or die ('Query Gagal');
						$data = mysql_fetch_array($getKeterangan);
						echo "<p style='margin-top: -270px;margin-left:20%;'>Trend TFR Berdasarkan $data[nama_sumber] Tahun $_POST[slctTahun]</p>";
					}else if($kat == 4){
						$ids = $_POST['cmbKeterangan'];
						$query = "SELECT nama_kb FROM jenis_kb where id_kb='$ids'";
						$getKeterangan = mysql_query($query) or die ('Query Gagal');
						$data = mysql_fetch_array($getKeterangan);
						echo "<p style='margin-top: -270px;margin-left:20%;'>Trend Pelayanan Kontrasepsi Berdasarkan $data[nama_kb] Tahun $_POST[slctTahun]</p>";
					}else if($kat == 5){
						$ids = $_POST['cmbKeterangan'];
						$query = "SELECT ket_kb FROM ket_kb where id_ket='$ids'";
						$getKeterangan = mysql_query($query) or die ('Query Gagal');
						$data = mysql_fetch_array($getKeterangan);
						echo "<p style='margin-top: -270px;margin-left:20%;'>Trend Peserta KB Aktif Berdasarkan $data[ket_kb] Tahun $_POST[slctTahun]</p>";
					}
					}
			?>
			
		</div>
	</div>
	<div class="tab-pane fade" id="graph">
		<?php include 'home/graph.php';?>
	</div>
</div>

