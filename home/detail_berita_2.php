<!-- script untuk validasi form

<script language="JavaScript" src="js/gen_validatorv31.js" type="text/javascript"></script>	

<script language="JavaScript">
	var frmvalidator  = new Validator("form_komentar");
	
	frmvalidator.EnableOnPageErrorDisplaySingleBox();
	frmvalidator.EnableMsgsTogether();

	frmvalidator.addValidation("name","req","Please provide your name"); 
	frmvalidator.addValidation("email","req","Please provide your email"); 
	frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>-->

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


<link rel="stylesheet" type="text/css" href="css/ml-modal-contact-form.css" />

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
		font-size:1.2em;
		display:block;
		width:100%;
	}

	#comment_body {
		display:block;
		width:100%;
		height:150px;
	}
	
	.services ul,.services li,.services ol{
	    padding:00px !Important;
		margin:15px !important;
	 }
</style>

<div class="l-content-wrap">
<?php
	//definisi konstanta konfigurasi parameter keperluan koneksi database
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'bkkbn';

	$koneksi = mysql_connect($host,$user,$password) or die(mysql_error());
	mysql_select_db($database) or die(mysql_error());

	define('APP_ID', '620580374704951');
	define('APP_SECRET', '0a7881092d8580155258e500cac7b591');

	// pathnya sesuaikan dengah letak file yang kamu punya
	require 'home/facebook-php-sdk-master/src/facebook.php';

	$facebook = new Facebook(array(
		'appId'  => APP_ID,
		'secret' => APP_SECRET,
	));

	// ada user?
	$user = $facebook->getUser();

	// jika iya
	if ($user) {
	  try {
		// dapatkan profil user yang sudah masuk
		$user_profile = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}

	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
		if(isset($logoutUrl)){
			$logout = $facebook->destroySession();
		}
	} else {
	  $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
	}

	//require "koneksi.php";
	
	require_once 'home/function.php';
	$sql = mysql_query("SELECT * FROM berita WHERE id_berita = '$_GET[id]' ");
	$i=1;
	while($hasil = mysql_fetch_array($sql)){	
		$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
		$l = mysql_fetch_array($g);
		echo "
		<div class='m-page-title'>
		  <h3> $hasil[judul] </h3>
		</div><!-- m-page-title -->

			<div class='row l-user-profile'>
				<div class='col-lg-3 col-md-3 col-sm-3 user-avatar'>
					<img src='component/gambar/$hasil[gambar]' width='121px' height='122'/>
				</div>
				
				<div class='col-lg-9 col-md-9 col-sm-9 user-info'>
					<h2></h2>
					<span>$hasil[tanggal], Oleh : $l[nama]</span>
					
				<p>
					$hasil[isi]
				</p>
			
				</div><!-- col-lg-9 -->
			</div> <!-- row 1-user-profile-->
			";
		$i++;
		
		// komentar
		$alert = "<h3><div style=\"margin-top:40px; !important\"><span>Leave your comment</span></div></h3>";
		$id_berita = $_GET['id']; 
		
		if(isset($_POST['submit'])) {
			$error = false;
			//$nama = trim($_POST['nama']);
			//$email = check_email($_POST['email']);
			$pesan = trim($_POST['pesan']);
			$alert .= "<br><span style='color:#c00;'>";
			
			/*
			if (strlen($nama) < 2) {
				$alert .= "Mohon tulis nama dengan benar!<br>";
				$error = true;
			} */
			
			if (strlen($pesan) < 5) {
				$alert .= "Mohon tulis komentar dengan benar!<br>";
				$error = true;
			}
			
			/*
			if (!$email) {
				$alert .= "Alamat e-mail Anda tidak valid!<br>";
				$error = true;
			}*/
			
			if(empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0){
				$alert .= "Kode captcha tidak sesuai!";
			} else {
				if (!$error) {
					//$nama = strip_tags($nama);
					//$pesan = strip_tags($pesan);
					// baca ID FB dari pengisi komentar
					$idFB = $_POST['idFB'];
					// baca NAMA dari pengisi komentar
					$nama = $_POST['nama'];
					// baca Email dari pengisi komentar
					$email = $_POST['email'];

					$id_induk = mysql_real_escape_string($_POST['id_induk']);
					// query simpan data ke tabel komentar
					$query = mysql_query("INSERT INTO komentar (id_fb, id_berita, id_induk, nama, email, komentar, status) VALUES ('$idFB','$_GET[id]','$id_induk','$nama','$email','$pesan','1')");
					
					//unset($_POST['nama'],$_POST['email'],$_POST['pesan']);
					if(mysql_affected_rows()==1) {
						header("location:home.php?menu=detail_berita&id=$hasil[id_berita]");
					} else {
						echo "Komentar tidak dapat di<i>post</i>. Silakan coba lagi.";
					}

					if($query){		
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
		
		echo "<div id='wrapper'><ul>";
		// proses menampilkan semua data komentar

		$query = mysql_query("SELECT * FROM komentar WHERE id_berita = '$_GET[id]' AND id_induk = '0' AND status = '1' ");
		while ($row = mysql_fetch_assoc($query)) {
			getComments($row);
		}
		echo "</ul>";
		
		//$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		//$email = isset($_POST['email']) ? $_POST['email'] : "";
		$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : "";

		echo "<a name='postkomentar'></a> {$alert}";?>
		
		<?php echo "<div id = 'form'><form id='comment_form' method='POST' name='form_komentar' action='home.php?menu=detail_berita&id=$hasil[id_berita]#postkomentar'>";?>
	
		<?php if ($user): ?>
				<table>
						<tr>
							<td>
								<a href="<?php echo $logout; ?>"><img src="images/logout.png" style='width:150px; height:40px; margin-left:-2px; margin-top:-10px;margin-bottom:15px;'/></a>
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='nama' id='name' type='text' value="<?php echo $user_profile['name']; ?>" class='your-name' placeholder = 'Account Name' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='nama' id='name' type='text' value="<?php echo $user_profile['email']; ?>" class='your-name' placeholder = 'Account Email Address' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<textarea name='pesan' id='comment_body' class='your-message' placeholder = 'Please type your comment here...' required></textarea>
							</td>
						</tr>
				
						<tr>
							<td>
								<input id='6_letters_code' name='6_letters_code' type='text' placeholder = 'Enter captcha code here' class='your-name' required>
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
								<input type="hidden" name="idFB" value="<?php echo $user_profile['id']; ?>">
								<input type="hidden" name="nama" value="<?php echo $user_profile['name']; ?>">
								<input type="hidden" name="email" value="<?php echo $user_profile['email']; ?>">
								<input type='hidden' name='id_induk' id='id_induk' value='0'/>
								<input type='submit' value='Submit' name='submit' class='' style='width:30%;background:#56a8e4;padding:5px;border:1px solid #fff;color:#fff;'/> 
							</td>
						</tr>
				</table>
				</form></div>
		<?php else: ?>
				<div style='font-size:18px;margin-top:-5px;'>Silakan login untuk mengirim komentar</div>
				<table>
						<tr>
							<td>
								<a href="<?php echo $loginUrl; ?>"><img src="images/login_1.png" style='width:150px; height:80px; margin-left:-12px; margin-top:-16px; margin-bottom:-10px;'/></a>
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='nama' id='name' type='text' value="<?php echo isset($user_profile['name']); ?>" class='your-name' placeholder = 'Account Name' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='nama' id='name' type='text' value="<?php echo isset($user_profile['email']); ?>" class='your-name' placeholder = 'Account Email Address' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<textarea name='pesan' id='comment_body' class='your-message' placeholder = 'Please type your comment here...' required></textarea>
							</td>
						</tr>
				
						<tr>
							<td>
								<input id='6_letters_code' name='6_letters_code' type='text' placeholder = 'Enter captcha code here' class='your-name' required>
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
								<input type="hidden" name="idFB" value="<?php echo $user_profile['id']; ?>">
								<input type="hidden" name="nama" value="<?php echo $user_profile['name']; ?>">
								<input type="hidden" name="email" value="<?php echo $user_profile['email']; ?>">
								<input type='hidden' name='id_induk' id='id_induk' value='0'/>
								<button class='default-button' type='submit' name='submit'>Leave a Comment</button>
							</td>
						</tr>
				</table></div>
			</form></div></div>
		<?php endif ?>
	<?php } ?>