<?php
	include "koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['kode'])));
	$query =mysql_query("SELECT * FROM user WHERE id_user='$id'");
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
	<h4 class="widgettitle">Form Ubah Data User</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_user.php?id_user=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
				<label>NIP</label>
				<span class="field"><input type="text" name="id_user" class="input-xlarge" style= 'margin-left:-10%;width:23%; height:4% !important' value="<?php echo $id; ?>" readonly /></span>
			</p>	
			<p>
				<label>Nama User</label>
				<span class="field"><input type="text" name="nama" value="<?php echo $ss['nama']; ?>" class="input-xlarge" style= 'margin-left:-10%;width:50%; height:4% !important'/></span>
			</p>	
			<p>
				<label>Username</label>
				<span class="field"><input type="text" name="username" value="<?php echo $ss['username']; ?>" class="input-xlarge" style= 'margin-left:-10%;width:25%; height:4% !important'/></span>
			</p>	
			<p>
				<label>Password</label>
				<span class="field"><input type="password" name="password" value="<?php echo $ss['password']; ?>" class="input-xlarge" style= 'margin-left:-10%; height:4% !important'/></span>
			</p>	
			<p>
				<label style="width:22% !important">Level</label>
				<span class="field">
                        <select name="level" class="chzn-select" style="width:150px !important">
                            <option value="1" <?php if($ss['level'] == '1'){echo 'selected';}?>>Administrator</option>
                            <option value="2" <?php if($ss['level'] == '2'){echo 'selected';}?>>Staf</option>
					   </select>
                </span>
			</p>
			<div class="par">
			    <label>File Upload</label>
				
			    <div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-append" style="margin-left:-7.5%">
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