<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:fb="http://www.facebook.com/2008/fbml">
	<body>
	<h1>Buku Tamu</h1>
	<?php 
		require 'src/facebook.php';
	?>
	
	<?php
		require "koneksi.php";

		// proses simpan data komentar ke DB
		
		if (isset($_POST['submit']))
		{
			// baca tanggal posting komentar
			$tgl = date("Y-m-d");
			// baca ID FB dari pengisi komentar
			$idFB = $_POST['idFB'];
			// baca isi komentar
			$komentar = $_POST['komentar'];

			// query simpan data ke tabel guestbook
			$query = "INSERT INTO fb_users (id_FB, tgl, komentar) VALUES ('$idFB', '$tgl', '$komentar')";
			mysql_query($query);
		}

		// proses menampilkan semua data komentar

		$query = "SELECT * FROM fb_users ORDER BY id DESC";
		$hasil = mysql_query($query);
		while ($data = mysql_fetch_array($hasil))
		{
			// proses parsing data profile pengisi komentar berdasarkan ID FB
			$user = json_decode(file_get_contents("https://graph.facebook.com/".$data['idFB']), true);
			// menampilkan photo profile
			echo "<p><img src='https://graph.facebook.com/".$data['idFB']."/picture'><br>";
			// menampilkan nama profile dan link profile FB nya
			echo "Nama: <a href='".$user['link']."'>".$user['name']."</a><br>";
			// menampilkan email profile FB
			echo "Email: ".$user['email']."<br>";
			// menampilkan tanggal posting komentar
			echo "Tanggal posting: ".$data['tgl']."<br>";
			// menampilkan komentarnya
			echo "Komentar: ".$data['komentar']."</p><hr>";
		}
	?>

	<?php 
		if ($cookie) { 
	?>
	
	<?php
		// setelah login sukses
		// proses parsing data JSON profile user dengan ID Facebook
		$user = json_decode(file_get_contents("http://graph.facebook.com/".$cookie['uid']), true);

		// menampilkan sapaan berisi nama lengkap
		echo "<p>Selamat datang ".$user['name'].", silakan isi buku tamunya di sini</p>";
	?>

	<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
		<textarea name="komentar" cols="30" rows="10"></textarea>
		<input type="hidden" name="idFB" value="<?php echo $cookie['uid']; ?>">
		<br>
		<input type="submit" name="submit" value="Simpan">
	</form>  
 
	<?php 
		} else { 
	?>

	<!-- jika user belum login maka munculkan tombol login -->
		<fb:login-button></fb:login-button>
	<?php 
		} 
	?>

	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>
		FB.init({appId: '<?= FACEBOOK_APP_ID ?>', status: true,
		cookie: true, xfbml: true});
		FB.Event.subscribe('auth.login', function(response) {
		window.location.reload();
		});
	</script>
	</body>
</html>