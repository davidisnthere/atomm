<!--***************************** Body Starts Here *****************************-->
  <div class="body-content">
  	  <div class="container">
  	  	<div class="row">
			<!-- ##########-- Forum Post Starts Here ##########-->
  	  		<div class="col-lg-8 col-md-12">


            <?php $this->load->view('pages/inc/single_post'); ?>


  	  		<div class=" view-box d-flex justify-content-center">
  	  				<nav aria-label="...">
							<?php echo $this->pagination->create_links(); ?>
					</nav>
  	  			</div>

  	  		</div><!------- Forum Posts Here ------->

 	  		<!-- ##########-- Left Side Starts Here ##########-->
  	  		  <div class="col-lg-4 col-md-12">

              <?php $this->load->view('pages/inc/category'); ?>
			
			 <!------- Left Side Ad Slot - 1 ------->
			  <?php if($ads[1]->status == 'enable'): ?>
					<?php if($ads[1]->type == 'image'){ ?>
						<div class="ad-cover">
							<a target="_blank" href="<?php echo $ads[1]->link ?>">
							<img src="<?php echo base_url() ?>upload/ad/<?php echo $ads[1]->image;?>" alt="">
							</a>
						</div>
					<?php }else{ ?>
						<div class="ad-cover">
							<?php echo $ads[1]->script;?>
						</div>
					<?php } ?>
					
				<?php endif; ?>

              <?php $this->load->view('pages/inc/status'); ?>
				
				 <!------- Left Side Ad Slot - 2 ------->
				<?php if($ads[3]->status == 'enable'): ?>
					<?php if($ads[3]->type == 'image'){ ?>
						<div class="ad-cover">
							<a target="_blank" href="<?php echo $ads[3]->link ?>">
							<img src="<?php echo base_url() ?>upload/ad/<?php echo $ads[3]->image;?>" alt="">
							</a>
						</div>	
					<?php }else{ ?>
						<?php echo $ads[3]->script;?>
					<?php } ?>
				<?php endif; ?>


              <?php $this->load->view('pages/inc/top_post'); ?>

			 <!------- Left Side Ad Slot - 3 ------->			
			  <?php if($ads[5]->status == 'enable'): ?> 
					<?php if($ads[5]->type == 'image'){ ?>
						<div class="ad-cover">
							<a target="_blank" href="<?php echo $ads[5]->link ?>">
							<img src="<?php echo base_url() ?>upload/ad/<?php echo $ads[5]->image;?>" alt="">
							</a>
						</div>	
					<?php }else{ ?>
						<?php echo $ads[5]->script;?>	
					<?php } ?>
					
				<?php endif; ?>


  	  		</div><!------- Left Side End Here ------->
  	  	</div>
  	  </div>
  </div><!------- Body Content Ends Here ------->
