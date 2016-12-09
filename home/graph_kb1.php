	<script type='text/javascript'>
		var chart1; // globally available
		$(document).ready(function() {
		  chart1 = new Highcharts.Chart({
			 chart: {
				renderTo: 'container',
				type: 'column'
			 },   
			 title: {
				text: 'Grafik Keterangan KB Provinsi Jawa Tengah'
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
					$sql   = "SELECT p.*, k.nama_kab  FROM pengguna_kb p, kabupaten k  WHERE p.id_kab= k.kode_kab AND id_kb = '$_POST[cmbKeterangan]' AND tahun = '$_POST[slctTahun]'";
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
<div id='container' style='width:60% !important'></div>	
