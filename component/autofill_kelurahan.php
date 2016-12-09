<?php
include('koneksi.php');
include('pointInPolygon.php');

//$id_kelurahan = $_POST['id_kelurahan'];
$koordinat = $_REQUEST['koordinat'];
$desa = unserialize(file_get_contents('gondes.coordinates'));

function cari_kelurahan($koordinat){
	$pointLocation = new pointLocation();
	global $desa;
	
	$koordinat = $pointLocation->makePointCari($koordinat);
	for ($i=0; $i < count($desa); $i++) {
		if ($pointLocation->pointInPolygon($koordinat,$desa[$i]['koordinat'])){
			return $desa[$i]['id_kelurahan'];
			break;
		}
	}
	return false; 
}

$id_kelurahan = cari_kelurahan($koordinat);

if ($id_kelurahan == false){
	$data['error'] = 1;
} else {
	$data['error'] = 0;
	
	//$data['id_kelurahan'] = $id_kelurahan;

	/**** AMBIL VARIABEL VALUE ****/
	
	$sql = mysql_query("SELECT banyak_sarana FROM keberadaan_sarana WHERE id_kelurahan='$id_kelurahan' ORDER BY TAHUN DESC LIMIT 0,1");
	$data['ambil_keberadaan'] = mysql_fetch_array($sql)['banyak_sarana'];
	
	$sql = mysql_query("SELECT nilai_kepadatan FROM kepadatan_penduduk WHERE id_kelurahan='$id_kelurahan' ORDER BY TAHUN DESC LIMIT 0,1");
	$data['ambil_kepadatan'] = mysql_fetch_array($sql)['nilai_kepadatan'];
	
	$sql = mysql_query("SELECT nilai_perkembangan FROM perkembangan_pemukiman WHERE id_kelurahan='$id_kelurahan' ORDER BY TAHUN DESC LIMIT 0,1");
	$data['ambil_perkembangan'] = mysql_fetch_array($sql)['nilai_perkembangan'];
	
	$sql = mysql_query("SELECT nilai_potensi FROM potensi_ekonomi WHERE id_kelurahan='$id_kelurahan' ORDER BY TAHUN DESC LIMIT 0,1");
	$data['ambil_potensi'] = mysql_fetch_array($sql)['nilai_potensi'];
	
	$sql = mysql_query("SELECT nilai_arus FROM arus_lalulintas WHERE id_kelurahan='$id_kelurahan' ORDER BY TAHUN DESC LIMIT 0,1");
	$data['ambil_arus'] = mysql_fetch_array($sql)['nilai_arus'];


	/**** AMBIL VARIABEL LINGUISTIK ****/

	/*$sql = mysql_query("SELECT klas_keberadaan 
		               	FROM keberadaan_sarana b, klasifikasi_keberadaan c
		               	WHERE id_kelurahan='$id_kelurahan' 
		               	AND b.id_klasifikasikeberadaan=c.id_klasifikasikeberadaan
		               	ORDER BY TAHUN DESC LIMIT 0,1");
	$data['status_keberadaan'] = mysql_fetch_array($sql)['klas_keberadaan'];
	
	$sql = mysql_query("SELECT klas_kepadatan
						FROM kepadatan_penduduk b, klasifikasi_kepadatan c
						WHERE id_kelurahan='$id_kelurahan'
						AND b.id_klasifikasikepadatan=c.id_klasifikasikepadatan
						ORDER BY TAHUN DESC LIMIT 0,1");
	$data['status_kepadatan'] = mysql_fetch_array($sql)['klas_kepadatan'];
	
	$sql = mysql_query("SELECT klas_perkembangan
						FROM perkembangan_pemukiman b, klasifikasi_perkembangan c
						WHERE id_kelurahan='$id_kelurahan'
						AND b.id_klasifikasiperkembangan=c.id_klasifikasiperkembangan
						ORDER BY TAHUN DESC LIMIT 0,1");
	$data['status_perkembangan'] = mysql_fetch_array($sql)['klas_perkembangan'];
	
	$sql = mysql_query("SELECT klas_potensi
						FROM potensi_ekonomi b, klasifikasi_potensi c
						WHERE id_kelurahan='$id_kelurahan'
						AND b.id_klasifikasipotensi=c.id_klasifikasipotensi
						ORDER BY TAHUN DESC LIMIT 0,1");
	$data['status_potensi'] = mysql_fetch_array($sql)['klas_potensi'];
	
	$sql = mysql_query("SELECT klas_arus
						FROM arus_lalulintas b, klasifikasi_arus c
						WHERE id_kelurahan='$id_kelurahan'
						AND b.id_klasifikasiarus=c.id_klasifikasiarus
						ORDER BY TAHUN DESC LIMIT 0,1");
	$data['status_arus'] = mysql_fetch_array($sql)['klas_arus'];*/

}

echo json_encode($data);

?>