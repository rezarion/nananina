<style>
	#jateng_3301{
		background:#000;
	}
</style>
<script>
	jQuery(document).ready(function(){
		//alert("<?php echo (ISSET($_POST['kategori']))?$_POST['kategori']:''; ?>");
		var old_color ;
		jQuery('[id*=jateng_]').bind('mouseover',function(){
			old_color = jQuery(this).attr('fill');
			jQuery(this).attr('fill','yellow');
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 10000;visibility:visible');
		})
		
		jQuery('[id*=jateng_]').bind('mouseout',function(){
			jQuery(this).attr('fill',old_color);
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 10000;visibility:hidden');
		})
	})
</script>

<?php
/*
header('Content-type: image/svg+xml');
print("<?xml version=\"1.0\" encoding=\"iso-8859-1\" standalone=\"no\" ?>");
?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd" 
[<!ENTITY styleukm "fill: blue; fill-rule:red; stroke:none; stroke-width: 20; font-size: 100; text-rendering: optimizeLegibility;">]>*/

	include "koneksi.php";
	$t=0;

// MEMBACA TABEL PROJECT
$projectResult = mysql_query("SELECT * from project");
if ($myprojectrow = mysql_fetch_array($projectResult)) {
	do {
		$MapName= $myprojectrow["Title"];
		$Width= $myprojectrow["Width"];
		$Height= $myprojectrow["Height"];
		$Scale= $myprojectrow["Scale"];
		$TransFactor= $myprojectrow["TransFactor"];
		$IsProjected= $myprojectrow["IsProjected"];
		if ($IsProjected==0) {
			$LonMin= $myprojectrow["LonMin"];
			$LonMax= $myprojectrow["LonMax"];
			$LatMin= $myprojectrow["LatMin"];
			$LatMax= $myprojectrow["LatMax"];
		}
	} while ($myprojectrow = mysql_fetch_array($projectResult));
}

print("<svg id=\"main\" name='svgmap' width=\"900\" " . "height=\"750\" " . 
	"viewBox=\"20000 120000 " . ($Width*$TransFactor) . " " . ($Height*$TransFactor) . "\" " ." preserveAspectRatio=\"xMinYMin slice\"
>");
/***************************************************************************************************************************************************/

echo "<g id='maplayer' style='fill:#000;fill-rule:evenodd'>";
	//reading Kabupaten
	$layerID = 'jateng';
	echo "<g id='$layerID' style='fill:#DDD; stroke:#000; stroke-width:1;'>";
	$sql1 = mysql_query("SELECT * FROM kabupaten");
	
	if(ISSET($_POST['submit'])){
		//echo "<script>alert('aa');</script>";
		$kat = $_POST['cmbKat'];
			if($kat == 1){
				$sql1 = mysql_query("SELECT *, ((pria+wanita)/Luas) as hitung FROM kabupaten k left join jumlah_penduduk p ON k.kode_kab=p.kode_kab left join sumber s ON p.id_sumber = s.id_sumber WHERE p.tahun='$_POST[slctTahun]' AND p.id_sumber='$_POST[cmbKeterangan]'");
				
			}else if($kat == 3){
				$sql1 = mysql_query("SELECT *, jumlah as hitung FROM kabupaten k left join tfr t ON k.kode_kab=t.kode_kab left join sumber s ON t.id_sumber = s.id_sumber WHERE t.tahun='$_POST[slctTahun]' AND t.id_sumber='$_POST[cmbKeterangan]'");
				$rata = mysql_query("SELECT AVG(jumlah) as hitung FROM kabupaten k left join tfr t ON k.kode_kab=t.kode_kab left join sumber s ON t.id_sumber = s.id_sumber WHERE t.tahun='$_POST[slctTahun]' AND t.id_sumber='$_POST[cmbKeterangan]'");
				$rerata = mysql_fetch_array($rata);
				$rerata = $rerata['hitung'];
				
			}else if($kat == 2){
				$sql1 = mysql_query("SELECT *, jumlah as hitung FROM kabupaten k left join imr i ON k.kode_kab=i.id_kab left join sumber s ON i.id_sumber = s.id_sumber WHERE i.tahun='$_POST[slctTahun]' AND i.id_sumber='$_POST[cmbKeterangan]'");
				$rata = mysql_query("SELECT AVG(jumlah) as hitung FROM kabupaten k left join imr i ON k.kode_kab=i.id_kab left join sumber s ON i.id_sumber = s.id_sumber WHERE i.tahun='$_POST[slctTahun]' AND i.id_sumber='$_POST[cmbKeterangan]'");
				$rerata = mysql_fetch_array($rata);
				$rerata = $rerata['hitung'];
				
			}else if($kat == 4){
				$sql1 = mysql_query("SELECT *, jumlah as hitung FROM kabupaten k left join pengguna_kb pk ON k.kode_kab=pk.id_kab left join jenis_kb j ON pk.id_kb = j.id_kb
				WHERE pk.tahun='$_POST[slctTahun]' AND pk.id_kb='$_POST[cmbKeterangan]'");
				$rata = mysql_query("SELECT AVG(jumlah) as hitung FROM kabupaten k left join  pengguna_kb pk ON k.kode_kab=pk.id_kab left join jenis_kb j ON pk.id_kb = j.id_kb 
				WHERE pk.tahun='$_POST[slctTahun]' AND pk.id_kb='$_POST[cmbKeterangan]'");
				$rerata = mysql_fetch_array($rata);
				$rerata = $rerata['hitung'];
				
			}else if($kat == 5){
				$sql1 = mysql_query("SELECT *, jumlah as hitung FROM kabupaten k left join pengguna_jns_kb pk ON k.kode_kab = pk.id_kab left join ket_kb j ON pk.id_ket = j.id_ket
				WHERE pk.tahun = '$_POST[slctTahun]' AND pk.id_ket='$_POST[cmbKeterangan]'");
				$rata = mysql_query("SELECT AVG(jumlah) as hitung FROM kabupaten k left join  pengguna_jns_kb pk ON k.kode_kab=pk.id_kab left join ket_kb j ON pk.id_ket = j.id_ket
				WHERE pk.tahun='$_POST[slctTahun]' AND pk.id_ket='$_POST[cmbKeterangan]'");
				$rerata = mysql_fetch_array($rata);
				$rerata = $rerata['hitung'];
				
			}else{

			}
		}else{
			$sql = mysql_query("SELECT * FROM kabupaten");
		}
	
	while($f = mysql_fetch_array($sql1)){
		$subLayer = $layerID.'_'.$f['kode_kab'];
		$subLayer1 = 'label_'.$f['kode_kab'];
		$centerx = $f['XMin'] + ($f['XMax']-$f['XMin']) / 2;
		$centery = $f['YMin'] + ($f['YMax']-$f['YMin']) / 2;
		
		//tampilkan blobnya
		if(ISSET($_POST['submit'])){
			$kat = $_POST['cmbKat'];
			if($kat == 1){
				if(($f['hitung']) < 100){
					echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#000' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
					}else if (($f['hitung'])>=100 &&($f['hitung'])<= 199){		
					echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='green' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
					}else if (($f['hitung'])>=200 &&($f['hitung'])<= 799){		
					echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='blue' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
					}else if (($f['hitung'])>=800 &&($f['hitung'])<= 1199){		
					echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#61B9DE' style='stroke: #000066;
						stroke-width: 300px;' d='$f[Geometry]' />\n";
					}else if (($f['hitung'])>= 1199){		
					echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#D9EDF7' style='stroke: #000066;
						stroke-width: 300px;' d='$f[Geometry]' />\n";
					}
			}else if($kat == 3){
					if(($f['jumlah']) >= $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#D9EDF7' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}else if(($f['jumlah']) < $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#61B9DE' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}
			}else if($kat == 2){
					if(($f['jumlah']) >= $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#D9EDF7' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}else if(($f['jumlah']) < $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#61B9DE' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}
			}else if($kat == 4){
					if(($f['jumlah']) >= $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#D9EDF7' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}else if(($f['jumlah']) < $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#61B9DE' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}
			}else if($kat == 5){
					if(($f['jumlah']) >= $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#D9EDF7' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}else if(($f['jumlah']) < $rerata){
							echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#61B9DE' style='stroke: #000066;
							   stroke-width: 300px;' d='$f[Geometry]' />\n";
						}
			}else{
				echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#DDD' style='stroke: #000066; stroke-width: 300px;' d='$f[Geometry]' />\n";
			}
				
		}else{
			echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#DDD' style='stroke: #000066;
               stroke-width: 300px;' d='$f[Geometry]' />\n";
		}
	}
	echo "</g>";
	
	//echo "<g id='maplabel' style='fill:#000;fill-rule:evenodd'>";
	//reading Kabupaten
	$layerID = 'label';
	echo "<g id='$layerID' style='fill:#DDD; stroke:#000; stroke-width:1;'>";
	$sql = mysql_query("SELECT * FROM kabupaten");
	
	while($f = mysql_fetch_array($sql)){
		$subLayer = 'label_'.$f['kode_kab'];
		$centerx = $f['XMin'] + ($f['XMax']-$f['XMin']) / 2;
		$centery = $f['YMin'] + ($f['YMax']-$f['YMin']) / 2;
		echo "";
		if($f['kode_kab'] == '3301'){
			echo "<text id='$subLayer' x='".($centerx-40000)."' y='$centery' fill='#000' style=\"font-family:arial; fill: #000; font-size: 10000; visibility:hidden;\" >$f[nama_kab]</text>\n";
		}else{
			echo "<text id='$subLayer' x='$centerx' y='$centery' fill='#000' style=\"font-family:arial; fill: #000; font-size: 10000; visibility:hidden;\" >$f[nama_kab]</text>\n";
		}
	}
	echo "</g>";
?>
</g>
</svg>
