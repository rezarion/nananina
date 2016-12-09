<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/responsive-tables.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
        });
        
        jQuery('#dyntable2').dataTable( {
            "bScrollInfinite": true,
            "bScrollCollapse": true,
            "sScrollY": "300px"
        });
        
    });
</script>

<?php
	//ambil data dari database (query);
	include "config/koneksi.php";	
	$query =mysql_query("SELECT * FROM info ORDER BY tanggal DESC") or die (mysql_error());
	
	//notifikasi
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}

	//tampilkan
    echo" <div class=\"widget\">
			<h4 class=\"widgettitle\">Lihat Data Informasi</h4>
			<div class=\"widgetcontent\">
			<table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
						<th><center>Judul</th>
						<th><center>Tanggal</th>
                        <th><center>Isi</th>
                        <th><center>Gambar</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
				
				$no = 1;				
				while($pecah = mysql_fetch_array($query)){
				$date = date('d-m-Y, H:i:s', strtotime($pecah['tanggal']));
					echo "<tr class=\" \">
						<td></td>
						<td style='width:5%;'><center>$no</td>
						<td style='width:20%;'><center>$pecah[judul]</td>
						<td style='width:10%;'><center>$date</td>
						<td style='width:40%; padding-left: 20px;'><justify>$pecah[isi]</td>
						<td style='width:20%;'><center><img width='200px' src='component/upload/$pecah[gambar]'></td>
						
						<td class=\"center\" style=\"width: 60px;\">
							<a href= \"main.php?menu=editInfo&id_info=$pecah[id_info]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
							<a href=\"main.php?menu=hapusInfo&id_info=$pecah[id_info]\" title=\"Hapus\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class=\"icon-trash\"><i></i></a>
						</td>";
	
					echo "</td>		
									
					</tr>";
				$no++;
				};
				echo "</tbody>
			</table>
		 </div>
		 </div>
	";
?>

						<!--<tr>
							<td width='20%'>";
							if($pecah['gambar'] != ""){	
								echo "<img width='300px' src=upload/$pecah[gambar]>";
							}else{
								echo "no display picture";
								}
								echo "</td>		
							<td width='80%' style=\"word-wrap:break-word; !important\">$pecah[isi]</td>
						</tr>-->