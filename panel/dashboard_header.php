<?php
	session_start();
	if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])){
		header("Location: ..");
		die;
	}

	include_once('generalFunctions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MagicPoll - A bit of magic in your poll</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/sweet-alert.css">
	</head>
	<body>
		<div class="content">
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container">
					<ul class="nav navbar-nav">
						<li><a href="dashboard.php">Dashboard</a></li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My polls<span class="caret"></span></a>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="viewMyPolls.php">View polls</a></li>
							<li><a href="createPoll.php">Create polls</a></li>
							<li><a href="votedPolls.php">Voted polls</a></li>
						  </ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Other polls<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="search.php">Show all polls</a></li>
								<li><a href="searchpoll.php">Search polls</a></li>
							</ul>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle notification" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="badge"> <?= getNotifications($_SESSION['ID']) ?> </span></a>
							<ul class="dropdown-menu notificationBox" role="menu">
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle nickname" data-toggle="dropdown" role="button" aria-expanded="false"><?= getName($_SESSION['ID']) ?><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			
			<div id="confirmation_of_email_sent"></div>
