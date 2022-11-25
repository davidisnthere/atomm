<!--***************************** Body Starts Here *****************************-->
  <div class="body-content">
  	  <div class="container">
  	  	<div class="row">
  	  		<!-- ##########-- Right Menu Starts Here ##########-->
  	  		 <div class="col-md-3 no-padding profile-cover">

  	  			<?php $this->load->view('users/inc/user_menu'); ?>

  	  		</div><!------- Right Menu End Here ------->

			<!-- ##########-- Dashboard Starts Here ##########-->
  	  		<div id="user-replay-vue" class="col-md-9 fpd">





 	  			<div class="row no-margin mypost-cover">
 	  				<h6 class="cd-titl hid">My Latest Threads</h6>

          <?php $this->load->view('users/inc/single_replay'); ?>

 	  			</div>




  	  		</div><!------- Dashboard Ends Here ------->


  	  	</div>
  	  </div>
  </div><!------- Body Content Ends Here ------->
