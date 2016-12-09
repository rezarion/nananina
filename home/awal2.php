<link rel="stylesheet" href="css1/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />		
<link rel="stylesheet" type="text/css" href="scroll/css/style_scroll.css" media="screen"/>
<script type="text/javascript" src="js1/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js1/jquery.dataTables.js"></script>	
<script type="text/javascript">
	$(window).load(function() {
		$('#slider').nivoSlider();
	});
	
	$(document).ready(function(){
		$('.testable').dataTable({
			"sPaginationType": "full_numbers",
			"bSort" : false,
			"iDisplayLength" : 1
		});
		
		$('.dataTables_length, .dataTables_filter, .dataTables_info').hide();
	})
</script>
<script type="text/javascript" src="js1/easySlider1.5.js"></script>

<style>
	.table, .table td, .table th{
		border:0px solid #DDD;
		
	}
	
	.table td, .table th{
		padding:5px;
		text-align:justify;
	}
	
	.span {
		background: none repeat scroll 0 0 #56a8e4;
		border-color: #999999 #4496D2 #EBEBEB;
		border-style: dotted solid solid;
		border-width: 0 1px 5px;
		color: #FFFFFF;
		height: 27px;
		padding:3px;
		margin-left:10px;
	}
	.span:hover{
		color:#f1f4f9;
	}
</style>

<?php
	include "koneksi.php";
?>
			<br/>
			<div class="main_body_resize">
				<div class="main_body">
					<div class="theme-default">
						<div id="slider" class="nivoSlider">
							<img src="images/panoramic_forests2.jpg" data-thumb="images/panoramic_forests2.jpg" alt="" title="#htmlcaption" />
							<img src="images/8_ingoscholtes_sweden.jpg" data-thumb="images/8_ingoscholtes_sweden.jpg" alt="" data-transition="slideInLeft" title="#htmlcaption"/>
							<img src="images/the-sunny-spring-5.jpg" data-thumb="images/the-sunny-spring-5.jpg" alt="" title="#htmlcaption"/>
						</div>
						<div id="htmlcaption" class="nivo-html-caption">
							SISTEM INFORMASI GEOGRAFIS PENYEBARAN PENDUDUK PROVINSI JAWA TENGAH
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
<div class='l-content-wrap'>

  <div class='container'>

	<div class='row'>
	<section class="span" style='margin:-20px 0 0 -50px; width:110.5%; height:30px; background: #56a8e4 !important;'>
	<b>Berita Terkini</b>
	</section>
	<table class='testable table' id='examples' style='width:100%;padding:3px;'>
		<thead>
			<tr>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 	
				$sql2 = mysql_query("SELECT * FROM berita WHERE status = '1' ORDER BY tanggal DESC");
				//echo '<div class=\'span\' >Informasi Terkini</div>';
				while($hasil = mysql_fetch_array($sql2)){
					$is= "";
					$is = explode(" ",$hasil['isi']);
					$fa = "";
					
					if(count($is) >= 50){
						for($i=0;$i<50;$i++){
							$fa .= $is[$i]." ";
						}
					}else{
						$fa = implode(" ",$is);
					}
					
					if(count($is) >= 45){
						$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
						$l = mysql_fetch_array($g);
						echo "	
							<tr><td>
							<!-- standard post -->
								<div class='m-page-title'>
								  <h1> $hasil[judul] </h1>
								</div><!-- m-page-title -->
						
							<div class='row l-user-profile'>
								<div class='col-lg-3 col-md-3 col-sm-3 user-avatar'>
									<img src='component/gambar/$hasil[gambar]' width='121px' height='122'/>
								</div>	
								<div class='col-lg-9 col-md-9 col-sm-9 user-info'>
								<h2></h2>
								<span>$hasil[tanggal], Oleh : $l[nama]</span>	
							<p class='font'>
								$fa ....
								<a href='home.php?menu=detail_berita&id=$hasil[id_berita]' >
								<i>read more</i>
								</a>
							</p>

					
						</div><!-- col-lg-9 -->
						</div> <!-- row 1-user-profile-->

                <!-- separator -->

                <div class='l-separator'>
                    <div class='separator-border'>
                      <span class='icon-separator'></span>
                    </div><!-- separator-border -->
                </div><!-- l-separator -->

							</td></tr>";	
					}else{
						$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
						$l = mysql_fetch_array($g);
						echo "	
							<tr><td>
									<p><img src='component/gambar/$hasil[gambar]' width='121px' height='122'/></p>
									<p><span>$hasil[judul]</span></p>
									<div style=\"margin-top:5px !important\"></div>
									<p><i>$hasil[tanggal]</i> Oleh <i>$l[nama]</i></p>
									<div style=\"margin-top:15px !important\"></div>
									<p class='font'>
										$hasil[isi]
									</p>
									<p align='right'>
										<a href='home.php?menu=detail_berita&id=$hasil[id_berita]' >Komentar</a>
									</p>
									<div style=\"margin-top:70px !importan	t\"></div>
									<div style=\"border-bottom:2px dotted #02b1c5; margin:40px 20px 0px 20px; !important\"></div>
							</td></tr>";	
					}
					$i++;
				}
			?>
		</tbody>
	</table>
</div>
				
			
		<div class="clr"></div>
	</div> 
	<div class="clr"></div>
</div>