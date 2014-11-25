<?php
	session_start();
	if (!isset($_SESSION["ID"]) && empty($_SESSION["ID"])){
		session_destroy();
		header("Location: http://localhost:8888/LTW/");
	}
	
	require 'dashboard_header.php';

?>