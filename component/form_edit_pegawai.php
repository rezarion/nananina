<?php
	include "koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['kode'])));
	$query =mysql_query("select * from pegawai where id_pegawai='$id'");
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
	<h4 class="widgettitle">Form Edit Data Pengguna Sistem Informasi Geografis</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_pegawai.php?id_pegawai=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>NIP</label>
				<span class="field"><input type="text" name="id_pegawai" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>	
			<p>
				<label>Nama Pegawai</label>
				<span class="field"><input type="text" name="nama_pegawai" value="<?php echo $ss['nama_pegawai']; ?>" class="input-xlarge" style= 'margin-left:0.1%;!important'/></span>
			</p>	
			<p>
				<label>Gender</label>
					<select name="gender" class="chzn-select" style="width:100px !important">
						<option value="1" <?php if($ss['gender'] == '1'){echo 'selected';}?>>Laki-laki</option>
						<option value="2" <?php if($ss['gender'] == '2'){echo 'selected';}?>>Perempuan</option>
					</select>
			</p>	
			<p>
				<label>Jabatan</label>
				<span class="field"><input type="text" name="jabatan" value="<?php echo $ss['jabatan']; ?>" class="input-medium" style= 'margin-left:0.1%;!important'/></span>
			</p>	
			<p>
				<label>Tempat Lahir </label>
				<span class="field"> <input type="text" name="tempat_lahir" class="input-small" value="<?php echo $ss['tempat_lahir']; ?>" style= 'margin-left:0.1%;!important' placeholder=" kota lahir" maxlength="15" required/>		
			</p>
			<p>
				<label>Tanggal Lahir </label>
				<span class="field"> <input type="date" onkeypress="return numbersonly(event, false)" name="tanggal_lahir" class="input-small" value="<?php echo $ss['tanggal_lahir']; ?>" style= 'margin-left:0.1%;!important' placeholder=" yyyy-mm-dd" maxlength="8" required/>
			</p>
			<div class="par">
			    <label>Foto</label>
				
			    <div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-append">
				<div class="uneditable-input span2">
				    <i class="iconfa-file fileupload-exists"></i>
				    <span class="fileupload-preview"></span>
				</div>
				<span class="btn btn-file"><span class="fileupload-new">Select file</span>
				<span class="fileupload-exists">Change</span>
				<input type="file" name="foto" /></span>
				<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				</div>
			    </div>
			</div>
			
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>