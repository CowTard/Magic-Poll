<?php
	session_start();
	if (isset($_SESSION['ID'])) header("Location: ./panel/dashboard.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MagicPoll - A bit of magic in your poll</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		<link rel="stylesheet" href="./css/main.css">
		<link rel="stylesheet" type="text/css" href="css/sitename.css" />
	</head>

	<body>
		<div class="content">
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container">
					<ul class="nav navbar-nav">
						<li class="active"><a href=".">Home</a></li>
						<li><a href="#">Features</a></li>
						<li><a href="#">About us</a></li>
						<li><a href="#">Support</a></li>
					</ul>
					<p class="navbar-text navbar-right"><a href="." class="navbar-link" id="login-link">Login</a> or <a href="register.php" class="navbar-link" id="register-link">Register</a></p>
				</div>
			</nav>
			
			<div id="confirmation_of_email_sent"></div>
			
			<div class="container-fluid">
				<div class="col-md-12 text-center">
					<p><img src="images/logo.png" alt="Site Logo" /></p>
					<h1>MagicPoll</h1>
				</div>
				
				<div id="register-form" class="col-sm-6 col-md-4 col-md-offset-4">
				<?php if( isset($_SESSION['errorReg'])) {
					echo '<div id="error" class="alert alert-danger" role="alert"> ' . $_SESSION['errorReg'] . '</div>'; 
					unset($_SESSION['errorReg']);
					}
				?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Sign up</h3>
						</div>
						<div class="panel-body">
							<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> 
								<form class="form-horizontal" role="form" action="./panel/register.php" method="POST">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-user"></i>
											</span> 
											<input type="text" class="form-control" name="username" id="Username" placeholder="Username" required>
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
											<input type="email" class="form-control" name="email" id="Email" placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-lock"></i>
											</span>
											<input type="password" class="form-control" name="password" id="Password" placeholder="Password">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-lock"></i>
											</span>
											<input type="password" class="form-control" name="passwordConfirmation" id="PasswordConfirm" placeholder="Retype password">
										</div>
									</div>
									<div class="form-group">
										<div class="g-recaptcha" data-sitekey="6Ld7sf4SAAAAAJX-UAL3J-mbHcMrN2LEsz3xYac8"></div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="push"></div>
		</div>
		
		<!-- Modal for contact form -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalform" aria-hidden="true" id="modalform">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Don't be too harsh on us. We are trying each day to improve this site.</h4>
					</div>
					<form id="contact-form">
						 <div class="modal-body">
							<div class="form-group">
								<label for="name">Name</label>                      
								<input id="name" type="text" class="form-control" placeholder="Your name" name="name" required/>
							</div>
							<div class="form-group">
								<label for="subject">Subject</label>                     
								<input id="subject" type="text" class="form-control" placeholder="Brief description of your message" name="subject" required/>
							</div>
							<div class="form-group">
								<label for="email">Email address</label>                        
								<input id="email" type="text" class="form-control" placeholder="Your email address" name="email" required/>
							</div>
							<div class="form-group">
								<label for="message">Message</label>
									<textarea class="form-control" placeholder="Your message here..." name="message" id="message"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success pull-right">Send It!</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="footer">
		   <div class="container">
			  <p class="text-center"><a data-toggle="modal" data-target="#modalform" href="#">[Support]</a>
			  <p class="text-center">© MagicPoll 2014 <a href="www.fe.up.pt">MIEIC@FEUP</a></p>
		   </div>
		</div>
		
		<script src="../script/jquery-1.11.1.min.js"></script>
		<script src="../script/bootstrap.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
	</body>
</html>
