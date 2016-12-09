<center><h4><b>Peta Kota Semarang</b></h4>
<!--<p>Kota Semarang merupakan ibu kota propinsi Jawa Tengah yang terdiri dari 16 kecamatan dan 177 kelurahan.
Anda dapat melihat informasi setiap kelurahan dengan mengarahkan mouse dan memilih salah satu kelurahan pada peta berikut.
</p>--></center>
<br>


<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<!--<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>-->

<style>
	#kelurahan_1{
		background:#000;
	}
</style>

<!-- JS EFEK MOUSE PADA PETA -->
<script>
	jQuery(document).ready(function(){
		jQuery('[id*=kelurahan_]').bind('mouseover',function(){
			jQuery(this).attr('fill','#168cba');
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 4500; font-weight: bold; visibility:visible');
		})
			
		jQuery('[id*=kelurahan_]').bind('mouseout',function(){
			jQuery(this).attr('fill','#DDD');
			val = jQuery(this).attr('class');
			jQuery('#'+val).attr('style','font-family:arial; fill: #000; font-size: 4500; font-weight: bold;visibility:hidden');
		})
			
		jQuery('[id*=kelurahan_]').click(function(){
			$('html, body').animate({scrollTop:1000},'100000000');			
			//alert('aaa');
			var id = jQuery(this).attr('id');
			jQuery.ajax({
				type : 'POST',
				data : 'id='+id,
				url  : 'component/ajax_petakel.php',
				success : function(msg){
					jQuery('.data').html(msg);
				}
			})
		})
	})
</script>

<?php
include "koneksi.php";
$t=0;

/* MEMBACA TABEL PROJECT */
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

/* MENAMPILKAN KOTAK INFO*/
print("<center><svg class=\"naik\" id=\"main\" name='svgmap' width=\"880\" " . "height=\"630\" " . 
	"viewBox=\"0 0 " . ($Width*$TransFactor) . " " . ($Height*$TransFactor) . "\" " ." preserveAspectRatio=\"xMinYMin meet\">");
	//xMinYMin meet    xMidYMid slice
	
echo "<g id='maplayer' style='fill:#000;fill-rule:evenodd'>";
	//reading kelurahan
	$layerID = 'kelurahan';
	echo "<g id='$layerID' style='fill:#DDD; stroke:#000; stroke-width:1;'>";
	$sql = mysql_query("SELECT * FROM kelurahan");

	while($f = mysql_fetch_array($sql)){
		$subLayer = $layerID.'_'.$f['id_kelurahan'];
		$subLayer1 = 'label_'.$f['id_kelurahan'];
		$centerx = $f['XMin'] + ($f['XMax']-$f['XMin']) / 2;
		$centery = $f['YMin'] + ($f['YMax']-$f['YMin']) / 2;
		//tampilkan blobnya
							
		echo "<path id='$subLayer' class='$subLayer1' centerx='$centerx' centery='$centery' fill='#DDD' style='stroke: #000066;stroke-width: 300px;' d='$f[Geometry]' />\n";
	}
	echo "</g>";
	
	//nama kelurahan
	$layerID = 'label';
	echo "<g id='$layerID' style='fill:#DDD; stroke:#000; stroke-width:1;'>";
	$sql = mysql_query("SELECT * FROM kelurahan");
	
	while($f = mysql_fetch_array($sql)){
		$subLayer = 'label_'.$f['id_kelurahan'];
		$centerx = $f['XMin'] + ($f['XMax']-$f['XMin']) / 2;
		$centery = $f['YMin'] + ($f['YMax']-$f['YMin']) / 2;
	
		echo "<text id='$subLayer' x='$centerx' y='$centery' fill='#000' style=\"font-family:arial; fill: #000; font-size: 10000; visibility:hidden;\" >$f[Kelurahan]</text>\n";
	}
	echo "</g>";
	
?>
</g>
</svg>
</center>

<div class='data'></div>