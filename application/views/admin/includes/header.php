<!doctype html>
<html lang="id">

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin Panel</title>

    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/fav.png?<?php echo date("Ymd");?>">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/fontawsom-all.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/data-table/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/data-table/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin/css/style.css" />
</head>

<body>

	<div class="container-fluid h-100">
		<div class="row no-margin h-100">

			<!--  ************************* Side Menu Starts Here ************************** -->

			<div id="sidebar" class="teft-part">
				<nav id="nav-div">
					<ul>

						<li class="bottom-line"><a href="<?php echo base_url() ?>admin"> <i class="fab fa-uikit"></i> <span> Dashboard</span></a>
						</li>
						

						<li><a href="<?php echo base_url() ?>admin/category"><i class="fas fa-cubes"></i>
								<span> Topics </span></a>
							 </li>
						<li><a href="<?php echo base_url() ?>admin/view_users"><i class="fas fa-users"></i>
								<span> View Users </span></a>
						</li>

						<li class="bottom-line"><a href="<?php echo base_url() ?>admin/view_posts"><i class="far fa-credit-card"></i>
								<span> View Post </span></a>
						</li>

						<li ><a href="<?php echo base_url() ?>admin/trash_users"><i class="far fa-trash-alt"></i>
								<span>User Trash Bin</span></a>
						</li>

						<li class="bottom-line"><a href="<?php echo base_url() ?>admin/trash_posts"><i class="fas fa-trash"></i>
								<span>Post Trash Bin</span></a>
						</li>

						<li ><a href="<?php echo base_url() ?>admin/user_settings"><i class="fas fa-user-cog"></i>
								<span> User Settings </span></a>
						</li>

						<li class="bottom-line"><a href="<?php echo base_url() ?>admin/password_setings"><i class="fas fa-user-lock"></i>
								<span> Password Settings </span></a>
						</li>

						<li class="bottom-line"><a href="<?php echo base_url() ?>admin/app_setings"><i class="fas fa-cogs"></i>
								<span> App Settings </span></a>
						</li>

				

						<!-- <li><i class="icon-grid"></i>
							<span> Settings <i class="fas rit-ico fa-caret-down"></i>
								<div class="inner-nav">
									<ul>
										<li><a href="<?php echo base_url() ?>admin/user_settings"> <i class="fas fa-angle-right"></i> Admin Settings</a></li>
										<li><a href="<?php echo base_url() ?>admin/password_setings"><i class="fas fa-angle-right"></i> Password Settings</a></li>
									</ul>
								</div>
							</span>
						</li> -->
						<li class="bottom-line"><a href="<?php echo base_url() ?>admin/log_out"><i class="fas fa-lock" style="color:red;"></i>
								<span style="color:red;"> Logout </span></a>
						</li>

					</ul>
				</nav>
			</div>
			<!-- ######## Side menu End ####### -->


			<div id="content" class="right-part">
				<!--  ************************* Header Starts Here ************************** -->
				<div class="right-header">
					<ul class="left-ul">
						<li class="nav-item">
							<a id="sidebarCollapse" class="nav-link toggle-menu" href="javascript:void();">
								<i class="icon-menu menu-icon"></i>
							</a>
						</li>
						<!-- <li class="nav-item">
							<form class="search-bar">
								<input type="text" class="form-control" placeholder="Enter keywords">
								<i class="icon-magnifier"></i>
							</form>
						</li> -->
					</ul>
					<ul class="right-ul">
						
						
						<li>
							<a class="dropdown-toggle" href="#" id="dropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img class="kijhj" src="<?php echo base_url() ?>assets/images/fav.png?<?php echo date("Ymd");?>" alt="">
							</a>
							<div class="dropdown-menu user-details" aria-labelledby="dropdownMenuLink-3">
								<ul class="list-group">
									<li class="list-group-item user-info list-title d-flex justify-content-between align-items-center">
										<a href="javaScript:void();">
											<div class="media">
												<div class="avatar">
												<img class="align-self-start mr-3 vbkmn" src="<?php echo base_url() ?>assets/images/fav.png?<?php echo date("Ymd");?>" alt="user avatar">
												</div>
												<div class="media-body">
													<h6 class="mt-2 user-title"><?php echo $this->page_detail['name'] ?></h6>
													<p class="user-subtitle"><?php echo $this->page_detail['email'] ?></p>
												</div>
											</div>
										</a>
									</li>

									

									<li class="">
									<a href="<?php echo base_url() ?>admin/user_settings">
										<i class="fas fa-user-cog  mr-2"></i> User Settings
									</a>
									</li>
									<li class="">
									<a href="<?php echo base_url() ?>admin/password_setings">				
										<i class="icon-settings  mr-2"></i> Password Settings
									</a>
									</li>
									<li class="">
									<a href="<?php echo base_url() ?>admin/log_out">			
										<i class="icon-power  mr-2"></i> Logout
									</a>
									</li>

								</ul>
							</div>
						</li>

					</ul>
				</div>
				<!-- ######## Header End ####### -->
				<!--  ************************* Content Starts Here ************************** -->
				<div class="content-container">
