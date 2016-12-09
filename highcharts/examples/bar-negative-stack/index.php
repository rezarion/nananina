<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
    var chart,
        categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75-79', '80-84', '85-89', '90-94',
            '95-99', '100 +'];
    $(document).ready(function() {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Population pyramid for Germany, midyear 2010'
            },
            subtitle: {
                text: 'Source: www.census.gov'
            },
            xAxis: [{
                categories: categories,
                reversed: false,
                labels: {
                    step: 1
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function(){
                        return (Math.abs(this.value) / 1000000) + 'M';
                    }
                },
                min: -4000000,
                max: 4000000
            },
    
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
    
            tooltip: {
                formatter: function(){
                    return '<b>'+ this.series.name +', age '+ this.point.category +'</b><br/>'+
                        'Population: '+ Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },
			<?php
				include "koneksi.php";
				$sql = mysql_query("SELECT p.*, r.nama_range FROM jumlah_penduduk_umur p, range_umur r WHERE r.id_range= p.id_range AND id_sumber = 1 AND tahun = 2010");
				//$hsl = mysql_fetch_array($sql);
			?>
            series: [{
                name: 'Male',
                data: [<?php 
				$i = 1;
				while($hsl = mysql_fetch_array($sql)){
					
				echo (-($hsl['laki'])); 
				echo ','; 
				
				$i++;}
				?>
				
				]
            }, {
			<?php
				//include "koneksi.php";
				$sql2 = mysql_query("SELECT p.*, r.nama_range FROM jumlah_penduduk_umur p, range_umur r WHERE r.id_range= p.id_range AND id_sumber = 1 AND tahun = 2010");
				//$hsl = mysql_fetch_array($sql);
			?>
                name: 'Female',
                data: [<?php 
				$i = 1;
				while($hsl2 = mysql_fetch_array($sql2)){
					
				echo $hsl2['perempuan']; 
				echo ','; 
				
				$i++;}
				?>]
            }]
        });
    });
    
});
		</script>
	</head>
	<body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
