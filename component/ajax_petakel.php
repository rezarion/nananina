<?php 
	include "koneksi.php";
	$id = explode('_',$_POST['id']);
	$id = $id[1];
	
	$sql = mysql_query("SELECT * FROM kelurahan WHERE id_kelurahan='$id'");
	$kel = mysql_fetch_array($sql);
?>

<link rel="stylesheet" href="../css/style.default.css" type="text/css" />

<script>
	jQuery(document).ready(function(){
		jQuery('.kel-content-keberadaan').show();
		jQuery('.kel-content-kepadatan').hide();
		jQuery('.kel-content-perkembangan').hide();
		jQuery('.kel-content-potensi').hide();
		jQuery('.kel-content-arus').hide();
		
		jQuery('.kel-keberadaan').click(function(){
			jQuery('.kel-content-keberadaan').show();
			jQuery('.kel-content-kepadatan').hide();
			jQuery('.kel-content-perkembangan').hide();
			jQuery('.kel-content-potensi').hide();
			jQuery('.kel-content-arus').hide();
		});
		
		jQuery('.kel-kepadatan').click(function(){
			jQuery('.kel-content-kepadatan').show();
			jQuery('.kel-content-keberadaan').hide();
			jQuery('.kel-content-perkembangan').hide();
			jQuery('.kel-content-potensi').hide();
			jQuery('.kel-content-arus').hide();
		});
		
		jQuery('.kel-perkembangan').click(function(){
			jQuery('.kel-content-perkembangan').show();
			jQuery('.kel-content-keberadaan').hide();
			jQuery('.kel-content-kepadatan').hide();
			jQuery('.kel-content-potensi').hide();
			jQuery('.kel-content-arus').hide();
		});
		
		jQuery('.kel-potensi').click(function(){
			jQuery('.kel-content-potensi').show();
			jQuery('.kel-content-keberadaan').hide();
			jQuery('.kel-content-kepadatan').hide();
			jQuery('.kel-content-perkembangan').hide();
			jQuery('.kel-content-arus').hide();
		});
		
		jQuery('.kel-arus').click(function(){
			jQuery('.kel-content-arus').show();
			jQuery('.kel-content-keberadaan').hide();
			jQuery('.kel-content-kepadatan').hide();
			jQuery('.kel-content-perkembangan').hide();
			jQuery('.kel-content-potensi').hide();
			
		});
	})
</script>
	<div class="tabbable" style='top:-200px !important' >

		<h3><b>Kelurahan <?php echo $kel['Kelurahan'];?></b></h3> </br>
                <ul class="nav nav-tabs buttons-icons">
				<li class="kel-keberadaan active"><a href="#keberadaan" data-toggle="tab">Keberadaan Sarana</a></li>
				<li class="kel-kepadatan"><a href="#kepadatan" data-toggle="tab">Kepadatan Penduduk</a></li>
				<li class="kel-perkembangan" ><a href="#perkembangan" data-toggle="tab">Perkembangan Pemukiman</a></li>
				<li class="kel-potensi"><a href="#potensi" data-toggle="tab">Potensi Ekonomi</a></li>
				<li class="kel-arus"><a href="#arus" data-toggle="tab">Arus Lalu Lintas</a></li>
			</ul>
			
			
			<div id="myTabContent" class="tab-content">
				<div class="kel-content-keberadaan tab-pane" id="keberadaan">
					<!--tampilkan data keberadaan sarana-->
					<br><h4><b>Keberadaan Sarana</b></h4> </br>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="30%" align="center">Tahun</th>
								<th width="30%" align="center">Banyaknya Keberadaan Sarana</th>
								<th width="40%" align="center">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$a = mysql_query("SELECT * FROM keberadaan_sarana b, klasifikasi_keberadaan c, kelurahan d, kriteria e
												WHERE b.id_klasifikasikeberadaan = c.id_klasifikasikeberadaan
												AND e.nama_kriteria = 'Keberadaan Sarana'
												AND b.id_kelurahan = d.id_kelurahan
												AND d.id_kelurahan = '$id'
												ORDER BY b.tahun desc");
							
							while($pecah =  mysql_fetch_array($a)){
							//$bulan = bulan($pecah['bulan']);
							// $skor = $pecah['nilai_variabel'] * $pecah['bobot'];
							echo "
							<tr>
								<td>$pecah[tahun]</td>
								<td>$pecah[banyak_sarana]</td>
								<td>$pecah[klas_keberadaan]</td>
							</tr>";
							}
						?>			
						</tbody>
					</table>
				</div>
				
				<div class="kel-content-kepadatan tab-pane" id="kepadatan">
					<!--tampilkan data kepadatan penduduk-->
					<br><h4><b>Kepadatan Penduduk</b></h4> </br>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="30%" align="center">Tahun</th>
								<th width="30%" align="center">Nilai Kepadatan Penduduk</th>
								<th width="40%" align="center">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$a = mysql_query("SELECT * FROM kepadatan_penduduk b, klasifikasi_kepadatan c, kelurahan d, kriteria e
												WHERE b.id_klasifikasikepadatan = c.id_klasifikasikepadatan
												AND e.nama_kriteria = 'Kepadatan Penduduk'
												AND b.id_kelurahan = d.id_kelurahan
												AND d.id_kelurahan = '$id'
												ORDER BY b.tahun desc");
							
							while($pecah =  mysql_fetch_array($a)){
							//$bulan = bulan($pecah['bulan']);
							// $skor = $pecah['nilai_variabel'] * $pecah['bobot'];
							echo "
							<tr>
								<td>$pecah[tahun]</td>
								<td>$pecah[nilai_kepadatan]</td>
								<td>$pecah[klas_kepadatan]</td>
							</tr>";
							}
						?>			
						</tbody>
					</table>
				</div>
				
				<div class="kel-content-perkembangan tab-pane" id="perkembangan">
					<!--tampilkan data perkembangan pemukiman-->
					<br><h4><b>Perkembangan Pemukiman</b></h4> </br>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="30%" align="center">Tahun</th>
								<th width="30%" align="center">Nilai Perkembangan Pemukiman</th>
								<th width="40%" align="center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$a = mysql_query("SELECT * FROM perkembangan_pemukiman b, klasifikasi_perkembangan c, kelurahan d, kriteria e
													WHERE b.id_klasifikasiperkembangan = c.id_klasifikasiperkembangan
													AND e.nama_kriteria = 'Perkembangan Pemukiman'
													AND b.id_kelurahan = d.id_kelurahan
													AND d.id_kelurahan = '$id'
													ORDER BY b.tahun desc");
								
								while($pecah =  mysql_fetch_array($a)){
								// $skor = $pecah['nilai_variabel'] * $pecah['bobot'];
								echo "
								<tr>
									<td>$pecah[tahun]</td>
									<td>$pecah[nilai_perkembangan]</td>
									<td>$pecah[klas_perkembangan]</td>
								</tr>";
								}
							?>						
						</tbody>
					</table>
				</div>
				
				<div class="kel-content-potensi tab-pane" id="potensi">
					<!-- tampilkan data potensi ekonomi-->
					<br><h4><b>Potensi Ekonomi</b></h4> </br>
						<table class="table table-bordered">
							<thead>
							<tr>
								<th width="30%" align="center">Tahun</th>
								<th width="30%" align="center">Nilai Potensi Ekonomi</th>
								<th width="40%" align="center">Status</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$a = mysql_query("SELECT * FROM potensi_ekonomi b, klasifikasi_potensi c, kelurahan d, kriteria e
												WHERE b.id_klasifikasipotensi = c.id_klasifikasipotensi
												AND e.nama_kriteria = 'Potensi Ekonomi'
												AND b.id_kelurahan = d.id_kelurahan
												AND d.id_kelurahan = '$id'
												ORDER BY b.tahun desc");
												
								while($pecah =  mysql_fetch_array($a)){
								// $skor = $pecah['nilai_variabel'] * $pecah['bobot'];
								echo "
								<tr>
									<td>$pecah[tahun]</td>
									<td>$pecah[nilai_potensi]</td>
									<td>$pecah[klas_potensi]</td>
								</tr>";
								}
							?>
							</tbody>
						</table>
						
					
				</div>
				
				<div class="kel-content-arus tab-pane" id="arus">
					<!-- tampilkan data arus lalulintas-->	
					<br><h4><b>Arus Lalu Lintas</b></h4> </br>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th width="30%" align="center">Tahun</th>
							<th width="30%" align="center">Nilai Arus Lalu Lintas</th>
							<th width="40%" align="center">Status</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$a = mysql_query("SELECT * FROM arus_lalulintas b, klasifikasi_arus c, kelurahan d, kriteria e
												WHERE b.id_klasifikasiarus = c.id_klasifikasiarus
												AND e.nama_kriteria = 'Arus Lalu Lintas'
												AND b.id_kelurahan = d.id_kelurahan
												AND d.id_kelurahan = '$id'
												ORDER BY b.tahun desc");
							
							while($pecah =  mysql_fetch_array($a)){
							// $skor = $pecah['nilai_variabel'] * $pecah['bobot'];
							echo "
							<tr>
								<td>$pecah[tahun]</td>
								<td>$pecah[nilai_arus]</td>
								<td>$pecah[klas_arus]</td>
							</tr>";
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	function bulan($bulan) { 
	Switch($bulan){ 
	case 1 : $bulan="Januari"; Break; 
	case 2 : $bulan="Februari"; Break; 
	case 3 : $bulan="Maret"; Break; 
	case 4 : $bulan="April"; Break; 
	case 5 : $bulan="Mei"; Break; 
	case 6 : $bulan="Juni"; Break; 
	case 7 : $bulan="Juli"; Break; 
	case 8 : $bulan="Agustus"; Break; 
	case 9 : $bulan="September"; Break; 
	case 10 : $bulan="Oktober"; Break; 
	case 11 : $bulan="November"; Break;
	case 12 : $bulan="Desember"; Break; 
	} 
	return $bulan; }
?>
