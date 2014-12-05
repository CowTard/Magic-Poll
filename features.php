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
						<li><a href=".">Home</a></li>
						<li class="active"><a href="features.php">Features</a></li>
						<li><a href="aboutus.php">About us</a></li>
					</ul>
					<p class="navbar-text navbar-right"><a href="." class="navbar-link" id="login-link">Login</a> or <a href="register.php" class="navbar-link" id="register-link">Register</a></p>
				</div>
			</nav>
			
			<div id="confirmation_of_email_sent"></div>
            
            <div class="container-fluid">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel">
                        <div class="panel-body">
                            <h2>Features</h2>
                            <p><strong>MagicPoll</strong> supports the following features:</p>
                            <ul>
                                <li>User accounts</li>
                                <li>Create polls</li>
                                <ul>
                                    <li>Public or private</li>
                                    <li>Possibility of adding an image</li>
                                    <li>A poll may be closed by its creator</li>
                                </ul>
                                <li>View results in a pie chart</li>
                                <li>View and vote on others' polls</li>
                                <li>Get notified of changes in polls you've previously voted on</li>
                                <li>Search within the poll database</li>
                                <li>Contact the developers</li>
                            </ul>
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
			  <p class="text-center">&copy; MagicPoll 2014 <a href="http://fe.up.pt/">MIEIC@FEUP</a></p>
		   </div>
		</div>
		
		<script src="../script/jquery-1.11.1.min.js"></script>
		<script src="../script/bootstrap.min.js"></script>
	</body>
</html>
