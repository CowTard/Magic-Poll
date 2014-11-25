<?php
	require 'generalFunctions.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nickname = security($_POST["username"]);
		$password = password_hash(security($_POST["password"]),PASSWORD_DEFAULT);
		$email = security($_POST["email"]);

		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('INSERT INTO Users(nickname,email,password) values(?,?,?)');
		$dbPrepared->execute(array($nickname,$email,$password));
		$dbPrepared->fetchAll();
		header("Location: http://localhost:8888/LTW");
	}
	else {
		echo "Sorry but something went wrong.";
		header("Location: http://localhost");
	}

?>