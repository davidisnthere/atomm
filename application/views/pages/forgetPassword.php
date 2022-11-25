<!--***************************** Body Starts Here *****************************-->
<div class="body-content">


	<div class="container">

		<div id="vu-reset" class="row">
			<!-- ########## Add Post Starts Here ##########-->
			<div id="fps" class="col-lg-5 app-post-cont forget-pswd col-md-12">
				<div class="forg-title">
					<h6>Forget Password</h6>
				</div>

				<p id="errmsg">We couldn't find your account with that Email </p>	

				<div class="row no-margin form-row">
					<div class="col-sm-4">
						<label for="">Email Address</label><span class="rit-coln">:</span>
					</div>
					<div class="col-sm-8">
						<input id="reset-email" type="text" placeholder="Enter Email Address" class="form-control form-control-sm">
						<div id="loemail-err" class="smart-valid"></div>
					</div>
				</div>
				<div class="row no-margin form-row">
					<div class="col-sm-4">
						
					</div>
					<div class="col-sm-8">
						<button v-on:click="emailCkeck()" class="btn btn-sm btn-info">Reset Password</button>
					</div>
				</div>
			</div>
			<!------- Add Post Ends Here ------->


					<div id="sps" class="col-lg-6 hid app-post-cont verification-info col-md-12">

<i class="far fa-check-circle"></i>



<p>Password reset link was send to your email address please check you inbox and click the reset Button</p>

<p>If email is not found please check  spam folder</p>

</div><!------- Add Post Ends Here ------->


		</div>
	</div>
</div>
<!------- Body Content Ends Here ------->
