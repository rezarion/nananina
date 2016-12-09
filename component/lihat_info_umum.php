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
<script type="text/javascript">
    jQuery(document).ready(function(){
        
        //content slider
        jQuery('#slidercontent').bxSlider({
            prevText: '',
            nextText: ''
        });
        
        //slim scroll
        jQuery('#scroll1').slimscroll({
             color: '#666',
             size: '10px',
             width: 'auto',
             height: '208px'                  
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
				<h4 class=\"widgettitle\">Informasi</h4>
			<div class=\"widgetcontent\">
			<div class=\"row-fluid\">
			<div class=\"span\" height=\"500px\">
				
				<br />
				<div id=\"scroll1\" class=\"mousescroll\">
				<ul class=\"enrylist\">			
				";
				
				$no = 1;				
				while($pecah = mysql_fetch_array($query)){
				$date = date('d-m-Y, H:i:s', strtotime($pecah['tanggal']));
					echo "	<li>
							<div class=\"entry_wrap\">
								<div class=\"entry_img\"><img width='100px' height='200px' src='component/upload/$pecah[gambar]' alt=\"\"></div>
								<div class=\"entry_content\">
									<h5> <a href=\"\">$pecah[judul]</a></h5>
									<small>Submitted by: <a href=\"\"><strong>admin</strong></a> -$date</small>
									<p><br />$pecah[isi]</p>
								</div>
							</div>
							</li>
						";

				$no++;
				};
				
				echo "
				</ul>
				</div>
			</div>
			</div>
			</div>
		</div>  
	";
?>
