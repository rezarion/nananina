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
	$hitung= mysql_query("SELECT count(id_galeri) as jumlah FROM gallery ");
	while($jumlah = mysql_fetch_array($hitung)){
		$jml= $jumlah['jumlah'];
	}
?>

<?php
	//ambil data dari database (query);
	$query =mysql_query("SELECT * FROM gallery;");
	

	//tampilkan
     echo "<div class=\"maincontent\">
	 
            <div class=\"maincontentinner\">
                <h4 class=\"widgettitle\">Lihat Gallery</h4>
                <table id=\"dyntable\" class=\"table table-bordered responsive\">
				
					<thead>
                        <tr>
							<th></th>
                            <th><center>No.</th>
                            <th ><center>Nama Galeri</th>
                            <th ><center>Kategori</th>
							<th ><center>Tanggal</th>
							<th><center>Gambar</th>
							<th><center>Aksi</th>
                        </tr>
                    </thead>
					<tbody>";
						
				$i = 1;
				function kategori ($g){
				if ($g==1){
					echo "Dokumen";
				}else if ($g==2){
					echo "Gambar";
				}else {
				}
				}
				while($pecah = mysql_fetch_array($query)){
				echo "
					<tr class=\" \" >
						<td><center></td>
						<td style='width:5%;' ><center>$i</td>
						<td style='width:25%;'>$pecah[nama_galeri]</td>
						<td style='width:10%;' ><center>";kategori($pecah['id_kategori']);
					echo "</td>
						<td style='width:15%;' ><center>$pecah[tanggal]</td>
						<td style='width:20%;' ><center>";
						if($pecah['id_kategori'] == 2){	
							echo "<img width='100px' src=component/gambar/$pecah[gambar]>";
						}else{
							echo "dokumen";
						}
						echo "</td>
						
						<td class=\"center\" style=\"width:10% ;\">
						<a href=\"main.php?menu=editGaleri&kode=$pecah[id_galeri]\" title=\"Edit\" ><i  class=\"icon-edit\"></i></a> 
						<a href=\"main.php?menu=hapusGaleri&kode=$pecah[id_galeri]\" title=\"Hapus\" onClick=\"return confirm('Are you sure to delete?')\" class=\"icon-trash\"><i></i></a>
						</td>
				</tr>";
			$i++; 
	};
	echo "</tbody>
	</table>
			</div>
	  </div>";
?>