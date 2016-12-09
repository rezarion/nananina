<?php
	SESSION_start();
	include "config/koneksi.php";
	include "library/injection.php";
	//$id = $_GET['id_titik'];
	//if(isset($_GET['id_titik'])){ $id = $_GET['id_titik']; } 
	//$query = mysql_query('SELECT * FROM titik_rekomendasi WHERE id_titik='.$id);
	//$pecah= mysql_fetch_array($query);
	
	$update = $_POST['update'];
		
	if (ISSET($update)){
		
		$id_user = $_SESSION['id_user'];
		$id = $_POST['id_kriteria'];
		//$id = isset($_GET['id_titik']) ? $_GET['id_titik'] : '';
		$nama_titik = $_POST['nama_kriteria'];
		$bobot = $_POST['bobot'];
		$klas_bobot = $_POST['klas_bobot'];


		$cek = mysql_query("SELECT * FROM kriteria WHERE id_kriteria = '$id'");
			
		if(mysql_num_rows($cek) == 0){
			$sql = "UPDATE kriteria
					SET nama_kriteria = '$nama_kriteria', bobot = '$bobot', klas_bobot = '$klas_bobot'
					WHERE id_kriteria = '$id'";
		}else{
			$sql = "UPDATE kriteria
					SET nama_kriteria = '$nama_kriteria', bobot = '$bobot', klas_bobot = '$klas_bobot'
					WHERE id_kriteria = '$id'";
			};
			
			$hasil = mysql_query($sql);
		
			if($hasil){
				$status = "INSERT INTO user_log(id_log,id_user,status)
							VALUES ('','$_SESSION[id_user]','Edit data kriteria')";
				$status2 = mysql_query($status);
				
				echo mysql_error();
				$_SESSION['success'] = "Data berhasil diubah";
				//echo "<div class='alert alert-success' style='margin:7px;width:53%;'><strong>Data berhasil diubah</strong></div>";
				echo "<meta http-equiv='refresh' content='0;url=../main.php?menu=lihatKriteria'/>";
				//exit();
				//header("Location: http://localhost/ta2/main.php?menu=lihatTitik");

			}else{
				echo mysql_error();
				$_SESSION['error'] = "Proses gagal, terjadi kesalahan : ".mysql_error();
				echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editKriteria'/>";
			};
			
		}else {
			echo mysql_error();
			$_SESSION['error'] = "Proses dibatalkan";
			echo"<meta http-equiv='refresh' content='0;url=../main.php?menu=editKriteria'/>";
		};
					
?>
