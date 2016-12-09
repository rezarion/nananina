<?php
	include "config/koneksi.php";

	// keberadaan sarana
	function get_bobot_satu($nilai) {
		if ($nilai <= 100)
			$hasil = 1.00;
		else if ($nilai > 100 && $nilai <= 200)
			$hasil = 0.80;
		else if ($nilai > 200 && $nilai <= 300)
			$hasil = 0.60;
		else if ($nilai > 300 && $nilai <= 400)
			$hasil = 0.40;
		else if ($nilai > 400)
			$hasil = 0.20;

		return $hasil;
	}

	function get_status_satu($nilai) {
		if ($nilai <= 100)
			$hasil = "Sedikit";
		else if ($nilai > 100 && $nilai <= 200)
			$hasil = "Kurang";
		else if ($nilai > 200 && $nilai <= 300)
			$hasil = "Sedang";
		else if ($nilai > 300 && $nilai <= 400)
			$hasil = "Cukup";
		else if ($nilai > 400)
			$hasil = "Banyak";

		return $hasil;
	}

	// kepadatan penduduk
	function get_bobot_dua($nilai) {
		if ($nilai < 1250)
			$hasil = 0.14;
		else if ($nilai >= 1250 && $nilai < 2500)
			$hasil = 0.28;
		else if ($nilai >= 2500 && $nilai < 4000)
			$hasil = 0.42;
		else if ($nilai >= 4000 && $nilai < 6000)
			$hasil = 0.56;
		else if ($nilai >= 6000 && $nilai < 7500)
			$hasil = 0.70;
		else if ($nilai >= 7500 && $nilai < 8500)
			$hasil = 0.84;
		else if ($nilai >= 8500)
			$hasil = 0.98;

		return $hasil;
	}

	function get_Status_dua($nilai) {
		if ($nilai < 1250)
			$hasil = "Sangat Renggang";
		else if ($nilai >= 1250 && $nilai < 2500)
			$hasil = "Renggang";
		else if ($nilai >= 2500 && $nilai < 4000)
			$hasil = "Cukup Renggang";
		else if ($nilai >= 4000 && $nilai < 6000)
			$hasil = "Sedang";
		else if ($nilai >= 6000 && $nilai < 7500)
			$hasil = "Cukup Padat";
		else if ($nilai >= 7500 && $nilai < 8500)
			$hasil = "Padat";
		else if ($nilai >= 8500)
			$hasil = "Sangat Padat";

		return $hasil;
	}

	// perkembangan pemukiman
	function get_bobot_tiga($nilai) {
		if ($nilai <= 16774)
			$hasil = 0.33;
		else if ($nilai > 16774 && $nilai < 33548)
			$hasil = 0.66;
		else if ($nilai >= 33548)
			$hasil = 0.99;

		return $hasil;
	}

	function get_status_tiga($nilai) {
		if ($nilai <= 16774)
			$hasil = "Rendah";
		else if ($nilai > 16774 && $nilai < 33548)
			$hasil = "Sedang";
		else if ($nilai >= 33548)
			$hasil = "Tinggi";

		return $hasil;
	}

	// potensi ekonomi
	function get_bobot_empat($nilai) {
		if ($nilai <= 913864.56)
			$hasil = 0.33;
		else if ($nilai > 913864.56 && $nilai < 1827729.13)
			$hasil = 0.66;
		else if ($nilai >= 1827729.13)
			$hasil = 0.99;

		return $hasil;
	}

	function get_status_empat($nilai) {
		if ($nilai <= 913864.56)
			$hasil = "Rendah";
		else if ($nilai > 913864.56 && $nilai < 1827729.13)
			$hasil = "Sedang";
		else if ($nilai >= 1827729.13)
			$hasil = "Tinggi";

		return $hasil;
	}

	// arus lalu lintas
	function get_bobot_lima($nilai) {
		//$query_arus = mysql_query("SELECT nilai_variabel FROM klasifikasi_arus");
		
		if ($nilai < 0.6)
			$hasil = 0.16;
		else if ($nilai >= 0.6 && $nilai < 0.7)
			$hasil = 0.32;
		else if ($nilai >= 0.7 && $nilai < 0.8)
			$hasil = 0.48;
		else if ($nilai >= 0.8 && $nilai < 0.9)
			$hasil = 0.64;
		else if ($nilai >= 0.9 && $nilai < 1.0)
			$hasil = 0.80;
		else if ($nilai >= 1.0)
			$hasil = 0.96;

		return $hasil;
	}

	function get_status_lima($nilai) {
		//$query_arus = mysql_query("SELECT nilai_variabel FROM klasifikasi_arus");
		
		if ($nilai < 0.6)
			$hasil = "LoS A";
		else if ($nilai >= 0.6 && $nilai < 0.7)
			$hasil = "LoS B";
		else if ($nilai >= 0.7 && $nilai < 0.8)
			$hasil = "LoS C";
		else if ($nilai >= 0.8 && $nilai < 0.9)
			$hasil = "LoS D";
		else if ($nilai >= 0.9 && $nilai < 1.0)
			$hasil = "LoS E";
		else if ($nilai >= 1.0)
			$hasil = "LoS F";

		return $hasil;
	}

	function get_nama($id) {
		$query_nama = mysql_query ("SELECT nama_titik FROM titik_rekomendasi WHERE id_titik = $id;") or die (mysql_error());
		$ar_nama = mysql_fetch_array($query_nama);
		if (mysql_num_rows($query_nama) == 1) {
			return $ar_nama['nama_titik'];
		}
		 
		return null;
	}

	function get_position($id) {
		$query_koor = mysql_query ("SELECT lat, lng FROM titik_rekomendasi WHERE id_titik = $id;") or die (mysql_error());
		$ar_koor = mysql_fetch_array($query_koor);
		if (mysql_num_rows($query_koor) == 1) {
			return $ar_koor['lat'].','.$ar_koor['lng'];
		}
		 
		return null;
	}

	function get_max_alternatif($c){
		$ar_max = array();
		$query_c = mysql_query ("SELECT * FROM titik_rekomendasi") or die (mysql_error());

		while ($row = mysql_fetch_array ($query_c))
	    {
	    	array_push($ar_max, $row[$c]);
	    }

	    //if ($c == 'c1')
	    	//$hasil = min($ar_max);
	    //else
	    	$hasil = max($ar_max);

	    return $hasil;
		
	}

	function get_max_alternatif_jarak($c){
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
		$ar_max = array();
		$query_c = mysql_query ($query_jarak) or die (mysql_error());

		while ($row = mysql_fetch_array ($query_c))
	    {
	    	array_push($ar_max, $row[$c]);
	    }

	    //if ($c == 'c1')
	    	//$hasil = min($ar_max);
	    //else
	    	$hasil = max($ar_max);

	    return $hasil;
		
	}
	
	function get_hasil($details) {
	  return $details['hasil'];
	}

	function get_id_terpilih($id, $array) {
	   foreach ($array as $key => $val) {
	       if ($val['hasil'] === $id) {
	           return $key;
	       }
	   }
	   return null;
	}
?>