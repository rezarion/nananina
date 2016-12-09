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
	$query =mysql_query("SELECT l.*, u.nama
							FROM user_log l, user u
							WHERE u.id_user = l.id_user
							ORDER BY id_log DESC");
	

	//tampilkan
     echo "<div class=\"maincontent\">
	 
            <div class=\"maincontentinner\">
                <h4 class=\"widgettitle\">Lihat User Log</h4>
                <table id=\"dyntable\" class=\"table table-bordered responsive\">
				
					<thead>
                        <tr>
							<th></th>
                            <th><center>No.</th>
                            <th ><center>Nama User</th>
                            <th ><center>Aktivitas</th>
							<th ><center>Tanggal</th>
                        </tr>
                    </thead>
					<tbody>";
						
				$i = 1;
				while($pecah = mysql_fetch_array($query)){
				$date = date('d-m-Y, H:i:s', strtotime($pecah['tanggal']));
				echo "
					<tr class=\" \" >
						<td><center></td>
						<td style='width:5%;' ><center>$i</td>
						<td style='width:25%;'>$pecah[nama]</td>
						<td style='width:25%;'>$pecah[status]</td>
						<td style='width:15%;' ><center>$date</td>
				</tr>";
			$i++; 
	};
	echo "</tbody>
	</table>
			</div>
	  </div>";
?>