<!--  ************************* Page Title Starts Here ************************** -->
<div class="page-title row no-margin">
	<h4>App Settings</h4>
	<ul>
		<li><a>Home <i class="fas fa-angle-double-right"></i></a></li>
		<li><a>Settings <i class="fas fa-angle-double-right"></i></a></li>
		<li>App Settings</li>
	</ul>
</div> <!-- Page Title End -->


<!--  ************************* Password Settings Starts Here ************************** -->
<div id="app-setting" class="row body-content">

	<div class="col-lg-8 float-auto">
		<div class="panel-card">
			<div class="panel-header">App Settings</div>
			<div class="form-body">
				<p class="err bgghn-err" id="err">Old Password not Match Please try again</p>


				<div class="form-group  row">
					<div class="col-sm-10">
						<label for="">Email Activation mandatory for Login</label>
						<span class="form-indicat">:</span>
					</div>
					<div class="col-sm-2 toggle-switch">
						<label class="switch">
						  <input <?php if($setting->activation == 1){ echo'checked=""'; } ?> id="aemail"  type="checkbox">
						  <span class="slider round"></span>
						</label>
						
					</div>
				</div>

				<div class="form-group  row">
					<div class="col-sm-10">
						<label for="">Enable Email notification for Post Reply</label>
						<span class="form-indicat">:</span>
					</div>
					<div class="col-sm-2 toggle-switch">
						<label class="switch">
						  <input <?php if($setting->replay == 1){ echo'checked=""'; } ?>  id="remail"  type="checkbox">
						  <span class="slider round"></span>
						</label>
						
					</div>
				</div>

				<div class="form-group  row">
					<div class="col-sm-10">
						<label for="">Enable Email notification for Reply like</label>
						<span class="form-indicat">:</span>
					</div>
					<div class="col-sm-2 toggle-switch">
						
						 <label class="switch">
						  <input <?php if($setting->like == 1){ echo'checked=""'; } ?>  id="lemail" type="checkbox">
						  <span class="slider round"></span>
						</label>
					</div>
				</div>

				<div class="form-group  row">
					<div class="col-sm-5">
						<label for="">Total number of posts per page</label>
						
					</div>
					<div class="col-sm-5 range-boot">
						<div class="slidecontainer">
						 	 <input type="range" min="6" max="30" value="<?php echo $setting->pp; ?>" class="slider" id="myRange">

						</div>
						
					</div>
					<div class="col-sm-2 pt-1 center">
						<span id="rangval"></span>
					</div>
				</div>
				

				<div class="form-group  row">
					<div class="col-sm-10">
						<label for="">Use SMTP server to send email</label>
						<span class="form-indicat">:</span>
						<p class="small">If your server Email not Works Please use SMTP Email</p>
					</div>
					<div class="col-sm-2 toggle-switch">
						
						 <label class="switch">
						  <input <?php if($setting->smtp == 1){ echo'checked=""'; } ?>  id="smtp" type="checkbox">
						  <span class="slider round"></span>
						</label>
					</div>
				</div>

				<div class="smtp_setting <?php if($setting->smtp == 0){ echo 'hid'; } ?> ?>" id="smtp_setting">
					<div class="form-group  row">
						<div class="col-md-4">
							<label for="">Host Name</label>
							<span class="form-indicat">:</span>
						</div>
						<div class="col-md-6">
							<input id="host" value="<?php echo $setting->host; ?>" placeholder="Enter Host Name" type="text" class="form-control form-control-sm">
						</div>
					</div>

					<div class="form-group  row">
						<div class="col-md-4">
							<label for="">Port Number</label>
							<span class="form-indicat">:</span>
						</div>
						<div class="col-md-6">
							<input id="port" value="<?php echo $setting->port; ?>" placeholder="Enter Host Name" type="text" class="form-control form-control-sm">
						</div>
					</div>

					<div class="form-group  row">
						<div class="col-md-4">
							<label for="">User Name</label>
							<span class="form-indicat">:</span>
						</div>
						<div class="col-md-6">
							<input id="user" value="<?php echo $setting->user; ?>" placeholder="Enter Host Name" type="text" class="form-control form-control-sm">
						</div>
					</div>

					<div class="form-group  row">
						<div class="col-md-4">
							<label for="">Password</label>
							<span class="form-indicat">:</span>
						</div>
						<div class="col-md-6">
							<input id="pswd" value="<?php echo $setting->pswd; ?>" placeholder="Enter Host Name" type="password" class="form-control form-control-sm">
						</div>
					</div>
					<div class="form-group  row">
						<div class="col-md-4">
						
						</div>
						<div class="col-md-6">
							<button v-on:click="update_smtp_settings()" class="btn btn-primary btn-sm">Save SMTP Settings</button>
						</div>
					</div>
				</div>


				
				
				
			</div>
		</div>
	</div>

</div><!-- Password Settings  End -->
