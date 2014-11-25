<?php
	require 'generalFunctions.php';

	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = security($_POST["title"]);

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Poll(IDuser,Title,Votes) values(?,?,?)');
		$dbPrepared->execute(array($_SESSION["ID"],$title,0));
		$last_id = intval($db->lastInsertId()) + 1;
		$dbPrepared->fetchAll();

		/*
		 Inserting options in database 
		*/

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Options(IDPoll,OptionText) values(?,?)');

		$tamanhoPost = count($_POST);
		$tamanhoPost = $tamanhoPost - 1;

		$i = 1;
		while($i <= $tamanhoPost){
			$id = "Option" . $i;
			$dbPrepared->execute(array($last_id,security($_POST[$id])));
			$dbPrepared->fetchAll();
			$i = $i + 1;
		}
		header("Location: createPoll.php");

	}
	else {
		header("Location: ..");
	}

?>