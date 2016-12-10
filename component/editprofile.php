<?php	
	//session_start();
	include "koneksi.php";
	
	$s = mysql_query("SELECT * FROM user WHERE id_user = '$_SESSION[id_user]' ");
	$ss = mysql_fetch_array($s);
	/*
	if(isset($_SESSION["nama_user"]) && isset($_SESSION["password"])){
	$id_user = $_SESSION['id_user'];
	
	//$id = $_SESSION['id_user'];
	$query =mysql_query("select * from user where id_user='$id_user'");
	$ss = mysql_fetch_array($query);*/
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

       
        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    	<div class="span4 profile-left">
                        
                        <div class="widgetbox profile-photo">
                            <div class="headtitle">
                                <h4 class="widgettitle">Profile Photo</h4>
                            </div>
                            <div class="widgetcontent">
                                <div class="profilethumb" >
                                    <img src="<?php echo "component/foto/".$ss['foto'];?>" alt="" class="img-polaroid" />
                                </div><!--profilethumb-->
                            </div>
                        </div>
                        <?php
								if(ISSET($_SESSION['success'])){
									echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
									unset($_SESSION['success']);
								}else if(ISSET($_SESSION['error'])){
									echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
									unset($_SESSION['error']);
								}
							?>	   
                            
                        <div class="widgetbox tags">
                                
                        </div>
                            
                        </div><!--span4-->
                        <div class="span8">
                            <form action="component/proses_editprofile.php" method="post" enctype="multipart/form-data" class="editprofileform">
							
                                
                                <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Login Information</h4>
                                    <div class="widgetcontent">
                                        <p>
                                            <label>NIP</label>
                                            <input type="text" name="id_user" class="input-medium" style= 'width:30%; margin-left:0%;height:5%; !important' value="<?php echo $ss['id_user'];?>" readonly />
                                        </p>
										<p>
                                            <label>Nama:</label>
                                            <input type="text" name="nama" value="<?php echo $ss['nama']; ?>" class="input-xlarge" style= 'width:30%; height:5%; margin-left:0% !important' pattern="[A-Za-z\s]+" maxlength="50" placeholder="masukkan nama user" required/>
                                        </p>
										<p>
                                            <label>Username:</label>
                                            <input type="text" name="username" value="<?php echo $ss['username']; ?>" class="input-xlarge" style= 'width:20%; margin-left:0%;height:5%; !important' pattern="[a-zA-Z0-9]+" placeholder="masukkan username" maxlength="20" required/>
                                        </p>
										<p>
                                            <label> Password</label>
                                            <input type="password" name="password" class="input-xlarge" style= 'width:30%; margin-left:0%;height:5%; !important' value="<?php echo $ss['password']; ?>" placeholder="masukkan password" required/>
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
                                    </div>
                                </div>
                               
                                
                                <div class="widgetbox personal-information">
                                </div>
                                                                
                                <p>
                                	<button type="submit" class="btn btn-primary" name="update">Update Profile</button> &nbsp; <a href=""></a>
                                </p>
                                
                            </form>
                        </div><!--span8-->
                    </div><!--row-fluid-->
                    
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->

</body>
</html>
<?php
//}
?>