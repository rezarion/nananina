<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:45% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Angka Kepadatan Penduduk Jawa Tengah</h4>
			</div><!-- m-page-title -->
		<form class="form-horizontal tasi-form" role="form" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label" for="exampleSelect">Tahun</label>
                <div class="col-lg-10">
				  <select class="form-control" style='width:15% !important' select id="selectTahun" name="slctTahun">
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
    
				<label class="col-sm-2 col-sm-2 control-label" for="exampleSelect">Sumber</label>
                <div class="col-lg-10">
                  <select class="form-control" name="id_sumber">
					<option selected="selected" value="0"> </option>
						<?php
							$s_sumber= mysql_query("select * from sumber");
							while ($r_sumber=mysql_fetch_array($s_sumber)) {
								if($r_sumber['id_sumber']==$ss['id_sumber']){
									echo "<option value=\"$r_sumber[id_sumber]\" selected> $r_sumber[nama_sumber]</option>";
								}else{
									echo "<option value=\"$r_sumber[id_sumber]\"> $r_sumber[nama_sumber]</option>";
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
				
			//include "koneksi.php";
			$x = $_POST['slctTahun'];
			$y = $_POST['id_sumber'];
			$_SESSION['x'] =  $x;
			$_SESSION['y'] =  $y;
			$sql1 = mysql_query("SELECT * FROM jumlah_penduduk p, sumber s WHERE p.id_sumber = s.id_sumber AND p.id_sumber = '$y' AND p.tahun = '$x' ");
			$ket = mysql_fetch_array($sql1);
			?>		
	<script type="text/javascript">
		var chart1; // globally available
		$(document).ready(function() {
		  chart1 = new Highcharts.Chart({
			 chart: {
				renderTo: 'container',
				type: 'column'
			 },   
			 title: {
				text: 'Grafik Kepadatan Penduduk Tahun <?php echo "$x";?>'
			 },
			 subtitle: {
				text: 'Sumber: <?php echo "$ket[nama_sumber]";?>'
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
						$sql   = "SELECT p.*, k.nama_kab, k.Luas FROM jumlah_penduduk p, kabupaten k WHERE p.kode_kab= k.kode_kab AND id_sumber = '$_POST[id_sumber]' AND tahun ='$_POST[slctTahun]'";
						$query = mysql_query( $sql )  or die(mysql_error());
						$i=0;
						while( $ret = mysql_fetch_array( $query ) ){
							$a = $ret['wanita']+$ret['pria'];
							$jumlah = $a / $ret['Luas'];
							$i=$i+1;
							  ?>
								{
								name: '<?php echo $i; echo '. ';  echo $ret['nama_kab']; ?>',
								data: [<?php echo $jumlah; ?>]
							  },
						<?php 
						}
						?>					  
					]
		});
	});

		</script>
		<div id="container"></div>
		<?php
			}?>