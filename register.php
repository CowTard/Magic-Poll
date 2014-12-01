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
	</head>

	<body>

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
							    	<input type="password" class="form-control" name="passwordConfirmation" id="Password" placeholder="Password confirmation">
							    </div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-lg btn-primary btn-block">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="footer">
				<p class="text-center">© MagicPoll 2014 <a href="www.fe.up.pt">MIEIC@FEUP</a></p>
		    </div>
		</div>

		<!-- BETTER PERFORMANCE -->
		<script src="./script/jquery-1.11.1.min.js"></script>
		<script src="./script/main.js"></script>
		<script src="./script/bootstrap.min.js"></script>
	</body>
</html>