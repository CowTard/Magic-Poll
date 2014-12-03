<?php
	require 'generalFunctions.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Ld7sf4SAAAAAB2hJBlvXJrzBwRTb5LocDE6rFEu&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
		$recaptcha_result = json_decode($recaptcha, true);
		
		if (!$recaptcha_result['success']) {
			session_start();
			$_SESSION['errorReg'] = 'Are you a bot? O.o Ain\'t nobody got time fo\' dat!';
			header('Location: ../register.php');
			exit;
		}
		
		$nickname = security($_POST['username']);
		$password = security($_POST['password']);
		$passwordConf = security($_POST['passwordConfirmation']);
		$email = security($_POST['email']);

		/*
			VERIFY IF THERE IS ALREADY A USER WITH THIS NICKNAME
		*/

		$db = new PDO('sqlite:../db/users.db');
		$dbPrepared = $db->prepare('SELECT * FROM Users where Nickname = ?');
		$dbPrepared->execute(array($nickname));
		$result = $dbPrepared->fetch();

		if ($password == $passwordConf && empty($result)) {
			$password = password_hash(security($_POST["password"]),PASSWORD_DEFAULT);
			$db = new PDO('sqlite:../db/users.db');
			$dbPrepared = $db->prepare('INSERT INTO Users(nickname,email,password) values(?,?,?)');
			$dbPrepared->execute(array($nickname,$email,$password));
			$dbPrepared->fetchAll();
			header('Location: ..');
		}
		else {
			session_start();
			$_SESSION['errorReg'] = 'Oops... Something went wrong. Maybe the username is already taken, or the passwords don\'t match.';
    		header('Location: ../register.php');
    	}
	}
	else {
		echo 'Sorry but something went wrong.';
		header('Location: ../..');
	}
?>
