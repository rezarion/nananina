<?php 
	$x = $_POST['slctTahun'];
	$y = $_POST['cmbKeterangan'];
	$sql1 = mysql_query("SELECT * FROM imr i, sumber s WHERE i.id_sumber = s.id_sumber AND i.id_sumber = '$y' AND i.tahun = '$x' ");
	$ket = mysql_fetch_array($sql1);
?>	

<script type="text/javascript">
	$(function () {
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Grafik IMR Provinsi Jawa Tengah <?php echo "<br/>";?>Tahun <?php echo "$x";?>'
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
				$sql   = "SELECT i.*, k.nama_kab FROM imr i, kabupaten k WHERE i.id_kab= k.kode_kab AND id_sumber = '$_POST[cmbKeterangan]' AND tahun ='$_POST[slctTahun]'";
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