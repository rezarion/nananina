<?php
	include "koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_user'])));
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
	<h4 class="widgettitle">Form Ubah Data User</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_user.php?id_user=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			
			<p>
                <span class="field">
                    <img src="<?php echo "component/foto/".$ss['foto'];?>" alt="" class="img-polaroid" style= 'width:10%;height:20%;margin-left:10%;!important' />
                </span>
            </p>
			<p>
				<label>NIP</label>
				<span class="field"><input type="text" name="id_user" class="input-xlarge" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" placeholder="masukkan NIP" pattern="[0-9]+" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Nama User</label>
				<span class="field"><input type="text" name="nama" value="<?php echo $ss['nama']; ?>" class="input-xlarge" style= 'margin-left:0.1%;!important' pattern="[A-Za-z\s]+" maxlength="50" placeholder="masukkan nama user" required/></span>
			</p>	
			<p>
				<label>Username</label>
				<span class="field"><input type="text" name="username" value="<?php echo $ss['username']; ?>" class="input-xlarge" style= 'margin-left:0.1%;!important' pattern="[a-zA-Z0-9]+" placeholder="masukkan username" maxlength="20" required/></span>
			</p>	
			<p>
				<label>Password</label>
				<span class="field"><input type="password" name="password" value="<?php echo $ss['password']; ?>" class="input-xlarge" style= 'margin-left:0.1%;!important' placeholder="masukkan password" required/></span>
			</p>	
			<p>
				<label>Level</label>
				<span class="field">
                        <select name="level" class="chzn-select" style="width:150px !important">
                            <option value="1" <?php if($ss['level'] == '1'){echo 'selected';}?>>Administrator</option>
                            <option value="2" <?php if($ss['level'] == '2'){echo 'selected';}?>>Staf</option>
					   </select>
                </span>
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
				<span class="field" ><img id="preview" src="" alt="" width="15%" height="25%" /></span>
			</p>
			
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>