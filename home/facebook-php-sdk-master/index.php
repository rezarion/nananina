<?php
	define('APP_ID', '559224970841766');
	define('APP_SECRET', '4628b43ed597617b5bc145837199b372');

	// pathnya sesuaikan dengah letak file yang kamu punya
	require 'src/facebook.php';

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
	} else {
	  $loginUrl = $facebook->getLoginUrl();
	}

require "koneksi.php";

// proses simpan data komentar ke DB

if (isset($_POST['submit']))
{
	// baca ID FB dari pengisi komentar
	$idFB = $_POST['idFB'];
	$nama = $_POST['nama'];
	// baca isi komentar
	$komentar = $_POST['komentar'];

	// query simpan data ke tabel guestbook
	$query = "INSERT INTO fb_users (id_FB, nama, komentar) VALUES ('$idFB','$nama','$komentar')";
	mysql_query($query);
}

// proses menampilkan semua data komentar

$query = "SELECT * FROM fb_users ORDER BY id DESC";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
	// menampilkan nama profile dan link profile FB nya
	echo "Nama: ".$data['nama']."</a><br>";
	// menampilkan komentarnya
	echo "Komentar: ".$data['komentar']."</p><hr>";
}
	
?>

<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title>Form Komentar</title>
		<style>
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
	</head>
	
	<body>
		<h1>Form Komentar</h1>
		<?php 
			if ($user){?>
				<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
					<table>
						<?phpif(isset($logoutUrl)){?>
							<tr>
								<td>
									<a href="<?php echo $loginUrl; ?>"><img src="../images/login_1.png" style='width:150px; height:80px;'/></a>	
								</td>
							<tr>
							<tr>
								<td>
									<a href="<?php echo $logoutUrl; ?>"><img src="../images/logout.png" style='width:150px; height:50px;'/></a>	
								</td>
							<tr>
								<td>
									<textarea name="komentar" placeholder = 'Please type your comment here...' required rows='5' cols='60'></textarea>
								</td>
							</tr>
					
							<tr>
								<td>
									<input type="hidden" name="idFB" value="<?php echo $user_profile['id']; ?>">
									<input type="hidden" name="nama" value="<?php echo $user_profile['name']; ?>">
									<input type='submit' value='Submit' name='submit' class='' style='width:30%;background:#56a8e4;padding:5px;border:1px solid #fff;color:#fff;'/> 
								</td>
							</tr>
					</table>
				</form> 
		<?php }} ?>
	</body>
</html>
