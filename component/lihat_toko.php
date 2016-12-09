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
	$query =mysql_query("SELECT * FROM lokasi_toko a, kelurahan b, kecamatan c
							WHERE a.id_kelurahan = b.id_kelurahan
							AND b.id_kecamatan = c.id_kecamatan
							ORDER BY tahun DESC, c.id_kecamatan ASC") or die (mysql_error());
	
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
			<h4 class=\"widgettitle\">Lihat Data Lokasi Toko Modern</h4>
			<div class=\"widgetcontent\">
			<table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
						<th><center>Nama Toko</th>
						<th><center>Jenis</th>
						<th><center>Ijin</th>
						<th><center>Terbit</th>
						<th><center>Kecamatan</th>
						<th><center>Kelurahan</th>
                        <th><center>Alamat Toko</th>
                        <th><center>Tahun</th>
						<th><center>Koordinat<br>Latitude Longitude</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
				
				$no = 1;				
				while($pecah = mysql_fetch_array($query)){
					echo "<tr class=\" \">
						<td></td>
						<td style='width:5%;'><center>$no</td>
						<td style='width:10%;'><center>$pecah[nama_toko]</td>
						<td style='width:7.5%;'><center>$pecah[jenis]</td>
						<td style='width:7.5%;'><center>$pecah[ijin]</td>
						<td style='width:7.5%;'><center>$pecah[terbit]</td>
						<td style='width:10%;'><center>$pecah[nama_kecamatan]</td>
						<td style='width:10%;'><center>$pecah[Kelurahan]</td>
						<td style='width:15%;'><center>$pecah[alamat_toko]</td>
						<td style='width:7.5%;'><center>$pecah[tahun]</td>
						<td style='width:15%;'><center>$pecah[lat]., .$pecah[lng]</td>
						<td class=\"center\" style=\"width: 60px;\">
							<a href= \"main.php?menu=editToko&id_toko=$pecah[id_toko]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
							<a href=\"main.php?menu=hapusToko&id_toko=$pecah[id_toko]\" title=\"Hapus\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class=\"icon-trash\"><i></i></a>
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