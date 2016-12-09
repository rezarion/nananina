<?php

error_reporting(E_ALL);
//error_reporting(0);
set_time_limit(0);

date_default_timezone_set('Europe/London');

include "koneksi.php";

?>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Hai</title>

	</head>
	<body>

	<?php

	/** Include path **/
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

	/** PHPExcel_IOFactory */
	include 'PHPExcel/IOFactory.php';


	//$inputFileName = 'example1.xls';
	$inputFileName = 'pasar_tradisional.xls';
	echo 'Hai,';
	echo '<br/> janggal';
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


	echo '<hr />';

	$objWorksheet = $objPHPExcel->getActiveSheet();
	$highestRow = $objWorksheet->getHighestRow(); // e.g. 10

	

	for ($row = 7; $row <= $highestRow; ++$row) {
		
		$kelurahan = urlencode($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
		$nama = urlencode($objWorksheet->getCellByColumnAndRow(2, $row)->getValue());
		$golongan = urlencode($objWorksheet->getCellByColumnAndRow(3, $row)->getValue());
		$uptd = urlencode($objWorksheet->getCellByColumnAndRow(4, $row)->getValue());
		$alamat = urlencode($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
		$tahun = urlencode($objWorksheet->getCellByColumnAndRow(6, $row)->getValue());
		
		//cocokan id_kelurahan
		$sql = mysql_query("SELECT DISTINCT id_kelurahan, Kelurahan FROM kelurahan
								WHERE Kelurahan LIKE '%$kelurahan%' ");
		$kelurahan = mysql_fetch_array($sql)['id_kelurahan'];
		
		$s = mysql_query("SELECT * FROM lokasi_pasar WHERE nama_pasar='$nama' and id_kelurahan='$kelurahan'") or die (mysql_error());
			
		
		if ($alamat != null){
			//$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$alamat&key=AIzaSyAYzUilmKmgX-_YFiYuhc1v7eV7frg7LRc";
			$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$alamat&keyAIzaSyBkEjrTLk3LHRqdK1qTQTVlASdJZM3FzD8";
			$hasil_request = json_decode(file_get_contents($url));
			// print_r($hasil_request['results'][0]['geometry']['location']);
			$lat = $hasil_request->results[0]->geometry->location->lat;
			$lng = $hasil_request->results[0]->geometry->location->lng;
			
			$kelurahan = urldecode($kelurahan);
			$nama = urldecode($nama);
			$golongan = urldecode($golongan);
			$uptd = urldecode($uptd);
			$alamat = urldecode($alamat);
			$tahun = urldecode($tahun);
			echo "kelurahan : $kelurahan &nbsp;&nbsp; | nama : $nama &nbsp;&nbsp; | golongan : $golongan &nbsp;&nbsp; | uptd : $uptd &nbsp;&nbsp; | alamat : $alamat &nbsp;&nbsp; | hasil lat : $lat , long : $lng <br/>";
			
			
			if(mysql_num_rows($s) > 0){
					$_SESSION['error'] = "Data sudah ada ";
			}else{
				$query ="INSERT INTO lokasi_pasar(id_pasar,nama_pasar,golongan,uptd,id_kelurahan,alamat_pasar,tahun,lat,lng)
							VALUES ('','$nama', '$golongan', '$uptd', '$kelurahan', '$alamat', '$tahun', '$lat','$lng' )";
			
				$hasil = mysql_query($query);
			};
		}
	}

	?>
	
	<body>
</html>