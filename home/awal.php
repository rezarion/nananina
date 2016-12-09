<?php
	include "koneksi.php";
?>

<div class='l-slider-wrap l-main-slider-wrap'>
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
			  </div><!-- slider-wrapper -->
			</div><!-- l-slider-text -->
		  </div><!-- slider-text-wrap -->

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
		  </div><!-- slider-wrapper -->
		</div><!-- l-slider-text -->
	  </div><!-- slider-text-wrap -->
	</li>
	</ul>
</div>
</section>
</div>
		
		<div class='l-content-wrap'>

          <div class='container'>

            <div class='row'>
			<section class="panel" style='margin:-20px 0 0 -50px; width:111%; background: #d9edf7 !important;'>
				<div class="panel-body"><b>Berita Terkini</b></div>
			</section>

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
								
							<p>
								$fa ....
							</p>

						  <a class='read-more' href='home.php?menu=detail_berita&id=$hasil[id_berita]'>Read More</a>

					
						</div><!-- col-lg-9 -->
						</div> <!-- row 1-user-profile-->

                <!-- separator -->

                <div class='l-separator'>
                    <div class='separator-border'>
                      <span class='icon-separator'></span>
                    </div><!-- separator-border -->
                </div><!-- l-separator -->";
			}else{
			$g = mysql_query("SELECT * FROM user WHERE id_user = '$hasil[id_user]'");
					$l = mysql_fetch_array($g);
				
					echo "	
             			
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
								<p>	$fa ... </p>
								<a class='read-more' href='home.php?menu=detail_berita&id=$hasil[id_berita]'>Read More</a>
							</div><!-- col-lg-9 -->
						</div> <!-- row 1-user-profile-->						  
				        <!-- separator -->

						<div class='l-separator'>
							<div class='separator-border'>
							  <span class='icon-separator'></span>
							</div><!-- separator-border -->
						</div><!-- l-separator -->";
				}
			}
			?>
			
	
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
			
				