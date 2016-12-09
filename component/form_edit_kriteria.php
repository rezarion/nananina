<?php
	include "config/koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_kriteria'])));
	//$id = isset($_GET['id']) ? $_GET['id'] : '';
	$query =mysql_query("SELECT * FROM kriteria WHERE id_kriteria = '$id'");
	$ss = mysql_fetch_array($query);

	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
?>

<div class="widget">
	<h4 class="widgettitle">Form Ubah Data Kriteria</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_titik.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>No.</label>
				<span class="field"><input type="text" name="id_kriteria" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>	
			<p>
				<label>Nama Kriteria</label>
				<span class="field"><input type="text" id="nama_kriteria" name="nama_kriteria" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" value="<?php echo $ss['nama_kriteria']; ?>" readonly /></span>
			</p>	
			<p>
				<label>Bobot</label>
					<select name="bobot" class="chzn-select" style="width:100px !important">
						<option value="1" <?php if($ss['bobot'] == '1.00'){echo 'selected';}?>>1.00</option>
						<option value="2" <?php if($ss['bobot'] == '2.00'){echo 'selected';}?>>2.00</option>
						<option value="3" <?php if($ss['bobot'] == '3.00'){echo 'selected';}?>>3.00</option>
						<option value="4" <?php if($ss['bobot'] == '4.00'){echo 'selected';}?>>4.00</option>
					</select>
			</p>
			<p>
				<label>Kelas Bobot</label>
					<select name="bobot" class="chzn-select" style="width:100px !important">
						<option value="1" <?php if($ss['klas_bobot'] == 'Sangat Tinggi'){echo 'selected';}?>>Sangat Tinggi</option>
						<option value="2" <?php if($ss['klas_bobot'] == 'Tinggi'){echo 'selected';}?>>Tinggi</option>
						<option value="3" <?php if($ss['klas_bobot'] == 'Sedang'){echo 'selected';}?>>Sedang</option>
						<option value="4" <?php if($ss['klas_bobot'] == 'Rendah'){echo 'selected';}?>>Rendah</option>
						<option value="5" <?php if($ss['klas_bobot'] == 'Sangat Rendah'){echo 'selected';}?>>Sangat Rendah</option>
					</select>
			</p>
			
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>