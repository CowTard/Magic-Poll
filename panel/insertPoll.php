<?php
	require 'generalFunctions.php';

	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = security($_POST["title"]);

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Poll(IDuser,Title,Votes) values(?,?,?)');
		$dbPrepared->execute(array($_SESSION["ID"],$title,0));
		$last_id = intval($db->lastInsertId());
		$dbPrepared->fetchAll();

		$dbPrepared = $db->prepare('UPDATE Poll SET EncodedID = ? WHERE ID = ? ');
		$dbPrepared->execute(array(sha1($last_id),$last_id));
		$dbPrepared->fetch();
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
