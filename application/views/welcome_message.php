<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> <?php if(!empty($this->title)){ echo $this->title; } ?> </title>
	<?php if(!empty($this->page_detail['fav_icon'])): ?>
		<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/fav.png?<?php echo date("Ymd");?>">
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fontawsom-all.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/summer-note/summernote-lite.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/crope-box/jquery.cropbox.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />
</head>

<body>

	<div class="container">

		<div class="row title-demo">
			<h2>Smart Forum Demo login Details</h2>
		</div>
		<div class="row cvfg">
			<div class="col-md-6">
				<div class="demo-cover">
					<a href="<?php echo base_url() ?>pages">
						<img src="<?php echo base_url() ?>assets/images/home.jpg" alt="">
					</a>
						<div class="view">
							<h4>Demo Front End</h4>

							<div class="demo-row  row">
								<div class="col-md-4">
									<label for="">Demo Username</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									demouser@gmail.com
								</div>
							</div>

							<div class="demo-row row">
								<div class="col-md-4">
									<label for="">Demo Password</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									Demo12345
								</div>
							</div>
							<div class="demo-row row">
								<div class="col-md-4">
									<label for="">Demo link</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									<a style="color: #007bff" href="<?php echo base_url() ?>pages">Click to Open</a>
								</div>
							</div>
						</div>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="demo-cover">
					<a href="<?php echo base_url() ?>admin">
						<img src="<?php echo base_url() ?>assets/images/admin.jpg" alt="">
					</a>
						<div class="view">
							<h4>Demo Admin Panel</h4>

							<div class="demo-row  row">
								<div class="col-md-4">
									<label for="">Admin Username</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									admin
								</div>
							</div>

							<div class="demo-row row">
								<div class="col-md-4">
									<label for="">Admin Password</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									Admin12345
								</div>
							</div>

							<div class="demo-row row">
								<div class="col-md-4">
									<label for="">Demo link</label>
									<span>:</span>
								</div>
								<div class="col-md-8">
									<a style="color: #007bff" href="<?php echo base_url() ?>admin">Click to Open</a>
								</div>
							</div>
						</div>
					
				</div>
			</div>
		</div>
	</div>


</body>

<script src="<?php echo base_url() ?>assets/js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/popper.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>