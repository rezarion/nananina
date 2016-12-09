
<center><h4><b>Grafik Pasar Tradisional Per Kelurahan</h4></b></center>
<br>
			
<?php 
	//if(ISSET($_POST['show'])){
	include('config/koneksi.php');
	//$x = $_POST['slctTahun'];
	//$_SESSION['x'] =  $x;
	$sqli = mysql_query("SELECT * FROM lokasi_pasar");
	//$ket = mysql_fetch_array($sqli);
?>
<script type='text/javascript'>
	var chart2; // globally available
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
			renderTo: 'container2',
			type: 'column'
		 },   
		 title: {
			text: 'Grafik Pasar Tradisional'
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
					//nampilin nama pasar
					$sql   = "SELECT l.*, k.Kelurahan
							  FROM lokasi_pasar l, kelurahan k
							  WHERE l.id_kelurahan= k.id_kelurahan
							  ";
					$query = mysql_query( $sql ) or die(mysql_error());
					
					//hitung row
					$result = mysql_query("SELECT Kelurahan, count(lokasi_pasar.id_kelurahan) as jml FROM lokasi_pasar inner join kelurahan
										   ON lokasi_pasar.id_kelurahan = kelurahan.id_kelurahan
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

<div id='container2' style='width:95% !important'></div>	

<?php
	//}
?>
