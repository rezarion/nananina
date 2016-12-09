<?php
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
?>	

<script>
	/*MELIHAT PREVIEW UPLOAD FOTO*/
    function tampilkanPreview(gambar,idpreview){
		//membuat objek gambar
        var gb = gambar.files;
               
		//loop untuk merender gambar
        for (var i = 0; i < gb.length; i++){
			//bikin variabel
            var gbPreview = gb[i];
            var imageType = /image.*/; //untuk semua gambar /image.*/
            var preview=document.getElementById(idpreview);            
            var reader = new FileReader();
                    
			if (gbPreview.type.match(imageType)) {
				//jika tipe data sesuai
				preview.file = gbPreview;
				reader.onload = (function(element) { 
					return function(e) { 
						element.src = e.target.result; 
					}; 
				})(preview);
				//membaca data URL gambar
				reader.readAsDataURL(gbPreview);
			}else{
				//jika tipe data tidak sesuai
				alert("Type file tidak sesuai. Harus file image");
				}           
        }    
    }
</script>

<div class="widget">
	<h4 class="widgettitle">Form Data User</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_input_user.php" method="post" enctype="multipart/form-data">		
			
			<p>
				<label>NIP</label>
				<span class="field"><input type="text" name="id_user" class="input-medium" style= 'margin-left:0.1% !important' placeholder="masukkan NIP" pattern="[0-9]+" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Nama</label>
				<span class="field"><input id="text" type="text" name="nama" class="input-xlarge" style= 'margin-left:0.1% !important' pattern="[A-Za-z]+" maxlength="50" placeholder="masukkan nama user" required/></span>
			</p>	
			<p>
				<label>Username</label>
				<span class="field"><input type="text" name="username" class="input-medium" style= 'margin-left:0.1% !important' placeholder="masukkan username" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Password</label>
				<span class="field"><input type="password" name="password" class="input-xlarge" style= 'margin-left:0.1% !important' placeholder="masukkan password" required/></span>
			</p>	
			<p>
				<label>Level</label>
					<select name="level" class="chzn-select" style="width:120px !important">
						<option value="1">Administrator</option>
						<option value="2">Staf</option>
					</select>
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
				<input type="file" name="foto" accept="image/*" onchange="tampilkanPreview(this,'preview')"/></span>
				<a href="#" class="btn fileupload-exists" data-dismiss="fileupload" onclick="document.getElementById('preview').src=''">Remove</a>
				</div>
			    </div>
			</div> 
			<p>
				<label> </label>
				<span class="field" ><img id="preview" src="" alt="" width="60px" height="240px" /></span>
			</p>
			<p class="stdformbutton">
                <button type="submit" class="btn btn-primary" name="input" style='margin-left:-9% !important'><a href="" style="text-decoration=:none; color:white;"></span>Submit</a></button>
                <button type="reset" class="btn" >Reset</button>
            </p>
		</form>
	</div>
</div>