<?php
	require 'generalFunctions.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nickname = security($_POST["username"]);
		$password = security($_POST["password"]);
		$passwordConf = security($_POST["passwordConfirmation"]);
		$email = security($_POST["email"]);

		/*
			VERIFY IF THERE IS ALREADY A USER WITH THIS NICKNAME
		*/

		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT * FROM Users where Nickname = ?');
		$dbPrepared->execute(array($nickname));
		$result = $dbPrepared->fetch();

		if( $password == $passwordConf && empty($result)){
			$password = password_hash(security($_POST["password"]),PASSWORD_DEFAULT);
			$db = new PDO('sqlite:../db/users.db');
			$dbPrepared = $db->prepare('INSERT INTO Users(nickname,email,password) values(?,?,?)');
			$dbPrepared->execute(array($nickname,$email,$password));
			$dbPrepared->fetchAll();
			header("Location: ..");
		}
		else{
			session_start();
			$_SESSION['errorReg'] = 'Oops... Something went wrong. Maybe it\' the username that it\'s already taken, or the passwords doesnt match.';
			$_SESSION['page'] = 'register';
    		header("Location: ..");
    	}
	}
	else {
		echo "Sorry but something went wrong.";
		header("Location: ../..");
	}
?>
