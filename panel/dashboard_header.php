<?php
	session_start();
	if (!isset($_SESSION['ID']) || empty($_SESSION['ID'])){
		header("Location: ..");
		die;
	}
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
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
	   		<ul class="nav navbar-nav">
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My polls<span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="viewAllPoll.php">View polls</a></li>
		            <li><a href="createPoll.php">Create polls</a></li>
		          </ul>
		        </li>
				<li><a href="search.php">Search polls</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>
