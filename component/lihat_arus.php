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
	$query = mysql_query("SELECT * FROM arus_lalulintas a, kelurahan b, kecamatan c
							WHERE a.id_kelurahan = b.id_kelurahan
							AND b.id_kecamatan = c.id_kecamatan
							ORDER BY tahun DESC, c.id_kecamatan ASC") or die (mysql_error());
							
	//$query =mysql_query("SELECT * FROM arus_lalulintas") or die (mysql_error());
	//$pecah= mysql_fetch_array($query);
	
	//notifikasi
	if(ISSET($_SESSION['success'])){
		echo '<div class="alert alert-success" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['success'].'</strong></div>';
		unset($_SESSION['success']);
	}else if(ISSET($_SESSION['error'])){
		echo '<div class="alert alert-error" style="margin:7px;width:53%;"><button data-dismiss="alert" class="close" type="button">&times;</button><strong>'.$_SESSION['error'].'</strong></div>';
		unset($_SESSION['error']);
	}
	
	//tampilkan
    echo "<div class=\"widget\">
			<h4 class=\"widgettitle\">Lihat Data Arus Lalu Lintas</h4>
			<div class=\"widgetcontent\">
            <table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
						<th><center>Tahun</th>
                        <th><center>Kecamatan</th>
						<th><center>Kelurahan</th>
						<th><center>Nilai arus</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
				
				$no = 1;
				while($pecah = mysql_fetch_array($query)){
					echo "<tr class=\" \">
						<td></td>
						<td style='width:5%;'><center>$no</td>
						<td style='width:10%;'><center>$pecah[tahun]</td>
						<td style='width:30%;'><center>$pecah[nama_kecamatan]</td>
						<td style='width:30%;'><center>$pecah[Kelurahan]</td>
						<td style='width:20%;'><center>$pecah[nilai_arus]</td>
						<td class=\"center\" style=\"width: 5%;\">
							<a href= \"main.php?menu=editArus&id_arus=$pecah[id_arus]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
							<a href=\"main.php?menu=hapusArus&id_arus=$pecah[id_arus]\" title=\"Hapus\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class=\"icon-trash\"><i></i></a>
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