<div class="col-lg-12">
		<div class="panel-card ads-card">
			<div  class="panel-header"> Any additional script to be add in the header 
				<p>(If you want to add any additional script to the header of the pages place it here)</p>
			 </div>
			<div style="padding: 15px;" class="form-body">
			<form action="<?php echo base_url() ?>ads/header_script" enctype="multipart/form-data" method="post">
				<div class="form-group  row">
						
						<div class="col-sm-12 nins">
							<textarea class="form-control form-control-sm" name="txt" id="" cols="30" rows="8"><?php echo $txt; ?></textarea>
						</div>
					</div>

					






				<div class="form-group no-margin-bottom row">
						<div class="col-sm-4">
							<button  class="btn btn-primary btn-sm">Update Script</button>
						</div>
						<div class="col-sm-8">
								
						</div>
				</div>

				</form>
			</div>
			
		</div>
	</div>