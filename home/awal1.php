<script type="text/javascript" src="js1/easySlider1.5.js"></script>
<!-- <script type="text/javascript">
	
	$(document).ready(function(){
		$('.testable').dataTable({
			"sPaginationType": "full_numbers",
			"bSort" : false,
			"iDisplayLength" : 2
		});
		
		$('.dataTables_length, .dataTables_filter, .dataTables_info').hide();
	})
</script> -->
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
					"iDisplayLength" : 2
				});
				
				$('.dataTables_length, .dataTables_filter, .dataTables_info').hide();
			})
		</script>
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

<!-- <div class='l-slider-wrap l-main-slider-wrap'>
  <section class='slider'>
	<div class='flexslider loading'>
	  <ul class='slides'>
		<li>
		  <img class='lazy' src='images/logo-bkkbn-_140211093414-423.jpg'/>

		  <div class='slider-text-wrap'>
			<div class='l-slider-text' >
			  <div class='slider-wrapper'>
				<h1>BKKBN Perwakilan Provinsi jawa Tengah</h1>
				<p>
				  Voluptate delectus minim nostrud dreamcatcher meggings. Deep v 90's enim assumenda adipisicing drinking vinegar. 
				  Deep v magna cupidatat biodiesel
				</p>                    
			  </div><!-- slider-wrapper 
			</div><!-- l-slider-text
		  </div><!-- slider-text-wrap 

		</li>
		<li>
	  <img class='lazy' src='images/start.jpg'/>

	  <div class='slider-text-wrap'>
		<div class='l-slider-text'>
		  <div class='slider-wrapper'>
			<h1>Ut enim ad minim veniam</h1>
			<p>
			  Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
			</p>   
		  </div><!-- slider-wrapper 
		</div><!-- l-slider-text 
	  </div><!-- slider-text-wrap
	</li>
	</ul>
</div>
</section>
</div>
 -->		
		<div class='l-content-wrap'>

          <div class='container'>

            <div class='row'>
			<section class="span" style='margin:-20px 0 0 -50px; width:110.5%; height:30px; background: #56a8e4 !important;'>
			<b>Berita Terkini</b>
			</section>
				
				<table class='testable table' id='examples'>
				<thead>
					<tr>
						<th></th>
					</tr>
				</thead>
				<tbody>
				
              <!-- posts-list -->
			<?php 
				//melakukan SELECT query dengan perintah ORDER BY, LIMIT, hasil disimpan di $sql2
				$sql2 = mysql_query("SELECT * FROM berita WHERE status = '1'");
				
				while ($hasil = mysql_fetch_array($sql2)){
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
						<div class='m-page-title' style='margin-top:-30px !important'>
						  <h3> $hasil[judul] </h3>
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
					  <!-- standard post -->
						<div class='m-page-title' style='margin-top:-30px !important'>
						  <h2> $hasil[judul] </h2>
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
				}
				$i++;
			}
			?>
					</tbody>
				</table>
			</div>
			
	
			<!--<div class='l-pagination-wrap'>
                  <ul class='pagination pagination-lg'>
                    <li class='disabled'><a class='icon-arrow-left' href='#'></a></li>
                    <li class='active'><a href='#'>1</a></li>
                    <li><a href='#'>2</a></li>
                    <li><a href='#'>3</a></li>
                    <li><a href='#' class='icon-arrow-right'></a></li>
                  </ul>
			</div> l-pagination-wrap -->
		       
				</div><!--1 #page- wrapper-->
			</div>
			</div>
			</div>

		
		<div style="display:none;" class="nav_up" id="nav_up"></div>
		<div style="display:none;" class="nav_down" id="nav_down"></div>
        
<!--		<script src="scroll/jquery-1.3.2.js" type="text/javascript"></script>
		<script src="scroll/scroll-startstop.events.jquery.js" type="text/javascript"></script> -->
		<script>
			$(function() {
				var $elem = $('#content');
				
				$('#nav_up').fadeIn('slow');
				$('#nav_down').fadeIn('slow');  
				
				$(window).bind('scrollstart', function(){
					$('#nav_up,#nav_down').stop().animate({'opacity':'0.2'});
				});
				$(window).bind('scrollstop', function(){
					$('#nav_up,#nav_down').stop().animate({'opacity':'1'});
				});
				
				$('#nav_down').click(
					function (e) {
						$('html, body').animate({scrollTop: $elem.height()}, 800);
					}
				);
				$('#nav_up').click(
					function (e) {
						$('html, body').animate({scrollTop: '0px'}, 800);
					}
				);
            });
        </script>