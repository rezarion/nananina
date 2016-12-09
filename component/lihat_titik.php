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
	$query =mysql_query("SELECT * FROM titik_rekomendasi") or die (mysql_error());
	
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
			<h4 class=\"widgettitle\">Lihat Data Titik Rekomendasi</h4>
			<div class=\"widgetcontent\">
			<table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
						<th><center>Nama Titik</th>
						<th><center>Keberadaan Sarana(C1)</th>
                        <th><center>Kepadatan Penduduk (C2)</th>
						<th><center>Perkembangan Pemukiman Baru (C3)</th>
						<th><center>Potensi Ekonomi (C4)</th>
						<th><center>Arus Lalu Lintas (C5)</th>
						<th><center>Koordinat Latitude Longitude</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
				
				$no = 1;				
				while($pecah = mysql_fetch_array($query)){
					echo "<tr class=\" \">
						<td></td>
						<td style='width:10%;'><center>$no</td>
						<td style='width:20%;'><center>$pecah[nama_titik]</td>
						<td style='width:10%;'><center>$pecah[c1]</td>
						<td style='width:10%;'><center>$pecah[c2]</td>
						<td style='width:10%;'><center>$pecah[c3]</td>
						<td style='width:10%;'><center>$pecah[c4]</td>
						<td style='width:10%;'><center>$pecah[c5]</td>
						<td style='width:10%;'><center>$pecah[lat]., .$pecah[lng]</td>
						<td class=\"center\" style=\"width: 60px;\">
							<a href= \"main.php?menu=editTitik&id_titik=$pecah[id_titik]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
							<a href=\"main.php?menu=hapusTitik&id_titik=$pecah[id_titik]\" title=\"Hapus\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class=\"icon-trash\"><i></i></a>
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