<?php
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
?>	
			
<div class="widget">
	<h4 class="widgettitle">Form Data Pegawai</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_pegawai.php" method="post" enctype="multipart/form-data">
					
			<p>
				<label>NIP</label>
				<span class="field"><input type="text" name="id_pegawai" class="input-medium" style= 'margin-left:0.1%;!important' placeholder="masukkan id pegawai" onkeypress="return numbersonly(event, false)" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Nama Pegawai</label>
				<span class="field"><input id="text" type="text" name="nama_pegawai" class="input-xlarge" style= 'margin-left:0.1%;!important' maxlength="50" placeholder="masukkan nama pegawai" required/></span>
			</p>	
			<p>
				<label>Gender</label>
					<select name="gender" class="chzn-select" style="width:100px !important">
						<option value="1">Laki-laki</option>
						<option value="2">Perempuan</option>
					</select>
			</p>
			<p>
				<label>Jabatan</label>
				<span class="field"><input type="text" name="jabatan" class="input-medium" style= 'margin-left:0.1%;!important' placeholder="masukkan jabatan" maxlength="20" required/></span>
			</p>
			<p>
				<label>Tempat Lahir </label>
				<span class="field"> <input type="text" name="tempat_lahir" class="input-small" style= 'margin-left:0.1%;!important' placeholder=" kota lahir" maxlength="15" required/>		
			</p>
			<p>
				<label>Tanggal Lahir </label>
				<span class="field"> <input type="date" onkeypress="return numbersonly(event, false)" name="tanggal_lahir" class="input-small" style= 'margin-left:0.1%;!important' placeholder=" yyyy-mm-dd" maxlength="8" required/>		
			</p>			
			<div class="par">
			    <label >Foto</label>
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
                <button type="submit" class="btn btn-primary" name="input" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"></span>Submit</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>