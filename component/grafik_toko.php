
<center><h4><b>Grafik Toko Modern Per Kelurahan</h4></b></center>
<br>
	
	
	<div class='variabel' style='border:2px solid #0866C6; margin-bottom:10px; background:#FFF; width:15.5%;'>
	<div style='padding:10px;'>
		<form method='post'>
			<table style='font-size:13px;'>
				<tr>
					<td>
					<select data-placeholder="Pilih Tahun" style="width:auto;margin-left:8%" class="" tabindex="2" select id="selectTahun" name="slctTahun">
						<option value="">--Pilih Tahun--</option>
						<?php
						$today = mktime();
						$tahun = date("Y");
						for($i=2013;$i<=($tahun);$i++)
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
						<!--<button class="btn btn-default">Cancel</button> -->
						<button type='submit' name='show' class="btn btn-primary" style="margin-left:30%"><a href="" style="text-decoration=:none; color:white;">Show</a></button> 
					</td>
				</tr>
			</table>
		</form>
	</div>
	</div>

			
<?php 
	if(ISSET($_POST['show'])){
	include('config/koneksi.php');
	$x = $_POST['slctTahun'];
	$_SESSION['x'] =  $x;
	$sqli = mysql_query("SELECT * FROM lokasi_toko WHERE tahun = '$x' ");
	//$ket = mysql_fetch_array($sqli);
?>
<script type='text/javascript'>
	var chart1; // globally available
	$(document).ready(function() {
	  chart1 = new Highcharts.Chart({
		exporting: {
            chartOptions: { // specific options for the exported image
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                }
            },
            scale: 3,
            fallbackToExportServer: false
        },
		 
		 chart: {
			renderTo: 'container',
			type: 'column'
		 },   
		 title: {
			text: 'Grafik Toko Modern Tahun <?php echo "$x";?>'
		 },
		 xAxis: {
			categories: ['Kelurahan']
		 },
		 yAxis: {
			title: {
			   text: 'Jumlah'
			}
		 },
			  series:             
				[
				<?php
					//nampilin tahun yg dipilih
					$sql   = "SELECT l.*, k.Kelurahan
							  FROM lokasi_toko l, kelurahan k
							  WHERE l.id_kelurahan= k.id_kelurahan
							  AND tahun ='$_POST[slctTahun]'";
					$query = mysql_query( $sql ) or die(mysql_error());
					
					//hitung row
					$result = mysql_query("SELECT Kelurahan, count(lokasi_toko.id_kelurahan) as jml FROM lokasi_toko inner join kelurahan
										   ON lokasi_toko.id_kelurahan = kelurahan.id_kelurahan WHERE tahun ='$_POST[slctTahun]'
										   GROUP BY Kelurahan");
					$num_rows = mysql_num_rows($result);
					
					$i=0;
					while( $ret = mysql_fetch_array( $result ) ){						
						//$jumlah = $ret['jumlah'];
						
						
						$i=$i+1;
						  ?>
							{
							name: '<?php echo $i; echo '. '; echo $ret['Kelurahan']; ?>',
							data: [<?php echo $ret['jml']; ?>]
						  },
					<?php 
					}
					?>				  
				]
				
		 });
	});	
</script>

<div id='container' style='width:95% !important'></div>	

<?php
	}
?>
