<style>
	.span {
		background: none repeat scroll 0 0 #56a8e4;
		border-color: #999999 #4496D2 #EBEBEB;
		border-style: dotted solid solid;
		border-width: 0 1px 5px;
		color: #FFFFFF;
		height: 33px;
		padding:3px;
		margin-left:10px;
	}
	
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
</style>

<link rel="stylesheet" type="text/css" href="css1/stapel.css" />
<link rel="stylesheet" type="text/css" href="css1/custom.css" />
<script src="js1/modernizr.custom.63321.js"></script>
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />


<div class="l-content-wrap">
<div class="services" style='font-family:Trebuchet MS; margin:45px 45px 45px -10px; width:80% !important'>
	<div class="span">Galeri</div>
	<div class="container">	
		<section class="main">
			<div class="wrapper">
				<div class="topbar">
					<span id="close" class="back">&larr;</span>
				</div> 
				
				<ul id="tp-grid" class="tp-grid" >
					<?php
						require 'koneksi.php';
						$sql1 = mysql_query("SELECT * FROM gallery WHERE id_kategori = 1");
						$i=1;
						while($hasil = mysql_fetch_array($sql1)){
							$i++;
							echo"<li data-pile='Dokumen'>";
							//echo "<span class='tp-info'><span>Akademik</span></span>";
							echo "<a class='fancybox' href='component/gambar/$hasil[gambar]' data-fancybox-group='gallery' title='$hasil[gambar]'><img src='component/gambar/doc.png'></a>";
							//echo"<br />";
							//echo"<p style='opaque: 0.5;'>$hasil[gambar]</p>";
							echo "</li>";
						}
						
						$sql2 = mysql_query("SELECT * FROM gallery WHERE id_kategori = 2");
						$i=1;
						while($hasil2 = mysql_fetch_array($sql2)){
							$i++;
							echo"<li data-pile='Gambar'>";
							//echo "<span class='tp-info'><span>Kemahasiswaan</span></span>";
							echo "<a class='fancybox' href='component/gambar/$hasil2[gambar]' data-fancybox-group='gallery' title='$hasil2[gambar]'>
							<img src='component/gambar/$hasil2[gambar]'></a>";
							echo "</li>";
						}
						
						$sql3 = mysql_query("SELECT * FROM berita");
						$i=1;
						while($hasil3 = mysql_fetch_array($sql3)){
							$i++;
							echo"<li data-pile='Lain-lain'>";
							//echo "<span class='tp-info'><span>Umper</span></span>";
							echo "<a class='fancybox' href='component/gambar/$hasil3[gambar]' data-fancybox-group='gallery' title='$hasil3[gambar]'><img src='component/gambar/$hasil3[gambar]'></a>";
							echo "</li>";
						}
						
						$sql4 = mysql_query("SELECT * FROM gallery WHERE id_kategori = 4");
						$i=1;
						while($hasil4 = mysql_fetch_array($sql4)){
							$i++;
							echo"<li data-pile='kategori4'>";
							//echo "<span class='tp-info'><span>Info Wisuda</span></span>";
							echo "<a class='fancybox' href='component/gambar/$hasil4[gambar]' data-fancybox-group='gallery' title='kategori4'><img src='component/gambar/$hasil4[gambar]'></a>";
							echo "</li>";
						}
						
						$sql5 = mysql_query("SELECT * FROM gallery WHERE id_kategori = 5");
						$i=1;
						while($hasil5 = mysql_fetch_array($sql5)){
							$i++;
							echo"<li data-pile='kategori5'>";
							//echo "<span class='tp-info'><span>Event</span></span>";
							echo "<a class='fancybox' href='img/gambar/$hasil5[link]' data-fancybox-group='gallery' title='kategori5'><img src='img/gambar/$hasil5[link]'></a>";
							echo "</li>";
						}
					?>
				</ul>
			</div>
		</section>

	</div><!-- /container -->
	</div>
	</div>
	<style>
		.fancybox-wrap{
			z-index:9999999 !important;
		}
		
		.fancybox-overlay{
			z-index:99999 !important;
		}
	</style>
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="js1/jquery.stapel.js"></script>
	<script type="text/javascript">	
		$(function() {
			var $grid = $( '#tp-grid' ),
				$name = $( '#name' ),
				$close = $( '#close' ),
				$loader = $( '<div class="loader"><i></i><i></i><i></i><i></i><i></i><i></i><span>Loading...</span></div>' ).insertBefore( $grid ),
				stapel = $grid.stapel( {
					randomAngle : true,
					delay : 50,
					gutter : 70,
					pileAngles : 5,
					onLoad : function() {
						$loader.remove();
					},
					onBeforeOpen : function( pileName ) {
						$name.html( pileName );
					},
					onAfterOpen : function( pileName ) {
						$(document).ready(function() {
							$('.fancybox').fancybox();
						});
						$close.show();
					}
				} );

			$close.on('click', function() {
				$close.hide();
				$name.empty();
				stapel.closePile();
			});

		} );
	</script>