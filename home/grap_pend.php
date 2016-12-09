<?php 
	$x = $_POST['slctTahun'];
	$y = $_POST['cmbKeterangan'];
	$sql1 = mysql_query("SELECT * FROM jumlah_penduduk p, sumber s WHERE p.id_sumber = s.id_sumber AND p.id_sumber = '$y' AND p.tahun = '$x' ");
	$ket = mysql_fetch_array($sql1);
?>	
<script type="text/javascript">
	$(function () {
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Grafik Kepadatan Penduduk Provinsi Jawa Tengah <?php echo "<br/>";?>Tahun <?php echo "$x";?>'
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
						text: 'Kepadatan Penduduk (jiwa/km)'
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
					$sql   = "SELECT p.*, k.nama_kab, k.Luas FROM jumlah_penduduk p, kabupaten k WHERE p.kode_kab= k.kode_kab AND id_sumber = '$_POST[cmbKeterangan]' AND tahun ='$_POST[slctTahun]'";
					$query = mysql_query( $sql )  or die(mysql_error());
					while( $ret = mysql_fetch_array( $query ) ){
						$a = $ret['wanita']+$ret['pria'];
						$jumlah = $a / $ret['Luas'];            
						  ?>
							{
							name: '<?php echo $ret['nama_kab']; ?>',
							data: [<?php echo $jumlah; ?>]
						  },
					<?php 
					}
					?>					  
						]
			});
		});


</script>
<div id='container' style='width:58% !important'></div>	