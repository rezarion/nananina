<?php
	session_start();	
?>	

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Perencaan Penempatan Toko Modern di Semarang</title>
		
        <script src="js1/jquery-latest.min.js"></script>
        <link href='css1/fonts.css' rel='stylesheet' type='text/css'>
     
        <link href="css1/style.css" rel="stylesheet" type="text/css" />         
        <link href="inc/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="inc/bootstrap/css/bootstrap-reset.css" rel="stylesheet" type="text/css" />       
        <link href="css1/font.css" rel="stylesheet" type="text/css" />              
       <link href="inc/flexslider/flexslider.css" rel="stylesheet" type="text/css" /> 
        <link href="inc/colorbox/example1/colorbox.css" rel="stylesheet" type="text/css" />
        <link href="inc/fontawesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="css1/responsive.css" rel="stylesheet" type="text/css" />
        <link href="css1/colors-blue.css" rel="stylesheet" type="text/css" />

        <script src="inc/bootstrap/js/bootstrap.js" /></script>
        <script src="inc/flexslider/jquery.flexslider.js" /></script>
        <script src="inc/isotope/jquery.isotope.min.js" /></script>
        <script src="js1/front.js" /></script>
        <script src="inc/lazyload/jquery.lazyload.min.js" /></script>
        <script src="inc/colorbox/jquery.colorbox-min.js"></script>
		<!-- -->
		<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/responsive-tables.js"></script>
		
		<!--<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/jquery.nivo.slider.js"></script> -->
    </head>
    
<body>

<div class="page-loader"></div>


<div id="page" class="hfeed site">


<div class="l-sidebar-left">

<a href="#" class="sidebar-open fa fa-plus"></a>

  <div class="l-header-wrap">
    <header id="masthead" class="m-site-header" role="banner">
      
     <!-- <div class="m-site-info">
        <h1 class="t-site-title"><a href="index.html" title="Home Page" rel="home"></a></h1>
        <h2 class="t-site-description">Perencaan Penempatan Toko Modern di Semarang</h2>
      </div> site-info  -->
<br><br><br><br><br><br><br><br>	 
	 
      <div class="m-current-user-actions" style='font-color:black; width:90%; margin-left:10px;!important' >
		<ul class="user-actions">
          <li><a href="home.php?menu=bkkbn">Profil</a></li>
		  <li><a href="home.php?menu=organisasi">Struktur Organisasi</a></li>
		  <li><a href="home.php?menu=pimpinan">Pimpinan</a></li>
		  <li><a href="home.php?menu=contac">Contact Us</a></li>
        </ul>
      </div><!-- current-user-actions -->

      <div class="clearfix"></div>
	      <!-- search widget -->
		<aside class="l-sidebar-widget sidebar-widget">
		  <form role="search" method="post" class="sidebar-search-form" action="home.php?menu=search">
			<label>         
			  <input name="keywords" type="search" class="sidebar-search-field " placeholder="" value="" name="s" title="Search for:">
			  <div class="sidebar-search-button">
				<input name="cari" type="submit" class="search-submit" value="" title="Cari Berita"><span class="icon-search left-sidebar-icon"></span>
			  </div><!-- sidebar-search-button -->
			</label>
		  </form>
		</aside>

    </header><!-- #masthead -->
  </div><!-- header-wrap -->

	  <div class="l-user-info">



  </div><!-- l-user-info -->

</div><!-- l-sidebar-left -->


<div class="l-sidebar-left-color  background-theme-color"></div>
<div class="l-cont-side-wrap">

    
<div class="l-navigation-wrap background-theme-color">



    <div class="navbar navbar-inverse">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">
          <li><a href="home.php">Home</a></li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown">Data Kependudukan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="home.php?menu=cari_pend">Kepadatan Penduduk</a></li>
                <li><a href="home.php?menu=cari_pend_umur">Penduduk Berdasarkan Range Umur</a></li>
                <li><a href="home.php?menu=cari_tfr">TFR</a></li>
                <li><a href="home.php?menu=cari_imr">IMR</a></li>
                <li><a href="home.php?menu=cari_kb1">Pelayanan Kontrasepsi</a></li>
                <li><a href="home.php?menu=cari_kb2">Metode Kontrasepsi</a></li>
              </ul>
          </li>          

          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Peta <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="home.php?menu=peta">Peta Provinsi Jawa Tengah</a></li>
                <li><a href="home.php?menu=peta1">Trend Peta</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a data-toggle="dropdown" href="#">Grafik <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="home.php?menu=grafik_kepadatan_pend">Kepadatan Penduduk</a></li>
                <li><a href="home.php?menu=grafik_pend_umur">Penduduk Berdasarkan Range Umur</a></li>
                <li><a href="home.php?menu=grafik_tfr">TFR</a></li>
                <li><a href="home.php?menu=grafik_imr">IMR</a></li>
                <li><a href="home.php?menu=grafik_prevKB">Kontrasepsi KB</a></li>
                <li><a href="home.php?menu=grafik_jenisKB">Metode Kontrasepsi</a></li>
            </ul>
          </li>
		 <li><a href="home.php?menu=galeri">Gallery</a></li>
        </ul>

        <div class="m-search-field">
			<a href="login.php" style="float:right !important; font-size:14px;color:#fff!important; margin-top:10px;">Log in</a>
			<a href="login.php"> <img src="images/login.png" style='width:30px; height:25px !important; margin-top:10px; !important '></a>
			<?php
				if (ISSET($_SESSION['username']) AND ISSET($_SESSION['password'])){
					echo '<a href="home.php" style="float:right !important; font-size:14px;color:#fff!important; margin: 0px -650px 0 0; !important ">Back to Admin Page</a>';
				}
			?>
        </div>

      </div><!-- /.nav-collapse -->
    </div><!-- /.navbar -->

</div><!-- l-menu-wrap -->

<div class="l-page-wrapper" >
		<?php
			if(ISSET($_GET['menu'])){
				include "home/koneksi.php";
			
				$d = $_GET['menu'];
				if($d == 'home'){
					include "home.php";
				}else if($d == 'search'){
					include "home/search.php";
				}else if($d == 'cari_pend'){
					include "home/cari_pend.php";
				}else if($d == 'cari_pend_umur'){
					include "home/cari_pend_umur.php";
				}else if($d == 'cari_tfr'){
					include "home/cari_tfr.php";
				}else if($d == 'cari_imr'){
					include "home/cari_imr.php";
				}else if($d == 'cari_kb1'){
					include "home/cari_kb1.php";
				}else if($d == 'cari_kb2'){
					include "home/cari_kb2.php";
				}else if($d == 'search'){
					include "home/search.php";
				}else if($d == 'detail_berita'){
					include "home/detail_berita2.php";
				}else if($d == 'grafik_kepadatan_pend'){
					include "home/grafik_kepadatan_pend.php";
				}else if($d == 'grafik_imr'){
					include "home/grafik_imr.php";
				}else if($d == 'grafik_tfr'){
					include "home/grafik_tfr.php";
				}else if($d == 'grafik_prevKB'){
					include "home/grafik_prevKB.php";
				}else if($d == 'grafik_jenisKB'){
					include "home/grafik_jenisKB.php";
				}else if($d == 'grafik_pend_umur'){
					include "home/grafik_pend_umur.php";
				}else if($d == 'pimpinan'){
					include "home/profil1.php";
				}else if($d == 'pimpinan'){
					include "home/profil1.php";
				}else if($d == 'detail_peg'){
					include "home/detail_peg.php";
				}else if($d == 'contac'){
					include "home/contac.php";
				}else if($d == 'bkkbn'){
					include "home/bkkbn.php";
				}else if($d == 'galeri'){
					include "home/galeri.php";
				}else if($d == 'organisasi'){
					include "home/organisasi.php";
				}else if($d == 'peta'){
					//echo '<div style="position:relative;width:100%;height:600px;overflow:hiddeh;">';
					include "home/peta.php";
					//echo "</div>";
				}else if($d == 'peta1'){
					//echo '<div style="position:relative;width:100%;height:600px;overflow:hiddeh;">';
				//	echo "<br /> <br /> <br /> <br /> <br />";
					include "home/peta1a.php";
					//echo "</div>";
				}else{
				// echo "Perencaan Penempatan Toko Modern di Semarang";
				include "home/awal1.php";	
				}
			}else{
			// echo "Perencaan Penempatan Toko Modern di Semarang";
			include "home/awal1.php";
			}
			?>

	</div><!-- l-con-side-wrap -->
</div>
	
	<script type="text/javascript">

	jQuery(window).load(function() {

	  jQuery('.flexslider').flexslider({
		animation: "fade",
		slideshow: false,
		smoothHeight: false,
		controlNav: false,
		prevText: "",
		nextText: "",
		directionNav: true,
		start: function(slider) {
		  slider.removeClass('loading');
		}
	  });

	  jQuery('.flexslider-carousel').flexslider({
		animation: "slide",
		slideshow: true,
		smoothHeight: true,
		directionNav: true,
		controlNav: false,
		prevText: '',
		nextText: '',
		itemWidth: 280,
		itemMargin: 26,
		minItems: 3,
		maxItems: 5,
		move: 3
	  });

	  
	});
	</script>
	<script src="highcharts/js/highcharts.js"></script>
	<script src="highcharts/js/modules/exporting.js"></script>
	

	</body>
</html>
