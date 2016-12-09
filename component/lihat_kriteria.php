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
	$query =mysql_query("SELECT * FROM kriteria") or die (mysql_error());
	
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
			<h4 class=\"widgettitle\">Lihat Data Kriteria</h4>
			<div class=\"widgetcontent\">
			<table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
                        <th><center>Nama Kriteria</th>
						<th><center>Bobot</th>
						<th><center>Kelas Bobot</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
				
				$no = 1;				
				while($pecah = mysql_fetch_array($query)){
					echo "<tr class=\" \">
						<td></td>
						<td style='width:10%;'><center>$no</td>
						<td style='width:30%;'><center>$pecah[nama_kriteria]</td>
						<td style='width:20%;'><center>$pecah[bobot]</td>
						<td style='width:30%;'><center>$pecah[klas_bobot]</td>
						<td class=\"center\" style=\"width: 60px;\">
							<a href= \"main.php?menu=editKriteria&id_kriteria=$pecah[id_kriteria]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
							
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