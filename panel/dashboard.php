<?php
	session_start();
	if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"])){
		session_destroy();
		header("Location: ..");
	}

	require 'dashboard_header.php';

	require 'dashboard_footer.php';
?>