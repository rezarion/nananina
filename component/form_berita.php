<script>
	tinymce.init({selector:'textarea'});
</script>
<div class="widget">
	<h4 class="widgettitle">Form Berita</h4>
	<div class="widgetcontent" >
		<form class="stdform" action="component/proses_input_berita.php" method="post" enctype="multipart/form-data">
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
				<label>Judul</label>
				<span class="field"><input type="text" name="judul" style='width:87%; margin-left:0.1%;!important' class="input-xlarge" placeholder="Your tittle here" required/></span>
			</p>	
			<p>
				<label>Content</label>
					<div class="" style="width:20%; !important" >
						<textarea id="elm1" name="isi" rows="15" cols="40" class="tinymce" style= 'margin-left:0.1%;!important'></textarea>
						<!--<textarea name="isi" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Your content here..':this.value;">Your content here..</textarea>-->
					</div>
			</p>	
			<div class="par">
			    <label>Gambar</label>
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
			<p>
				<label>Status</label>
					<select name="status" class="chzn-select" style="width:100px !important">
						<option value="1">Publish</option>
						<option value="0">Pending</option>
					</select>
			</p>	
			 
			<p class="stdformbutton">
                <button class="btn btn-info alertinfo" name='update' style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"><span class="icon-thumbs-up icon-white" ></span>Save</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>