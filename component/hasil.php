<?php 
if (!isset($_SESSION))
	session_start();

//include('header_hasil.php');
include('koneksi.php');
include('function.php');
include ("function_peta.php");

// ERROR_REPORTING (0);
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


			        /*//UNION

		            $query_jarak = "SELECT * FROM keberadaan_sarana b, klasifikasi_keberadaan c, kelurahan d, titik_rekomendasi e
											WHERE b.id_klasifikasikeberadaan = c.id_klasifikasikeberadaan
											AND b.id_kelurahan = d.id_kelurahan = e.id_kelurahan";

	             	//UNION

	             	$query_jarak = "SELECT * FROM kepadatan_penduduk b, klasifikasi_kepadatan c, kelurahan d, titik_rekomendasi e
											WHERE b.id_klasifikasikepadatan = c.id_klasifikasikepadatan
											AND b.id_kelurahan = d.id_kelurahan = e.id_kelurahan";
					//UNION
	             	
	             	$query_jarak = "SELECT * FROM perkembangan_pemukiman b, klasifikasi_perkembangan c, kelurahan d, titik_rekomendasi e
											WHERE b.id_klasifikasiperkembangan = c.id_klasifikasiperkembangan
											AND b.id_kelurahan = d.id_kelurahan = e.id_kelurahan";

	             	//UNION

	             	$query_jarak = "SELECT * FROM potensi_ekonomi b, klasifikasi_potensi c, kelurahan d, titik_rekomendasi e
											WHERE b.id_klasifikasipotensi = c.id_klasifikasipotensi
											AND b.id_kelurahan = d.id_kelurahan = e.id_kelurahan";

	             	//UNION

	             	$query_jarak = "SELECT * FROM arus_lalulintas b, klasifikasi_arus c, kelurahan d, titik_rekomendasi e
											WHERE b.id_klasifikasiarus = c.id_klasifikasiarus
											AND b.id_kelurahan = d.id_kelurahan = e.id_kelurahan";				
				//";*/
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
	<script type="text/javascript" src = "js2/infobox.js";></script>
	
	<link rel="stylesheet" href="css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="css/responsive-tables.css">
	
	<!--<link rel="stylesheet" href="../css/bootstrap-fileupload.min.css" type="text/css" />
	<link rel="stylesheet" href="../css/bootstrap-timepicker.min.css" type="text/css" />-->
	
<!-- 	<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.9.2.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../js/jquery.cookie.js"></script>
	<script type="text/javascript" src="../js/modernizr.min.js"></script>
	<script type="text/javascript" src="../js/responsive-tables.js"></script>
	<script type="text/javascript" src="../js/custom.js"></script> -->
	<script type="text/javascript">
	    jQuery(document).ready(function(){
	        // dynamic table
	        jQuery('#dyntable').dataTable({
	            "bScrollInfinite": true,
	            "bScrollCollapse": true,
	            "sScrollY": "300px"
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
	            "sScrollY": "300px",
	            /*"fnRowCallback" : function(nRow, aData, iDisplayIndex){      
                    var oSettings = oAllLinksTable.fnSettings();
                    $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                    return nRow;
                }*/
                /*var index = iDisplayIndex +1;
				$('td:eq(0)',nRow).html(index);
				return nRow;*/
				"fnDrawCallback": function( oSettings ) {
				    // use jQuery to alter the content of certain cells
				    $('#dyntable5').find('tr').not(':eq(0)').each(function(i){
				    //using children('td:eq(0)') I'm getting the first td element inside the tr
				    $(this).children('td:eq(0)').addClass('sno').text(i+1);
					});
				}
	        });

	        //$('#num_sort').html(oSettings._iDisplayStart+iDisplayIndex +1);
	        $('#hasil_sort').trigger('click');
	        $('#hasil_sort').trigger('click');

	       /* $('#dyntable5').find('tr').not(':eq(0)').each(function(i){
		        //using children('td:eq(0)') I'm getting the first td element inside the tr
		        $(this).children('td:eq(0)').addClass('sno').text(i+1);
		    });*/

	        //var iter = 1;
	        // $('#dyntable5 tbody tr').each(function () {
	        // 	$(this).first('td').html(iter);
	        // 	iter++;
	        // })

	        // tablee.draw();

	        /*$(document).ready(function() {
			    if(!localStorage.count) {
			        localStorage.count = 0;   
			    }
			    localStorage.count++;
			    var num = localStorage.count;
			    $("#num_sort").text(num);
			});*/

	        // tabel_hasil.order([3, 'desc']).draw();
	        
	    });
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
		    //use a special class name or id for the table
		    //using find I'm getting all tr elements in the table
		    //using not(':eq(0)') I'm ignoring the first tr element
		    //using each I'm iterating through the selected elements
		    	//var iter=1;
		    
		});

		/*$(document).ready(function(){
    
		$('tbody > tr').sort(function (a, b) {
		    return +$('td.hasil_lala', b).text() > +$('td.hasil_lala', a).text();
		}).appendTo('tbody').find('td:first').text(function(index) {
		    return ++index + '.';
		});
		    
		});*/
	</script>

	<center><h4><b>Hasil Metode FMADM SAW Titik Radius 2 km</b></h4>
	</center>
	<br>

<p style="font-size: 14">
	<b> 1. Melakukan Identifikasi Kriteria (Cj). </b> <br>
	Identifikasi Kriteria : <br>
	C1 = Keberadaan Sarana <br>
	C2 = Kepadatan Penduduk <br>
	C3 = Perkembangan Pemukiman <br>
	C4 = Potensi Ekonomi <br>
	C5 = Arus Lalu Lintas
</p>
<br>

<p style="font-size: 14">
	<b> 2. Menentukan Nilai Bobot Preferensi (W). </b> <br>
	Identifikasi Bobot : <br>
	W1 untuk C1 = Sangat Tinggi, dengan nilai 0.30 <br>
	W2 untuk C2 = Tinggi, dengan nilai 0.25 <br>
	W3 untuk C3 = Sedang, dengan nilai 0.20 <br>
	W4 untuk C4 = Rendah, dengan nilai 0.15 <br>
	W5 untuk C5 = Sangat Rendah, dengan nilai 0.10
</p>
<br>

<p style="font-size: 14">
	<b> 3. Memberikan nilai masukan dari setiap alternatif pada setiap kriteria. </b> <br>
<div class="widget">
	<h4 class="widgettitle">Tabel Nilai Masukan</h4>
	<div class="widgetcontent">
	<table class="table table-bordered table-infinite" id="dyntable">
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
	</div>
	</div>
	<br>

<p style="font-size: 14">
	<b> 4. Memberikan nilai rating kecocokan setiap alternatif (Ai) pada setiap kriteria (Cj) yang sudah ditentukan. </b> <br>
	Nilai setiap alternatif (Ai) disajikan dalam bentuk variabel linguistik. <br>
	Variabel linguistik masing-masing kriteria ditentukan oleh pakar instansi terkait.
</p>
<div class="widget">
	<h4 class="widgettitle">Tabel Nilai Rating Kecocokan dari Setiap Alternatif</h4>
	<div class="widgetcontent">
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
	         $sql2 = mysql_query ($query_jarak) or die (mysql_error());
	         while ($row = mysql_fetch_array ($sql2))
	         { 
	         	$latng = $row['lat'].','.$row['lng'];
	         	$alamat = $geo_alamat[0].','.$geo_alamat[1];
	         	//${'jarak_'.$row['id_titik']} = dekat($alamat,$latng);
	         ?>
	         <tr>
	             <td><?php echo $no++;?></td>
	             <td><?php echo $row ['nama_titik']; ?></td>
	             <td><?php echo get_status_satu($row ['c1']); ?></td>
	             <td><?php echo get_status_dua($row ['c2']); ?></td>
	             <td><?php echo get_status_tiga($row ['c3']); ?></td>
	             <td><?php echo get_status_empat($row ['c4']); ?></td>
	             <td><?php echo get_status_lima($row ['c5']); ?></td>
	             
	         </tr>
	         <?php } ?>
	    </tbody>

	</table>
	</div>
	</div>
	<br>

	<p style="font-size: 14">
		<b> 5. Membuat Matriks Keputusan (X). </b> <br>
		Dari konversi bilangan fuzzy ke bilangan crisp, <br>
		dapat dibentuk matriks keputusan berdasarkan kriteria (Cj).
	</p>
	<div class="widget">
	<h4 class="widgettitle">Tabel Matriks Keputusan (X)</h4>
	<div class="widgetcontent">
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
	</div>
	</div>
	<br>

	<p style="font-size: 14">
		<b> 6. Membuat Matriks Ternormalisasi (R). </b> <br>
		Proses normalisasi dilakukan berdasarkan persamaan yang disesuai dengan jenis kriteria. <br>
		Jenis kriteria : <br>
		Keuntungan (Benefit) = Semakin tinggi nilainya, maka semakin baik <br>
		Biaya (Cost)		 = Semakin rendah nilainya, maka semakin baik
	</p>
	<div class="widget">
	<h4 class="widgettitle">Tabel Matriks Ternormalisasi (R)</h4>
	<div class="widgetcontent">
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
			
			 $c1 = get_bobot_satu(get_max_alternatif_jarak('c1'));
			 $c2 = get_bobot_dua(get_max_alternatif_jarak('c2'));
			 $c3 = get_bobot_tiga(get_max_alternatif_jarak('c3'));
			 $c4 = get_bobot_empat(get_max_alternatif_jarak('c4'));
			 $c5 = get_bobot_lima(get_max_alternatif_jarak('c5'));


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
	</div>
	</div>
	<br>

	<p style="font-size: 14">
		<b> 7. Melakukan Proses Perangkingan. </b> <br>
		Proses perangkingan dilakukan dengan mencari Nilai Preferensi (Vi) berdasarkan persamaan, yaitu <br>
		penjumlahan dari perkalian matriks ternormalisasi (R) dengan vektor bobot (W).
	</p>
	<div class="widget">
	<h4 class="widgettitle">Tabel Nilai Pereferensi (Vi)</h4>
	<div class="widgetcontent">
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
	       	<th id="hasil_sort">Hasil</th>
	    </tr>
	    </thead>

	    <tbody>
			<?php 
			//print_r($v);
			//$hasil = array();
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
				//print_r($hasil);

			    /*----- COBA usort -----
				usort($new_data, function($a, $b) {
				  return $a['hasil'] - $b['hasil'];
				});
				//print_r($new_data);
				array_push($hasil,$new_data);
				*/

				/* ----- COBA ARRAY FLIP -----
				//hasil diambil 2 dibelakang koma
				$hasil = round($hitungv,3);
				//create a copy and sort
				$hasil_copy = $hasil;
				sort($hasil_copy);
				//reverse key and values
				$hasil_copy = array_flip($hasil_copy);
				//create result by using keys from sorted values + 1
				foreach ($hasil as $val)
					$hasil2[] =  $hasil_copy[$val]+1;
			    array_push($hasil2,$new_data);
			    */
				
				/*----- COBA multisort -----
				$hasil_sort = array();
				foreach ($new_data as $key => $row) {
					//replace 0 with the field's index/key
					$hasil_sort[$key] = $row['hasil'];
				}
				array_multisort($hasil_sort, SORT_DESC, $new_data);
				array_push($hasil,$new_data);
				*/
			    
			?>
		     <tr>
		     	<td class="sno"></td>       
		        <td><?php echo $row['nama_titik'];?></td>
		        <td><?php echo '('.$v[$i]['c1'].' * '.$bbt[1].') + ('.$v[$i]['c2'].' * '.$bbt[2].
		                   ') + ('.$v[$i]['c3'].' * '.$bbt[3].') + ('.$v[$i]['c4'].' * '.$bbt[4].
		                   ') + ('.$v[$i]['c5'].' * '.$bbt[5].') = ';?></td>
		        <td class="hasil_lala"><?php echo '<b>'.$hasil[$i]['hasil'].'</b>' ?></td>
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
    </div>
    </div>
	<br>

	<p style="font-size: 14">
		<b> 8. Hasil Akhir. </b> <br>
		Hasil akhir diperoleh dari nilai preferensi (Vi) terbesar yang dipilih sebagai alternatif terbaik sebagai solusi.
	</p>
	<br>
	<p style="font-size:20px">
		Dari perhitungan yang sudah dilakukan, hasil V tertinggi adalah = <b><?php echo $max;?></b>
		<br>
		Dengan ini dapat disimpulkan bahwa Alternatif penempatan Toko Modern terbaik
		berada pada titik = <b><?php echo $nama_titik;?></b>
	</p>
	
	<br>
	<br>

	<table class="table table-bordered table-infinite">
		<tr>
			<div class="map" >
			  <div id="kanvas_peta" style="width:100%; height:100vh; "></div>
			  <div id="directions_panel" style="width:300; z-index:10000; position:absolute; overflow:hidden; background:#f8f8f8;"></div>
			</div>			
		</tr>
	</table>

	
	<script type="text/javascript">
	<?php
		//extract($_POST, EXTR_SKIP);
		$_POST['lokasi'] = str_replace(' ', '', $_POST['lokasi']);
		//echo "alert('terpelatuk');\n";
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
			zoom : 13,
			center : latlng,
			//radius: 1,
    		//color: '#FFFF99',
			mapTypeId: google.maps.MapTypeId.ROADMAP //bisa HYBRID, ROADMAP, dll
		};

		map = new google.maps.Map(document.getElementById("kanvas_peta"),myOptions);

        map.setCenter(latlng);
		
		marker = new google.maps.Marker({
		 	position: latlng,
		 	map: map,
		 	draggable: false
		});

		// Add circle overlay and bind to marker
		var circle = new google.maps.Circle({
		  map: map,
		  radius: 2000,
		  fillColor: '#FFFF99'
		});
		circle.bindTo('center', marker, 'position');
      
		
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
				echo "var icon = '".$base_url."img/lightblue.png';\n";
				//echo" var icon = '".$base_url."http://maps.google.com/mapfiles/ms/micons/blue.png';\n";
				echo "var nama_titik = '$row[nama_titik]';\n";
				echo "var desc = '';\n";
				echo "tambah_marker(map,nama_titik,latlngm_$i,icon,desc,'','');\n";
				
				//echo "var batas = new google.maps.LatLngBounds();\n";
				//echo "batas.extend(latlng);\n";
				//echo "batas.extend(pos);\n";
				//echo "batas.extend(latlngm_$i);\n";
				//echo "map.fitBounds(batas);\n";
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
		
				//echo "var batas = new google.maps.LatLngBounds();\n";
				//echo "batas.extend(latlng);\n";
				//echo "batas.extend(pos);\n";
				//echo "batas.extend(latlngmc_$b);\n";
				//echo "map.fitBounds(batas);\n";
			  }
			
		?>

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

			    echo "var batas = new google.maps.LatLngBounds();\n";
			    echo "batas.extend(latlng);\n";
				echo "batas.extend(pos);\n";
				echo "batas.extend(latlngm_$i);\n";
				echo "batas.extend(latlngmc_$b);\n";
				echo "map.fitBounds(batas);\n";  
	    		
	  		?>
 
          	}, function() {
            	handleLocationError(true, map.getCenter());
          	});
        } 
        else {
         	 handleLocationError(false, map.getCenter());
        }

		// map.setCenter(latlng);

		//google.maps.event.addDomListener(window, 'load', initialize);

			
	 
	}


	</script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EiBwX-b-KOGPbWUIlXdRbvVl7WfN9vo&callback=initialize" type="text/javascript"></script>

        