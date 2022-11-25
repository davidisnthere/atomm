<!--***************************** Body Starts Here *****************************-->
  <div class="body-content">
  	  <div class="container">
  	  	<div class="row">
			<!-- ##########-- Forum Post Starts Here ##########-->
  	  		<div  class="col-lg-8 col-md-12">



          <?php $this->load->view('pages/inc/single_post'); ?>

		 




				<div class=" view-box d-flex justify-content-center">
  	  				<nav aria-label="...">
							<?php echo $this->pagination->create_links(); ?>
					</nav>
  	  			</div>


  	  			<!-- <div class="singl-post-row view-box hid d-flex justify-content-center">
  	  			<a href="view_all_post.html">View All posts</a>
  	  			</div> -->


  	  		</div><!------- Forum Posts Here ------->

 	  		<!-- ##########-- Left Side Starts Here ##########-->
  	  		  <div  class="col-lg-4 col-md-12">

				  
				  
            <?php $this->load->view('pages/inc/category'); ?>
			
            <?php $this->load->view('pages/inc/status'); ?>

            <?php $this->load->view('pages/inc/top_post'); ?>




  	  		</div><!------- Left Side End Here ------->
  	  	</div>
  	  </div>
  </div><!------- Body Content Ends Here ------->
