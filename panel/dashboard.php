<?php
	session_start();
	if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"])){
		header("Location: ..");
		die;
	}

	require 'dashboard_header.php';

	require 'dashboard_footer.php';
?>
