<?php 
session_start();

//include('header_hasil.php');
include('koneksi.php');
include('function.php');
include ("function_peta.php");

ERROR_REPORTING (0);
// print_r($_POST);
// die();
	
	$w = array();
	$v = array();
	$bbt = array();
	$hasil = array();
	$position_ = str_replace(' ', '', $_POST['lokasi']);
	$position = explode(',', $position_);
	// print_r($position);
	$query_jarak = "SELECT *,
        (6378137 * acos(cos(radians(".$position[0].")) 
        * cos(radians(lat)) * cos(radians(lng) 
        - radians(".$position[1].")) + sin(radians(".$position[0].")) 
        * sin(radians(lat)))) 
        AS jarak 
        FROM titik_rekomendasi
        HAVING jarak <= 2000
        ORDER BY jarak";
    // echo $query_jarak;
    // die();
     // $query_semua = $query_jarak;
    $query_semua = "SELECT * FROM titik_rekomendasi";
	$sql = mysql_query ($query_jarak) or die (mysql_error());
	
	$keberadaan = get_bobot_satu(round($_POST['keberadaan']));
	$kepadatan = get_bobot_dua(round($_POST['kepadatan']));
	$perkembangan = get_bobot_tiga(round($_POST['perkembangan']));
	$arus = get_bobot_empat($_POST['arus']);
	$potensi = get_bobot_lima(round($_POST['potensi']));
	//$jarak = get_bobot_empat($_POST['3']);

	array_push($w,$keberadaan);
	array_push($w,$kepadatan);
	array_push($w,$perkembangan);
	array_push($w,$arus);
	array_push($w,$potensi);
	//array_push($w,$jarak);

	/*AMBIL BOBOT (W) PREFERENSI KRITERIA*/
	$bb = 1;
	$bobot = mysql_query ("SELECT bobot FROM kriteria");
	while ($krit = mysql_fetch_array ($bobot)){
		$bbt[$bb] = $krit["bobot"];
		$bb += 1;
	}


	$alamat = $_POST['lokasi'];
	$lat_lokasi = $_POST['latitude'];
	$lng_lokasi = $_POST['longitude'];
	if ($alamat != '')
		$geo_alamat = geocode($alamat);
	else
		$geo_alamat = array($_POST['latitude'],$_POST['longitude'])
	

?>


	<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?sensor=false";></script>
	<!--<script type="text/javascript" src = "http://maps.googleapis.com/maps/api/js?v=3&sensor=false";></script>-->
	<script type="text/javascript" src = "../js2/infobox.js";></script>
	
	<link rel="stylesheet" href="../css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="../css/responsive-tables.css">
	
	<!--<link rel="stylesheet" href="../css/bootstrap-fileupload.min.css" type="text/css" />
	<link rel="stylesheet" href="../css/bootstrap-timepicker.min.css" type="text/css" />-->
	
	<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.9.2.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/jquery.cookie.js"></script>
	<script type="text/javascript" src="../js/modernizr.min.js"></script>
	<script type="text/javascript" src="../js/responsive-tables.js"></script>
	<script type="text/javascript" src="../js/custom.js"></script>
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

	        jQuery('#dyntable3').dataTable( {
	            "bScrollInfinite": true,
	            "bScrollCollapse": true,
	            "sScrollY": "300px"
	        });

	        jQuery('#dyntable4').dataTable( {
	            "bScrollInfinite": true,
	            "bScrollCollapse": true,
	            "sScrollY": "300px"
	        });

	        jQuery('#dyntable5').dataTable( {
	            "bScrollInfinite": true,
	            "bScrollCollapse": true,
	            "sScrollY": "300px"
	        });
	        
	    });
	</script>
	
	<div class="mainwrapper">
	
	    <div class="header">
        <div class="logo">
			<!--<img src="images/disperindag.png" alt="" style=" width:258px; height:110px; !important" />-->
			<img src="../images/disperindag.png" alt="" style=" width:200px; height:70px; margin-top:-20px; !important" />
		</div>
			<div class="headerinner">
                <ul class="headmenu">
					<li>
						<!--<img src="images/logo7.bmp" alt="" style=" width:910px; height:111px; !important"  />-->
						<img src="../images/logo8.png" alt="" style=" width:900px; height:20px; margin-top:40px; !important"  />
					</li>
				<li class="right">
                    <div class="userloggedinfo">
						
						<!--<img style='width:60px;height:90px;!important' src="-->
						<?php
							include "koneksi.php";
							$s = mysql_query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ");
							$ss = mysql_fetch_array($s);
						
							//echo "component/foto/".$ss['foto'] 
						
						?><!--"alt="" class="img-polaroid" />-->
						
                         <div class="userinfo">
                            <h5><?php echo $_SESSION['nama_user']; ?> <small>- <?php echo $_SESSION['username']; ?></small></h5>
                            <ul>
								<li> <a  data-toggle="modal" href="#myModal">Tentang Sistem <span class="iconfa-question-sign"></span></a></li>
                                <li><a href="main.php?menu=editProfile">Edit Profile <span class="iconfa-cog"></span></a></li>
                                <li><a href="logout.php">Sign Out <span class="iconfa-signout"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
			<!--</li>-->
            </ul><!--headmenu-->
        </div>
    </div>
	
	<div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>

					<li> <a href="../main.php"><span class="iconfa-home"></span>Home</a>
					</li>

			</ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="main.php"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Dashboard</li>
			<li class="right">
                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i> Color Skins</a>
                    <ul class="dropdown-menu pull-right skin-color">
                        <li><a href="default">Default</a></li>
                        <li><a href="navyblue">Navy Blue</a></li>
                        <li><a href="palegreen">Pale Green</a></li>
                        <li><a href="red">Red</a></li>
                        <li><a href="green">Green</a></li>
                        <li><a href="brown">Brown</a></li>
                    </ul>
            </li> 
        </ul>
		
        <!--<div class="pageheader">
            <form action="results.html" method="post" class="searchbar">
                <input type="text" name="keyword" placeholder="To search type and hit enter..." />
            </form>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>All Features Summary</h5>
                <h1>Dashboard</h1>
            </div>
        </div><!--pageheader-->
	
	<div class="maincontent">
	<div class="maincontentinner" style='position:relative;'>
	
	<a href="../main.php" class="iconfa-arrow-left"> Kembali Ke Menu Utama </a>
	
	<br> <br>
	<h3>Hasil</h3>
	
	<br>
	<!--<p>Diketahui Bobot (W) dari masukan = <?php// echo '('.$keberadaan.', '.$kepadatan.', '.$perkembangan.', '.$potensi.', '.$arus.')';?></p>-->

	<br>
	<h4 class="widgettitle">Tabel Alternatif</h4>
	<table class="table table-bordered table-infinite" id="dyntable2">
	    <colgroup>
            <col class="con1" style="align: center; width: 4%" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
           	<col class="con1" />
       	</colgroup>
	    <thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Titik</th>
	        <th>Keberadaan Sarana(C1)</th>
	        <th>Kepadatan Penduduk(C2)</th>
	        <th>Perkembangan Pemukiman(C3)</th>
	        <th>Potensi Ekonomi(C4)</th>
	        <th>Arus Lalu Lintas(C5)</th>
	        
	    </tr>
	    </thead>

	    <tbody>
	         <?php   
	         $no = 1;
	         while ($row = mysql_fetch_array ($sql))
	         { 
	         	$latng = $row['lat'].','.$row['lng'];
	         	$alamat = $geo_alamat[0].','.$geo_alamat[1];
	         	//${'jarak_'.$row['id_titik']} = dekat($alamat,$latng);
	         ?>
	         <tr>
	             <td><?php echo $no++;?></td>
	             <td><?php echo $row ['nama_titik']; ?></td>
	             <td><?php echo $row ['c1']; ?></td>
	             <td><?php echo $row ['c2']; ?></td>
	             <td><?php echo $row ['c3']; ?></td>
	             <td><?php echo $row ['c4']; ?></td>
	             <td><?php echo $row ['c5']; ?></td>
	             
	         </tr>
	         <?php } ?>
	    </tbody>

	</table>
	<br>
	<h4 class="widgettitle">Tabel Decission Matrix X</h4>
	<table class="table table-bordered table-infinite" id="dyntable3">
	    <colgroup>
            <col class="con1" style="align: center; width: 4%" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
           	<col class="con1" />
       	</colgroup>
	    <thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Titik</th>
	        <th>Keberadaan Sarana(C1)</th>
	        <th>Kepadatan Penduduk(C2)</th>
	        <th>Perkembangan Pemukiman(C3)</th>
	        <th>Potensi Ekonomi(C4)</th>
	        <th>Arus Lalu Lintas(C5)</th>
	        
	    </tr>
	    </thead>

	    <tbody>
	         <?php  
	         $no=1; 
			 $sql2 = mysql_query ($query_jarak) or die (mysql_error());
	         while ($row = mysql_fetch_array ($sql2))
	         {
	         ?>
	         <tr>
	             <td ><?php echo $no++;?></td>
	             <td><?php echo $row['nama_titik']; ?></td>
	             <td><?php echo get_bobot_satu($row ['c1']); ?></td>
	             <td><?php echo get_bobot_dua($row ['c2']); ?></td>
	             <td><?php echo get_bobot_tiga($row ['c3']); ?></td>
	             <td><?php echo get_bobot_empat($row ['c4']); ?></td>
	             <td><?php echo get_bobot_lima($row ['c5']); ?></td>
	             
	         </tr>
	         <?php } ?>
	    </tbody>

	</table>

	<br>
	<h4 class="widgettitle">Tabel Normalisasi</h4>
	<table class="table table-bordered table-infinite" id="dyntable4">
	    <colgroup>
            <col class="con1" style="align: center; width: 4%" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
           	<col class="con1" />
       	</colgroup>
	    <thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Titik</th>
	        <th>Keberadaan Sarana(C1)</th>
	        <th>Kepadatan Penduduk(C2)</th>
	        <th>Perkembangan Pemukiman(C3)</th>
	        <th>Potensi Ekonomi(C4)</th>
	        <th>Arus Lalu Lintas(C5)</th>
	        
	    </tr>
	    </thead>

	    <tbody>
	         <?php   
			 $sql2 = mysql_query ($query_jarak) or die (mysql_error());
			 $no = 1;
			
			 $c1 = get_bobot_satu(get_max_alternatif('c1'));
			 $c2 = get_bobot_dua(get_max_alternatif('c2'));
			 $c3 = get_bobot_tiga(get_max_alternatif('c3'));
			 $c4 = get_bobot_empat(get_max_alternatif('c4'));
			 $c5 = get_bobot_lima(get_max_alternatif('c5'));


			 		/*$ar_max = array();
			 		$query_c = mysql_query ($query_jarak) or die (mysql_error());

			 		while ($row = mysql_fetch_array ($query_c))
			 	    {
			 	    	array_push($ar_max, ${'jarak_'.$row['id_titik']});
			 	    }
			     	$max_jarak = max($ar_max);*/

			 	   
			 		
			 	
			 //$c5 = get_bobot_empat($max_jarak);
			 
	         while ($row = mysql_fetch_array ($sql2))
	         { 
	         	$newdata =  array (
	         	      //'c1' => @(round((get_bobot_satu($row ['c1'])/$c1),3)),
	         		  'c1' => @(round(($c1/get_bobot_satu($row ['c1'])),3)),
	         	      'c2' => @(round((get_bobot_dua($row ['c2'])/$c2),3)),
	         	      'c3' => @(round((get_bobot_tiga($row ['c3'])/$c3),3)),
	         	      'c4' => @(round((get_bobot_empat($row ['c4'])/$c4),3)),
	         	      'c5' => @(round((get_bobot_lima($row ['c5'])/$c5),3)),
	         	      //'c5' => @(round((get_bobot_empat(${'jarak_'.$row['id_titik']})/$c5),3)),
	         	    );
	         	array_push($v,$newdata);	
	         ?>
	         <tr>
	             <td><?php echo $no++;?></td>
	             <td><?php echo get_nama($row['id_titik']); ?></td>
	             <!--<td><?php// echo '<span class="text-muted">'.get_bobot_satu($row ['c1']).'/'.$c1.'= </span>'.@(round(get_bobot_satu($row ['c1'])/$c1,3)); ?></td>-->
	             <td><?php echo '<span class="text-muted">'.$c1.'/'.get_bobot_satu($row ['c1']).'= </span>'.@(round($c1/get_bobot_satu($row ['c1']),3)); ?></td>
	             <td><?php echo '<span class="text-muted">'.get_bobot_dua($row ['c2']).'/'.$c2.'= </span>'.@(round(get_bobot_dua($row ['c2'])/$c2,3)); ?></td>
	             <td><?php echo '<span class="text-muted">'.get_bobot_tiga($row ['c3']).'/'.$c3.'= </span>'.@(round(get_bobot_tiga($row ['c3'])/$c3,3)); ?></td>
	             <td><?php echo '<span class="text-muted">'.get_bobot_empat($row ['c4']).'/'.$c4.'= </span>'.@(round(get_bobot_empat($row ['c4'])/$c4,3)); ?></td>
	             <td><?php echo '<span class="text-muted">'.get_bobot_lima($row ['c5']).'/'.$c5.'= </span>'.@(round(get_bobot_lima($row ['c5'])/$c5,3)); ?></td>
	             
	         </tr>
	         <?php } ?>
	    </tbody>

	</table>
	<br>

	
	<h4 class="widgettitle">Tabel Perankingan</h4>
	<table class="table table-bordered table-infinite" id="dyntable5">
	    <colgroup>
            <col class="con1" style="align: center; width: 4%" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <col class="con0" />
           	<col class="con1" />
       	</colgroup>
	    <thead>
	    <tr>
	        <th>No</th>
	        <th>Nama Titik</th>
	        <th>Matriks Normalisasi dikali Bobot Preferensi</th>
	       	<th>Hasil</th>
	    </tr>
	    </thead>

	    <tbody>
			<?php //print_r($v);
			$i = 0;
			$no = 1;
			$sql = mysql_query ($query_jarak) or die (mysql_error());
			while ($row = mysql_fetch_array ($sql))
			{
				$id = $row['id_titik'];
				$hitungv= 	($v[$i]['c1']*$bbt[1])+($v[$i]['c2']*$bbt[2])+($v[$i]['c3']*$bbt[3])+($v[$i]['c4']*$bbt[4])+($v[$i]['c5']*$bbt[5]);
				$new_data =  array (
			         	      'id_titik' => $id,
			         	      'hasil' => round($hitungv,3)
			         	    );
			    array_push($hasil,$new_data);
			?>
		     <tr>
		     	<td><?php echo $no++;?></td>       
		        <td><?php echo $row['nama_titik'];?></td>
		        <td><?php echo '('.$v[$i]['c1'].' * '.$bbt[1].') + ('.$v[$i]['c2'].' * '.$bbt[2].
		                   ') + ('.$v[$i]['c3'].' * '.$bbt[3].') + ('.$v[$i]['c4'].' * '.$bbt[4].
		                   ') + ('.$v[$i]['c5'].' * '.$bbt[5].') = ';?></td>
		        <td><?php echo '<b>'.$hasil[$i]['hasil'].'</b>' ?></td>
    		</tr>
    		<?php 
    			$i++;
    				$numbers = array_map('get_hasil', $hasil);
					$max = max($numbers);   

					$id = get_id_terpilih($max, $hasil);
					$id_terpilih = $hasil[$id]['id_titik'];
					$nama_titik = get_nama($id_terpilih);
					//untuk koordinat terpilih
					$koor_position = get_position($id_terpilih); 
			} 
			?> 

	  	 </tbody>
    </table>

	<br>
	<p style="font-size:20px">
		Dari perhitungan yang sudah dilakukan, hasil V tertinggi adalah = <b><?php echo $max;?></b>
		<br>
		Dengan ini dapat disimpulkan bahwa Alternatif penempatan Toko Modern terbaik
		berada pada = <b><?php echo $nama_titik;?></b>
	</p>
	
	<br>
	<br>


	
	<script type="text/javascript">
	<?php
		//extract($_POST, EXTR_SKIP);
		$_POST['lokasi'] = str_replace(' ', '', $_POST['lokasi']);
		echo "alert('terpelatuk');\n";
		echo "var input_lokasi = '".$_POST['lokasi']."';\n";
	?>
	var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map;
	var oldDirections = [];
	var currentDirections = null;
	var marker;
	var latlng;

	function myPos() {
	    var lok = parseFloat(document.getElementById('lokasi').value);
	    var newLatLng = new google.maps.LatLng(lok);
	    marker.setPosition(newLatLng)
	}

	function initialize() {
		<?php 	
		   	//echo "var latlng = new google.maps.LatLng(-6.989772,110.422229);"; //simpang lima
		   	//echo "var latlng = new google.maps.LatLng(-6.966667,110.416667);"; //kota semarang
			//extract($_POST, EXTR_SKIP);
			//echo "var lat = parseFloat(document.getElementById('latitude').value);";
			//echo "var lng = parseFloat(document.getElementById('longitude').value);";
			//echo "var newLatLng = new google.maps.LatLng(lat, lng);";
			
		?>

		input_lokasi = input_lokasi.split(',');

		latlng = new google.maps.LatLng(parseFloat(input_lokasi[0]),parseFloat(input_lokasi[1]));
		// var latlng = new google.maps.LatLng(<?=$_POST['lokasi']?>);

		var myOptions = {
			zoom : 10,
			center : latlng,
			//radius: 1,
    		//color: '#FFFF99',
			mapTypeId: google.maps.MapTypeId.ROADMAP //bisa HYBRID atau lainnya
		};

		map = new google.maps.Map(document.getElementById("kanvas_peta"),myOptions);

        map.setCenter(latlng);
		
		marker = new google.maps.Marker({
		 	position: latlng,
		 	map: map,
		 	draggable: false
		});

		// HTML5 Geolocation
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
	                                       position.coords.longitude);
			<?php        
			    echo "var icon = '".$base_url."img/place.png';";
			    echo "var nama_titik = '';";
			    echo "var aaa = '';";
			    echo "tambah_marker(map,nama_titik,pos,icon,aaa,'','');";
			  
	    		//echo "var latlng = new google.maps.LatLng(-0.506914,117.159225);";
	  		?>
 
          }, function() {
            handleLocationError(true, map.getCenter());
          });
        } else {
          handleLocationError(false, map.getCenter());
        }
      
		
		/*---DIRECTION---*/
		directionsDisplay = new google.maps.DirectionsRenderer({
			'map': map,
			'preserveViewport': true,
			'draggable': true
		});
		directionsDisplay.setPanel(document.getElementById("directions_panel"));

		<?php
			$sql = mysql_query ($query_jarak) or die (mysql_error());
			$i=0;
			while ($row = mysql_fetch_array ($sql))
			{
				$i++;
				echo "var latlngm_$i = new google.maps.LatLng($row[lat],$row[lng]);\n"; 
				echo "var icon = '".$base_url."img/marker_toko.png';\n";
				echo "var nama_titik = '$row[nama_titik]';\n";
				echo "var desc = '';\n";
				echo "tambah_marker(map,nama_titik,latlngm_$i,icon,desc,'','');\n";
				
				echo "var batas = new google.maps.LatLngBounds();\n";
				echo "batas.extend(latlng);\n";
				echo "batas.extend(latlngm_$i);\n";
				echo "map.fitBounds(batas);\n";
			}

			$cari_input = $id_terpilih;
			$cari = mysql_query ("SELECT * FROM titik_rekomendasi WHERE id_titik =$cari_input") or die (mysql_error());
			$row_cari = mysql_fetch_array($cari);
		  
			$latit = $geo_alamat[0];
			$longi = $geo_alamat[1];
		  
			echo "var latlngmd = new google.maps.LatLng($row_cari[lat],$row_cari[lng]);\n"; 
			echo "var ikon1 = '".$base_url."img/arrow.png';\n";
			//echo "var radius =  1,";
	    	//echo "color = '#FFFF99'";
			echo "var nama_titik = '';\n";
			echo "var aaa = '';\n";

			echo "calcRoute(new google.maps.LatLng($latit,$longi),latlngmd);\n";

			$cari1 = mysql_query ("SELECT * FROM titik_rekomendasi where id_titik =$cari_input") or die (mysql_error());
			$b=0;
			while ($row_cari3 = mysql_fetch_array($cari1)){
				$rs = $row_cari3['id_titik'];
				$nama_titik = $row_cari3['nama_titik'];
				
				$lat = $row_cari3['lat'];
				$lng = $row_cari3['lng'];
				$b++;

				echo "var latlngmc_$b = new google.maps.LatLng($lat,$lng);\n"; 
				echo "var ikon1 = '".$base_url."img/arrow.png';\n";
				//echo "var radius =  1,";
	    		//echo "color = '#FFFF99'";
				echo "var nama_titik = '$nama_titik';\n";
				echo "var aaa = '';\n";
				echo "tambah_marker(map,nama_titik,latlngmc_$b,ikon1,aaa,'','set');\n";
		
				echo "var batas = new google.maps.LatLngBounds();\n";
				echo "batas.extend(latlng);\n";
				echo "batas.extend(latlngmc_$b);\n";
				echo "map.fitBounds(batas);\n";
			  }
			
		?>

		map.setCenter(latlng);



			
	 
	}


	</script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EiBwX-b-KOGPbWUIlXdRbvVl7WfN9vo&callback=initialize" type="text/javascript"></script>

	<div class="map">
	  <div id="kanvas_peta" style="width:100%; height:100vh; position:absolute;"></div>
	  <div id="directions_panel" style="width:300; z-index:10000; position:absolute; overflow:hidden; background:#f8f8f8 "></div>
	</div>
    
				<div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2015. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
	</div><!--rightpanel-->
    
	</div><!--mainwrapper-->
	
	</body>
</html>