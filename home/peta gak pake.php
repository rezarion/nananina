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
     jQuery("#cmbKat").change(function(){
          jQuery("img#imgLoad").show();
          var id_kat = $(this).val();
 
          jQuery.ajax({
             type: "POST",
             dataType: "html",
             url: "home/get_keterangan.php",
             data: "id_kat="+id_kat,
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
 /* 
     $("#cmbProvinsi").change(getAjaxAlamat);
     function getAjaxAlamat(){
          $("img#imgLoadMerk").show();
          var idProvinsi = $("#cmbProvinsi").val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getKota.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                         $("select#cmbKota").html('<option value="">--Pilih Kota--</option>');                                                                                  
                 }else{
                           $("select#cmbKota").html(msg);                              
                 }
                 $("img#imgLoadMerk").hide();                                                        
             }
          });
     }     */
});
</script>

<!-- PETA -->
<script type='text/javascript'>
	jQuery(document).ready(function(){
		jQuery('.pilih').click(function(){
			id = jQuery(this).attr('id');
			jQuery.ajax({
				type    : 'POST', 
				url     : 'component/peta1.php',
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
<div class='data' style='position:absolute; width:180px; height:20px; top:90px; right=10px; max-height:50px;font-size:13px;'>
	<div class='variabel' style='border:1px solid #61B9DE;margin-bottom:0px;padding-bottom:10px; background:#FFF; '>
		<h1 style='background:#61B9DE;padding:10px;margin-top:0px;font-size:13px;color:#FFF;'><b>Variabel</b></h1>
		<div style='padding:10px;'>
			<form method='post'>
			<table style='font-size:13px;' method='POST'>
				<tr>
					<td>
					<select data-placeholder="Pilih Tahun" style="width:150px" class="" tabindex="2" select id="selectTahun" name="slctTahun">
						<option value="">--Pilih Tahun--</option>
						<?php
						
						$tahun = date("Y");
						for($i=2008;$i<=$tahun;$i++)
						{
						?>
							<option value="<?php echo $i?>"><?php echo $i;?></option>
							<?php
						}
							?>
					</select>
					</td>
				</tr>
				<tr>
					<td>
						<select name="cmbKat" id="cmbKat" style="width:150px">
							<option value="">--Pilih Kategori--</option>
							<?php
								while($data = mysql_fetch_array($getKat)){
								echo '<option value="'.$data['id_kat'].'">'.$data['nama_kat'].'</option>';
								}
							?>
						</select>
 					</td>
				</tr>
					<td>
						<select name="cmbKeterangan" id="cmbKeterangan" style="width:150px">
							<option value="">-- Pilih Keterangan --</option>					
						</select>
					</td>
				<tr>
					<td>

							<!--<button class="btn btn-default">Cancel</button> -->
							<button type='submit' name='submit' class="btn btn-primary"><a href="" style="text-decoration=:none; color:white;">Show</a></button> 
					
						
					</td>
				</tr>
				
			</table>
			</form>
		</div>
	</div>
	
</div>	
<!--<div>	
	<div class='variabel' style='border:1px solid #0866C6;margin-bottom:10px; background:#FFF;'>
		<h3 style='background:#0866C6;padding:10px;font-size:13px;color:#FFF;'>Variabel</h3>
		<div style='padding:10px;'>
			<table style='font-size:13px;'>
				<tr>
					<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
					<td>Legenda 1</td>
				</tr>
				<tr>
					<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
					<td>Legenda 2</td>
				</tr>
				<tr>
					<td ><div style='background:blue;width:30px;margin:0 10px 10px 0;'>&nbsp;</div></td>
					<td>Legenda 3</td>
				</tr>
			</table>
		</div>
	</div>
</div>
-->


<div style='min-height:400px;'>
	<div class='showPeta'>
		<?php
			include "peta1.php";
		?>
	</div>
</div>