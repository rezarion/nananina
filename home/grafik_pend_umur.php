<?php
	include "koneksi.php";
?>
<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:45% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Grafik Demografi Penduduk Jawa Tengah</h4>
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
			$x = $_POST['slctTahun'];
			$y = $_POST['id_sumber'];
			$sql1 = mysql_query("SELECT * FROM jumlah_penduduk_umur p, sumber s WHERE p.id_sumber = s.id_sumber AND p.id_sumber = '$y' AND p.tahun = '$x' ");
			$ket = mysql_fetch_array($sql1);
			?>

		<script type="text/javascript">
$(function () {
    var chart,
        categories = ['0-4', '5-9', '10-14', '15-19',
            '20-24', '25-29', '30-34', '35-39', '40-44',
            '45-49', '50-54', '55-59', '60-64', '65-69',
            '70-74', '75+'];
    $(document).ready(function() {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Piramida Penduduk Tahun <?php echo "$x";?>'
            },
            subtitle: {
                text: 'Sumber: <?php echo "$ket[nama_sumber]";?>'
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
                        return (Math.abs(this.value) / 100000) + 'ribu';
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
					
					if(($_POST['slctTahun'] == "") &&($_POST['id_sumber'] == "")){
					echo "";
					}else{
					$sql = mysql_query("SELECT p.*, r.nama_range FROM jumlah_penduduk_umur p, range_umur r WHERE r.id_range= p.id_range AND id_sumber ='$_POST[id_sumber]' AND tahun ='$_POST[slctTahun]' ORDER BY id_range asc");
					  ?>
					series: [{
						name: 'Laki-laki',
						data: [<?php 
						$i = 1;
						while($hsl = mysql_fetch_array($sql)){
							
						echo (-($hsl['laki'])); 
						echo ','; 
						
						$i++;}
						?>
						]				  
					},{
					<?php
						$sql2 = mysql_query("SELECT p.*, r.nama_range FROM jumlah_penduduk_umur p, range_umur r WHERE r.id_range= p.id_range AND id_sumber ='$_POST[id_sumber]' AND tahun ='$_POST[slctTahun]' ORDER BY id_range asc");
						
					?>
						name: 'Perempuan',
						data: [<?php 
						$i = 1;
						while($hsl2 = mysql_fetch_array($sql2)){
							
						echo $hsl2['perempuan']; 
						echo ','; 
						
						$i++;}
						?>
						]
					}]
				});
			});
			
		});
		</script>
		<div id="container"></div>
				<?php
					}
					}?>