<?php
	include "config/koneksi.php";
	$id = htmlentities( htmlspecialchars (addslashes ($_GET['id_info'])));
	//$id = isset($_GET['id']) ? $_GET['id'] : '';
	$query =mysql_query("SELECT * FROM info WHERE id_info = '$id'");
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
    tinymce.init({selector:'textarea'});
</script>

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
	<h4 class="widgettitle">Form Edit Data Informasi</h4>
	<div class="widgetcontent">
		<form class="stdform" action="component/proses_edit_info.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
			<p>
				<label>No.</label>
				<span class="field"><input type="text" name="id_info" class="input-medium" style= 'margin-left:0.1%;!important' value="<?php echo $id; ?>" readonly /></span>
			</p>
			<p>
				<label>Judul</label>
				<textarea id="autoResizeTA" name="judul" class="input-xlarge" style="resize: vertical; height: 117px;" rows="5" cols="80" required/> <?php echo $ss['judul']; ?></textarea>
			</p>
			<p>
				<label>Isi</label>
				<span class="field">
					<textarea id="elm1" class="tinymce" name="isi" style="resize: vertical; height: 117px;" rows="5" cols="80" placeholder="masukkan isi" /><?php echo $ss['isi']; ?></textarea>
				</span>
			</p>
			<div class="par">
			    <label>Gambar</label>
			    <div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="input-append">
					<div class="uneditable-input span2">
						<i class="iconfa-file fileupload-exists"></i>
						<span class="fileupload-preview"></span>
						<?php echo $ss['gambar'];?> 
					</div>
					<span class="btn btn-file"><span class="fileupload-new">Select file</span>
						<span class="fileupload-exists">Change</span>
						<input type="file" name="gambar" accept="image/*" onchange="tampilkanPreview(this,'preview')"/>
					</span>
					<a href="#" class="btn fileupload-exists" data-dismiss="fileupload" onclick="document.getElementById('preview').src=''">Remove</a>
					</div>
			    </div>
			</div>
			<p>
				<label> </label>
				<span class="field" ><img id="preview" src="" alt="" width="200px" /></span>
			</p>
			<p class="stdformbutton">
                <button class="btn btn-primary" name='update' style='margin-left:-9% !important'></span>Update</a></button>
                <button type="reset" class="btn">Reset</button>
            </p>
		</form>
	</div>
</div>	