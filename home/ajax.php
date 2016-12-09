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
		jQuery('.kab-content-data2').hide();
		jQuery('.kab-content-tfr').hide();
		jQuery('.kab-content-imr').hide();
		
		jQuery('.kab-data').click(function(){
			jQuery('.kab-content-data').show();
			jQuery('.kab-content-data2').hide();
			jQuery('.kab-content-tfr').hide();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-imr').click(function(){
			jQuery('.kab-content-imr').show();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-data2').hide();
			jQuery('.kab-content-tfr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-tfr').click(function(){
			jQuery('.kab-content-tfr').show();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-data2').hide();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-data2').click(function(){
			jQuery('.kab-content-data2').show();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-tfr').hide();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-penduduk').hide();
		});
		
		jQuery('.kab-penduduk').click(function(){
			jQuery('.kab-content-penduduk').show();
			jQuery('.kab-content-imr').hide();
			jQuery('.kab-content-data').hide();
			jQuery('.kab-content-data2').hide();
			jQuery('.kab-content-tfr').hide();
			
		});

	})
</script>
<div class="l-content-wrap" >
	<div class="col-lg-12" style='top:-150px;'>
				<h3><b><?php echo $kab['nama_kab'];?></b></h3>
                <ul class="nav nav-pills">
					
                  <li class="kab-penduduk active"><a href="#kab" data-toggle="tab">Jumlah Penduduk</a></li>
                  <li class="kab-tfr"><a href="#tfr" data-toggle="tab">TFR</a></li>
                  <li class="kab-imr"><a href="#imr" data-toggle="tab">IMR</a></li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      KB <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li class="kab-data"><a href="#kb1" data-toggle="tab">Pelayanan Kontrasepsi</a></li>
					  <li class="divider"></li>
                      <li class="kab-data2"><a href="#kb2" data-toggle="tab">Peserta KB Aktif</a></li>
                    </ul>
                  </li>
                </ul>
			 <div id="myTabContent" class="tab-content">
				 <div class="kab-content-penduduk tab-pane fade active in" id="kab">
				<?php					
						$s = mysql_query("SELECT * FROM jumlah_penduduk p, kabupaten k , sumber s
						WHERE 
							k.kode_kab='$id' and p.id_sumber = s.id_sumber and p.kode_kab = k.kode_kab 
							");
						$pecah =  mysql_fetch_array($s);
						//print_r($d);
						
						//tampilkan data penduduk
						echo "
						<table id=\"dyntable\" class=\"table table-bordered responsive\">
							<thead>
								<tr class='active'>					
									<th>Sumber</th>";
										$thn = mysql_query("SELECT DISTINCT tahun FROM jumlah_penduduk where kode_kab='$id' ORDER BY tahun limit 0,4");
										while($th =mysql_fetch_array($thn)){
											echo "<th colspan='2' style='text-align:center;'>$th[tahun]</th>";
										}
						echo "</tr><tr><th rowspan='2'></th>";
								$thn = mysql_query("SELECT DISTINCT tahun FROM jumlah_penduduk where kode_kab='$id' ORDER BY tahun limit 0,4");
										while($th =mysql_fetch_array($thn)){
											echo "<th style='width:50px; text-align:center;'>Pria</th>";
											echo "<th style='width:50px; text-align:center;'>Wanita</th>";
										}
							echo "</tr></thead>
							<tbody>";
						//$i = 1;
						$sql2 = mysql_query("SELECT * FROM sumber");
						while($f = mysql_fetch_array($sql2)){
							echo "<tr>
									<td>$f[nama_sumber]</td>";
								$thn = mysql_query("SELECT DISTINCT tahun FROM jumlah_penduduk where kode_kab='$id' ORDER BY tahun limit 0,4");
								
								while($th =mysql_fetch_array($thn)){
									$datanya  = mysql_query("SELECT pria, wanita FROM jumlah_penduduk WHERE tahun='$th[tahun]' AND kode_kab='$id' AND id_sumber='$f[id_sumber]'");
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
				 <div class="kab-content-tfr" id="tfr">
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
							<tr class='active'>
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
									echo "<td>-</td>";
								}
							}
							
							echo "</tr>";
					}
					echo "</tbody>
					</table>";

				?>
                  </div>
				  <div class="kab-content-imr" id="imr">
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
							<tr class='active'>
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
									echo "<td>-</td>";
								}
							}
							echo "</tr>";
					}
					echo "</tbody>
					</table>";

				?>	
                  </div>
				  <div class="kab-content-data" id="kb1">
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
								<tr class='active'>
									<th >Keterangan</th>";
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
										echo "<td>-</td>";
									}
								}
								
								echo "</tr>";
						
						}
						echo "</tbody>
						</table>
						<p>Sumber : Laporan Statistik Rutin BKKBN </p>";	  
					?>
                  </div>
				  <div class="kab-content-data2" id="kb2">
                    <?php
							
						$s = mysql_query("SELECT * FROM pengguna_jns_kb pk, ket_kb j, kabupaten k 
						WHERE 
							pk.id_kab = k.kode_kab and
							pk.id_ket = j.id_ket and
							k.kode_kab='$id'");
						$pecah =  mysql_fetch_array($s);
						//print_r($d);
						
						//tampilkan data pengguna kb
						echo "
						<table id=\"dyntable\" class=\"table table-bordered responsive\">
							<thead>
								<tr class='active'>
									<th >Jenis KB</th>";
										$thn = mysql_query("SELECT DISTINCT tahun FROM pengguna_jns_kb ORDER BY tahun limit 0,5");
										while($th =mysql_fetch_array($thn)){
											echo "<th>$th[tahun]</th>";
										}

						echo "
								</tr>
							</thead>
							<tbody>";
						$i = 1;
						$sql2 = mysql_query("SELECT * FROM ket_kb");
						while($f = mysql_fetch_array($sql2)){
							echo "<tr>
								<td>$f[ket_kb]</td>";
								$thn = mysql_query("SELECT DISTINCT tahun FROM pengguna_jns_kb ORDER BY tahun limit 0,5");
								while($th =mysql_fetch_array($thn)){
									$datanya  = mysql_query("SELECT jumlah FROM pengguna_jns_kb WHERE tahun='$th[tahun]' AND id_kab='$id' AND id_ket='$f[id_ket]'");
									$ff = mysql_fetch_array($datanya);
									if(mysql_num_rows($datanya) > 0){
									echo "<td>$ff[jumlah]</td>";
									}else{
										echo "<td>-</td>";
									}
								}
								
								echo "</tr>";
						
						}
						echo "</tbody>
						</table>
						<p>Sumber : Laporan Statistik Rutin BKKBN </p>";	  
						
					?>
                  </div>
            </div>  
	</div>
</div>