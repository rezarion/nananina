<div class="widget">
	<h4 class="widgettitle">Form Gallery</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_galeri.php" method="post" enctype="multipart/form-data">
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
				<span class="field"><input type="text" name="nama_galeri" class="input-xlarge" style= 'margin-left:0.1% !important' placeholder="masukkan nama galeri" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Kategori</label>
					<select name="id_kategori" class="chzn-select" style="width:100px !important">
						<option value="1">Dokumen</option>
						<option value="2">Gambar</option>
					</select>
			</p>
			<div class="par">
			    <label>Gambar</label>
			    <div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="input-append">
				<div class="uneditable-input span2">
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
                <button class="btn btn-info alertinfo" name="save" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"><span class="icon-thumbs-up icon-white" ></span>Save</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>