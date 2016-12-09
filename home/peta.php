<center><h4><b>Peta Penyebaran Penduduk Provinsi Jawa Tengah</b></h4>
<p>Anda dapat melihat informasi setiap kabupaten dengan mengarahkan mouse Anda dan memilih salah satu kabupaten pada peta berikut.</p></center>

<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<style>
	#jateng_3301{
		background:#000;
	}
</style>
<script>
	jQuery(document).ready(function(){
		jQuery('[id*=jateng_]').bind('mouseover',function(){
			jQuery(this).attr('fill','yellow');
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 10000;visibility:visible');
		})
		
		jQuery('[id*=jateng_]').bind('mouseout',function(){
			jQuery(this).attr('fill','#DDD');
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 10000;visibility:hidden');
		})
		
		jQuery('[id*=jateng_]').click(function(){
			$('html, body').animate({scrollTop:300},'1000');			
			//alert('aaa');
			var id = jQuery(this).attr('id');
			jQuery.ajax({
				type : 'POST',
				data : 'id='+id,
				url  : 'home/ajax.php',
				success : function(msg){
					jQuery('.data').html(msg);
				}
			})
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
// ini hilangkan 

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

print("<svg id=\"main\" name='svgmap' width=\"950\" " . "height=\"700\" " . 
	"viewBox=\"0 110000 " . ($Width*$TransFactor) . " " . ($Height*$TransFactor) . "\" " ." preserveAspectRatio=\"xMinYMin slice\"
>");
/***************************************************************************************************************************************************/

echo "<g id='maplayer' style='fill:#000;fill-rule:evenodd'>";
	//reading Kabupaten
	$layerID = 'jateng';
	echo "<g id='$layerID' style='fill:#DDD; stroke:#000; stroke-width:1;'>";
	$sql = mysql_query("SELECT * FROM kabupaten");
	//$sql1 = mysql_query("SELECT * FROM kabupaten k left join penduduk_sp p ON k.kode_kab=p.kode_kab");
	//$sqla = mysql_query("SELECT AVG(pria+wanita) as rerata FROM penduduk_sp");
	
	//$rerata = mysql_fetch_array($sqla);
	while($f = mysql_fetch_array($sql)){
		$subLayer = $layerID.'_'.$f['kode_kab'];
		$subLayer1 = 'label_'.$f['kode_kab'];
		$centerx = $f['XMin'] + ($f['XMax']-$f['XMin']) / 2;
		$centery = $f['YMin'] + ($f['YMax']-$f['YMin']) / 2;
		//tampilkan blobnya
		
			echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#DDD' style='stroke: #000066;
               stroke-width: 300px;' d='$f[Geometry]' />\n";
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

<div class='data'></div>