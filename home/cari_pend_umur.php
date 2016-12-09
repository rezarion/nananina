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
  <section class="panel" style='width:100%; height:45% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Jumlah Penduduk Jawa Tengah Berdasarkan Range Umur</h4>
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
						if(($_POST['slctTahun'] == "") &&($_POST['id_sumber'] == "")){
							echo "";
						}else {
							$sql = mysql_query("SELECT * FROM jumlah_penduduk_umur p, range_umur r, sumber s WHERE p.id_sumber = s.id_sumber AND p.id_range = r.id_range AND p.id_sumber = '$_POST[id_sumber]' AND p.tahun = '$_POST[slctTahun]' ");
							$content = "
							<h3 style='border-bottom:0px solid #000;'><center> Jumlah Penduduk Berdasarkan Range Umur Jawa Tengah <br> Menurut $ket[nama_sumber] Tahun $_POST[slctTahun] </h3>
							<br>						
							<table id=\"dyntable\" class=\"table table-bordered responsive\">

					<thead>
                        <tr class='active'>
                            <th><center>Range</th>
                            <th><center>Laki-laki <br>(jiwa)</th>
                            <th><center>Perempuan <br>(jiwa)</th>
                            <th><center>Total <br>(jiwa)</th>
                        </tr>
                    </thead>
					<tbody>";
						
						if (mysql_num_rows ($sql) == 0){
						echo "<br> <br> Tidak ada DATA";
						}else {	
								$i = 1;
								while($pecah = mysql_fetch_array($sql)){
								$a = $pecah['perempuan']+$pecah['laki'];
								$jml = number_format($a);
								$pria = number_format($pecah['laki']);
								$wanita = number_format($pecah['perempuan']);
									$content .= "
									<tr class=\" \">
										<td><center>$pecah[nama_range]</td>
										<td><center>$pria</td>
										<td><center>$wanita</td>
										<td><center>$jml</td>
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