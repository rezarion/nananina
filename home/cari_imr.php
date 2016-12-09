<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script src="js/jquery-price-range.min.js" /></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "300px"
        });
        
    });
</script>

<script>
    $('.btnMedio').click(function(){
        $('html, body').animate({scrollTop:1000},'50');
    });
</script>

<?php
	include "koneksi.php";	
?>			
<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:50% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Angka IMR Jawa Tengah</h4>
			</div><!-- m-page-title -->
			<div>
				<p><center>IMR <i>(Infant Mortality Rate )</i> merupakan jumlah kematian bayi usia dibawah 1 tahun per 1000 kelahiran hidup dalam tahun tertentu. Angka kematian bayi merupakan indikator paling penting dalam menentukan tingkat kesehatan masyarakat.</p>
			</div>
			<br>
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
					<button type="submit" id="btnMedio" class="btn btn-primary" name='preview'><a href="" style="text-decoration=:none; color:white;">Tampilkan</a></button> 
				  </div>
				</div>
			</div>
			</form>
			
			</section>
</div>			
<div class="l-content-wrap" style="width:70%; margin-left:10%; margin-top:0% !important">
				<?php 
					if(ISSET($_POST['preview'])){
					$x = $_POST['slctTahun'];
					$y = $_POST['id_sumber'];
					$sql1 = mysql_query("SELECT * FROM imr t, sumber s WHERE t.id_sumber = s.id_sumber AND t.id_sumber = '$y' AND t.tahun = '$x' ");	
					$ket = mysql_fetch_array($sql1);						
						if(($_POST['slctTahun'] == "") &&($_POST['id_sumber'] == "")){
							echo "";
						}else {
							$sql = mysql_query("SELECT * FROM imr i , kabupaten k, sumber s WHERE i.id_sumber = s.id_sumber AND i.id_kab = k.kode_kab AND i.id_sumber = '$_POST[id_sumber]' AND i.tahun = '$_POST[slctTahun]' ");
							$content = "
							
							<h3 style='border-bottom:0px solid #000;'><center> Angka IMR Jawa Tengah <br> Berdasarkan $ket[nama_sumber] Tahun $x </h3>
							<br>											
							<table id=\"dyntable\" class=\"table table-bordered responsive\" >

					<thead>
                        <tr>
							<th><center>Kode</th>
                            <th><center>Kabupaten/Kota</th>
                            <th><center>Angka IMR (jiwa)</th>
					    </tr>
                    </thead>
					<tbody>";
						
						
						if (mysql_num_rows ($sql) == 0){
						echo "<br> <br> Tidak ada DATA";
						}else {	
								$i = 1;
								while($pecah = mysql_fetch_array($sql)){
									$content .= "
									<tr class=\" \">				
										<td><center>$pecah[id_kab]</td>
										<td>$pecah[nama_kab]</td>
										<td><center>$pecah[jumlah]</td>
									</tr>";
								$i++; 
		}
						$content .= "</tbody></table>";
						echo $content;
						
						?>

				<?php
				}
						}
						}
				?>
</div>