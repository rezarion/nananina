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
  <section class="panel" style='width:100%; height:50% !important'>
    <div class="panel-body"> 
			<div class="m-page-title">
				<h4><center>Jumlah Pengguna KB Berdasarkan Metode Kontrasepsi</h4>
			</div><!-- m-page-title -->
			<div>
				<p><center>Data jumlah pengguna KB berdasarkan metode/alat kontrasepsi merupakan hasil laporan statistik rutin BKKBN. <br/>Beberapa jenis metode kontrasepsi yaitu pil, suntik, kondom, IUD, Implan, MOW (tubektomi), dan MOP (Vasektomi).</p>
			</div>
			<br>
		<form class="form-horizontal tasi-form" role="form" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label" for="exampleSelect">Tahun</label>
                <div class="col-lg-10">
                  <select class="form-control" style='margin-top:0%; margin-left:0%;width:15%; !important' select id="selectTahun" name="slctTahun">
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
				
				<label class="col-sm-2 col-sm-2 control-label" style="" for="exampleSelect">Jenis KB</label>
                <div class="col-lg-10">
                  <select class="form-control" style="margin-top:0%; margin-left:0%; !important" name="id_ket">
					<option selected="selected" value="0"> </option>
						<?php
						$s_jenis= mysql_query("select * from ket_kb");
						while ($r_jenis=mysql_fetch_array($s_jenis)) {
							if($r_jenis['id_ket']==$ss['id_ket']){
								echo "<option value=\"$r_jenis[id_ket]\" selected> $r_sumber[ket_kb]</option>";
							}else{
								echo "<option value=\"$r_jenis[id_ket]\"> $r_jenis[ket_kb]</option>";
							}
						}
					?>
					</select>
                </div><!-- .col-sm-10 -->				
              </div><!-- .form-group -->
				
			<div class="form-group">
				  <div class="col-lg-10 col-lg-offset-2" style='margin-top:-1% !important'>
					<!--<button class="btn btn-default">Cancel</button> -->
					<button type="submit" class="btn btn-primary" style="" name='preview'><a href="" style="text-decoration=:none; color:white;">Tampilkan</a></button> 
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
					$y = $_POST['id_ket'];
					$sql1 = mysql_query("SELECT * FROM pengguna_jns_kb p, ket_kb j WHERE p.id_ket = j.id_ket AND p.id_ket = '$y' AND p.tahun = '$x' ");
					$ket = mysql_fetch_array($sql1);
					
						if(($_POST['slctTahun'] == "") &&($_POST['id_ket'] == "")){
							echo "";
						}else {
							$sql = mysql_query("SELECT * FROM pengguna_jns_kb p , kabupaten k, ket_kb j WHERE p.id_ket = j.id_ket and p.id_kab = k.kode_kab and p.id_ket = '$_POST[id_ket]' and p.tahun = '$_POST[slctTahun]' ");
							$content = "
							<h3 style='border-bottom:0px solid #000;'><center> Jumlah Pengguna KB Menggunakan $ket[ket_kb] <br>Provinsi Jawa Tengah Tahun $_POST[slctTahun] </h3>
							<br>						
							<table id=\"dyntable\" class=\"table table-bordered responsive\">
         			<thead>
                        <tr>
                           
							<th><center>Kode</th>
                            <th><center>Kabupaten/Kota</th>
                            <th><center>Jumlah (%)</th>
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
										<td><center>$pecah[nama_kab]</td>
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
</div>