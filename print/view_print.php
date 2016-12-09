<?php 
include 'dbc.php';

$page_limit = 10; 
				
		//Untuk menampilkan total row
		$rs_all = mysql_query("select count(*) as total_all from data_user") or die(mysql_error());				   
list($all) = mysql_fetch_row($rs_all);
//untuk menampilkan
        $tampil = "select * from data_user";
        $cek = mysql_query($tampil);
		 $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 20;
        $startpoint = ($page * $limit) - $limit;
         
        //to make pagination
        $statement = "`data_user`";
		$num_rows = mysql_num_rows($cek);
		
		//$delete=mysql_query("delete from data_user where id=idyangmaudihapus");
//setelah dihapus datanya mau diarahin kemana, smisal telah berhasil hapus diarahin ke index.php
//if($delete){
//echo '<meta http-equiv=refresh content=0;url="view_data.php">';
//}
//else{
// echo "<script>alert('gagal menghapus data') ";
// } 
        ?>
<html>
<head>
<title>View Data Kasus</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

    
<style type="text/css">
<!--
body {
	background-image: url(image/background.jpg);
	background-repeat:no-repeat;
	background-position:top;
	font-family:"Courier New", Courier, monospace;
	font-weight:bold;
}
.style6 {color: #003300}
.style7 {color: #0099FF}
.style8 {color: #0033FF}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr></br>
		    <td>            
            <td>            
     <tr></br>
		    <td>            
            <td>            
     <tr></br>
		    <td>            
            <td>            
     <tr></br>
	       <td>          
           <td>
     <tr></br>
	       <td>          
           <td>
	 <tr></br>
	       <td>          
 <hr>
  <tr>
    <td width="100%" valign="top" style="padding: 10px;">
<div class="myaccount">
   <div align="right"><? echo gmdate("d M Y H:i:s",time()+60*60*7);  ?></div>

        <?
    echo "<form action='view_print.php' method='post' name='postform'>";
	echo "<br>";
    echo "Cari berdasarkan<br>";
    echo "<select name='pilihan'>";
    echo "<option value='nama_lengkap'>Nama </option>";
	echo "<option value='nosp'>No SP Han </option>";
	echo "<option value='kasus1'>Kasus Perkara </option>";
	echo "</select>  ";
	echo "<input type='text' name='cari'>";
    echo "<input type='submit' value='cari'>";
	echo " | ";
	echo "<input type='submit' value='Tampilkan'>";
	echo "</form>";
    ?>  
  <span class="style1">Total Data : <?php echo $all;?></span>
 		 <table width="100%" border="0" align="center" cellpadding="2" background="">
	  <td width="60">
        <tr><td bgcolor="#CCCCCC" width="40"><div align="center" class="style2">Foto / Nama</div></td>
        <td bgcolor="#CCCCCC" width="30"><div align="center" class="style2">Jenis Kelamin</div></td>
        <td bgcolor="#CCCCCC" width="30"><div align="center" class="style2">Agama</div></td>
        <td bgcolor="#CCCCCC" width="40"><div align="center" class="style2">TTL</div></td>
        <td bgcolor="#CCCCCC" width="30"><div align="center" class="style2">Pekerjaan</div></td>
        <td bgcolor="#CCCCCC" width="50"><div align="center" class="style2">Alamat</div></td>
		<td bgcolor="#CCCCCC" width="48"><div align="center" class="style2">No SP Han</div></td>
        <td bgcolor="#CCCCCC" width="20"><div align="center" class="style2">Tgl Perkara</div></td>
        <td bgcolor="#CCCCCC" width="200"><div align="center" class="style2">Kasus Perkara</div></td>
        <td bgcolor="#CCCCCC" width="200"><div align="center" class="style2">Action</div></td>
        </tr></td>
	<?php
//di proses jika sudah klik tombol cari
if(isset($_POST['cari'])){
	
	//menangkap nilai form
	$option=$_POST['pilihan'];
    $katakunci=$_POST['cari'];
		
	if(empty($katakunci)){
		//jika tidak menginput apa2
		$query=mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}");
		
		
	}else{
		
		?><?php
		
		$query=mysql_query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit} where $option like '%$katakunci%'");
		
	}
		
	?>
	</p>
	<?php
	//untuk penomoran data
	$no=0;
	$query=mysql_query("SELECT * FROM data_user where $option like '%$katakunci%'");
	//menampilkan data
	while($row=mysql_fetch_array($query)){
	?>
		
		<td bordercolor="" background="grey" bgcolor="" ><div align="center" class="style7"><img src="image/<?php echo "".$row['photo']."";?>" height="90" width="90" /><br><a href="print.php?Nama=<?php echo "".$row['nama_lengkap']."";?>" target="_top"><?php echo "".$row['nama_lengkap']."";?></a></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['jeniskel']."";?></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['agama']."";?></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['tempat_lhr']."";?> | <?php echo "".$row['tgl_lahir']."";?></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['pekerjaan']."";?></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['alamat']."";?></div></td>
		<td bgcolor="#FFFFCC"><div align="center" class="style7"><a href="print.php?nosp=<?php echo "".$row['nosp']."";?>" target="_top"><?php echo "".$row['nosp']."";?></a></div></td>
        <td bgcolor="#FFFFCC"><div align="center" class="style7"><?php echo "".$row['tgl_perkara']."";?></div></td>
        <td bgcolor="#FFFFCC"><div align="left" class="style7">1. <?php echo "".$row['kasus1']."";?><br>2. <?php echo "".$row['kasus2']."";?><br>3. <?php echo "".$row['kasus3']."";?></div></td>
        <td bordercolor="" background="grey" bgcolor="" ><div align="center" class="style7"><a href="print.php?nosp=<?php echo "".$row['nosp']."";?>" target="_top">Preview</a></div></td>
        </tr>
        		 
        <tr><th colspan="11"></th></tr>
        <?php
        }
        ?>
		<?php
		//jika data tidak ditemukan
		if(mysql_num_rows($query)==0){
			echo "<strong><font color=red size=5>Tidak ada data yang dicari!</font></strong>";
		}
		?>
  </table>
	  	<?php echo pagination($statement,$limit,$page);?>
</div>		
  </div>
  <?php
}else{
	unset($_POST['cari']);
}
?>
</div>
</body>
</html>
