<script type="text/javascript" src="js1/jquery.dataTables.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.testable').dataTable({
			"sPaginationType": "full_numbers",
			"bSort" : false,
			"iDisplayLength" : 2
		});
		
		$('.dataTables_length, .dataTables_filter, .dataTables_info').hide();
	})
</script>
		
<?php
	include "koneksi.php";
?>

  <div class="l-content-wrap">
    <div class="container">

        <div class="row">

          <div class="m-page-title">
            <h1>Gallery</h1>
          </div><!-- m-page-title -->

          
          <div class="l-projects-categories col-lg-12">
            <div class="row">
              <ul>
                <li class="background-theme-color background-text-color" data-filter="*">All</li>
                <li data-filter=".design">Design</li>
                <li data-filter=".architecture">Architecture</li>
                <li data-filter=".development">Development</li>                  
              </ul>
            </div><!-- row -->
          </div><!-- l-projects-categories -->	  
		  
          <div class="l-project-posts">
           
              <div class="project-post project-post-3col architecture design">

                <div class="l-post-image background-theme-color ">
                  <img src="component/gambar/1.jpg" />

                  <div class="l-links">
                    <div class="links-wrap">
                      <div class="image-links">
                        <a href="#"><span class="icon-link"></span></a>
                        <a href="component/gambar/1.jpg" class="colorbox"><span class="icon-image"></span></a>
                      </div><!-- image-links -->
                    </div><!-- links-wrap -->
                  </div><!-- l-links -->

                </div><!-- l-post-image background-theme-color  -->

                <h4><a href="#">Praesent nisi leo</a></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </p>
              </div><!-- project-post -->

              <div class="project-post development architecture project-post-3col">
                <div class="l-post-image background-theme-color ">
                  <img src="component/gambar/2.jpg" />

                  <div class="l-links">
                    <div class="links-wrap">
                      <div class="image-links">
                        <a href="#"><span class="icon-link"></span></a>
                        <a href="component/gambar/2.jpg" class="colorbox"><span class="icon-image"></span></a>
                      </div><!-- image-links -->
                    </div><!-- links-wrap -->
                  </div><!-- l-links -->

                </div><!-- l-post-image background-theme-color  -->
                <h4><a href="#">Etiam vitae leo tempus</a></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </p>
              </div><!-- project-post -->

              <div class="project-post design project-post-3col">
                <div class="l-post-image background-theme-color ">
                  <img src="component/gambar/3.jpg" />

                  <div class="l-links">
                    <div class="links-wrap">
                      <div class="image-links">
                        <a href="#"><span class="icon-link"></span></a>
                        <a href="component/gambar/3.jpg" class="colorbox"><span class="icon-image"></span></a>
                      </div><!-- image-links -->
                    </div><!-- links-wrap -->
                  </div><!-- l-links -->

                </div><!-- l-post-image background-theme-color  -->
                <h4><a href="#">Aenean lectus velit</a></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </p>
              </div><!-- project-post -->

              <div class="project-post design project-post-3col">
                <div class="l-post-image background-theme-color ">
                  <img src="component/gambar/5.jpg" />

                  <div class="l-links">
                    <div class="links-wrap">
                      <div class="image-links">
                        <a href="#"><span class="icon-link"></span></a>
                        <a href="component/gambar/5.jpg" class="colorbox"><span class="icon-image"></span></a>
                      </div><!-- image-links -->
                    </div><!-- links-wrap -->
                  </div><!-- l-links -->

                </div><!-- l-post-image background-theme-color  -->
                <h4><a href="#">Curabitur ullamcorper</a></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </p>
              </div><!-- project-post -->

              <div class="project-post architecture development project-post-3col">
                <div class="l-post-image background-theme-color ">
                  <img src="component/gambar/6.jpg" />

                  <div class="l-links">
                    <div class="links-wrap">
                      <div class="image-links">
                        <a href="#"><span class="icon-link"></span></a>
                        <a href="component/gambar/6.jpg" class="colorbox"><span class="icon-image"></span></a>
                      </div><!-- image-links -->
                    </div><!-- links-wrap -->
                  </div><!-- l-links -->

                </div><!-- l-post-image background-theme-color  -->
                <h4><a href="#">Praesent est risus</a></h4>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                  </p>
              </div><!-- project-post -->


       
          </div><!-- l-project-posts -->
         
        </div><!-- row -->

    </div><!-- container -->
  </div><!-- l-content-wrap -->