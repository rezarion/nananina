<?php 
	include "koneksi.php";
	$id = explode('_',$_POST['id']);
	$id = $id[1];
	
	$sql = mysql_query("SELECT * FROM kabupaten where kode_kab='$id'");
	$kab = mysql_fetch_array($sql);
?>
 
<link rel="stylesheet" href="../css/style.default.css" type="text/css" />

<script>
	jQuery(document).ready(function(){
		jQuery('.kab-content-penduduk').show();
		jQuery('.kab-content-data').hide();
		jQuery('.kab-content-tfr').hide();
		jQuery('.kab-content-imr').hide();
		
		jQuery('.kab-data').click(function(){
			jQuery('.kab-content-data').show();
			jQuery('.kab-content-tfr').hide();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-imr').click(function(){
			jQuery('.kab-content-imr').show();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-tfr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-tfr').click(function(){
			jQuery('.kab-content-tfr').show();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-penduduk').click(function(){
			jQuery('.kab-content-penduduk').show();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-tfr').hide();
			
		});

	})
</script>

<div class="l-content-wrap">
	<div class="panel-group" id="accordion">
	<!--<div style='background:none repeat scroll 0 0 #0866C6;color:#FFF; border:1px solid #0866C6;border-collapse:collapse'> -->
		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title kab-penduduk">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				<?php echo $kab['nama_kab'];?>
			  </a>
			</h4>
			</div>
			<!-- isinya -->
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class='kab-content-penduduk'>
					<?php					
						$s = mysql_query("SELECT * FROM penduduk p, kabupaten k 
						WHERE 
							k.kode_kab='$id' and p.kode_kab = k.kode_kab 
							");
						$pecah =  mysql_fetch_array($s);
						//print_r($d);
						
						//tampilkan data penduduk
						echo "
						<table id=\"dyntable\" class=\"table table-bordered responsive\">
							<thead>
								<tr>
									";
										$thn = mysql_query("SELECT DISTINCT tahun FROM penduduk where kode_kab='$id' ORDER BY tahun limit 0,5");
										while($th =mysql_fetch_array($thn)){
											echo "<th colspan='2'>$th[tahun]</th>";
										}
						echo "</tr><tr>";
								$thn = mysql_query("SELECT DISTINCT tahun FROM penduduk where kode_kab='$id' ORDER BY tahun limit 0,5");
										while($th =mysql_fetch_array($thn)){
											echo "<th style='width:50px'><center>Pria</th>";
											echo "<th style='width:50px'><center>Wanita</th>";
										}
							echo "</tr></thead>
							<tbody>";
						//$i = 1;
						$sql2 = mysql_query("SELECT DISTINCT kode_kab FROM penduduk WHERE kode_kab='$id'");
						while($f = mysql_fetch_array($sql2)){
							echo "<tr>
									";
								$thn = mysql_query("SELECT DISTINCT tahun FROM penduduk where kode_kab='$id' ORDER BY tahun limit 0,5");
								
								while($th =mysql_fetch_array($thn)){
									$datanya  = mysql_query("SELECT pria, wanita FROM penduduk WHERE tahun='$th[tahun]' AND kode_kab='$id'");
									echo mysql_error();
									$ff = mysql_fetch_array($datanya);
									if(mysql_num_rows($datanya) > 0){
										echo "<td><center>$ff[pria]</td>";
										echo "<td><center>$ff[wanita]</td>";
									}else{
										echo "<td>-</td>";
										echo "<td>-</td>";
									}
								}
								echo "</tr>";				
						}
						echo "</tbody>
						</table>";
					?>	
				</div>
			</div>
		</div>
		  
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title kab-data">
				  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
					Data Pengguna KB
				  </a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse in">	
				<div class='panel-body kab-content-data'>
					<?php
							
						$s = mysql_query("SELECT * FROM pengguna_kb pk, jenis_kb j, kabupaten k 
						WHERE 
							pk.id_kab = k.kode_kab and
							pk.id_kb = j.id_kb and
							k.kode_kab='$id'");
						$pecah =  mysql_fetch_array($s);
						//print_r($d);
						
						//tampilkan data pengguna kb
						echo "
						<table id=\"dyntable\" class=\"table table-bordered responsive\">
							<thead>
								<tr>
									<th >Jenis KB</th>";
										$thn = mysql_query("SELECT DISTINCT tahun FROM pengguna_kb ORDER BY tahun limit 0,5");
										while($th =mysql_fetch_array($thn)){
											echo "<th>$th[tahun]</th>";
										}

						echo "
								</tr>
							</thead>
							<tbody>";
						$i = 1;
						$sql2 = mysql_query("SELECT * FROM jenis_kb");
						while($f = mysql_fetch_array($sql2)){
							echo "<tr>
									<td>$f[nama_kb]</td>";
								$thn = mysql_query("SELECT DISTINCT tahun FROM pengguna_kb ORDER BY tahun limit 0,5");
								while($th =mysql_fetch_array($thn)){
									$datanya  = mysql_query("SELECT jumlah FROM pengguna_kb WHERE tahun='$th[tahun]' AND id_kab='$id' AND id_kb='$f[id_kb]'");
									$ff = mysql_fetch_array($datanya);
									if(mysql_num_rows($datanya) > 0){
									echo "<td>$ff[jumlah]</td>";
									}else{
										echo "<td>0</td>";
									}
								}
								
								echo "</tr>";
						
						}
						echo "</tbody>
						</table>";	  
					?>	
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title kab-tfr">
				  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
					Data TFR
				  </a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse in">						   
			   <div class='kab-content-tfr'>
				<?php
									
					$s = mysql_query("SELECT * FROM tfr t, sumber s, kabupaten k 
					WHERE 
						t.kode_kab = k.kode_kab and
						t.id_sumber = s.id_sumber and
						k.kode_kab='$id'");
					$pecah =  mysql_fetch_array($s);
					//print_r($d);
					
					//tampilkan tfr
					echo "
					<table id=\"dyntable\" class=\"table table-bordered responsive\">
						<thead>
							<tr>
								<th >Sumber</th>";
									$thn = mysql_query("SELECT DISTINCT tahun FROM tfr ORDER BY tahun limit 0,5");
									while($th =mysql_fetch_array($thn)){
										echo "<th>$th[tahun]</th>";
									}

					echo "
							</tr>
						</thead>
						<tbody>";
					$i = 1;
					$sql2 = mysql_query("SELECT * FROM sumber");
					while($f = mysql_fetch_array($sql2)){
						echo "<tr>
								<td>$f[nama_sumber]</td>";
							$thn = mysql_query("SELECT DISTINCT tahun FROM tfr ORDER BY tahun limit 0,5");
							while($th =mysql_fetch_array($thn)){
								$datanya  = mysql_query("SELECT jumlah FROM tfr WHERE tahun='$th[tahun]' AND kode_kab='$id' AND id_sumber='$f[id_sumber]'");
								$ff = mysql_fetch_array($datanya);
								if(mysql_num_rows($datanya) > 0){
								echo "<td>$ff[jumlah]</td>";
								}else{
									echo "<td>0</td>";
								}
							}
							
							echo "</tr>";
					}
					echo "</tbody>
					</table>";

				?>	
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title kab-imr">
				  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
					Data IMR
				  </a>
				</h4>
			</div>
			<div id="collapseFour" class="panel-collapse collapse in">						   
			   <div class='kab-content-imr'>
				<?php
									
					$s = mysql_query("SELECT * FROM imr i, sumber s, kabupaten k 
					WHERE 
						i.id_kab = k.kode_kab and
						i.id_sumber = s.id_sumber and
						k.kode_kab='$id'");
					$pecah =  mysql_fetch_array($s);
					//print_r($d);
					
					//tampilkan imr
					echo "
					<table id=\"dyntable\" class=\"table table-bordered responsive\">
						<thead>
							<tr>
								<th >Sumber</th>";
									$thn = mysql_query("SELECT DISTINCT tahun FROM imr ORDER BY tahun limit 0,5");
									while($th =mysql_fetch_array($thn)){
										echo "<th>$th[tahun]</th>";
									}

					echo "
							</tr>
						</thead>
						<tbody>";
					$i = 1;
					$sql2 = mysql_query("SELECT * FROM sumber");
					while($f = mysql_fetch_array($sql2)){
						echo "<tr>
								<td>$f[nama_sumber]</td>";
							$thn = mysql_query("SELECT DISTINCT tahun FROM imr ORDER BY tahun limit 0,5");
							while($th =mysql_fetch_array($thn)){
								$datanya  = mysql_query("SELECT jumlah FROM imr WHERE tahun='$th[tahun]' AND id_kab='$id' AND id_sumber='$f[id_sumber]'");
								$ff = mysql_fetch_array($datanya);
								if(mysql_num_rows($datanya) > 0){
								echo "<td>$ff[jumlah]</td>";
								}else{
									echo "<td>0</td>";
								}
							}
							echo "</tr>";
					}
					echo "</tbody>
					</table>";

				?>	
				</div>
			</div>
		</div>
	</div>
</div>