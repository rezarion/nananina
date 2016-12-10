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
	$hitung= mysql_query("SELECT count(id_user) as jumlah FROM user ");
	while($jumlah = mysql_fetch_array($hitung)){
		$jml= $jumlah['jumlah'];
	}
?>

<?php
	//ambil data dari database (query);
	$query =mysql_query("SELECT * FROM user");

	//tampilkan
     echo "<div class=\"widget\">
                <h4 class=\"widgettitle\">Lihat Data User</h4>
                <div class=\"widgetcontent\">
                <table id=\"dyntable\" class=\"table table-bordered responsive\">
                    <thead>
                        <tr>
                            <th></th>
                            <th><center>No.</th>
                            <th><center>Nama</th>
                            <th><center>Username</th>
							<th><center>Level</th>
							<th><center>Aksi</th>
                        </tr>
                    </thead>
					<tbody>";
					
				$i = 1;	
				function level ($lvl){
				if ($lvl==1){
					echo "Administrator";
				}else if ($lvl==2){
					echo "Staf";
				}else {
					}
				}
				
				while($pecah = mysql_fetch_array($query)){
				
				echo "<tr class=\" \">
					<td></td>
					<td style='width:5%;'><center>$i</td>
					<td style='width:30%;'><center>$pecah[nama]</td>
					<td style='width:25%;'><center>$pecah[username]</td>	
					<td style='width:20%;'><center>"; level($pecah['level']);  echo "</td>
					<td class=\"center\" style=\"width: 60px;\"><center>
					<a href= \"main.php?menu=reset&kode=$pecah[id_user]&&username=$pecah[username]\" title=\"Reset password\" onClick=\"return confirm('Apakah Anda yakin ingin mereset password ini?')\"><i class=\" iconsweets-refresh3\"></i></a>
					<a href= \"main.php?menu=editUser&id_user=$pecah[id_user]\" title=\"Edit\"><i  class=\"icon-edit\"></i></a>
					<a href=\"main.php?menu=hapusUser&kode=$pecah[id_user]\" title=\"Hapus\" onClick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\" class=\"icon-trash\"><i></i></a>
					</td>
														
			</tr>";
			$i++; 
	};
	echo "</tbody>
	</table>
			</div>
	  </div>";
?>