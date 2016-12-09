<?php
	include "koneksi.php";	
?>			
<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:50% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Jumlah Pengguna KB Berdasarkan Metode Kontrasepsi</h4>
			</div><!-- m-page-title -->
			<div>
				<p><center>Data jumlah pengguna KB berdasarkan metode/alat kontrasepsi merupakan hasil laporan statistik rutin BKKBN. <br/>Beberapa jenis metode kontrasepsi yaitu pil, suntik, kondom, IUD, Implan, MOW (tubektomi), dan MOP (Vasektomi).</p>
			</div>
			<br>

<script src="component/highphp1/js/highcharts.js" type="text/javascript"></script>
		<form class="form-horizontal tasi-form" role="form" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label" for="exampleSelect">Tahun</label>
                <div class="col-lg-10">
                  <select class="form-control" style='margin-top:0%; margin-left:0%;width:15%; !important' select id="selectTahun" name="slctTahun">
					<option selected="selected" value="0"> </option>
				   <?php
						$today = mktime();
						$tahun = date("Y",$today);
						for($i=2010;$i<=($tahun-1);$i++)
						{
						?>
							<option value="<?php echo $i?>"><?php echo $i;?></option>
							<?php
						}
							?>
					</select>
                </div><!-- .col-sm-10 -->
				
				<label class="col-sm-2 col-sm-2 control-label" style="" for="exampleSelect">Jenis KB</label>
                <div class="col-lg-10">
                  <select class="form-control" style="margin-top:0%; margin-left:0%; !important" name="id_ket">
					<option selected="selected" value="0"> </option>
						<?php
						$s_jenis= mysql_query("select * from ket_kb");
						while ($r_jenis=mysql_fetch_array($s_jenis)) {
							if($r_jenis['id_ket']==$ss['id_ket']){
								echo "<option value=\"$r_jenis[id_ket]\" selected> $r_sumber[ket_kb]</option>";
							}else{
								echo "<option value=\"$r_jenis[id_ket]\"> $r_jenis[ket_kb]</option>";
							}
						}
					?>
					</select>
                </div><!-- .col-sm-10 -->				
              </div><!-- .form-group -->
				
			<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2" style='margin-top:-1% !important'>
					<!--<button class="btn btn-default">Cancel</button> -->
					<button type="submit" class="btn btn-primary" style="" name='preview'><a href="" style="text-decoration=:none; color:white;">Tampilkan</a></button> 
				  </div>
				</div>
			</div>
			</form>
			
			</section>
			<?php 
			if(ISSET($_POST['preview'])){
			?>
			<script type='text/javascript'>
				var chart1; // globally available
				$(document).ready(function() {
				  chart1 = new Highcharts.Chart({
					 chart: {
						renderTo: 'container',
						type: 'column'
					 },   
					 title: {
						text: 'Grafik Pengguna KB '
					 },
					 xAxis: {
						categories: ['Kabupaten']
					 },
					 yAxis: {
						title: {
						   text: 'Jumlah'
						}
					 },
						  series:             
						[
						<?php
						if(($_POST['slctTahun'] == "") &&($_POST['id_ket'] == "")){
							echo "Pilih Tahun dan Sumber Data";
						}else{
							$sql   = "SELECT *  FROM pengguna_jns_kb  WHERE id_ket = '$_POST[id_ket]' AND tahun = '$_POST[slctTahun]'";
							$query = mysql_query( $sql )  or die(mysql_error());
							while( $ret = mysql_fetch_array( $query ) ){
								$merek=$ret['id_kab'];      
								$sql = mysql_query("SELECT * FROM kabupaten WHERE kode_kab = '$merek'");
								$f = mysql_fetch_array($sql);
								 $sql_jumlah   = "SELECT jumlah FROM pengguna_jns_kb WHERE id_kab='$merek' ";        
								 $query_jumlah = mysql_query( $sql_jumlah ) or die(mysql_error());
								 while( $data = mysql_fetch_array( $query_jumlah ) ){
									$jumlah = $data['jumlah'];  
								  } 
						?>								  
								  {
									name: '<?php echo $f['nama_kab']; ?>',
									data: [<?php echo $jumlah; ?>]
								  },
							<?php }
							}
							?>
							]
					 });
				});	
			</script>
			<div id='container' style='width:95% !important'></div>	
			<?php
			}?>
