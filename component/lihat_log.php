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
	//$date = date('D-m-y H:i:s', strtotime($date));
	//ambil data dari database (query);
	$query =mysql_query("SELECT l.*, u.nama, level
							FROM user_log l, user u
							WHERE u.id_user = l.id_user
							ORDER BY id_log DESC");
	

	//tampilkan
     echo "<div class=\"widget\">
                <h4 class=\"widgettitle\">Lihat User Log</h4>
                <div class=\"widgetcontent\">
                <table id=\"dyntable\" class=\"table table-bordered responsive\">
				
					<thead>
                        <tr>
							<th></th>
                            <th><center>No.</th>
                            <th ><center>Nama User</th>
                            <th ><center>Level</th>
                            <th ><center>Aktivitas</th>
							<th ><center>Tanggal</th>
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
				$date = date('d-m-Y, H:i:s', strtotime($pecah['tanggal']));
				echo "
					<tr class=\" \" >
						<td><center></td>
						<td style='width:5%;' ><center>$i</td>
						<td style='width:20%;'><center>$pecah[nama]</td>
						<td style='width:20%;'><center>"; level($pecah['level']);  echo "</td>
						<td style='width:20%;'>$pecah[status]</td>
						<td style='width:15%;' ><center>$date</td>
				</tr>";
			$i++; 
	};
	echo "</tbody>
	</table>
			</div>
	  </div>";
?>