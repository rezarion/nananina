<?php
include 'dbc.php';
?>
<html>
<head>
<title>Print Data Tahanan - </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript">
function cetak()
{
window.print();
window.close();
}
</script>
<style type="text/css">
<!--
body {
	background-image: url(image/background.jpg);
	background-repeat:no-repeat;
	background-position:top;
	font-family:"Courier New", Courier, monospace;
	font-weight:bold;
}
.style1 {font-weight: bold}
.style2 {color: #009933}
.style5 {color: #000000}
-->
</style>
</head>
<body>
<body onLoad="window.print()">
   <?php
$idRS = $_GET['nosp'];
    $sql = "select * from data_user where nosp='$idRS'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
	// Cek Photo
$tipe_gambar = array('image/jpeg','image/bmp', 'image/x-png');

$nama = $_FILES['gambar']['name'];

$ukuran = $_FILES['gambar']['size'];

$tipe = $_FILES['gambar']['type'];

$error = $_FILES['gambar']['erorr'];

if($nama !=="" && $ukuran > 0 && $error == 0){

if(in_array(strtolower($tipe), $tipe_gambar)){

$move=move_uploaded_file($_FILES['gambar']['tmp_name'], 'image/'.$nama);
}
}	
?>
  </tr>
  <tr> 
   <table width="630" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
   <tr>
     <td>     
		 <?php	
	 if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";	
	   }
	 ?> 
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
     <tr></br><hr>
	        <td align="center">
			 <div align="left"><b>Data tahanan atas nama : <?php echo $row['nama_lengkap'];?></b></div>
			 <td align="center">             
     <tr> 
       <td bgcolor="">Tgl Perkara<br> </td>
	   <td bgcolor="">
       : <?php echo $row['tgl_perkara'];?></td>
		    <td rowspan="3" bgcolor=""><img src="image/<?php echo $row['photo'];?>" width="100" height="100"></td>
     </tr>
   		    <tr>
            <td bgcolor="">Nama / Alias<br> </td>
			<td bgcolor="">
              : <?php echo $row['nama_lengkap'];?></td>
	      </tr>
		  <tr> 
            <td bgcolor="">Jenis Kelamin<br></td>
            <td bgcolor="">: <?php echo $row['jeniskel'];?></td>
	      </tr>   	   
          <tr> 
            <td bgcolor="">Tempat Tanggal Lahir<br></td>
            <td bgcolor="">: <?php echo $row['tempat_lhr'];?>
              ,
              <?php echo $row['tgl_lahir'];?></td>
            <td bgcolor="">&nbsp;</td>
          </tr>        
          <tr> 
            <td bgcolor="">No Sp Han<br></td>
            <td bgcolor="">: <?php echo $row['nosp'];?></td>
            <td bgcolor="">&nbsp;</td>
          </tr>
		   <tr> 
            <td bgcolor="">Alamat<br></td>
            <td bgcolor="">: <?php echo $row['alamat'];?></td>
		    <td bgcolor="">&nbsp;</td>
		   </tr>
		  <tr> 
            <td bgcolor="">Agama<br></td>
            <td bgcolor="">: <?php echo $row['agama'];?></td>
		    <td bgcolor="">&nbsp;</td>
		  </tr>
		  <tr> 
            <td bgcolor="">Kasus / Pasal 1<br></td>
            <td bgcolor="">: <?php echo $row['kasus1'];?></td>
		    <td bgcolor="">&nbsp;</td>
		  </tr>		  		  
		  <tr>    
            <td height="26">Kasus / Pasal 2</td>
            <td>: <?php echo $row['kasus2'];?></td>
		    <td>&nbsp;</td>
		  </tr>
     <tr>
            <td>Kasus / Pasal 3          
            <td >: <?php echo $row['kasus3'];?>          
            </td >            
     </tr>
          
    </table>
</div>
  </div>
</div>
</body>
</html>