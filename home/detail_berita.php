<?php 
	@session_start();
	error_reporting(0);
	
	if(ISSET($_SESSION['unset_id']) && $_SESSION['unset_id'] == 1){
		unset($_SESSION['token']);
	}
								
	//print_r($_SESSION);
	########## Google Settings.. Client ID, Client Secret #############
	$google_client_id 		= '1085264267071-g97vgp6k0fthujlrkvnndsh59qu94vqr.apps.googleusercontent.com';
	$google_client_secret 	= 'GLWrH45HaXE5PTmzZO-qA05O';
	$google_redirect_url 	= 'http://localhost:80/bkkbn2/home.php?menu=detail_berita';
	$google_developer_key 	= 'AIzaSyDPMmK5QbM_Mb7QIsKyYoFLHY1ddmuChmw';

	########## MySql details (Replace with yours) #############
	$db_username = "root"; //Database Username
	$db_password = ""; //Database Password
	$hostname = "localhost"; //Mysql Hostname
	$db_name = 'bkkbn'; //Database Name
	###################################################################

	//include google api files
	require_once 'src/Google_Client.php';
	require_once 'src/contrib/Google_Oauth2Service.php';

	$gClient = new Google_Client();
	$gClient->setApplicationName('BKKBN');
	$gClient->setClientId($google_client_id);
	$gClient->setClientSecret($google_client_secret);
	$gClient->setRedirectUri($google_redirect_url);
	$gClient->setDeveloperKey($google_developer_key);

	$google_oauthV2 = new Google_Oauth2Service($gClient);
	
	//If user wish to log out, we just unset Session variable
	if (isset($_REQUEST['reset'])) 
	{
	  unset($_SESSION['token']);
	  $gClient->revokeToken();
	  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	}

	if (isset($_GET['code'])) 
	{ 
		$gClient->authenticate($_GET['code']);
		$_SESSION['token'] = $gClient->getAccessToken();
		header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
		return;
	}

	if (isset($_SESSION['token'])) 
	{ 
			$gClient->setAccessToken($_SESSION['token']);
	}

	if ($gClient->getAccessToken()) 
	{
		  //Get user details if user is logged in
		  $user 				= $google_oauthV2->userinfo->get();
		  $user_id 				= $user['id'];
		  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		  $_SESSION['token'] 	= $gClient->getAccessToken();
		 
	}
	else 
	{
		//get google login url
		$authUrl = $gClient->createAuthUrl();
		$_SESSION['authGoogle'] = $authUrl;
		
	}
	
	if(ISSET($_SESSION['id_data'])){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=home.php?menu=detail_berita&id=$_SESSION[id_data]\">";
		unset($_SESSION['id_data']);
	}else{
		if(ISSET($user_name)){
			$_SESSION['authGoogle'] = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/bkkbn2/home.php?menu=detail_berita";
		}
	}
?>
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
		font-size:1.2em;
		display:block;
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
	//require "koneksi.php";
	
	require_once 'home/function1.php';
	$sql = mysql_query("SELECT * FROM berita WHERE id_berita = '$_GET[id]' ");
	$i=1;
	while($hasil = mysql_fetch_array($sql)){	
		$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
		$l = mysql_fetch_array($g);
		echo "
		<div class='m-page-title'>
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
				<div class='l-post-image' style='width:60%; left:150px;'>
					<img src='component/gambar/$hasil[gambar]' width='120px' height='100px'/>
				</div>	
				<p>
					$hasil[isi]
				</p>
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

					$id_induk = mysql_real_escape_string($_POST['id_induk']);
					// query simpan data ke tabel google_users
					$query = mysql_query("INSERT INTO google_users (id_google, id_berita, id_induk, nama, email, komentar, status) VALUES ('$user_id','$_GET[id]','$id_induk','$user_name','$email','$pesan','1')");
					
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

		$query = mysql_query("SELECT * FROM google_users WHERE id_berita = '$_GET[id]' AND id_induk = '0' AND status = '1' ");
		while ($row = mysql_fetch_assoc($query)) {
			getComments($row);
		}
		echo "</ul>";
		
		//$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
		//$email = isset($_POST['email']) ? $_POST['email'] : "";
		$pesan = isset($_POST['pesan']) ? $_POST['pesan'] : "";

		echo "<a name='postkomentar'></a> {$alert}";?>
		
		<?php 	
		echo "<div id = 'form'><form id='comment_form' style='width:500px;' method='POST' name='form_komentar' action='home.php?menu=detail_berita&id=$hasil[id_berita]#postkomentar'>";
		//if(isset(echo "linkgoogle.php?id=$_GET[id]";)){ //user is not logged in, show login button
		?>
			<div style='font-size:18px;margin-top:-5px;'>Silakan login untuk mengirim komentar</div>
				<table>
						<tr>
							<td>
								
								<?php if(!ISSET($user_name)){?>
								<a href="<?php echo "home/linkgoogle.php?id=$_GET[id]"; ?>"><img src="images/sign-in-with-google.png" style='width:150px; height:40px; margin-left:-5px; margin-top:5px; margin-bottom:8px;'/></a>
								<?php }else{
									echo "<a href='home/linkgoogle.php?stat=logout&id=$_GET[id]'><img src='images/logout.png' style='width:150px; height:40px; margin-left:-2px; margin-top:5px;margin-bottom:15px;'/></a>";
								}?>
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='nama' id='name' type='text' value="<?php echo (isset($user_name))?$user_name:''; ?>" class='your-name' placeholder = 'Account Name' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<input name='email' id='name' type='text' value="<?php echo (isset($email))?$email:''; ?>" class='your-name' placeholder = 'Account Email Address' disabled>	
							</td>
						</tr>
						
						<tr>
							<td>
								<textarea name='pesan' id='comment_body' class='your-message' placeholder = 'Please type your  here...' required></textarea>
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
								<input type='hidden' name='id_induk' id='id_induk' value='0'/>
								<button class='default-button' type='submit' name='submit'>Leave a Comment</button>
							</td>
						</tr>
				</table></div></form></div></div>
		<?php
	//}
	}?>
	
	