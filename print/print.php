<?php
include 'dbc.php';
?>
<html>
<head>
<title>Print dan Preview Data Tahanan</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
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

-->
</style>
</head>
<body>
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
<script type="text/javascript">
var s5_taf_parent = window.location;
function popup_print() {
window.open('preview.php?nosp=<?php echo $row['nosp'];?>','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes')
}
</script>
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
     <tr></br>
	        <td align="center">
			 <div align="left"><b>Data tahanan atas nama : <?php echo $row['nama_lengkap'];?></b></div>
			 <td align="center">             
     <tr> 
       <td >Tgl Perkara<br> </td>
	   <td >
       : <?php echo $row['tgl_perkara'];?></td>
		    <td rowspan="3" ><img src="image/<?php echo $row['photo'];?>" width="100" height="100"></td>
     </tr>
   		    <tr>
            <td >Nama / Alias<br> </td>
			<td bgcolor="">
              : <?php echo $row['nama_lengkap'];?></td>
	      </tr>
		  <tr> 
            <td >Jenis Kelamin<br></td>
            <td >: <?php echo $row['jeniskel'];?></td>
	      </tr>   	   
          <tr> 
            <td >Tempat Tanggal Lahir<br></td>
            <td >: <?php echo $row['tempat_lhr'];?>
              ,
              <?php echo $row['tgl_lahir'];?></td>
            <td >&nbsp;</td>
          </tr>        
          <tr> 
            <td >No Sp Han<br></td>
            <td >: <?php echo $row['nosp'];?></td>
            <td >&nbsp;</td>
          </tr>
		   <tr> 
            <td >Alamat<br></td>
            <td >: <?php echo $row['alamat'];?></td>
		    <td bgcolor="">&nbsp;</td>
		   </tr>
		  <tr> 
            <td >Agama<br></td>
            <td >: <?php echo $row['agama'];?></td>
		    <td bgcolor="">&nbsp;</td>
		  </tr>
		  <tr> 
            <td >Kasus / Pasal 1<br></td>
            <td >: <?php echo $row['kasus1'];?></td>
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
          	  <td align="center"><hr><input type="button" class="button" value="Print dan Preview" onClick="popup_print()"/></center> 	
</td>
            </td>
    </table>
</div>
  </div>
</div>
</body>
</html>