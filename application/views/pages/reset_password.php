<!--***************************** Body Starts Here *****************************-->
<div class="body-content">


	<div class="container">

		<div id="vu-reset-pswd" class="row">
			<!-- ########## Add Post Starts Here ##########-->
			<div id="fps" class="col-lg-5 app-post-cont forget-pswd col-md-12">
				<div class="forg-title">
					<h6>Reset Password</h6>
				</div>

				<p id="errmsg">Something went wrong please try again </p>	

				<div class="row no-margin form-row">
					<div class="col-sm-5">
						<label for="">New Password</label><span class="rit-coln">:</span>
					</div>
					<div class="col-sm-7">
						<input id="resetpswd" type="password" placeholder="Enter Email Address" class="form-control form-control-sm">
						<div id="resetpswd-err" class="smart-valid"></div>
					</div>
				</div>
                <div class="row no-margin form-row">
					<div class="col-sm-5">
						<label for="">Confirm Password</label><span class="rit-coln">:</span>
					</div>
					<div class="col-sm-7">
						<input id="resetconfirm" type="password" placeholder="Enter Email Address" class="form-control form-control-sm">
						<div id="resetconfirm-err" class="smart-valid"></div>
					</div>
				</div>
				<div class="row no-margin form-row">
					<div class="col-sm-5">
						
					</div>
					<div class="col-sm-7">
						<button v-on:click="change_password()" class="btn btn-sm btn-info">Change Password</button>
					</div>
				</div>
			</div>
			<!------- Add Post Ends Here ------->


					<div id="sps" class="col-lg-6 hid app-post-cont verification-info col-md-12">

<i class="far fa-check-circle"></i>



<h4>Password Changed Sucessfully ! Thankyou</h5>

</div><!------- Add Post Ends Here ------->


		</div>
	</div>
</div>
<!------- Body Content Ends Here ------->
