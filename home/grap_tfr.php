<?php 
	$x = $_POST['slctTahun'];
	$y = $_POST['cmbKeterangan'];
	$sql1 = mysql_query("SELECT * FROM tfr t, sumber s WHERE t.id_sumber = s.id_sumber AND t.id_sumber = '$y' AND t.tahun = '$x' ");
	$ket = mysql_fetch_array($sql1);
?>
<script type="text/javascript">
	$(function () {
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Grafik TFR Provinsi Jawa Tengah <?php echo "<br/>";?> Tahun <?php echo "$x";?>'
				},
				subtitle: {
					text: 'Sumber: <?php echo "$ket[nama_sumber]";?>'
				},
				xAxis: {
					categories: [
						'kabupaten'
					]
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Jumlah'
					}
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [
				<?php
				$sql   = "SELECT t.*, k.nama_kab FROM tfr t, kabupaten k WHERE t.kode_kab= k.kode_kab AND id_sumber = '$_POST[cmbKeterangan]' AND tahun ='$_POST[slctTahun]'";
				$query = mysql_query( $sql )  or die(mysql_error());
				while( $ret = mysql_fetch_array( $query ) ){
				  ?>
					{
					name: '<?php echo $ret['nama_kab']; ?>',
					data: [<?php echo $ret['jumlah']; ?>]
				  },
				<?php 
				}
				?>					  
				]
			});
		});


</script>
<div id='container' style='width:58% !important'></div>	