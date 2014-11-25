<?php
	require 'generalFunctions.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nickname = security($_POST["username"]);
		$password = security($_POST["password"]);

		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT * FROM Users WHERE Nickname = ?');
		$dbPrepared->execute(array($nickname));  
  		$item = $dbPrepared->fetch();

		if (password_verify($password, $item['Password'])) {
			session_start();
    		$_SESSION["ID"] = $item['Id'];
    		$_SESSION["Nickname"] = $item['Nickname'];
    		header("Location: http://localhost:8888/LTW/Panel/dashboard.php");
		} else {
    		header("Location: http://localhost:8888/LTW/");
		}
	}
	else {
		echo "Sorry but something went wrong.";
		header("Location: http://localhost:8888/LTW/");
	}
?>