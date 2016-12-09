<!-- script untuk validasi form-->

<script language="JavaScript" src="js1/gen_validatorv31.js" type="text/javascript"></script>	

<script language="JavaScript">
	var frmvalidator  = new Validator("form_komentar");
	
	frmvalidator.EnableOnPageErrorDisplaySingleBox();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("name","req","Please provide your name"); 
	frmvalidator.addValidation("email","req","Please provide your email"); 
	frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>

<script language='JavaScript' type='text/javascript'>
	function refreshCaptcha(){
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
</script>

<!--
<script type='text/javascript' src='jquery.pack.js'></script>
-->

<script type='text/javascript'>
$(function(){
	$("a.reply").click(function() {
		var id = $(this).attr("id");
		$("#id_induk").attr("value", id);
		$("#name").focus();
	});
});
</script>


<link rel="stylesheet" type="text/css" href="css1/ml-modal-contact-form.css" />

<style type='text/css'>
	html, body, div, h1, h2, h3, h4, h5, h6, ul, ol, dl, li, dt, dd, p, blockquote,
	pre, form, fieldset, table, th, td { margin-left: 0px; padding: 0; }

	body {
		font-size: 14px;
		line-height:1.3em;
	}

	a, a:visited {
		outline:none;
	}

	.clear {
		clear:both;
	}

	#wrapper {
		width:750px;
		float:center;
		margin-left:5px;
	}
	
	#form {
		width:750px;
		float:left;
		margin-left:5px;
		font:normal 11px Trebuchet MS;
	}

	.comment {
		padding:5px;
		font:normal 13px Trebuchet MS;
		border: 2px solid #e3e6ed;
		margin-top:15px;
		list-style:none;
		border-radius: 4px;
		-webkit-border-radius: 4px;
		margin-left:3px;
	}

	.aut {
		font-weight:bold;
		color:#4496d2;
	}

	.timestamp {
		font-size:85%;
		float:right;
	}
	
	#comment_form {
		margin-top:5px;
		margin-left:3px;
	}

	#comment_form input {
		font-size:0.8em;
		display:block;
		color:grey;
		width:100%;
	}

	#comment_body {
		display:block;
		width:100%;
		height:150px;
	}
</style>

<div class="l-content-wrap">
<?php
	require 'koneksi.php';
	require_once 'home/function.php';
	$sql = mysql_query("SELECT * FROM berita WHERE id_berita = '$_GET[id]' ");
	$i=1;
	while($hasil = mysql_fetch_array($sql)){	
		$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
		$l = mysql_fetch_array($g);
		echo "
		<div class='m-page-title'  style='margin-top:-30px !important'>
		  <h3> $hasil[judul] </h3>
			<div class='l-meta-data'>
				<!-- display categories -->
				<ul class='date clearfix'>
				  <li>$hasil[tanggal]</li>
				</ul>

				<span class='meta-separator'>/</span>
				
				<!-- date -->
				<ul class='categories clearfix'>
				  <li>Oleh : $l[nama]</li>        
				</ul>
			
			</div>
		</div><!-- m-page-title -->
						
			<div class='row l-user-profile'>
				<div class='l-post-image' style='width:35%; left:250px; top:15px'>
					<img src='component/gambar/$hasil[gambar]' width='150px' height='130px'/>
				</div>
				<br/>
				<p>
					$hasil[isi]
				</p>
			
			</div><!-- col-lg-9 -->

			";
		$i++;
		
		
	$query1 = mysql_query("SELECT id_komentar FROM komentar where id_berita = '$_GET[id]' and status = '1' ");
	if (mysql_num_rows($query1)>0){
		echo "<h3>Komentar</h3>";
		}
		
		// komentar
		$alert = "<h3><div style=\"margin-top:40px; !important\"><span>Tinggalkan Komentar</span></div></h3>";
		$id_berita = $_GET['id']; 
		
		if(isset($_POST['submit'])) {
			$error = false;
			$nama = trim($_POST['nama']);
			$email = check_email($_POST['email']);
			$pesan = trim($_POST['pesan']);
			$alert .= "<br><span style='color:#c00;'>";
			
			if (strlen($nama) < 2 || strlen($pesan) < 2) {
				$alert .= "Mohon tulis nama dan komentar dengan benar!<br>";
				$error = true;
			}
			
			if (!$email) {
				$alert .= "Alamat e-mail Anda tidak valid!<br>";
				$error = true;
			}
			
			if(empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
				$alert .= "Kode captcha tidak sesuai!";
			} else {
				if (!$error) {
					$nama = strip_tags($nama);
					$pesan = strip_tags($pesan);
					$id_induk = mysql_real_escape_string($_POST['id_induk']);
					$d = mysql_query("INSERT INTO komentar (id_berita, id_induk, nama, email, komentar, status) VALUES ('$_GET[id]','$id_induk','{$nama}', '{$email}','{$pesan}','1')");
					
					//unset($_POST['nama'],$_POST['email'],$_POST['pesan']);
					if(mysql_affected_rows()==1) {
						header("location:home.php?menu=detail_berita&id=$hasil[id_berita]");
					} else {
						echo "Komentar tidak dapat di<i>post</i>. Silakan coba lagi.";
					}

					if($d){		
						$alert .= "Terima kasih atas komentar Anda...";
						echo "<meta http-equiv=\"refresh\" content=\"0; url=home.php?menu=detail_berita&id=$hasil[id_berita]\">";
					}else{
						echo mysql_error();
					}
				}
			}
			
			if(!empty($errors)){
				echo nl2br($errors)."</p>";
			}
		
		}
		$alert .= "</span></div><br>";
		echo "<br>";
		
		echo "<div id='wrapper'>";
		$query = mysql_query("SELECT * FROM komentar WHERE id_berita = '$_GET[id]' AND id_induk = '0' AND status = '1' ");
		while ($row = mysql_fetch_assoc ($query)) {
			getComments($row);
		}
		echo "";
		
		$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : "";
		//echo "<h3> Comments</h3>";
		echo "<a name='postkomentar'></a> {$alert}";
		
		echo "<form id='comment_form' style='width:500px;' onsubmit = 'return validasi(this)' method='POST' name='form_komentar' action='home.php?menu=detail_berita&id=$hasil[id_berita]#postkomentar'>
			<table>
				<tr>
					<td style=\"margin-bottom:78px; !important\">
						<input name='nama' id='name' type='text' onclick=\"this.value='';\" onfocus=\"this.select()\" onblur=\"this.value=!this.value?'Your name{$nama}':this.value;\" value='Your name' class='your-name' >
					</td>
				</tr>
				<tr>
					<td>
					<input name='email' type='text' size ='30' onclick=\"this.value='';\" onfocus=\"this.select()\" onblur=\"this.value=!this.value?'Email address{$email}':this.value;\" value='Email address' class='email-address'> 
					</td>
				</tr>
				
				<tr style=\"margin-bottom:50px; !important\">
					<td>
					<textarea name='pesan' id='comment_body' onclick=\"this.value='';\" onfocus=\"this.select()\" onblur=\"this.value=!this.value?'Please type your comment here..{$pesan}':this.value;\" class='your-message' >Please type your comment here..</textarea>
					</td>
				</tr>
				
				<tr>
					<td>
						<input id='6_letters_code' name='6_letters_code' type='text' onclick=\"this.value='';\" onfocus=\"this.select()\" onblur=\"this.value=!this.value?'Enter captcha code here':this.value;\" value='Enter captcha code here' class='your-name'>
						<img src='home/kode_captcha.php?rand=<?php echo rand(); ?>' id='captchaimg'>
					</td>
				</tr>
				<tr>
					<td>
						<small>Tidak dapat membaca captcha? Klik <a href='javascript: refreshCaptcha();'>di sini</a> untuk refresh</small>
					</td>
				</tr>
				<tr>
					<td>
						<button class='default-button' type='submit' name='submit'>Kirim</button>
					<!--	<input type='submit' value='Submit' name='submit' class='send-message'/> -->
						<input type='hidden' name='id_induk' id='id_induk' value='0'/>
					</td>
				</tr>
			</table>	
		</form></div></div>";
	}	
?>

