    <?php
	  $server = "localhost";
	  $user = "root";
	  $password = "";
	  
	  $id_mysql = mysql_connect($server, $user, $password);
//	  if(! $id_mysql)
//	    die("Tidak dapat melakukan koneksi ke server MySQL");
//		printf("Koneksi ke MySQL bisa dilakukan <br>\n");
//		
	  $db_bkkbn = mysql_select_db("bkkbn", $id_mysql);
//	  if(! $db_bkkbn)
//	    die("Tidak dapat mengakses database bkkbn");
//		printf("Database perpus bisa diakses <br>\n");
//		//mysql_close($id_mysql)	
	?>
