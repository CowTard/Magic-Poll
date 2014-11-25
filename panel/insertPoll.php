<?php
	session_start();
	require 'generalFunctions.php';
	$last_id = 1;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$title = security($_POST["title"]);
		$option1 = security($_POST["Option1"]);
		$option2 = security($_POST["Option2"]);

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Poll(IDuser,Title,Votes) values(?,?,?)');
		$dbPrepared->execute(array($_SESSION["ID"],$title,0));
		$dbPrepared->fetchAll();

		$db = new PDO('sqlite:../db/polls.db');
		$dbPrepared = $db->prepare('INSERT INTO Options(IDPoll,OptionText) values(?,?)');
		$dbPrepared->execute(array($last_id,$option1));
		$dbPrepared->fetchAll();

		header("Location: http://localhost:8888/LTW/panel/createPoll.php");

	}
	else {
		header("Location: http://localhost:8888/LTW");
	}

?>