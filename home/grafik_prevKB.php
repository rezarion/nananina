<?php
	include "koneksi.php";	
?>			
<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:50% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Jumlah Pengguna KB Berdasarkan Pelayanan Kontrasepsi</h4>
			</div><!-- m-page-title -->
			<div>
				<p><center>Data jumlah pengguna KB berdasarkan pelayanan kontrasepsi merupakan hasil laporan statistik rutin BKKBN. <br/>Beberapa jenis pelayanan kontrasepsi antara lain Prevalensi KB, KB Pria, Unmetneed, Peserta KB Baru Swasta, dan Peserta KB Baru Prasejahtera dan Sejahtera I.</p>
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
                  <select class="form-control" style="margin-top:0%; margin-left:0%; !important" name="id_kb">
					<option selected="selected" value="0"> </option>
						<?php
						$s_jenis= mysql_query("select * from jenis_kb");
						while ($r_jenis=mysql_fetch_array($s_jenis)) {
							if($r_jenis['id_kb']==$ss['id_kb']){
								echo "<option value=\"$r_jenis[id_kb]\" selected> $r_sumber[nama_kb]</option>";
							}else{
								echo "<option value=\"$r_jenis[id_kb]\"> $r_jenis[nama_kb]</option>";
							}
						}
						?>
					</select>
                </div><!-- .col-sm-10 -->				
              </div><!-- .form-group -->
				
			<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2" style='margin-top:-1% !important'>
					<!--<button class="btn btn-default">Cancel</button> -->
					<button type="submit" class="btn btn-primary" name='preview'><a href="" style="text-decoration=:none; color:white;">Tampilkan</a></button> 
				  </div>
				</div>
			</div>
			</form>
			
			</section>			
			<?php 
				if(ISSET($_POST['preview'])){
				$x = $_POST['slctTahun'];
				$y = $_POST['id_kb'];
				$sql1 = mysql_query("SELECT * FROM pengguna_kb p, jenis_kb j WHERE p.id_kb = j.id_kb AND p.id_kb = '$y' AND p.tahun = '$x' ");
				$ket = mysql_fetch_array($sql1);
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
									text: 'Grafik <?php echo "$ket[nama_kb]";?> Tahun <?php echo "$x";?>'
								 },
								 subtitle: {
									text: 'Sumber: Laporan Statistik Rutin BKKBN '
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
									if(($_POST['slctTahun'] == "") &&($_POST['id_kb'] == "")){
										echo "";
									}else{
										$sql   = "SELECT p.*, k.nama_kab  FROM pengguna_kb p, kabupaten k  WHERE p.id_kab= k.kode_kab AND id_kb = '$_POST[id_kb]' AND tahun = '$_POST[slctTahun]'";
										$query = mysql_query( $sql )  or die(mysql_error());
										while( $ret = mysql_fetch_array( $query ) ){   
											  ?>						  
											  {
												name: '<?php echo $ret['nama_kab']; ?>',
												data: [<?php echo $ret['jumlah']; ?>]
											  },
										<?php }
										}
										?>
										]
								 });
							});	
						</script>
						<div id='container'></div>	
						<?php
						}?>
