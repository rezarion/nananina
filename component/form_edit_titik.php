<?php
	include "config/koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_titik'])));
	//$id = isset($_GET['id']) ? $_GET['id'] : '';
	$query =mysql_query("SELECT * FROM titik_rekomendasi WHERE id_titik = '$id'");
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
	<h4 class="widgettitle">Form Ubah Data Titik Rekomendasi</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_titik.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>No.</label>
				<span class="field"><input type="text" name="id_titik" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>	
			<p>
				<label>Nama Titik</label>
				<span class="field"><input type="text" id="nama_titik" name="nama_titik" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" value="<?php echo $ss['nama_titik']; ?>" required/></span>
			</p>
			<p>
				<label>Keberadaan Sarana</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_keberadaan" name="keberadaan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['c1']; ?>" required/></span>
			</p>	
			<p>
				<label>Kepadatan Penduduk</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_kepadatan" name="kepadatan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['c2']; ?>" required/></span>
			</p>
			<p>
				<label>Perkembangan Pemukiman</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_perkembangan" name="perkembangan" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['c3']; ?>" required/></span>
			</p>
			<p>
				<label>Potensi Ekonomi</label>
				<span class="field"><input type="text" onkeypress="return numbersonly(event, false)" id="val_potensi" name="potensi" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['c4']; ?>" required/></span>
			</p>
			<p>
				<label>Arus Lalu Lintas</label>
				<span class="field"><input type="text" id="val_arus" name="arus" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['c5']; ?>" required/></span>
			</p>
			<p>
				<label>Koordinat</label>
				<span class="field">
					<input type="text" id="lat" name="lat" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['lat']; ?>" required/>
					<input type="text" id="lng" name="lng" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="20" value="<?php echo $ss['lng']; ?>" required/>
				</span>
			</p>
			
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>