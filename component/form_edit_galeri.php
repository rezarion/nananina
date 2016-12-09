<?php
	include "koneksi.php";
	$id = @$_GET['kode'];
	$query = mysql_query("select * from gallery where id_galeri='$id'");
	$ss = mysql_fetch_array($query);
?>	

<div class="widget">
	<h4 class="widgettitle">Form Berita</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_galeri.php?id_galeri=<?php echo $id?>" method="post" enctype="multipart/form-data">
			<?php
			if(ISSET($_SESSION['success'])){
					echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
					unset($_SESSION['success']);
				}else if(ISSET($_SESSION['error'])){
					echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
					unset($_SESSION['error']);
				} 
			?>		
			
			<p>
				<label>Nama Galeri</label>
				<span class="field"><input type="text" name="nama_galeri" value="<?php echo $ss['nama_galeri']; ?>" class="input-medium" style='height:4%; margin-left:0.1% !important' maxlength="20" placeholder="Your tittle here" required/></span>
			</p>		
			<p>
				<label>Kategori</label>
					<select name="id_kategori" class="chzn-select" style="width:100px !important">
						<option value="1" <?php if($ss['id_kategori'] == '1'){echo 'selected';}?>>Gambar</option>
						<option value="2" <?php if($ss['id_kategori'] == '2'){echo 'selected';}?>>Dokumen</option>
					</select>
			</p>	
			<div class="par">
			    <label>File</label>
			    <div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-append">
				<div class="uneditable-input span3">
				    <i class="iconfa-file fileupload-exists"></i>
				    <span class="fileupload-preview"></span>
				</div>
				<span class="btn btn-file"><span class="fileupload-new">Select file</span>
				<span class="fileupload-exists">Change</span>
				<input type="file" name="gambar" /></span>
				<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				</div>
			    </div>
			</div>	

			 
			<p class="stdformbutton">
                <button class="btn btn-info alertinfo" name='update' style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"><span class="icon-thumbs-up icon-white" ></span>Update</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>