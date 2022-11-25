<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body {
			Margin: 0!important;
			padding: 15px;
			background-color: #FFF;
			font-family:'Bookman Old Style';
		}
		.wrapper {
			width: 100%;
			table-layout: fixed;
			font-family:'Bookman Old Style';
		}
		.wrapper-inner {
			width: 100%;
			background-color: #eee;
			max-width: 670px;
			Margin: 0 auto;
			padding-bottom:50px;
			background-image:url('/assets/images/email_bg.jpg');
		}
		.table-1{
			
			padding: 45px;
			height: 45px;
			width: 100%;
			
		}
		.table-content{
			background-color:#FFF;
			width:500px;
			height:30px;
			float:none;
			margin:auto;
			padding:30px;
			border-radius:5px;
		}
		.table-content h2{
			color:#444;
		}
		.welcome-message{
			text-align:center;
		}
		.libnk-btn{
			padding:20px;
			background-color:#00a8df;
			width:150px;
			height:20px;
			text-align:center;
			float:none;
			margin:auto;
			color:#FFF;
			font-size:18px;
			margin-top:10px;
			margin-bottom:10px;
		}
		.libnk-btna{
			color:#FFF;
			text-decoration:none;
		}
		.final-msg{
			font-size:14px;
			text-align:center;
			line-height:22px;
		}
		.unsubs{
			text-align:center;
		}
		.uns-table{
			width:500px;
			height:30px;
			float:none;
			margin:auto;
			font-size:13px;
			margin-top:10px;
			margin-bottom:10px;
		}
		.uns-table a{
			text-decoration:underline;
		}
		/*--- Media Queries --*/
		@media screen and (max-width: 400px) {
			.h1 {
				font-size: 22px;
			}
			.two-column .column, .three-column .column {
				max-width: 100%!important;
			}
			.two-column img {
				width: 100%!important;
			}
			.three-column img {
				max-width: 60%!important;
			}
		}
		@media screen and (min-width: 401px) and (max-width: 400px) {

			.two-column .column {
				max-width: 50%!important;
			}
			.three-column .column {
				max-width: 33%!important;
			}
		}


	</style>
</head>
<body>
	<div class="wrapper">
		<div class="wrapper-inner">
			<table class="table-1">
				
			</table>
			<table  class="table-content">
				<tr>
					<th>
						<h2>Hi <?php echo $name ?> </h2>
					</th>
				</tr>
				<tr>
					<td class="welcome-message">
						<p>A password reset was requested for your email. To continue please click the below link. If you did not request this reset please ignore this email. 
						</p>				
					</td>
				</tr>
				<tr>
					<td class="link-button">
						<a class="libnk-btna" href="<?php echo $reset_link ?>">
							<div class="libnk-btn">Reset Password</div>
						</a>
						
					</td>
				</tr>


			</table>

			<table class="uns-table">	
				<tr>
					<td class="unsubs">
						<p>Dont like to recive email from us <a>Unsubscribe</a></p>
					</td>
				</tr>
			</table>
		</div> <!--- End Wrapper Inner -->
	</div> <!--- End Wrapper -->
	<br>
</body>
</html>