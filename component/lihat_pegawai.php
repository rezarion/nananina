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
	include "koneksi.php";
	$hitung= mysql_query("SELECT count(id_pegawai) as jumlah FROM pegawai ");
	while($jumlah = mysql_fetch_array($hitung)){
		$jml= $jumlah['jumlah'];
	}

	//ambil data dari database (query);
	$query =mysql_query("SELECT * FROM pegawai");
	
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
            <h4 class=\"widgettitle\">Lihat Data Pegawai</h4>
			<div class=\"widgetcontent\">
            <table id=\"dyntable\" class=\"table table-bordered responsive\">
                <thead>
                    <tr>
                        <th></th>
                        <th><center>No.</th>
						<th><center>NIP</th>
						<th><center>Nama</th>
                        <th><center>Gender</th>
						<th><center>Tempat Lahir</th>
						<th><center>Tanggal Lahir</th>
						<th><center>Jabatan</th>
						<th><center>Foto</th>
						<th><center>Aksi</th>
                    </tr>
                </thead>
				<tbody>";
					
				$i = 1;
				function gender ($g){
					if ($g==1){
						echo "Laki-laki";
					}else if ($g==2){
						echo "Perempuan";
					}else {
					}
				}
				
				while($pecah = mysql_fetch_array($query)){
					echo "<tr class=\" \">
						<td></td>
						<td style='width:5%;'><center>$i</td>
						<td style='width:20%;'>$pecah[id_pegawai]</td>
						<td style='width:30%;'>$pecah[nama_pegawai]</td>
						<td style='width:10%;'><center>";gender($pecah['gender']);
					echo "</td>
						<td style='width:10%;'>$pecah[tempat_lahir]</td>
						<td style='width:10%;'>$pecah[tanggal_lahir]</td>
						<td style='width:10%;'>$pecah[jabatan]</td>
						<td style='width:20%;'>";
					if($pecah['foto'] != ""){	
						echo "<img width='100px' src=component/foto/$pecah[foto]>";
					}else{
						echo "no display picture";
					}
					echo "</td>		
					
					<td class=\"center\" style=\"width: 60px;\">
						<a href= \"main.php?menu=editPegawai&kode=$pecah[id_pegawai]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
						<a href=\"main.php?menu=hapusPegawai&kode=$pecah[id_pegawai]\" title=\"Hapus\" onClick=\"return confirm('Are you sure to delete?')\" class=\"icon-trash\"><i></i></a>
					</td>
														
					</tr>";
				$i++; 
				};
				echo "</tbody>
			</table>
			</div>
		</div>
	";
?>