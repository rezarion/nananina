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

<?php
	include "koneksi.php";	
?>			
<div class="l-content-wrap">
  <section class="panel" style='width:100%; height:48% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Kepadatan Penduduk Jawa Tengah</h4>
			</div><!-- m-page-title -->
			<div>
				<p><center>Kepadatan penduduk hitung adalah jumlah penduduk setiap satuan luas tanah di lokasi tersebut.</p>
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
					$sql1 = mysql_query("SELECT * FROM jumlah_penduduk t, sumber s WHERE t.id_sumber = s.id_sumber AND t.id_sumber = '$y' AND t.tahun = '$x' ");	
					$ket = mysql_fetch_array($sql1);
						if(($_POST['slctTahun'] == "") &&($_POST['id_sumber'] == "")){
							echo "";
						}else {
							$sql = mysql_query("SELECT * FROM jumlah_penduduk p, kabupaten k, sumber s WHERE p.id_sumber = s.id_sumber AND p.kode_kab = k.kode_kab AND p.id_sumber = '$_POST[id_sumber]' AND p.tahun = '$_POST[slctTahun]' ");
							$content = "
							<h3 style='border-bottom:0px solid #000;'><center> Kepadatan Penduduk Jawa Tengah Menurut Kabupaten/Kota <br> Berdasarkan $ket[nama_sumber] Tahun $_POST[slctTahun] </h3>
							<br>						
							<table id=\"dyntable\" class=\"table table-bordered responsive\">
							
					<thead>
                        <tr class='active'>
							<th style='width: 20px;'>Kode</th>
                            <th style='width: 40px;'>Kabupaten/Kota</th>
                            <th style='width: 60px;'><center>Jumlah Laki-laki <br>(jiwa)</th>
                            <th style='width: 60px;'><center>Jumlah Perempuan <br>(jiwa)</th>
							<th style='width: 60px;'><center>Total <br>(jiwa)</th>
                            <th style='width: 60px;'><center>Luas <br> (km2)</th>
                            <th style='width: 70px;'><center>Kepadatan Penduduk <br> (jiwa/km2)</th>
                        </tr>
                    </thead>
					<tbody>";
						
						if (mysql_num_rows ($sql) == 0){
						echo "
						<div class='row'>
							<div class='col-lg-4'>
							<div class='alert alert-dismissable alert-info'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<strong>Tidak Ada data
						  </div>
						  </div>
						</div>";
						}else {	
								$i = 1;
								while($pecah = mysql_fetch_array($sql)){
								$pria = number_format($pecah['pria']);
								$wanita = number_format($pecah['wanita']);
								$a = $pecah['wanita']+$pecah['pria'];
								$total = number_format($a);
								$luas = number_format($pecah['Luas'],2);
								$b = number_format(($a / $pecah['Luas']),2);
									$content .= "
									<tr class=''>
										<td>$pecah[kode_kab]</td>
										<td>$pecah[nama_kab]</td>
										<td><center>$pria</td>
										<td><center>$wanita</td>
										<td><center>$total</td>
										<td><center>$luas</td>
										<td><center>$b</td>
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
</div>

