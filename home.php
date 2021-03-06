<?php
	session_start();	
?>	

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Sistem Perencanaan Penempatan Toko Modern di Semarang</title>
		<link rel="stylesheet" href="css/style.default.css" type="text/css" />
		<link rel="stylesheet" href="css/responsive-tables.css">

		<link rel="stylesheet" href="css/bootstrap-fileupload.min.css" type="text/css" />
		<link rel="stylesheet" href="css/bootstrap-timepicker.min.css" type="text/css" />
		
		<!-- JQUERY UNTUK PETA SVG -->
		<script type="text/javascript" src="component/highphp1/js/jquery.min.js" ></script>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script> <!--ganggu API kayaknya>>
		<!--<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>-->
		<!--<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>-->
		
		<!-- JQUERY UNTUK PETA GMAPS API LOKASI-->
		<!--<script type="text/javascript" src="js/jquery.js"></script>-->
		<!--<script type="text/javascript" src="js/markerclusterer_packed.js"></script>-->
		
		<!-- JQUERY UNTUK GRAFIK -->
		<script type="text/javascript" src="component/highphp1/js/highcharts.js" ></script>
		<script type="text/javascript" src="component/highphp1/js/exporting.js" ></script>
		<!--<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://code.highcharts.com/modules/offline-exporting.js"></script>-->
		
		<!-- JQUERY BAWAAN TEMPLATE -->
		<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/modernizr.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript" src="js/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" src="js/flot/jquery.flot.resize.min.js"></script>
		<script type="text/javascript" src="js/responsive-tables.js"></script>

	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
		<script language="javascript">
				function numbersonly(e, decimal) { 
					var key;
					var keychar;
					if (window.event) {
						key = window.event.keyCode;
					} else if (e) {
						key = e.which;
					} else return true;

					keychar = String.fromCharCode(key);
					if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
						return true;
					} else if ((("0123456789").indexOf(keychar) > -1)) {
						return true; 
					} else if (decimal && (keychar == ".")) {
						return true; 
					} else return false; 
				}
		</script>
		<!--<script>
            function about()
            {
                alert("Selamat Datang !");
            }
        </script>-->

	</head>
    
	<body>
		<?php 
			function setActive($d){
				if(ISSET($_GET['menu'])){
					if($_GET['menu'] == $d){
						echo "class='active'";
					}
				}
			}
			
			function setActive1(){
			echo "active";	
			}
			
		?>

	<div class="mainwrapper">

     <div class="header">
		<div class="logo">
			<!--<img src="images/disperindag.png" alt="" style=" width:258px; height:110px; !important" />-->
			<img src="images/disperindag.png" alt="" style=" width:200px; height:70px; margin-top:-20px; !important" />
		</div>
			<div class="headerinner">
                <ul class="headmenu">
					<li>
						<!--<img src="images/logo7.bmp" alt="" style=" width:910px; height:111px; !important"  />-->
						<img src="images/logo8.png" alt="" style=" width:900px; height:20px; margin-top:40px; !important"  />
					</li>
				<li class="right">
					<div class="userloggedinfo">
						<div class="userinfo">
							<ul> <br/>
								<!--<li>
									<a onclick="about()">Tentang Sistem <span class="iconfa-info-sign"></span></a>		
								</li>-->
								<li>
									<a data-toggle="modal" href="#myModal">Tentang Sistem <span class="iconfa-question-sign"></span></a>
								</li>
								<li>
									<a href="login.php">Log in <span class="iconfa-signin"></span></a>
								</li>
								<?php
									if (ISSET($_SESSION['username']) AND ISSET($_SESSION['password'])){
										echo '<a href="home.php" style="float:right !important; font-size:14px;color:#fff!important; margin: 0px -650px 0 0; !important ">Back to Admin Page</a>';
									}
								?>
							</ul>
						</div>
					</div>
				</li>
			<!--</li>-->
            </ul><!--headmenu-->
        </div>
    </div>

    <div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>

					<!--<li><a href=""><span class="iconfa-home"></span>Home</a>
					</li>-->
					
					<li <?php setActive('dashboard');?>><a href="index.php"><span class="iconfa-home"></span>Home</a>
						</li>
												
						<li class="dropdown  <?php if (($_GET['menu'] == 'petaSemarang') || ($_GET['menu'] == 'petaSemarangapi')){ setActive1(); }?>"><a href=""><span class="iconfa-globe"></span>Peta Kota Semarang</a>
							<ul>
								<li <?php setActive('petaSemarang');?>><a href="index.php?menu=petaSemarang">Peta Scalable Vector Graphics</a></li>
								<li <?php setActive('petaSemarangapi');?>><a href="index.php?menu=petaSemarangapi">Peta Google Maps API</a></li>
							</ul>
						</li>
						
						<li class="dropdown  <?php if (($_GET['menu'] == 'formToko') || ($_GET['menu'] == 'lihatToko')){ setActive1(); }?>"><a href=""><span class="iconfa-tags"></span>Lokasi Toko Modern</a>
							<ul>
								<li <?php setActive('petaToko');?>><a href="index.php?menu=petaToko">Peta Lokasi Toko Modern</a></li>
								<li <?php setActive('lihatToko');?>><a href="index.php?menu=lihatToko">Lihat Lokasi Toko Modern</a></li>
							</ul>
						</li>
						
						<li class="dropdown  <?php if (($_GET['menu'] == 'formPasar') || ($_GET['menu'] == 'lihatPasar')){ setActive1(); }?>"><a href=""><span class="iconfa-shopping-cart"></span>Lokasi Pasar Tradisional</a>
							<ul>
								<li <?php setActive('petaPasar');?>><a href="index.php?menu=petaPasar">Peta Lokasi Pasar Tradisional</a></li>
								<li <?php setActive('formPasar');?>><a href="main.php?menu=formLPasar">Tambah Lokasi Pasar Tradisional</a></li>
								<li <?php setActive('lihatPasar');?>><a href="main.php?menu=lihatPasar">Lihat Lokasi Pasar Tradisional</a></li>								
							</ul>
						</li>
						
						<li <?php setActive('penentuanToko');?>><a href="index.php?menu=penentuanToko"><span class="iconfa-map-marker"></span>Penempatan Toko Modern</a>
						</li>
						
						<!--<li class="dropdown  <?php// if (($_GET['menu'] == 'formGaleri') || ($_GET['menu'] == 'lihatGaleri')){ setActive1(); }?>"><a href=""><span class="iconfa-picture"></span>Gallery</a>
							<ul>
								<li <?php// setActive('formGaleri');?>><a href="main.php?menu=formGaleri">Tambah Gallery</a></li>
								<li <?php// setActive('lihatGaleri');?>><a href="main.php?menu=lihatGaleri">Lihat Gallery</a></li>
							</ul>
						</li>-->
						
						<li <?php setActive('lihatInfoumum');?>><a href="index.php?menu=lihatInfoumum"><span class="iconfa-info-sign"></span>Informasi</a>
						</li>

						
			</ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    
    <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="main.php"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li>Dashboard</li>
			<li class="right">
                    <a href="" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-tint"></i> Color Skins</a>
                    <ul class="dropdown-menu pull-right skin-color">
                        <li><a href="default">Default</a></li>
                        <li><a href="navyblue">Navy Blue</a></li>
                        <li><a href="palegreen">Pale Green</a></li>
                        <li><a href="red">Red</a></li>
                        <li><a href="green">Green</a></li>
                        <li><a href="brown">Brown</a></li>
                    </ul>
            </li> 
        </ul>
		     
        <div class="maincontent">
            <div class="maincontentinner" style='position:relative;'>
			
			<?php
			if(ISSET($_GET['menu'])){
				include "component/koneksi.php";
				$d = $_GET['menu'];
				if($d == 'home'){
					include "component/home.php";
				}else if($d == 'dashboard'){
					include "main.php";
				}else if($d == 'editProfile'){
					include "component/editprofile.php";
				}else if($d == 'resetPass'){
					include "component/resetpass.php";
				}else if($d == 'formInputUser'){
					include "component/form_user.php";
				}else if($d == 'lihatUser'){
					include "component/lihat_user.php";
				}else if($d == 'reset'){
					include "component/resetpass.php";
				}else if($d == 'hapusUser'){
					include "component/hapus_user.php";
					//menu Lihat Log
				}else if($d == 'lihatLog'){
					include "component/lihat_log.php";
					//menu Titik Rekomendasi
				}else if($d == 'formTitik'){
					include "component/form_titik.php";
				}else if($d == 'lihatTitik'){
					include "component/lihat_titik.php";
				}else if($d == 'editTitik'){
					include "component/form_edit_titik.php";
				}else if($d == 'hapusTitik'){
					include "component/hapus_titik.php";
					//menu Kepadatan Penduduk
				}else if($d == 'formKepadatan'){
					include "component/form_kepadatan.php";
				}else if($d == 'lihatKepadatan'){
					include "component/lihat_kepadatan.php";
				}else if($d == 'editKepadatan'){
					include "component/form_edit_kepadatan.php";
				}else if($d == 'hapusKepadatan'){
					include "component/hapus_kepadatan.php";
					//menu Perkembangan Pemukiman Baru
				}else if($d == 'formPerkembangan'){
					include "component/form_perkembangan.php";
				}else if($d == 'lihatPerkembangan'){
					include "component/lihat_perkembangan.php";
				}else if($d == 'editPerkembangan'){
					include "component/form_edit_perkembangan.php";
				}else if($d == 'hapusPerkembangan'){
					include "component/hapus_perkembangan.php";
					//menu Potensi Ekonomi
				}else if($d == 'formPotensi'){
					include "component/form_potensi.php";
				}else if($d == 'lihatPotensi'){
					include "component/lihat_potensi.php";
				}else if($d == 'editPotensi'){
					include "component/form_edit_potensi.php";
				}else if($d == 'hapusPotensi'){
					include "component/hapus_potensi.php";
					//menu Arus Lalu Lintas
				}else if($d == 'formArus'){
					include "component/form_arus.php";
				}else if($d == 'lihatArus'){
					include "component/lihat_arus.php";
				}else if($d == 'editArus'){
					include "component/form_edit_arus.php";
				}else if($d == 'hapusArus'){
					include "component/hapus_arus.php";
					//menu Info
				}else if($d == 'formInfo'){
					include "component/form_info.php";
				}else if($d == 'lihatInfoumum'){
					include "component/lihat_info_umum.php";
				}else if($d == 'editInfo'){
					include "component/form_edit_info.php";
				}else if($d == 'hapusInfo'){
					include "component/hapus_info.php";
					//menu Lokasi Toko Modern
				}else if($d == 'petaToko'){
					include "component/peta_toko.php";
				}else if($d == 'formToko'){
					include "component/form_toko.php";
				}else if($d == 'lihatToko'){
					include "component/lihat_toko.php";
				}else if($d == 'editToko'){
					include "component/form_edit_toko.php";
				}else if($d == 'hapusToko'){
					include "component/hapus_toko.php";
					//menu Lokasi Pasar Tradisional
				}else if($d == 'petaPasar'){
					include "component/peta_pasar.php";
				}else if($d == 'formPasar'){
					include "component/form_pasar.php";
				}else if($d == 'lihatPasar'){
					include "component/lihat_pasar.php";
				}else if($d == 'editPasar'){
					include "component/form_edit_pasar.php";
				}else if($d == 'hapusPasar'){
					include "component/hapus_pasar.php";
					//menu Galeri
				}else if($d == 'formGaleri'){
					include "component/form_galeri.php";
				}else if($d == 'lihatGaleri'){
					include "component/lihat_galeri.php";
				}else if($d == 'editGaleri'){
					include "component/form_edit_galeri.php";
				}else if($d == 'hapusGaleri'){
					include "component/hapus_galeri.php";
					//menu Pegawai
				}else if($d == 'formPegawai'){
					include "component/form_pegawai.php";
				}else if($d == 'lihatPegawai'){
					include "component/lihat_pegawai.php";
				}else if($d == 'editPegawai'){
					include "component/form_edit_pegawai.php";
				}else if($d == 'hapusPegawai'){
					include "component/hapus_pegawai.php";
					//menu Grafik Toko
				}else if($d == 'grafikToko'){
					include "component/grafik_toko.php";
					//menu Penentuan Toko
				}else if($d == 'penentuanToko'){
					include "component/penentuan_toko.php";
					//menu Peta
				}else if($d == 'petaSemarangapi'){
					include "component/peta_api.php";
				}else if($d == 'petaSemarang'){
					//echo '<div style="position:relative;width:100%;height:600px;overflow:hiddeh;">';
					include "component/peta.php";
					//echo "</div>";
				}//else if($d == 'cobapeta1'){
					//echo '<div style="position:relative;width:100%;height:600px;overflow:hidden;">';
					//include "component/peta1a.php";
				//	echo "</div>";
				//}
				else{
				//include "component/calendar.php";
				echo"<h4 class='widgettitle'>Home</h4><div class='widgetcontent'> <img src='img/home7.jpg'/></div>";
				 /*echo " <font size='3'> Keberadaan toko modern di Semarang saat ini dinilai sudah terlalu padat dan membanjiri sejumlah kawasan setempat, 
						yang antara lain berdasarkan pada kepadatan penduduk, perkembangan pemukiman baru, potensi ekonomi daerah setempat, dan jarak dengan toko lain.<br/><br/>
						Banyaknya aspek yang harus dianalisis tersebut maka akan digunakan Metode <i> Fuzzy Simple Addictive Weighting </i> 
						dalam pertimbangan awal lokasi pendirian toko modern baru.<br/><br/>
						Sistem Perencanaan Penempatan Toko Modern untuk wilayah Semarang ini diharapkan mampu memberikan informasi yang bermanfaat bagi pemerintah dan masyarakat. </font>
					  ";*/
				}
			}else{
			//include "component/calendar.php";
				echo"<h4 class='widgettitle'>Home</h4><div class='widgetcontent'> <img src='img/home7.jpg'/></div>";
			 /*echo "<p>  <font size='3'> Keberadaan toko modern di Semarang saat ini dinilai sudah terlalu padat dan membanjiri sejumlah kawasan setempat, 
						yang antara lain berdasarkan pada kepadatan penduduk, perkembangan pemukiman baru, potensi ekonomi daerah setempat, dan jarak dengan toko lain.<br/><br/>
						Banyaknya aspek yang harus dianalisis tersebut maka akan digunakan Metode <i> Fuzzy Simple Addictive Weighting </i> 
						dalam pertimbangan awal lokasi pendirian toko modern baru.<br/><br/>
						Sistem Perencanaan Penempatan Toko Modern untuk wilayah Semarang ini diharapkan mampu memberikan informasi yang bermanfaat bagi pemerintah dan masyarakat. </font>
				  </p>";*/
			
			};?>
				
				<!--<img src="img/sementara.jpg" width="75%" heigth="75%" />-->
				
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2015. Shamcey Admin Template. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Designed by: <a href="http://themepixels.com/">ThemePixels</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
	</div><!--mainwrapper-->
	
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade in" id="myModal">
    <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
        <h3 id="myModalLabel">Tentang Sistem</h3>
    </div>
    <div class="modal-body">
        <h4>Judul: </h4>
		<table class="table table-striped">
			<tr>
				<td></td>
				<td></td>
				<td>Sistem Informasi Geografis untuk <br> Perencanaan Penempatan Toko Modern <br> di Kota Semarang <br> dengan Menggunakan Metode <br> Fuzzy Multi-Attribute Decision Making (FMADM) <br> Simple Additive Weighting (SAW) </td>
			</tr>
		</table>
		<h4>Pengembang: </h4>
		<table class="table table-striped">
			<tr>
				<td></td>
				<td></td>
				<td>Reza Ardiansyah (24010311130046)</td>
			</tr>
		</table>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn">Close</button>
    </div>
</div><!--#myModal-->
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			//datepicker
			jQuery('#datepicker').datepicker();
			
			// tabbed widget
			jQuery('.tabbedwidget').tabs();
		});
	</script>	
	
	</body>
	<!-- UMUM -->
		<script type="text/javascript" src="js/bootstrap-fileupload.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/jquery.tagsinput.min.js"></script>
		<script type="text/javascript" src="js/jquery.autogrow-textarea.js"></script>
		<script type="text/javascript" src="js/tinymce/jquery.tinymce.js"></script>
		<script type="text/javascript" src="js/wysiwyg.js"></script>
		<script type="text/javascript" src="js/charCount.js"></script>
		<script type="text/javascript" src="js/colorpicker.js"></script>
		<script type="text/javascript" src="js/ui.spinner.min.js"></script>
		<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.bxSlider.min.js"></script>
		<script type="text/javascript" src="js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/forms.js"></script>
		<script type="text/javascript" src="js/jquery.alerts.js"></script>
		<script type="text/javascript" src="js/jquery.jgrowl.js"></script> <!--dari elements, untuk menu info-->
		<script type="text/javascript" src="js/elements.js"></script>
		<script type="text/javascript" src="prettify/prettify.js"></script>
</html>