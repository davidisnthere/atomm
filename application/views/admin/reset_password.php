<!doctype html>
<html lang="id">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Smart Admin Panel</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vplugins/v-map/jqvmap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin/css/style.css" />
</head>

<body>

    <div class="container-fluid h-100">
		<div class="oter-header">
			<div class="container-fluid">
				<div class="row no-margin">
				<div class="col-sm-3">
				
				<img src="<?php echo base_url() ?>upload/admin/logo.png?<?php echo date("Ymd");?>" alt="">
				
				</div>
				</div>
			</div>
		</div>
        <div class="row no-margin h-100">

          <div class="col-xl-4 col-lg-5 col-md-6 col-sm-10 login-cover">
          	<div class="login-box">
          		<div class="logo-cover d-flex align-items-center">
          			
          			<strong> Reset Password</strong>
					
					

          		</div>
          		<div class="row">
				  <?php if($this->err): ?>
					<p class="err">Email Address Wrong Pleas Try again</p>
					<?php endif; ?>
          				<form onsubmit="return validateReset()" method="post" action="<?php echo base_url() ?>admin/reset_request">
							<div class="form-group">
							   <div class="position-relative has-icon-right">
								  <label for="exampleInputUsername" class="sr-only">Email Address</label>
								  <input type="text" id="rsemail" name="name" class="form-control " placeholder="Enter Email Address">
								  <div class="smart-valid" id="rsemail-err"></div>
								  <div class="form-control-position">
									  <i class="icon-user"></i>
								  </div>
							   </div>
							  </div>
							
							  <div class="form-group align-right">
							  	<p><a href="<?php echo base_url() ?>admin/login">Try Login ?</a> 	</p>
							  </div>
							   <div class="form-group align-right">
							   	<button class="btn  btn-primary btn-round">
							   		Send Request
							   	</button>
							  </div>
						</form>
          			</div>
          	</div>
          </div>


        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/admin/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/popper.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url() ?>assets/admin/plugins/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url() ?>assets/admin/plugins/peity/jquery.peity.min.js"></script>

    <script src="<?php echo base_url() ?>assets/admin/plugins/v-map/sample-data.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/plugins/v-map/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/plugins/v-map/jquery.vmap.world.js"></script>

    <script src="<?php echo base_url() ?>assets/admin/plugins/chart-js/Chart.min.js"></script>

    <script src="<?php echo base_url() ?>assets/admin/js/script.js"></script>
</body>

</html>
