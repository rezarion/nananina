<div class='services'>
	<?php
	//session_start();

	/*
	function sql_connect($dbhost, $dbuser, $dbpass, $dbname) {
		$dbconn = mysql_connect($dbhost, $dbuser, $dbpass);
		if($dbconn) {
			$dbselect = mysql_select_db($dbname);
			if(!$dbselect) {
				mysql_close($dbconn);
				$dbconn = false;
			}
		}
		return $dbconn;
	}
	*/

	function check_email($email) {
		return preg_match("/^([_a-zA-Z0-9-+]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+)(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,6})$/" , $email) ? $email : FALSE;
	}

	function create_code() {
		$temp = explode(" ", microtime());
		$recnum = str_replace(".", "", $temp[1].$temp[0]);
		
		$rcode = hexdec(md5($recnum));
		$code = substr($rcode, 2, 6);
		
		$_SESSION['tmp']['captcha'][0] = $recnum;
		$_SESSION['tmp']['captcha'][1] = $code;
		
		return array($recnum, $code);
	}

	function verify_code($rec_num, $checkstr) {
		if ($_SESSION['tmp']['captcha'][0] == $rec_num) {
			$code = $_SESSION['tmp']['captcha'][1];
			$_SESSION['tmp']['captcha'] = '';
			return ($checkstr == $code);
		}
		return FALSE;
	}
	
	function getComments($row) {
		echo "<li class='comment'>";
		echo "<div class='timestamp' style=\"font-size:9pt; !important\"><i>Tanggal : ".$row['tanggal']."</i></div>";
		echo "<br />";
		echo "<div class='aut' style=\"font-size:11pt; !important\">".$row['nama']."</div>";
		echo "<div class='comment-body' style=\"font-size:10pt; !important\">".$row['komentar']."</div>";
		echo "<a href='#comment_form' class='reply' id='".$row['id_komentar']."'>Reply</a>";
		$q = "SELECT * FROM komentar WHERE id_induk = ".$row['id_komentar']." AND status = '1' ";
		$r = mysql_query($q);
		if(mysql_num_rows($r)>0){
			echo "<ul>";
			while($row = mysql_fetch_assoc($r)) {
				getComments($row);
			}
			echo "</ul>";
		}
		echo "</li>";
	}
	
	?>
</div>