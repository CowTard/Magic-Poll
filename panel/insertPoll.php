<?php
	session_start();
	require 'generalFunctions.php';
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = security($_POST["title"]);

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Poll(IDuser,Title,Votes) values(?,?,?)');
		$last_id = intval($db->lastInsertId('ID') + 1);
		var_dump($last_id);
		$dbPrepared->execute(array($_SESSION["ID"],$title,0));
		$dbPrepared->fetchAll();

		// Inserting options in database 
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
		header("Location: http://localhost:8888/LTW/panel/createPoll.php");

	}
	else {
		header("Location: http://localhost:8888/LTW");
	}

?>